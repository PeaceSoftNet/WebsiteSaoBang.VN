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
class AdController extends Controller {

    const _key_filter = 'ad_setFilter_valueCache_';

    protected $flag, $email, $openData, $userInfo;
    public $layout = 'adLayout1';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'maxLength' => 3,
                'minLength' => 2,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * ad index 
     * trang chu rao vat
     */
    public function actionIndex() {
        $keyCache = 'ad_index_category';
//         Yii::app()->cache->flush();
        $dataProvider = Yii::app()->cache->get($keyCache);
        if ($dataProvider === false) {
            $condition = '`isHidden` = 0';

            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`order` DESC, `name` ASC '
                    ));

            $dataProvider = new CActiveDataProvider('CategoryModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));

            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keyCache, $dataProvider, AdExtension::_forever);
        }
        $this->render('home/index', array('dataProvider' => $dataProvider));
    }

    /**
     * get top ask content
     */
    public function getTopAsk() {
        $keycache = 'adHome_getTopAsk';
        $dataProvider = Yii::app()->cache->get($keycache);
        if ($dataProvider === false) {
            $condition = '`isAuth` = 1';
            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => 'lastUpdate DESC',
                    ));
            $criteria->limit = 5;

            $dataProvider = new CActiveDataProvider('AskModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));

            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keycache, $dataProvider, 300);
        }
        $this->renderPartial('topask', array('dataProvider' => $dataProvider));
    }

    /**
     * home local
     */
    public function homeLocal() {
        $localKey = isset($_POST['localKey']) ? $_POST['localKey'] : 0;
        $condition = '`parentId` = 0';

        $keyCache = 'get_loCal_' . $localKey;

        $dataProviderLocality = Yii::app()->cache->get($keyCache);
        if ($dataProviderLocality === false) {

            $criteriaLocality = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`order` DESC',
                    ));

            if ($localKey)
                $criteriaLocality->addSearchCondition('name', $localKey);

            $dataProviderLocality = new CActiveDataProvider(LocationModel::model()->cache(3600, NULL), array(
                        'pagination' => FALSE,
                        'criteria' => $criteriaLocality,
                    ));
            $dataProviderLocality = $dataProviderLocality->getData();

            Yii::app()->cache->set($keyCache, $dataProviderLocality, AdExtension::_forever);
        }

        $this->renderPartial('home/local', array('dataProviderLocality' => $dataProviderLocality));
    }

    /**
     * local ajax
     */
    public function actionHomeLocalAjx() {
        self::homeLocal();
    }

    /**
     * home notify
     */
    public function homeNotify() {
        $keyCache = 'home_notify_value';
        $notify = Yii::app()->cache->get($keyCache);
        if ($notify === false) {
            $criteriaNotify = new CDbCriteria(array(
                        'order' => '`id` DESC',
                    ));
            $criteriaNotify->limit = 4;

            $dataProviderNotify = new CActiveDataProvider(NotifySlaveModel::model()->cache(6000, NULL), array(
                        'pagination' => false,
                        'criteria' => $criteriaNotify,
                    ));
            $notify = $dataProviderNotify->getData();

            Yii::app()->cache->set($keyCache, $notify, AdExtension::_forever);
        }

        $this->renderPartial('home/notify', array('notify' => $notify));
    }

    /**
     * notify
     */
    public function actionNotify() {
        $id = isset($_GET['id']) ? $_GET['id'] : 5;
        if ($id) {
            $model = Yii::app()->cache->get('home_Notify_' . $id);
            if ($model === false) {
                $model = NotifyModel::model()->findByPk($id);
                Yii::app()->cache->set('home_Notify_' . $id, $model, 3600);
            }
            //begin load main content
            $keyCache = 'ad_notify_list_' . $id;
            $dataProvider = Yii::app()->cache->get($keyCache);
            $condition = '`id` != ' . $id;
            if ($dataProvider === false) {
                $criteria = new CDbCriteria(array(
                            'condition' => $condition,
                            'order' => '`id` DESC'
                        ));

                $dataProvider = new CActiveDataProvider('NotifyModel', array(
                            'pagination' => false,
                            'criteria' => $criteria,
                        ));

                $dataProvider = $dataProvider->getData();

                Yii::app()->cache->set($keyCache, $dataProvider, AdExtension::_btime);
            }
            $this->render('notify', array('model' => $model, 'dataProvider' => $dataProvider));
        }
    }

    /**
     * get vip
     */
    public function getAdVip($ordername, $ordertype) {
        $keycache = 'home_ad_dataProviderAd_' . $ordername . '_' . $ordertype;
        $dataProviderAd = Yii::app()->cache->get($keycache);

        if ($dataProviderAd === false) {
            $listRand = array('0' => 'id', '1' => 'title', '2' => 'icon', '3' => 'createDate', '4' => 'categoryId', '5' => 'timeValue', '6' => 'id',);
            $typeRand = array('0' => 'ASC', '1' => 'DESC', '2' => 'ASC');
            $conditionAd = '`timeValue` >= ' . time();
            $criteriaAd = new CDbCriteria(array(
                        'condition' => $conditionAd,
                        'order' => '`sms` DESC, ' . $listRand[$ordername] . ' ' . $typeRand[$ordertype],
                    ));
            $criteriaAd->limit = 8;

            $dataProviderAd = new CActiveDataProvider(TopicAd::model()->cache(6, NULL), array(
                        'pagination' => false,
                        'criteria' => $criteriaAd,
                    ));

            $dataProviderAd = $dataProviderAd->getData();

            Yii::app()->cache->set($keycache, $dataProviderAd, AdExtension::_forever);
        }

        return $dataProviderAd;
    }

    /**
     * home vip
     */
    public function homeVip() {
        $ordername = rand(0, 6);
        $ordertype = rand(0, 2);
        $dataProviderAd = self::getAdVip($ordername, $ordertype);
        $this->renderPartial('home/vip', array('dataProviderAd' => $dataProviderAd));
    }

    /**
     * detail vip
     */
    public function vipDetailPage() {
        $ordername = rand(0, 6);
        $ordertype = rand(0, 2);
        $dataProviderAd = self::getAdVip($ordername, $ordertype);
        $this->renderPartial('left/vipDetailPage', array('dataProviderAd' => $dataProviderAd));
    }

    /**
     * ad new
     */
    public function actionStep1() {
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

        $keyCache = 'ad_index_category';

        $timeCache = AdExtension::_forever;

        $condition = '`isHidden` = 0';

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC, `name` ASC '
                ));
        if ($keyword) {
            $criteria->addSearchCondition('name', $keyword);
            $keyCache = 'ad_index_category' . substr(md5($keyword), 0, 8);
            $timeCache = AdExtension::_stime;
        }

        $dataProvider = Yii::app()->cache->get($keyCache);
        if ($dataProvider === false) {

            $dataProvider = new CActiveDataProvider('CategoryModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));

            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keyCache, $dataProvider, $timeCache);
        }
        $this->render('new/step1', array('dataProvider' => $dataProvider));
    }

    /**
     * buoc 2
     * step 2
     */
    public function actionStep2() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : 0;
        $childCategoryId = isset($_GET['childCategoryId']) ? $_GET['childCategoryId'] : 0;
        if (!$categoryId || !$childCategoryId) {
            $this->redirect(array('ad/step1'));
        }
        $imgUpload = isset($_POST['imgUpload']) ? $_POST['imgUpload'] : array();
        if ($id) {
            $model = AdExtension::getTopicById($id);

            $modelDetail = AdExtension::getTopicDetailById($id);
            if (!Yii::app()->user->id) {
                if ($model->email != Yii::app()->session['email']) {
                    $this->redirect(array('ad/step1'));
                }
                if (Yii::app()->session['email']) {
                    $model->email = Yii::app()->session['email'];
                }
            }
        } else {
            $model = new TopicModel;
            $modelDetail = new TopicDetail;
            //set value by post ajax
            $model->id = $modelDetail->id = $this->createTopicId();
        }
        if (isset($_POST['TopicModel']) && isset($_POST['TopicDetail'])) {
            $model->attributes = $_POST['TopicModel'];
            $modelDetail->attributes = $_POST['TopicDetail'];
            $model->categoryId = $categoryId;
            $model->childCatId = $childCategoryId;
            $model->hash1 = md5($model->email . $model->title);
            $model->hash2 = md5($model->email . $modelDetail->content);
            if ($model->validate() && $modelDetail->validate()) {
                $model->save();
                $modelDetail->save();
                $this->redirect(array('ad/step3', 'id' => $model->id));
            }
        }
        $this->render('new/step2', array('model' => $model, 'modelDetail' => $modelDetail, 'imgUpload' => $imgUpload));
    }

    /**
     * step3
     * @return types
     */
    public function actionStep3() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $duration = 6;
        $model = Yii::app()->cache->get('TopicModel_' . $id);
        if ($model === false) {
            $model = TopicModel::model()->cache($duration, NULL)->findByPk($id);
            Yii::app()->cache->set('TopicModel_' . $id, $model, 5 * 60);
        }

        $this->render('new/step3', array('topicModel' => $model));
    }

    /**
     * create topic id
     * @return type
     */
    protected function createTopicId() {
        return date('Y') . date('m') . date('d') . date('h') . date('i') . date('s') . rand(11, 99);
    }

    /**
     * upload image
     */
    public function uploadImg($imgUpload = array()) {

        $this->renderPartial('new/uploadImg', array('imgUpload' => $imgUpload));
    }

    /**
     * step2 category
     */
    public function step2Cateogry() {
        $this->layout = 'adLayout2';
        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
        $childCategoryId = isset($_GET['childCategoryId']) ? $_GET['childCategoryId'] : '';

        if ($categoryId && $childCategoryId) {
            $categoryModel = CategoryModel::model()->findByPk($categoryId);
            $childCategoryModel = CategoryModel::model()->findByPk($childCategoryId);
        } else {
            //back to step 1
            $this->redirect(array('ad/step1'));
        }

        $localAll = AdExtension::getLocalAll();

        $this->renderPartial('new/category', array('localAll' => $localAll, 'categoryModel' => $categoryModel, 'childCateogryModel' => $childCategoryModel));
    }

    /**
     * list by category
     */
    public function actionCategory() {
        $this->layout = 'adLayoutPagging';
        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : 0;
        $childCategoryId = isset($_GET['childCategoryId']) ? $_GET['childCategoryId'] : 0;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        //check local
        $localId = Yii::app()->request->cookies->contains('sb_adLocal') ? Yii::app()->request->cookies['sb_adLocal']->value : 0;
        $currUser = isset(Yii::app()->session['userId']) ? Yii::app()->session['userId'] : '';
        $item = 30;
        //get filter
        $fcurrent = Yii::app()->cache->get(self::_key_filter . substr(md5($_SERVER["HTTP_COOKIE"]), 0, 20));
        if ($fcurrent !== FALSE || $localId) {
            $currentTime = time() + 15 * 24 * 60 * 60 - $page * 24 * 60 * 60;
        } else {
            $currentTime = time() + 28 * 24 * 60 * 60 - $page * 24 * 60 * 60;
        }

        //defaul get value
        $condition = '`endDate` > ' . $currentTime;
        //get by category id
        if ($categoryId) {
            $condition .= ' AND `categoryId` = ' . $categoryId;
        }
        //get by child category id
        if ($childCategoryId) {
            $condition .= ' AND `childCatId` = ' . $childCategoryId;
        }

        if ($fcurrent !== FALSE) {
            $keyCache = 'adCategory_' . $page . '_' . $categoryId . '_' . $childCategoryId . '_' . $localId . '_' . substr(md5(json_encode($fcurrent)), 0, 5) . '_' . $currUser;
            foreach ($fcurrent as $fKey => $fValue) {
                $condition .= ' AND `extension' . $fKey . '` = ' . $fValue;
            }
        } else {
            $keyCache = 'adCategory_' . $page . '_' . $categoryId . '_' . $childCategoryId . '_' . $localId . '_' . $currUser;
        }

        if ($localId) {
            $condition .= ' AND `locality` = ' . $localId;
        }

        //set time cache
        if ($currUser || $page > 1) {
            $timeCache = 5;
        } else {
            $timeCache = 10 * 60;
            if ($fcurrent !== FALSE)
                $timeCache = 60 * 60;
        }
        //begin load main content
        $dataProvider = Yii::app()->cache->get($keyCache);
        if ($dataProvider === false) {

            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`isSms` DESC, `createDate` DESC'
                    ));
            $criteria->limit = $item;
            $criteria->offset = ($page - 1) * $item;

            $dataProvider = new CActiveDataProvider('TopicSlaveModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));

            $dataProvider = $dataProvider->getData();

            Yii::app()->cache->set($keyCache, $dataProvider, $timeCache);
        }

        //get category model by id
        $categoryModel = AdExtension::getCategoryById($categoryId);
        //get list childe category by id
        $listChildCategory = AdExtension::getListChildCategory($categoryId);

        if ($page > 1) {
            $this->renderPartial('listAdView', array('dataProvider' => $dataProvider, 'categoryModel' => $categoryModel));
            exit();
        }
        $this->render('category', array('categoryId' => $categoryId, 'childCategoryId' => $childCategoryId, 'categoryModel' => $categoryModel, 'listChildCategory' => $listChildCategory, 'dataProvider' => $dataProvider, 'fcurrent' => $fcurrent));
    }

    /**
     * search
     */
    public function actionSearch() {
        $this->layout = 'adLayoutPagging';
        $keySearchValue = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : 0;
        $categoryModel = AdExtension::getCategoryById($categoryId);

        $page = isset($_GET['ASolrDocument_page']) ? $_GET['ASolrDocument_page'] : 1;

        $postPerPage = $limit = 60;
        $condition = '';
        if ($keySearchValue) {
            $condition .= '(title:("' . $keySearchValue . '")^100 OR title:(' . $keySearchValue . ')^50 OR description:(' . $keySearchValue . '))';
            if ($categoryId != 0) {
                $condition .= ' AND (categoryId:"' . $categoryId . '")';
            }

            $location = Yii::app()->request->cookies->contains('sb_adLocal') ? Yii::app()->request->cookies['sb_adLocal']->value : 0;
            if ($location) {
                $condition .= ' AND locality:"' . $location . '"';
            }

            $dataProvider = new ASolrDataProvider("ASolrDocument");
            $criteria = $dataProvider->getCriteria()->query = $condition;
            $dataProvider->pagination = array(
                'pageSize' => $postPerPage,
            );
            $dataProvider = $dataProvider->getData();
            if ($page > 1) {
                $this->renderPartial('search/list', array('dataProvider' => $dataProvider));
                exit();
            }
            $this->render('search/view', array('keySearchValue' => $keySearchValue, 'categoryModel' => $categoryModel, 'dataProvider' => $dataProvider));
        } else {
            echo 'as';
        }
    }

    /**
     * preview
     */
    public function actionPreview() {
        $this->layout = 'popup';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $categoryName = isset($_GET['categoryName']) ? $_GET['categoryName'] : '';
        $topicModel = AdExtension::getTopicById($id);
        //get model detail
        $topicDetail = AdExtension::getTopicDetailById($id);
        $this->render('view/preview', array('topicModel' => $topicModel, 'topicDetail' => $topicDetail, 'title' => $title, 'categoryName' => $categoryName));
    }

    /**
     * ad detail
     */
    public function actionDetail() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            //get model
            $topicModel = AdExtension::getTopicById($id);
            //get model detail
            $topicDetail = AdExtension::getTopicDetailById($id);

            $this->render('detail', array('topicModel' => $topicModel, 'topicDetail' => $topicDetail));
        } else {
            $this->redirect(array('ad/index'));
        }
    }

    /**
     * view list ad
     * @param type $dataProvider
     * @param type $categoryModel
     */
    public function listAdView($dataProvider, $categoryModel) {
        $this->renderPartial('listAdView', array('dataProvider' => $dataProvider, 'categoryModel' => $categoryModel));
    }

    /**
     * ad chodientu
     */
    public function actionChodientu() {
        $category_id = isset($_POST['category']) ? $_POST['category'] : '6';
        $item_per_page = 20;
        $page_no = 1;
        $result = Yii::app()->cache->get('home_loadProductCDT_' . $category_id . '_' . $item_per_page . '_' . $page_no);
        if ($result === false) {
            $nusoap = new nusoapclient('http://chodientu.vn/item_webservice.php?wsdl', true);
            $erro = $nusoap->getError();

            $parram = array('password' => '!!!@@@', 'category_id' => $category_id, 'item_per_page' => $item_per_page, 'page_no' => $page_no, 'order' => 'TIME_UPDATE');
            $result = $nusoap->call('searchItem', $parram);
            var_dump($result);
            exit();
            Yii::app()->cache->set('home_loadProductCDT_' . $category_id . '_' . $item_per_page . '_' . $page_no, $result, 24 * 60 * 60);
        }
        $this->renderPartial('left/adchodientu', array('result' => $result));
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
     * get local
     */
    public function actionGetLocal() {
        $localId = isset($_POST['localId']) ? $_POST['localId'] : '';
        $cookie = new CHttpCookie('sb_adLocal', $localId);
        $cookie->expire = time() + 60 * 60 * 24 * 180;
        Yii::app()->request->cookies['sb_adLocal'] = $cookie;
        return true;
    }

    /**
     * set filter
     */
    public function actionSetFilter() {
        //get new filter
        $keyCache = self::_key_filter . substr(md5($_SERVER["HTTP_COOKIE"]), 0, 20);
        $fnum = isset($_POST['fnum']) ? $_POST['fnum'] : '';
        $fvalue = isset($_POST['fvalue']) ? $_POST['fvalue'] : '';
        $fArray = array($fnum => $fvalue);
//        $fcurrent = Yii::app()->cache->delete($keyCache);
        $fcurrent = Yii::app()->cache->get($keyCache);
        if ($fcurrent === false) {
            Yii::app()->cache->set($keyCache, $fArray, AdExtension::_ntime);
        } else {
            unset($fcurrent[$fnum]); //change old value by key
            $fcurrent[$fnum] = $fvalue; //add new value
            ksort($fcurrent); //sort filter by key
            Yii::app()->cache->set($keyCache, $fcurrent, AdExtension::_ntime);
        }
        return true;
    }

    /**
     * sort ad
     */
    public function aSort() {
        $this->renderPartial('view/asort');
    }

    /**
     * filter
     */
    public function filterValue($categoryId = 0, $childCategoryId = 0) {
        $keyCache = 'ad_filterValue_' . $categoryId . '_' . $childCategoryId;
        $fcurrent = Yii::app()->cache->get(self::_key_filter . substr(md5($_SERVER["HTTP_COOKIE"]), 0, 20));
        $dataProvider = Yii::app()->cache->get($keyCache);
        if ($dataProvider === false) {
            $condition = '`categoryId` = ' . $categoryId;
            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`order` ASC',
                    ));
            $dataProvider = new CActiveDataProvider('AttributesModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));
            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keyCache, $dataProvider, AdExtension::_forever);
        }
        if ($dataProvider)
            $this->renderPartial('left/filter', array('dataProvider' => $dataProvider, 'fcurrent' => $fcurrent));
    }

    /**
     * removeFilter
     */
    public function actionRemoveFilter() {
        $fnum = isset($_POST['fnum']) ? $_POST['fnum'] : '';
        $keyCache = self::_key_filter . substr(md5($_SERVER["HTTP_COOKIE"]), 0, 20);
        $fcurrent = Yii::app()->cache->get($keyCache);
        if ($fcurrent !== false) {
            unset($fcurrent[$fnum]); //change old value by key
            Yii::app()->cache->set($keyCache, $fcurrent, AdExtension::_ntime);
        }
        return true;
    }

    /**
     * left category
     */
    public function leftCategory($categoryModel, $childCategoryId) {
        $childCategoryModel = AdExtension::getCategoryById($childCategoryId);
        $this->renderPartial('left/category', array('categoryModel' => $categoryModel, 'childCategoryModel' => $childCategoryModel));
    }

    /**
     * pathway
     */
    public function pathWay($categoryModel, $childCategoryId = 0) {
        $childCategoryModel = AdExtension::getCategoryById($childCategoryId);
        $this->renderPartial('view/pathway', array('categoryModel' => $categoryModel, 'childCategoryModel' => $childCategoryModel));
    }

    /**
     * list child category
     */
    public function listChildCategoryItem($listChildCategory, $categoryModel, $childCategoryId) {
        $this->renderPartial('listChildCategoryItem', array('listChildCategory' => $listChildCategory, 'categoryModel' => $categoryModel, 'childCategoryId' => $childCategoryId));
    }

    /**
     * seller notify
     */
    public function sellerNotify() {
        $this->renderPartial('view/sellerNotify');
    }

    /**
     * comment
     */
    public function comment($topicModel) {
        $topicId = $topicModel->id;

        $keyCache = 'ad_comment_' . $topicId;
        $dataProvider = Yii::app()->cache->get($keyCache);
        if ($dataProvider === false) {
            $codition = '`topicId` = ' . $topicId;
            $criteria = new CDbCriteria(array(
                        'condition' => $codition,
                        'order' => '`id` ASC',
                    ));
            $criteria->limit = 20;

            $dataProvider = new CActiveDataProvider('TopicCommentModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));
            //get data
            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keyCache, $dataProvider, AdExtension::_btime);
        }
        //get count item
        $countCacheKey = 'count_comment_cache_' . $topicId;
        $itemCount = Yii::app()->cache->get($countCacheKey);
        if ($itemCount === false) {
            $itemCount = TopicCommentModel::model()->count("topicId=:topicId", array("topicId" => $topicId));
            Yii::app()->cache->set($countCacheKey, $itemCount, AdExtension::_btime);
        }
        $model = new TopicCommentModel;
        if (isset($_POST['TopicCommentModel'])) {
            $model->attributes = $_POST['TopicCommentModel'];
            $model->email = Yii::app()->session['email'];
            $model->topicId = $topicId;
            if ($model->validate()) {
                $model->save();
                $this->refresh();
            }
        }

        $this->renderPartial('comment', array('topicModel' => $topicModel, 'model' => $model, 'dataProvider' => $dataProvider, 'itemCount' => $itemCount));
    }

    /**
     * key relation
     */
    public function keyRelation($categoryId, $childCategoryId) {
        $keyRelation = AdExtension::getKeyRelationByCategoryId($categoryId, $childCategoryId);
        $this->renderPartial('view/keyrelation', array('keyRelation' => $keyRelation, 'categoryId' => $categoryId));
    }

    /**
     * update topic 
     */
    public function actionUpdateTopic() {
        $id = isset($_GET['topicId']) ? $_GET['topicId'] : 0;
        if ($id) {
            $value = Yii::app()->cache->get('ab_upload_' . $id);
            if ($value === false) {
                $rand = rand(1, 30 * 60);
                $value = (int) time() - $rand;
                $model = TopicModel::model()->findByPk($id);
                $model->createDate = new CDbExpression('NOW()');
                $model->order = $value;
                $model->update();
                Yii::app()->cache->set('ab_upload_' . $id, $value, 30 * 60);
                echo 'Up tin rao vặt thành công!';
            } else {
                echo 'Up tin vừa thực hiện, vui lòng chờ 30 phút sau để upload lại lần tiếp theo';
            }
        } else {
            echo 'Yêu cầu không hợp lệ! Bạn chưa chọn rao vặt cần upload';
        }
    }

    /**
     * login
     */
    public function actionLogin() {
        $this->layout = 'adLogin';
        //Check Logged-in
        $userId = Yii::app()->session['userId'];
        if ($userId)
            $this->redirect(array('user/profile'));

        $model = new UserLogin();
        $model->setScenario('login');

        $openSite = isset($_GET['openSite']) ? $_GET['openSite'] : '';

        $this->flag = Yii::app()->request->getUrlReferrer();

        if (!$openSite) {
            Yii::app()->request->cookies['call_back'] = new CHttpCookie('call_back', Yii::app()->request->getUrlReferrer());
        }

        if ($openSite) {
            $openid = new LightOpenID($_SERVER['HTTP_HOST']);
            if (!$openid->mode) {
                if ($openSite == 'google') {
                    $openid->identity = 'https://www.google.com/accounts/o8/id';
                    $openid->required = array('contact/email');
                    $this->redirect($openid->authUrl());
                } else if ($openSite == 'yahoo') {
                    $openid->identity = 'https://me.yahoo.com';
                    $openid->required = array('contact/email');
                    $this->redirect($openid->authUrl());
                } else if ($openSite == 'facebook') {
                    $userid = Yii::app()->facebook->getUser();
                    if ($userid == 0) {
                        $loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => 'email'));
                        $this->redirect($loginUrl);
                    } else {
                        $this->userInfo = Yii::app()->facebook->getInfo();
                        if (!empty($this->userInfo))
                            $this->email = isset($this->userInfo['email']) ? $this->userInfo['email'] : '';
                    }
                }
            }else {
                $this->openData = $openid->getAttributes();
                if (!empty($this->openData))
                    $this->email = isset($this->openData['contact/email']) ? $this->openData['contact/email'] : '';
            }
        }
        #Nếu xác thực thành công .
        if ($this->email) {
            $selects = array('select' => 'email,id,isActive');
            $this->userInfo = UserModel::model()->findByAttributes(array('email' => $this->email), $selects);
            if ($this->userInfo) {
                if ($this->userInfo->isActive == 1) {
                    Yii::app()->session['email'] = $this->userInfo->email;
                    Yii::app()->session['userId'] = $this->userInfo->id;

                    Yii::app()->user->setFlash('profile', '<p class="success">Đăng nhập tài khoản tại Saobang.vn thành công !</p>');
                    $curentUrl = isset(Yii::app()->request->cookies['call_back']) ? Yii::app()->request->cookies['call_back']->value : 'home/index';

                    unset(Yii::app()->request->cookies['call_back']);

                    $this->redirect($curentUrl);
                } else {
                    $this->render('activeAccount', array('code' => 'login'));
                    exit();
                }
            } else {
                Yii::app()->user->setFlash('register', '<p class="msg-error">Tài khoản email : ' . $this->email . ' không tồn tại trong hệ thống. Xin vui lòng đăng ký</p>');
                $this->redirect(Yii::app()->createUrl('user/register'));
            }
        } else {
            if (isset($_POST['UserLogin'])) {
                $model->attributes = $_POST['UserLogin'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate()) {
                    # Check login on submit
                    $attributes = array('email' => $model->email);
                    $selects = array('select' => 'email,id,isActive,password');
                    $this->userInfo = UserModel::model()->findByAttributes($attributes, $selects);
                    if (!empty($this->userInfo)) {
                        # Check trạng thái user
                        if ($this->userInfo->isActive != 1) {
                            $this->render('activeAccount', array('code' => 'login'));
                            exit();
                        }
                        $curentPassword = md5($model->password);
                        if ($this->userInfo->isActive == 1 && $this->userInfo->validatePassword($model->password)) {
                            Yii::app()->session['email'] = $this->userInfo->email;
                            Yii::app()->session['userId'] = $this->userInfo->id;
                            $lastUrl = $_POST['lastUrl'];

                            $curentUrl = isset(Yii::app()->request->cookies['call_back']) ? Yii::app()->request->cookies['call_back']->value : 'home/index';

                            unset(Yii::app()->request->cookies['call_back']);

                            if ($lastUrl == $curentUrl) {
                                $link = array('home/index');
                            } else if (strlen($_POST['lastUrl']) > 5)
                                $link = $lastUrl;
                            else
                                $link = array('home/index');

                            $this->redirect($link);
                        }
                    }
                }
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * get shop by title
     */
    public function getShopByTitle($string = '') {
        $this->renderPartial('view/shopByTitle', array('string' => $string));
    }

    /**
     * get shop by title
     */
    public function actionPageShop() {
        $string = isset($_POST['string']) ? $_POST['string'] : '';
        echo '<div id="listShopItem">';
        if ($string) {
            $string1 = '"' . $string . '"';
            $result = Yii::app()->shopSearch->get('content:' . $string1 . '^100 OR content:' . $string . '^10', 0, 6);
            echo '<ul class="clearfix" style="height: 72px;">';
            if (isset($result->response->docs)) {
                foreach ($result->response->docs as $doc) {
                    $shop = ExtensionSearch::getShopByShopId($doc->id);
                    echo '<li><a target="_blank" href="' . Yii::app()->createUrl('ask/shop', array('id' => $shop->id, 'title' => ExtensionClass::utf8_to_ascii($shop->name))) . '" class="pr-checked">' . $shop->name . '</a></li>';
                }
            }
            echo '</ul>';
        }
        echo '</div>';
    }

    /**
     * remove cache
     */
    public function actionRemoveCache() {
        Yii::app()->cache->flush();
    }

}