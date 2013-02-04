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
class AdministratorController extends Controller {

    public $layout = 'Administrator';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * access rules 
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * views list admininstrator 
     */
    public function actionView() {
        $criteria = new CDbCriteria(array(
                    'condition' => 'isBan = 0',
                    'order' => 'id ASC',
                ));
        $dataProvider = new CActiveDataProvider('AdministratorModel', array(
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('view', array('dataProvider' => $dataProvider));
    }

    /**
     * add new administrator
     */
    public function actionNew() {
        $this->layout = 'popup500';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $success = false;
        if ($id) {
            $model = AdministratorModel::model()->findByPk($id);
        } else {
            $model = new AdministratorModel();
        }

        if (isset($_POST['AdministratorModel'])) {
            $model->attributes = $_POST['AdministratorModel'];
            if ($model->validate()) {
                $model->save();
                $success = true;
            }
        }
        $this->render('new', array('model' => $model, 'success' => $success));
    }

    /**
     * action remove user 
     */
    public function actionRemove() {
        $userid = isset($_POST['userId']) ? $_POST['userId'] : '';
        if ($userid) {
            $model = AdministratorModel::model()->findByPk($userid);
            $model->isBan = '1';
            $model->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * view list user 
     */
    public function actionUserView() {
        $beginDate = isset($_GET['beginDate']) ? $_GET['beginDate'] : '';
        $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $condition = ' 1 ';
        if ($beginDate) {
            $condition .= ' AND `createDate` > \'' . $beginDate . '\'';
        }
        if ($endDate) {
            $condition .= ' AND `createDate` <= \'' . $endDate . '\'';
        }

        if ($title)
            $condition .= ' AND `email` LIKE \'%' . $title . '%\'';

        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $criteria->condition = $condition;
        $dataProvider = new CActiveDataProvider('UserModel', array(
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('userView', array('dataProvider' => $dataProvider, 'beginDate' => $beginDate, 'endDate' => $endDate));
    }

    /**
     *  view user action
     */
    public function actionUserAction() {
        $condition = '';
        $userId = isset($_GET['uId']) ? $_GET['uId'] : '';
        if ($userId)
            $condition = '`userId` = ' . $userId;
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $criteria->condition = $condition;
        $dataProvider = new CActiveDataProvider('UserActionModel', array(
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('viewAction', array('dataProvider' => $dataProvider));
    }

    /**
     * edit user 
     */
    public function actionEditUser() {
        $this->layout = 'popup500';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = UserModel::model()->findByPk($id);
            if (isset($_POST['UserModel'])) {
                $model->attributes = $_POST['UserModel'];
                if ($model->validate()) {
                    $model->save();
                    $this->redirect(array('administrator/UserView'));
                }
            }
        }
        $this->render('edit', array('model' => $model));
    }

    /**
     * change static value 
     */
    public function actionChangeStatic() {
        $uId = isset($_POST['uId']) ? $_POST['uId'] : '';
        if ($uId) {
            $model = UserModel::model()->findByPk($uId);
            if ($model->isActive == 1) {
                $model->isActive = false;
            } else {
                $model->isActive = true;
            }
            $model->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * profile 
     */
    public function actionProfile() {
        $this->layout = 'popup500';
        $model = AdministratorModel::model()->findByPk(Yii::app()->user->id);
        $this->render('profile', array('model' => $model));
    }

    /**
     * change passwd 
     */
    public function actionChangePasswd() {
        $this->layout = 'popup500';
        $model = AdministratorModel::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['AdministratorModel'])) {
            $model->attributes = $_POST['AdministratorModel'];
            if ($model->validate()) {
                $model->save();
                if (isset($_SERVER['HTTP_REFERER']))
                    $this->redirect($_SERVER['HTTP_REFERER']);
                else
                    $this->redirect(array('site/index'));
            }
        }
        $this->render('changePasswd', array('model' => $model));
    }

    /**
     * remove topic 
     */
    public function actionRemoveTopic() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        if ($id) {
            $model = TopicModel::model()->findByPk($id);
            if ($model) {
                $model->isDelete = 1;
                $model->update();
                $doc = new ASolrDocument;
                $doc->id = $id;
                $doc->delete(); // adds the document to solr
                $doc->getSolrConnection()->commit();
                if (TopicAd::model()->findByPk($id))
                    TopicAd::model()->findByPk($id)->delete();
            }
        }
        return true;
    }

    /**
     * remove topic 
     */
    public function actionReleaseTopic() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        if ($id) {
            $model = TopicModel::model()->findByPk($id);
            if ($model) {
                $model->isDelete = 0;
                $model->update();
            }
        }
        return true;
    }

    /**
     * remove ad topic 
     */
    public function actionRemoveAdTopic() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        if ($id) {
            $model = TopicAd::model()->findByPk($id);
            if ($model) {
                $model->delete();
            }
        }
        return true;
    }

    /**
     * manager search keyword 
     */
    public function actionSearchKey() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $categoryId = isset($_GET['catId']) ? $_GET['catId'] : '0';
        $childCatId = isset($_GET['childCat']) ? $_GET['childCat'] : '0';
        if (!$categoryId || !$childCatId) {
            echo '<center><h3 style="padding: 100px 0px 1000px 0px; color:red;">Bạn chưa chọn danh mục từ khóa! Vui lòng chọn danh mục trước khi quay trở lại với các từ khóa. Thanks U!</h3></center>';
            header("refresh:3;url=" . Yii::app()->createUrl('category/view'));
        }
        if (!$id) {// add new value
            $model = new SearchKeyModel();
            if (isset($_POST['SearchKeyModel'])) {
                $model->attributes = $_POST['SearchKeyModel'];
                $list = explode(';', $model->name);
                foreach ($list as $key => $value) {
                    $model2 = new SearchKeyModel();
                    $model2->name = trim($value);
                    $model2->categoryId = $categoryId;
                    $model2->childCatId = $childCatId;
                    $model2->order = time();
                    if ($model2->validate()) {
                        $model2->save();
                    }
                }
                $this->refresh();
            }
        } else {//update one key
            $model = SearchKeyModel::model()->findByPk($id);
            if (isset($_POST['SearchKeyModel'])) {
                $model->attributes = $_POST['SearchKeyModel'];
                if ($model->validate()) {
                    $model->save();
                    $this->refresh();
                }
            }
        }
        $condition = '`categoryId` = ' . $categoryId . ' AND `childCatId` = ' . $childCatId;
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('SearchKeyModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('searchkey', array('model' => $model, 'dataProvider' => $dataProvider, 'categoryId' => $categoryId, 'childCatId' => $childCatId));
    }

    /**
     * delete key 
     */
    public function actionDeleteKey() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = SearchKeyModel::model()->findByPk($id);
            $catId = $model->categoryId;
            $childCatId = $model->childCatId;
            $model->delete();
            $this->redirect(Yii::app()->createUrl('administrator/searchKey', array('catId' => $catId, 'childCat' => $childCatId)));
        }
    }

    /**
     *  statistic
     */
    public function actionSms() {
        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('SmsModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('sms', array('dataProvider' => $dataProvider));
    }

    public function actionActiveVipUser() {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        if ($userId) {
            $model = new UserVipModel;
            $model->userId = $userId;
            $model->save();
            echo 'Success';
        }
        return true;
    }

    /**
     * notify manager
     */
    public function actionNotify() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = NotifyModel::model()->findByPk($id);
        } else {
            $model = new NotifyModel;
        }

        if (isset($_POST['NotifyModel'])) {
            $model->attributes = $_POST['NotifyModel'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->cache->delete('home_Notify_' . $model->id);
                Yii::app()->cache->delete('ext_listnotify');
                if ($id) {
                    $this->redirect(array('administrator/notify'));
                } else {
                    $this->refresh();
                }
            }
        }

        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('NotifyModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('notify', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * help manager
     */
    public function actionHelp() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = HelpModel::model()->findByPk($id);
        } else {
            $model = new HelpModel;
        }

        if (isset($_POST['HelpModel'])) {
            $model->attributes = $_POST['HelpModel'];
            if ($model->validate()) {
                $model->save();
                //remove cache
                Yii::app()->cache->delete('ext_getListHelp');
                Yii::app()->cache->delete('homepage_Help_' . $model->id);
                if ($id) {
                    $this->redirect(array('administrator/help'));
                } else {
                    $this->refresh();
                }
            }
        }
        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('HelpModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('help', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     *  quan tri banner
     */
    public function actionBanner() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = BannerModel::model()->findByPk($id);
        } else {
            $model = new BannerModel;
        }
        if (isset($_POST['BannerModel'])) {
            $model->attributes = $_POST['BannerModel'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->cache->delete('ext_getAdBanner_' . $model->position);
                if ($id) {
                    $this->redirect(array('administrator/banner'));
                } else {
                    $this->refresh();
                }
            }
        }

        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('BannerModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('banner', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * admin tag
     */
    public function actionTag() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = tagModel::model()->findByPk($id);
        } else {
            $model = new tagModel();
        }

        if (isset($_POST['tagModel'])) {
            $model->attributes = $_POST['tagModel'];
            if (!$id) {
                $arr = explode(';', $model->name);
                foreach ($arr as $key => $value) {
                    $modelTag = new tagModel();
                    $modelTag->name = trim(strtolower($value));
                    if ($modelTag->validators) {
                        $modelTag->save();
                    }
                }
                $this->refresh();
            } else {
                $model->name = strtolower($model->name);
                if ($model->validate()) {
                    $model->save();
                    $this->redirect(array('administrator/tag'));
                }
            }
        }

        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('tagModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('tag', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * shop
     */
    public function actionShop() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        if ($id) {
            $model = ShopModel::model()->findByPk($id);
            $modelIdentify = ShopIdentify::model()->findByPk($id);
            $model->tag = json_decode($model->tag);
        } else {
            $model = new ShopModel;
            $modelIdentify = new ShopIdentify;
        }


        $modelTag = new tagModel();

        if (isset($_POST['ShopModel']) && isset($_POST['ShopIdentify'])) {
            $model->attributes = $_POST['ShopModel'];
            $modelIdentify->attributes = $_POST['ShopIdentify'];
            $model->tag = json_encode($model->tag);
            if ($model->validate() && $modelIdentify->validate()) {
                $model->save();
                $modelIdentify->save();
                $this->redirect(array('administrator/shopview'));
            }
        }

        $this->render('shop', array('model' => $model, 'modelTag' => $modelTag, 'modelIdentify' => $modelIdentify));
    }

    /**
     * shop view list
     */
    public function actionShopView() {

        $beginDate = isset($_GET['beginDate']) ? $_GET['beginDate'] : '';
        $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $condition = ' 1 ';
        //search shop
        if ($beginDate) {
            $condition .= ' AND `createDate` > \'' . $beginDate . '\'';
        }
        if ($endDate) {
            $condition .= ' AND `createDate` <= \'' . $endDate . '\'';
        }

        if ($name)
            $condition .= ' AND `name` LIKE \'%' . $name . '%\'';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => 'id DESC',
                ));

        $dataProvider = new CActiveDataProvider('ShopModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('shopview', array('dataProvider' => $dataProvider, 'beginDate' => $beginDate, 'endDate' => $endDate));
    }

    /**
     * shopSetting
     */
    public function actionShopSetting() {
        $sid = isset($_POST['sid']) ? $_POST['sid'] : '';
        if ($sid) {
            $shopModel = ShopModel::model()->findByPk($sid);
            $shopVip = new ShopVip;
            $shopVip->id = $sid;
            $shopVip->name = $shopModel->name;
            $shopVip->logo = $shopModel->logo;
            $shopVip->endTime = time() + 30 * 24 * 60 * 60; //set 30 day
            $shopVip->save();
            echo 'Success';
        } else {
            echo 'Error';
        }
    }

    /**
     * shop view list
     */
    public function actionShopVipView() {

        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));

        $dataProvider = new CActiveDataProvider('ShopVip', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('shopvip', array('dataProvider' => $dataProvider));
    }

    /**
     * email notify manager
     */
    public function actionEmailNotify() {
        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));

        $dataProvider = new CActiveDataProvider('AskEmail', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('emailnotify', array('dataProvider' => $dataProvider));
    }

    /**
     * shop category
     */
    public function actionShopCategory() {
        $model = new ShopCategory;
        if (isset($_POST['ShopCategory'])) {
            $model->attributes = $_POST['ShopCategory'];
            if ($model->validate()) {
                $model->save();
                $this->refresh();
            }
        }
        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));

        $dataProvider = new CActiveDataProvider('ShopCategory', array(
                    'pagination' => false,
                    'criteria' => $criteria,
                ));
        $this->render('shopcategory', array('model' => $model, 'dataProvider' => $dataProvider));
    }

}