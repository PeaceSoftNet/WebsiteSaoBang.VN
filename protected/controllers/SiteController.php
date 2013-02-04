<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
class SiteController extends Controller {

    public $layout = 'Administrator';
    public $keyword = '';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
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
     * access rules 
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated users to access all actions
                'actions' => array('index', 'login', 'UpdateIsHidden'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     *  site index 
     */
    public function actionIndex() {
        $this->redirect(array('ad/index'));
    }

    /**
     * write the error action 
     */
    public function actionError() {
        $this->layout = 'adHome';
        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false;
            }
        }
        if ($error = Yii::app()->errorHandler->error)
            $this->render('error', $error);
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = 'AdmininstratorLogin';
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        if (!$code)
            $this->redirect(Yii::app()->createUrl('home/index'));
        if (Yii::app()->user->id)
            $this->redirect(Yii::app()->createUrl('administrator/sms'));
        /**
         * check is login 
         */
        $model = new LoginForm();
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->createUrl('administrator/sms'));
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * logout
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('site/index'));
    }

    /**
     * add and edit location 
     */
    public function actionLocalityNew() {
        $this->layout = 'popup700';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = LocationModel::model()->findByPk($id);
        } else {
            $model = new LocationModel;
        }
        if (isset($_POST['LocationModel'])) {
            $model->attributes = $_POST['LocationModel'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('site/LocalityView'));
            }
        }
        $this->render('location/new', array('model' => $model));
    }

    /**
     * view list locality 
     */
    public function actionLocalityView() {

        $condition = '`parentId` = 0';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` ASC',
                ));

        $dataProvider = new CActiveDataProvider('LocationModel', array(
                    'pagination' => array(
                        'pageSize' => 80,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('location/view', array('dataProvider' => $dataProvider));
    }

    /**
     * remove locality 
     */
    public function actionRemoveLocality() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        /**
         * check child locality 
         */
        $sql = 'SELECT `id`, `name` FROM `tbl_location` WHERE `parentId` = ' . $id;
        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryRow();
        $errorMsg = '';
        if ($rs) {
            $errorMsg = 'Xóa không hợp lệ, tỉnh bạn chọn đang có quận huyện!';
            $this->render('location/remove', array('errorMsg' => $errorMsg, 'rs' => $rs));
            exit();
        } else {
            $model = LocationModel::model()->findByPk($id);
            $model->delete();
            $this->redirect(array('site/LocalityView'));
        }
    }

    /**
     * manager crawler site 
     */
    public function actionCrawlerSite() {
        $condition = '';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` ASC',
                ));

        $dataProvider = new CActiveDataProvider('CrawlerSite', array(
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('crawler/view', array('dataProvider' => $dataProvider));
    }

    /**
     * add new crawler site 
     */
    public function actionCrawlerNew() {
        $this->layout = 'popup500';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = CrawlerSite::model()->findByPk($id);
        } else {
            $model = new CrawlerSite();
        }
        if (isset($_POST['CrawlerSite'])) {
            $model->attributes = $_POST['CrawlerSite'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('site/CrawlerSite'));
            }
        }
        $this->render('crawler/new', array('model' => $model));
    }

    public function actionCrawlerChange() {
        $cid = isset($_POST['cid']) ? $_POST['cid'] : '';
        $cvalue = isset($_POST['cvalue']) ? $_POST['cvalue'] : '';
        if ($cid && $cvalue) {
            $model = CrawlerSite::model()->findByPk($cid);
            $model->order = $cvalue;
            $model->save();
            return true;
        } else {
            return false;
        }
    }

    public function actionCrawlerRemove() {
        $cid = isset($_POST['cid']) ? $_POST['cid'] : '';
        if ($cid) {
            $model = CrawlerSite::model()->findByPk($cid);
            $model->delete();
            return true;
        } else {
            return false;
        }
    }

    /**
     * test preview 
     */
    public function actionTest() {
        $this->layout = 'popup';
        $this->render('test');
    }

    /**
     * @author Chienlv
     * @return Hàm xử lý isHiden cho bảng
     */
    public function actionUpdateIsHidden() {
        if (Yii::app()->request->isPostRequest) {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            if ($id) {
                $model = CrawlerSite::model()->findByPk($id);
            } else {
                exit();
            }


            if ($model) {
                if ($model->isHidden == '0')
                    $model->isHidden = '1';
                elseif ($model->isHidden == '1')
                    $model->isHidden = '0';
                $model->save();
            }
            echo $model->isHidden;
            Yii::app()->end();
        }else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * @author  Chienlv
     * @return  Action xử lý hiển thị dữ liệu từ bảng tbl_blacklist
     */
    public function actionBlacklistKeyword() {
        $condition = '';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`id` ASC',
                ));

        $dataProvider = new CActiveDataProvider('TblBlacklist', array(
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('blacklistKeyword/view', array('dataProvider' => $dataProvider));
    }

    /**
     * @author  Chienlv
     * @return  Action thêm và sửa dữ liệu từ bảng tbl_blacklist
     */
    public function actionBlacklistKeywordNew() {
        $this->layout = 'popup500';
        $id = (int) (isset($_GET['id'])) ? $_GET['id'] : 0;
        if ($id) {
            $model = TblBlacklist::model()->findByPk($id);
        } else {
            $model = new TblBlacklist();
            $model->setScenario('create');
        }
        if (isset($_POST['TblBlacklist'])) {
            $model->attributes = $_POST['TblBlacklist'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('site/BlacklistKeyword'));
            }
        }
        $this->render('blacklistKeyword/new', array('model' => $model));
    }

    /**
     * @author  Chienlv
     * @return  Action xóa dữ liệu từ bảng tbl_blacklist
     */
    public function actionBlacklistKeywordRemove() {
        if (Yii::app()->request->isPostRequest) {
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            if ($id) {
                $model = TblBlacklist::model()->findByPk($id);
                $model->delete();
                return true;
            }else
                return false;
        }
    }

}