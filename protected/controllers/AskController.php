<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
class AskController extends Controller {

    public $layout = 'askLayout1';

    /**
     * new ask
     */
    public function actionNew() {

        $listShop = $listStack = array();

        $model = new AskModel;

        if (isset($_POST['AskModel'])) {
            $model->attributes = $_POST['AskModel'];
            //check is login email
            if (Yii::app()->session['email'])
                $model->email = Yii::app()->session['email'];
            //process tag
            if (isset($_POST['AskModel']['tag'])) {
                $listStack = $_POST['AskModel']['tag'];
                $tags = array();
                $listTag = ExtensionSearch::getAllTag();
                foreach ($listStack as $tag) {
                    $tags[$tag] = $listTag[$tag];
                }
                $model->tag = json_encode($tags);
            }
            if (isset($_POST['AskModel']['shop'])) {
                $listShop = $_POST['AskModel']['shop'];
            }

            if ($model->validate()) {
                $isLogin = GlobalComponents::isLogin();
                if ($isLogin) {
                    $model->isAuth = 1;
                } else {
                    $model->isAuth = 0;
                    //send email auth
                }
                //save into database
                $model->save();
                //insert to repli tag
                if (isset($listStack))
                    ExtensionSearch::insertToRepliTag($model->id, $listStack);
                //process shop
                if ($listShop) {
                    //insert to ask shop
                    ExtensionSearch::insertToRepliShop($model->id, $listShop, $model->isAuth);
                }
                if ($model->isAuth) {
                    $this->redirect(array('ask/view'));
                } else {
                    $this->render('add/newNotify', array('model' => $model));
                    exit();
                }
                //insert to search
                if ($model->id && $model->title && $model->content && $model->email && $model->mobileNumber) {
                    $arrayUpdate = array(
                        'id' => $model->id,
                        'title' => $model->title,
                        'content' => $model->content,
                        'email' => $model->email,
                        'mobile' => $model->mobileNumber,
                    );
                    Yii::app()->askSearch->updateOne($arrayUpdate);
                    //end insert to solr
                } elseif ($model->id && $model->title && $model->content && $model->email) {
                    $arrayUpdate = array(
                        'id' => $model->id,
                        'title' => $model->title,
                        'content' => $model->content,
                        'email' => $model->email,
                    );
                    Yii::app()->askSearch->updateOne($arrayUpdate);
                }
                //end insert to search.
            }
        }

        $this->render('add/new', array('model' => $model, 'listShop' => $listShop, 'listStack' => $listStack));
    }

    /**
     * list shop view
     */
    public function listShopViewColum() {
        $listShopUyTin = ExtensionSearch::listShopUyTin();
        $this->renderPartial('shop/listColum', array('listShopUyTin' => $listShopUyTin));
    }

    /**
     * view
     */
    public function actionView() {
        $type = isset($_GET['type']) ? $_GET['type'] : '0';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $item = isset(Yii::app()->request->cookies['setItem']) ? Yii::app()->request->cookies['setItem']->value : 30;

        //begin set cache
        $keycache = 'view_ask_' . $type . '_' . $page . '_' . $item;
        $dataProvider = Yii::app()->cache->get($keycache);
        if ($dataProvider === false) {
            $condition = '`isAuth` = 1';

            if ($type == 1) {
                $condition .= ' AND `status` = 0';
            } elseif ($type == 2) {
                $condition .= ' AND `status` = 1';
            }

            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => 'lastUpdate DESC',
                    ));

            $criteria->limit = $item;
            $criteria->offset = ($page - 1) * $item;

            $dataProvider = new CActiveDataProvider('AskModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));

            $dataProvider = $dataProvider->getData();

            Yii::app()->cache->set($keycache, $dataProvider, 5);
        }
        //end set cache
        //add comment value

        $this->commentProcess();

        if ($page > 1) {
            $this->renderPartial('view/list', array('dataProvider' => $dataProvider));
            exit();
        }

