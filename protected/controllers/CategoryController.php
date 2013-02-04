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
class CategoryController extends Controller {

    /**
     * set controller's layout
     * @var type 
     */
    public $layout = 'Administrator';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

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
     * add and edit category 
     */
    public function actionNew() {
        $this->layout = 'popup';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        if ($id) {
            $model = CategoryModel::model()->findByPk($id);
        } else {
            $model = new CategoryModel;
            if ($catId)
                $model->parentId = $catId;
        }
        if (isset($_POST['CategoryModel'])) {
            $model->attributes = $_POST['CategoryModel'];
            if ($model->validate()) {
                $model->save();
                //redirect to list category
                $this->redirect(Yii::app()->createUrl('category/view') . '#cat' . $model->primaryKey);
            }
        }
        $this->render('new', array('model' => $model));
    }

    /**
     * views list category 
     */
    public function actionView() {
        $condition = '`parentId` = 0';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC, `name` ASC',
                ));

        $dataProvider = new CActiveDataProvider('CategoryModel', array(
                    'pagination' => array(
                        'pageSize' => 125,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('view', array('dataProvider' => $dataProvider));
    }

    /**
     * update Orther value
     */
    public function actionUpdateOrder() {
        //get posts value
        $orderVal = isset($_POST['orderVal']) ? $_POST['orderVal'] : false;
        $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : false;
        if (isset($categoryId) && isset($orderVal)) {
            $model = CategoryModel::model()->findByPk($categoryId);
            $model->order = $orderVal;
            $model->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * attributes manager 
     */
    public function actionAttributesView() {
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        if ($catId) {
            $condition = '`group` = 0 AND `categoryId` = ' . $catId;
        } else {
            $condition = '`group` = 0';
        }

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order`, `categoryId` ASC',
                ));

        $dataProvider = new CActiveDataProvider('AttributesModel', array(
                    'pagination' => array(
                        'pageSize' => 25,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('attributes/view', array('dataProvider' => $dataProvider));
    }

    /**
     * attributes add, edit 
     */
    public function actionAttributesNew() {
        $this->layout = 'popup';
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        $group = isset($_GET['group']) ? $_GET['group'] : '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = AttributesModel::model()->findByPk($id);
        } else {
            $model = new AttributesModel();
            if ($catId)
                $model->categoryId = $catId;
            if ($group)
                $model->group = $group;
        }

        if (isset($_POST['AttributesModel'])) {
            $model->attributes = $_POST['AttributesModel'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('category/AttributesView', 'catId' => $model->categoryId));
            }
        }
        $this->render('attributes/new', array('model' => $model, 'catId' => $catId));
    }

    /**
     * category delete 
     */
    public function actionAttributeDelete() {
        $aid = isset($_GET['aid']) ? $_GET['aid'] : '';
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        if ($aid) {
            /**
             * check child attributtes 
             */
            $sql = 'SELECT `id`, `name` FROM `tbl_attributes` WHERE `group` = ' . $aid . ' AND `categoryId` = ' . $catId;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryRow();
            if ($rs) {
                $errorMsg = 'Xóa thất bại, thuộc tính cần xóa có thuộc tính con';
                $this->render('attributes/delete', array('errorMsg' => $errorMsg, 'rs' => $rs));
                exit();
            } else {
                $model = AttributesModel::model()->findByPk($aid);
                if ($model)
                    $model->delete();
                $this->redirect(array('category/AttributesView', 'catId' => $catId));
            }
        }else {
            $this->redirect(array('category/AttributesView'));
        }
    }

    /**
     * delete child attributes 
     */
    public function actionChildAttrDelete() {
        $aid = isset($_POST['aid']) ? $_POST['aid'] : '';
        if ($aid) {
            $model = AttributesModel::model()->findByPk($aid);
            if ($model)
                $model->delete();
            return true;
        }else {
            return false;
        }
    }

    /**
     * change attributes 
     */
    public function actionChangeAttributes() {
        $aid = isset($_POST['aid']) ? $_POST['aid'] : '';
        $aval = isset($_POST['aval']) ? $_POST['aval'] : '';
        if ($aid && $aval) {
            $model = AttributesModel::model()->findByPk($aid);
            if ($model) {
                $model->order = $aval;
                $model->save();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Demand add, edit 
     */
    public function actionDemandNew() {
        $this->layout = 'popup';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        if ($id) {
            $model = DemandModel::model()->findByPk($id);
        } else {
            $model = new DemandModel();
            if ($catId)
                $model->categoryId = $catId;
        }

        if (isset($_POST['DemandModel'])) {
            $model->attributes = $_POST['DemandModel'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('category/DemandView', 'catId' => $model->categoryId));
            }
        }

        $this->render('demand/new', array('model' => $model));
    }

    /**
     * view DemandView 
     */
    public function actionDemandView() {
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        if ($catId) {
            $condition = '`categoryId` = ' . $catId;
        } else {
            $condition = '';
        }

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` ASC',
                ));

        $dataProvider = new CActiveDataProvider('DemandModel', array(
                    'pagination' => array(
                        'pageSize' => 25,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('demand/view', array('dataProvider' => $dataProvider, 'catId' => $catId));
    }

    /**
     * delete demand 
     */
    public function actionDemandDelete() {
        $did = isset($_POST['did']) ? $_POST['did'] : '';
        if ($did) {
            $model = DemandModel::model()->findByPk($did);
            if ($model)
                $model->delete();
            return true;
        }else {
            return false;
        }
    }

    /**
     * change demand 
     */
    public function actionChangeDemand() {
        $did = isset($_POST['did']) ? $_POST['did'] : '';
        $dval = isset($_POST['dval']) ? $_POST['dval'] : '';
        if ($did && $dval) {
            $model = DemandModel::model()->findByPk($did);
            if ($model) {
                $model->order = $dval;
                $model->save();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Filter add, edit 
     */
    public function actionFilterNew() {
        $this->layout = 'popup';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        if ($id) {
            $model = FilterModel::model()->findByPk($id);
        } else {
            $model = new FilterModel();
            if ($catId)
                $model->categoryId = $catId;
        }

        if (isset($_POST['FilterModel'])) {
            $model->attributes = $_POST['FilterModel'];
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('category/FilterView'));
            }
        }

        $this->render('filter/new', array('model' => $model));
    }

    /**
     * Filter views 
     */
    public function actionFilterView() {
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        if ($catId) {
            $condition = '`categoryId` = ' . $catId;
        } else {
            $condition = '';
        }

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` ASC',
                ));

        $dataProvider = new CActiveDataProvider('FilterModel', array(
                    'pagination' => array(
                        'pageSize' => 25,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('filter/view', array('dataProvider' => $dataProvider, 'catId' => $catId));
    }

    /**
     * filter delete 
     */
    public function actionFilterDelete() {
        $fid = isset($_POST['fid']) ? $_POST['fid'] : '';
        if ($fid) {
            $model = FilterModel::model()->findByPk($fid);
            if ($model)
                $model->delete();
            return true;
        }else {
            return false;
        }
    }

    /**
     * order filter 
     */
    public function actionChangeFilter() {
        $fid = isset($_POST['fid']) ? $_POST['fid'] : '';
        $fval = isset($_POST['fval']) ? $_POST['fval'] : '';
        if ($fid && $fval) {
            $model = FilterModel::model()->findByPk($fid);
            if ($model) {
                $model->order = $fval;
                $model->save();
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * delete category 
     */
    public function actionDelete() {
        $categoryId = isset($_GET['id']) ? $_GET['id'] : '';
        if (!$categoryId) {
            $errorMsg = 'Bạn chưa chọn danh mục';
        }
        /**
         * check topic category 
         */
        $sqlTopic = 'SELECT `id`, `title` FROM `tbl_topic` WHERE (`categoryId` = ' . $categoryId . ' OR `childCatId` = ' . $categoryId . ')';
        $commandTopic = Yii::app()->db->createCommand($sqlTopic);
        $rsTopic = $commandTopic->queryRow();
        if ($rsTopic) {
            $errorMsg = 'Xóa thất bại, danh mục của bạn hiện đang có bài viết';
            $this->render('delete', array('errorMsg' => $errorMsg, 'rsTopic' => $rsTopic));
            exit();
        }
        /**
         * check filter category 
         */
        $sqlfilter = 'SELECT `id`, `name` FROM `tbl_category_filter` WHERE `categoryId` = ' . $categoryId;
        $commandFilter = Yii::app()->db->createCommand($sqlfilter);
        $rsFilter = $commandFilter->queryRow();
        if ($rsFilter) {
            $errorMsg = 'Xóa thất bại, danh mục của bạn hiện đang có bộ lọc.';
            $this->render('delete', array('errorMsg' => $errorMsg, 'rsFilter' => $rsFilter));
            exit();
        }
        /**
         * check demand category 
         */
        $sqlDemand = 'SELECT `id`, `name` FROM `tbl_category_demand` WHERE `categoryId` = ' . $categoryId;
        $commandDemand = Yii::app()->db->createCommand($sqlDemand);
        $rsDemand = $commandDemand->queryRow();
        if ($rsDemand) {
            $errorMsg = 'Xóa thất bại, danh mục của bạn hiện đang có thuộc tính nhu cầu.';
            $this->render('delete', array('errorMsg' => $errorMsg, 'rsDemand' => $rsDemand));
            exit();
        }
        /**
         * check attributes category 
         */
        $sqlAttributes = 'SELECT `id` FROM `tbl_attributes` WHERE `categoryId` = ' . $categoryId;
        $commandAttributes = Yii::app()->db->createCommand($sqlAttributes);
        $rsAttributes = $commandAttributes->queryRow();
        if ($rsAttributes) {
            $errorMsg = 'Xóa thất bại, danh mục của bạn hiện đang có thuộc tính.';
            $this->render('delete', array('errorMsg' => $errorMsg, 'rsAttributes' => $rsAttributes));
            exit();
        }
        /**
         * check child category 
         */
        $sql = 'SELECT `id`, `name` FROM `tbl_category` WHERE `parentId` = ' . $categoryId;
        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryRow();
        if ($rs) {
            $errorMsg = 'Xóa thất bại, danh mục của bạn hiện đang có danh mục con.';
            $this->render('delete', array('errorMsg' => $errorMsg, 'rs' => $rs));
            exit();
        }
        $model = CategoryModel::model()->findByPk($categoryId);
        $model->delete();
        if ($model->parentId) {
            $this->redirect(array('category/view#cat' . $model->parentId));
        } else {
            $this->redirect(array('category/view'));
        }
    }

    public function actionUpdateIsHidden() {
        if (Yii::app()->request->isPostRequest) {
            $model = CategoryModel::model()->findByPk($_POST['id']);
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
     * update description
     */
    public function actionUpdateDescription() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $sql = 'SELECT `description` FROM {{category}} WHERE `parentId` = ' . $id;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            $description = '';
            foreach ($rs as $key => $value) {
                $description .= ' ' . $value["description"];
            }
            $model = CategoryModel::model()->findByPk($id);
            $model->description = $description;
            $model->update();
            echo 'Success';
        } else {
            echo 'Error';
        }
    }

}