        $this->render('view/index', array('dataProvider' => $dataProvider));
    }

    /**
     * list ask
     */
    public function listAsk($dataProvider) {
        $this->renderPartial('view/list', array('dataProvider' => $dataProvider));
    }

    /**
     * get list ask throught tag id
     */
    public function actionTag() {
        $tagId = isset($_GET['id']) ? $_GET['id'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $item = isset(Yii::app()->request->cookies['setItem']) ? Yii::app()->request->cookies['setItem']->value : 30;

        $keycache = 'ask_tag_' . $tagId . '_' . $page . '_' . $item;

        $dataProvider = Yii::app()->cache->get($keycache);
        if ($dataProvider === false) {
            $condition = '`id` IN (SELECT `askId`  FROM {{ask_tag}} WHERE `tagId` = \'' . $tagId . '\')';
            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => 'lastUpdate DESC',
                    ));
            $criteria->limit = $item;
            $criteria->offset = ($page - 1) * $item;

            $dataProvider = new CActiveDataProvider('AskModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));

            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keycache, $dataProvider, 5);
        }

        //add comment value

        $this->commentProcess();

        $this->render('view/index', array('dataProvider' => $dataProvider, 'tagId' => $tagId));
    }

    /**
     * get list ask throught tag id
     */
    public function actionSearch() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $condition = '`id` < 0';
        $tagId = '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $item = isset(Yii::app()->request->cookies['setItem']) ? Yii::app()->request->cookies['setItem']->value : 30;
        $office = ($page - 1) * $item;
        $listId = '';
        if ($keyword) {
            $string = $keyword;
            $string1 = '"' . $keyword . '"';
            $result = Yii::app()->askSearch->get('content:' . $string1 . '^60 OR content:' . $string . '^10 OR title:' . $string1 . '^100 OR title:' . $string . '^20', $office, $item);
            if (isset($result->response->docs)) {
                foreach ($result->response->docs as $doc) {
                    $listId .= ',' . $doc->id;
                }
            }
            if (strlen($listId) > 1) {
                $listId = substr($listId, 1);
                $condition = '`id` IN (' . $listId . ')';
            }
        }

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => 'lastUpdate DESC',
                ));
        $criteria->limit = $item;
        $criteria->offset = ($page - 1) * $item;

        $dataProvider = new CActiveDataProvider('AskModel', array(
                    'pagination' => false,
                    'criteria' => $criteria,
                ));

        $dataProvider = $dataProvider->getData();

        //add comment value

        $this->commentProcess();

        $this->render('view/search', array('dataProvider' => $dataProvider, 'tagId' => $tagId, 'keyword' => $keyword));
    }

    /**
     * get list comment throught ask id
     */
    public function ListComment($askId) {
        $itemCount = 0;
        $keycache = 'listComment_' . $askId;
        $dataProvider = Yii::app()->cache->get($keycache);
        if ($dataProvider === false) {
            $command = Yii::app()->db->createCommand();
            $command->select('*');
            $command->from('{{ask_report}}');
            $command->where = '`askId` = ' . $askId;
            $rawData = $command->queryAll();
            $dataProvider = new CArrayDataProvider($rawData, array(
                        'sort' => array(
                            'defaultOrder' => 'createDate ASC',
                            'attributes' => array(
                                'createDate'
                            ),
                        ),
                        'pagination' => false,
                    ));

            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keycache, $dataProvider, 5);
        }

        $itemCount = Yii::app()->cache->get('listcomment_count_' . $askId);
        if ($itemCount === false) {
            $itemCount = AskReport::model()->count("askId=:askId", array("askId" => $askId));
            Yii::app()->cache->set('listcomment_count_' . $askId, $itemCount, 5);
        }

        $this->renderPartial('view/listComment', array('dataProvider' => $dataProvider, 'itemCount' => $itemCount, 'askId' => $askId));
    }

    /**
     * list comment all
     */
    public function actionListCommentAll() {
        $askId = isset($_POST['askId']) ? $_POST['askId'] : '';
        if ($askId) {
            $dataProvider = Yii::app()->cache->get('list_comment_all_' . $askId);
            if ($dataProvider === false) {
                $command = Yii::app()->db->createCommand();
                $command->select('*');
                $command->from('{{ask_report}}');
                $command->where = '`askId` = ' . $askId;
                $rawData = $command->queryAll();
                $dataProvider = new CArrayDataProvider($rawData, array(
                            'sort' => array(
                                'defaultOrder' => 'createDate ASC',
                                'attributes' => array(
                                    'createDate'
                                ),
                            ),
                            'pagination' => false,
                        ));

                $dataProvider = $dataProvider->getData();
                Yii::app()->cache->set('list_comment_all_' . $askId, $dataProvider, 5);
            }
            $this->renderPartial('listCommentAll', array('dataProvider' => $dataProvider, 'askId' => $askId));
        }
    }

    /**
     * list comment all
     */
    public function actionListCommentPrice() {
        $askId = isset($_POST['askId']) ? $_POST['askId'] : '';
        if ($askId) {
            $dataProvider = Yii::app()->cache->get('ask_ListCommentPrice_' . $askId);
            if ($dataProvider === false) {
                $command = Yii::app()->db->createCommand();
                $command->select('*');
                $command->from('{{ask_report}}');
                $command->where = '`askId` = ' . $askId . ' AND `price` > 1000';
                $rawData = $command->queryAll();
                $dataProvider = new CArrayDataProvider($rawData, array(
                            'sort' => array(
                                'defaultOrder' => 'price ASC',
                                'attributes' => array(
                                    'createDate'
                                ),
                            ),
                            'pagination' => false,
                        ));

                $dataProvider = $dataProvider->getData();
                Yii::app()->cache->set('ask_ListCommentPrice_' . $askId, $dataProvider, 5);
            }

            $this->renderPartial('listCommentAll', array('dataProvider' => $dataProvider, 'askId' => $askId));
        }
    }

    /**
     * detail
     */
    public function actionDetail() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $this->ViewPlus($id);
        $itemCount = 0;
//        $askData = AskModel::model()->findByPk($id);

        $askData = Yii::app()->cache->get('askModel_byId_' . $id);
        if ($askData === false) {
            $askData = AskModel::model()->findByPk($id);
            Yii::app()->cache->set('askModel_byId_' . $id, $askData, 60 * 60);
        }

        if (!$askData) {
            $this->redirect(array('ask/view', 'type' => '1', 'name' => 'can-mua'));
        }
        $dataProvider = Yii::app()->cache->get('AskReport_By_askId_' . $id);

        $itemCount = Yii::app()->cache->get('AskReport_itemcount_By_askId_' . $id);

        if ($dataProvider === false || $itemCount === false) {

            $criteria = new CDbCriteria(array(
                        'condition' => '`askId` = ' . $id,
                        'order' => '`id` ASC',
                    ));

            $dataProvider = new CActiveDataProvider('AskReport', array(
                        'pagination' => array(
                            'pageSize' => 30,
                        ),
                        'criteria' => $criteria,
                    ));

            $itemCount = $dataProvider->totalItemCount;
            Yii::app()->cache->set('AskReport_itemcount_By_askId_' . $id, $itemCount, 500);

            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set('AskReport_By_askId_' . $id, $dataProvider, 500);
        }

        $this->commentProcess();

        $mail = isset($_GET['m']) ? $_GET['m'] : ''; //check by read email
        if ($mail) {
            $emailModel = AskEmail::model()->findByPk($mail);
            if ($emailModel) {
                $emailModel->isOpen = 1;
                $emailModel->openDate = new CDbExpression('NOW()');
                $emailModel->hash = md5($id . '_' . $emailModel->email . $emailModel->openDate);
                $emailModel->update();
            }
        }

        $this->render('detail/view', array('dataProvider' => $dataProvider, 'askData' => $askData, 'itemCount' => $itemCount));
    }

    /**
     * replation ask
     */
    public function replationAsk($keyword, $askId = 0) {
        $string = $keyword;
        $string1 = '"' . $keyword . '"';
        $result = Yii::app()->askSearch->get('content:' . $string1 . '^60 OR content:' . $string . '^10 OR title:' . $string1 . '^100 OR title:' . $string . '^20', 0, 8);
        if (isset($result->response->docs))
            $this->renderPartial('detail/replicate', array('result' => $result, 'askId' => $askId));
    }

    /**
     * ask plus
     * xu ly cache cho phep cap nhat visit sau 3s.
     */
    public function ViewPlus($askId) {
        if ($askId) {
            //check model cache 
            //cache name for AskModel
            $model = Yii::app()->cache->get('askModel_byId_' . $askId);
            if ($model === false) {
                $model = AskModel::model()->findByPk($askId);
                Yii::app()->cache->set('askModel_byId_' . $askId, $model, 60 * 60);
            }
            //add plus
            if ($model) {
                /**
                 * kiem tra cache 24h cho visit va lay ra gia tri cache ma he thong dang luu
                 * Neu cache da ton chua ton tai thi set gia tri 1, neu da ton tai thi cong them 1
                 */
                $plus24h = Yii::app()->cache->get('plus_24h_' . $askId);
                if ($plus24h === false) {
                    $plus24h = 1;
                    Yii::app()->cache->set('plus_24h_' . $askId, $plus24h, 24 * 60 * 60);
                } else {
                    $plus24h++;
                    Yii::app()->cache->set('plus_24h_' . $askId, $plus24h, 24 * 60 * 60);
                }
                $plus5s = Yii::app()->cache->get('plus_5s_' . $askId);
                if ($plus5s === false) {//kiem tra cache 5s, neu co khong co thi duoc phep cong
                    $model->visit = $model->visit + $plus24h;
                    $model->update();
                    Yii::app()->cache->set('askModel_byId_' . $askId, $model, 60 * 60);
                    Yii::app()->cache->set('plus_5s_' . $askId, 1, 5);
                    Yii::app()->cache->set('plus_24h_' . $askId, 0, 24 * 60 * 60);
                }
            }
        }
    }

    /**
     * shop infomation
     */
    public function actionShop() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $shop = AdExtension::getShopById($id);
        if ($shop)
            $this->render('shop/detail', array('shop' => $shop));
    }

    /**
     * get tag
     */
    public function actionGetTag() {
        $string = isset($_POST['string']) ? $_POST['string'] : '';
        $listTag = ExtensionSearch::getAllTag();
        $stackhay = ExtensionSearch::getSearchTag();
        $stack = array();
        if ($string) {
            $arr = explode(' ', $string);
            foreach ($arr as $key => $value) {
                $input = ExtensionClass::textProcessingSeach($value);
                $result = array_filter($stackhay, function ($item) use ($input) {
                            if (stripos($item, $input) !== false) {
                                return true;
                            }
                            return false;
                        });
                $stack = array_merge($stack, $result);
            }
        }
        $stack = array_unique($stack);

        foreach ($stack as $key => $value) {
            if (isset($listTag[$key]) && stripos(ExtensionClass::textProcessingSeach($string), $value) !== false)
                echo '<li id="tag_' . $key . '" class="selected-btn"><span>' . $listTag[$key] . '</span><a class="close" onclick="removeTag(\'' . $key . '\');" href="javascript:void(0);"></a><input type="hidden" name="AskModel[tag][]" value="' . $key . '" /></li>';
        }
    }

    /**
     * comment process
     */
    public function commentProcess() {
        $model = new AskReport();
        if (isset($_POST['AskReport'])) {
            $model->attributes = $_POST['AskReport'];
            $model->email = Yii::app()->session['email'];
            $model->userId = Yii::app()->session['userId'];
            $model->hash = md5($model->comment . '_' . $model->askId . '_' . $model->userId);
            if ($model->link == 'Link tham khảo (nếu có)')
                $model->link = '';
            if ($model->comment == 'Nội dung')
                $model->comment = '';
            if ($model->validate()) {
                $model->save();
            }
            //redirect to comment
            $this->redirect('#show_comment_' . $model->askId);
        }
    }

    /**
     * get shop info
     */
    public function actionGetShop() {
        $description = isset($_POST['dest']) ? $_POST['dest'] : '';
        if ($description) {
            $listDest = explode('.', $description);
            echo '<div id="runtimeGetShop" class="previewShop">
                <p style="margin: 10px 0px 5px 0px; font-style: italic; color: #666">Hệ thống tự động tìm kiếm và gửi yêu cầu của bạn tới các đơn vị cung cấp sản phẩm, dịch vụ.</p>
                <ul class="check-seller clearfix">';
            foreach ($listDest as $string) {
                $string1 = '"' . $string . '"';
                $result = Yii::app()->shopSearch->get('content:' . $string1 . '^100 OR content:' . $string . '^10', 0, 5);
                if ($result) {
                    foreach ($result->response->docs as $doc) {
                        $shop = ExtensionSearch::getShopByShopId($doc->id);
                        echo '<li>
                        <div class="check"><input type="checkbox"name="AskModel[shop][]" checked="true" value="' . $doc->id . '" id="shopIdentify_' . $doc->id . '" /></div>
                        <div class="seller">
                        <span class="logo-seller"><img width="30px" src="' . $shop->logo . '" /></span>
                        <label for="shopIdentify_' . $doc->id . '">' . $shop->name . '</label>
                    </div>
                </li>';
                    }
                }
            }
            echo '</ul></div>';
        }
    }

    /**
     * banner a2b
     */
    public function bannerA2b() {
        //check coookie
        $cookieCheck = Yii::app()->request->cookies['a2bBanner'];

        if (!$cookieCheck) {
            $this->renderPartial('bannerA2b');
        }
    }

    /**
     * banner a2b
     */
    public function actionHiddenbannerA2b() {
        $isHidden = isset($_POST['isHidden']) ? $_POST['isHidden'] : '';
        $cookie = new CHttpCookie('a2bBanner', $isHidden);
        $cookie->expire = time() + 60 * 60 * 24 * 180;
        if ($isHidden) {
            Yii::app()->request->cookies['a2bBanner'] = $cookie;
        }
        echo 'Success';
    }

    /**
     * top bar
     */
    public function topBar() {
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->renderPartial('topbar');
    }

    /**
     * pagging
     */
    public function pagers() {
        $resultCount = 30 * 140;
        $pages = new CPagination($resultCount);
        $this->renderPartial('pagers', array('pages' => $pages, 'resultCount' => $resultCount));
    }

    /**
     * banner sort
     */
    public function bannerSort() {
        $item = isset(Yii::app()->request->cookies['setItem']) ? Yii::app()->request->cookies['setItem']->value : 30;
        $this->renderPartial('bannerSort', array('item' => $item));
    }

    /**
     * set item
     */
    public function actionSetItem() {
        $item = isset($_POST['item']) ? $_POST['item'] : 30;
        $cookie = new CHttpCookie('setItem', $item);
        $cookie->expire = time() + 60 * 60 * 24 * 180;
        Yii::app()->request->cookies['setItem'] = $cookie;
        echo 'Success';
    }

    /**
     * Shop email
     */
    public function actionShopEmail() {
        $model = AskShop::model()->find('type = 1');
        if (isset($model->shopId) && isset($model->askId)) {
            $ShopModel = ShopModel::model()->findByPk($model->shopId);
            //ask cache by ask id
            $AskModel = Yii::app()->cache->get('askModel_byId_' . $model->askId);
            if ($AskModel === false) {
                $AskModel = AskModel::model()->findByPk($model->askId);
                Yii::app()->cache->set('askModel_byId_' . $model->askId, $AskModel, 60 * 60);
            }

            $shopEmail = new ShopEmail;
            $shopEmail->shopId = $model->shopId;
            $shopEmail->email = $ShopModel->email;
            $shopEmail->title = $AskModel->title;
            $content = '<p>Chào bạn.</p>
        <p>Chủ đề <a href="http://saobang.vn' . Yii::app()->createUrl('ask/detail', array('id' => $AskModel->id, 'title' => ExtensionClass::utf8_to_ascii($AskModel->title))) . '">' . $AskModel->title . '</a> từ email ' . $AskModel->email . ' hỏi báo giá của bạn.</p>
        <p style="padding: 5px 30px; border-left: 1px solid #333; color: #333;">' . $AskModel->content . '</p>
        <p>Xem chi tiết <a href="http://saobang.vn' . Yii::app()->createUrl('ask/detail', array('id' => $AskModel->id, 'title' => ExtensionClass::utf8_to_ascii($AskModel->title))) . '">tại đây</a>
            <p><strong><i>Support saobang.vn</></strong></p>
        </p>';
            $shopEmail->content = $content;
            if ($shopEmail->validate()) {
                //update status
                $model->type = 2;
                $model->update();
                //save and send email
                $shopEmail->save();
                echo 'Success';
            } else {
                echo 'Error save';
            }
        } else {
            echo 'Not found';
        }
    }

    /**
     * change auth
     */
    public function actionIsAuth() {
        $isOk = 0;
        $askId = isset($_GET['askId']) ? $_GET['askId'] : '';
        $hash = isset($_GET['hash']) ? $_GET['hash'] : '';
        if (md5($askId . 'saobang.vnauth') == $hash) {
            $model = Yii::app()->cache->get('askModel_byId_' . $askId);
            if ($model === false) {
                $model = AskModel::model()->findByPk($askId);
                Yii::app()->cache->set('askModel_byId_' . $askId, $model, 60 * 60);
            }
            //kiem tra neu chua xac thuc
            if ($model->isAuth == 0) {
                $model->isAuth = 1;
                $model->update();
                Yii::app()->cache->set('askModel_byId_' . $askId, $model, 60 * 60);
                //update ask shop
                $sql = "UPDATE `{{ask_shop}}` SET `type` = '1' WHERE `askId` = " . $askId;
                $command = Yii::app()->db->createCommand($sql);
                $command->execute();
            }
            $isOk = 1;
        }
        $this->render('isAuth', array('isOk' => $isOk));
    }

    /**
     * ask search form
     */
    public function searchForm() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : 'Ví dụ: Cần mua iphone cũ..';
        $this->renderPartial('searchForm', array('keyword' => $keyword));
    }

    /**
     * shop register
     */
    public function actionShopRegister() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = ShopModel::model()->findByPk($id);
            $modelIdentify = ShopIdentify::model()->findByPk($id);
        } else {
            $model = new ShopModel;
            $modelIdentify = new ShopIdentify;
        }
        $modelTag = new tagModel();

        //lay danh muc nganh hang
        $listShopCategory = AdExtension::getListShopCategory();
        if (isset($_POST['ShopModel']) && isset($_POST['ShopIdentify'])) {
            $model->attributes = $_POST['ShopModel'];
            $modelIdentify->attributes = $_POST['ShopIdentify'];
            $listCategory = isset($_POST['ShopModel']['category']) ? $_POST['ShopModel']['category'] : array();
            $model->category = json_encode($listCategory);
            if ($model->validate() && $modelIdentify->validate()) {
                $model->save();
                $modelIdentify->save();
                ExtensionSearch::insertCategoryShop($model->id, $listCategory);
                $this->render('shop/registerComplate');
                exit();
            }
        }
        $this->render('shop/register', array('model' => $model, 'listShopCategory' => $listShopCategory, 'modelTag' => $modelTag, 'modelIdentify' => $modelIdentify));
    }

    /**
     * topPage
     */
    public function topPage() {
        list($lobalController) = Yii::app()->createController('global/topPage');
        return $lobalController->topPage();
    }

    /**
     * fotter page
     * @return type
     */
    public function footerPage() {
        list($lobalController) = Yii::app()->createController('global/footerPage');
        return $lobalController->footerPage();
    }

    /**
     * banner ad
     */
    public function bannerAd() {
        list($lobalController) = Yii::app()->createController('global/bannerAd');
        return $lobalController->bannerAd();
    }

    /**
     * gooogle ad
     */
    public function googleAd() {
        list($lobalController) = Yii::app()->createController('global/googleAd');
        return $lobalController->googleAd();
    }

    /**
     * set local
     */
    public function setLocal() {
        list($lobalController) = Yii::app()->createController('global/setLocal');
        return $lobalController->setLocal();
    }

    /**
     * get list shop
     */
    public function getListShopVip() {
        $criteria = new CDbCriteria(array(
                    'order' => '`rank` DESC',
                ));
        $criteria->limit = 7;
        $dataProvider = new CActiveDataProvider('ShopModel', array(
                    'pagination' => false,
                    'criteria' => $criteria,
                ));
        $dataProvider = $dataProvider->getData();

        $this->renderPartial('view/listShop', array('dataProvider' => $dataProvider));
    }

    /**
     * list shop
     */
    public function actionListShop() {
        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $condition = '';
        if ($categoryId) {
            $listId = AdExtension::getListShopIdByCategoryId($categoryId);
            if ($listId) {
                $condition = '`id` IN (' . $listId . ')';
            }
        }
        $keyCache = 'ask_listShop_' . $categoryId;
        $dataProvider = Yii::app()->cache->get($keyCache);
        if ($dataProvider === false) {
            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`id` DESC',
                    ));

            $dataProvider = new CActiveDataProvider('ShopModel', array(
                        'pagination' => array(
                            'pageSize' => 30,
                        ),
                        'criteria' => $criteria,
                    ));
            $dataProvider = $dataProvider->getData();

            Yii::app()->cache->set($keyCache, $dataProvider, AdExtension::_btime);
        }


        $this->render('shop/view', array('dataProvider' => $dataProvider, 'categoryId' => $categoryId));
    }

    /**
     * category lisst
     */
    public function categoryShop() {
        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
        $listShopCategory = AdExtension::getListShopCategory();
        $this->renderPartial('categoryShop', array('listShopCategory' => $listShopCategory, 'categoryId' => $categoryId));
    }

    /**
     * remove ask
     */
    public function actionRemove() {
        $this->layout = 'popup';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $isDelete = isset($_GET['isDelete']) ? $_GET['isDelete'] : '';
        if (Yii::app()->user->id) {
            $askModel = AskModel::model()->findByPk($id);
            if ($isDelete) {
                $askModel->delete();
                $this->redirect(array('ask/view', 'type' => '1', 'name' => 'can-mua'));
            }
            $this->render('delete', array('askModel' => $askModel));
        }
    }

}