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
class MarketingController extends Controller {

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
     * tong hop cac email, danh muc 
     */
    public function actionStatistic() {
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '`email`';
        $type = isset($_GET['type']) ? $_GET['type'] : 'ASC';
        //view
        $criteria = new CDbCriteria();
        $criteria->select = '`id` , `categoryId` , `childCatId` , `locality` , `email` , `authorId` , `mobileNumber` , `domain`, `createDate`';
        $criteria->condition = '`email` != "noreply@saobang.vn"';
        $criteria->group = '`email`';
        $criteria->order = $sort . ' ' . $type;
        $dataProvider = new CActiveDataProvider('TopicModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        if ($type == 'ASC') {
            $type = 'DESC';
        } else {
            $type = 'ASC';
        }
        $this->render('statistic', array('type' => $type, 'dataProvider' => $dataProvider));
    }

    /**
     * quan tri cac nhu cau 
     */
    public function actionDemand() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = MarketingTypeModel::model()->findByPk($id);
        } else {
            $model = new MarketingTypeModel;
        }
        if (isset($_POST['MarketingTypeModel'])) {
            $model->attributes = $_POST['MarketingTypeModel'];
            if ($model->validate()) {
                $model->save();
                if ($id) {
                    $this->redirect(array('marketing/demand'));
                }
                $this->refresh();
            }
        }

        //view
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('MarketingTypeModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('demand', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * delete demand 
     */
    public function actionDemandRemove() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = MarketingTypeModel::model()->findByPk($id);
            $model->delete();
            $this->redirect(array('marketing/demand'));
        }
    }

    /**
     * find demand 
     */
    public function actionDemandFind() {
        $did = isset($_GET['did']) ? $_GET['did'] : '';
        $dModel = MarketingTypeModel::model()->findByPk($did);
        $dModel->lastSearch = date('Y-m-d h:i:s');
    }

    /**
     * search topic list by id type 
     */
    public function actionSearchTopic() {
        $id = isset($_POST['did']) ? $_POST['did'] : '';
        if ($id) {
            $demandModel = MarketingTypeModel::model()->findByPk($id);

            //search demand A
            $demandA = $demandModel->demandTypeA;

            $conditionA .= '(title:(' . $demandA . ')^100 OR description:(' . $demandA . '))';

            $dataProviderA = new ASolrDataProvider("ASolrDocument");
            $criteriaA = $dataProviderA->getCriteria()->query = $conditionA;

            $demandB = $demandModel->demandTypeB;

            $conditionB .= '(title:(' . $demandB . ')^100 OR description:(' . $demandB . '))';

            $dataProviderB = new ASolrDataProvider("ASolrDocument");
            $criteriaB = $dataProviderB->getCriteria()->query = $conditionB;

            $listA = '0';
            foreach ($dataProviderA->getData() as $key => $item) {
                $listA .= ', ' . $item->id;
            }

            $listB = '0';
            foreach ($dataProviderB->getData() as $key => $item) {
                $listB .= ', ' . $item->id;
            }

            $listA = substr($listA, 2);
            $listB = substr($listB, 2);
            //print
            $demandModel->topicA = $listA;
            $demandModel->topicB = $listB;
            $demandModel->lastSearch = date('Y-m-d h:i:s');
            $demandModel->save();
            echo 'Success';
        } else {
            echo 'Error Id';
        }
    }

    /**
     * send email 
     */
    public function actionProduct() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = MarketingTypeModel::model()->findByPk($id);
            $mailTitle = $model->demandTypeA;
            if ($model->topicA && $model->topicB) {
                // ben A
                $conditionA = ' `id` IN (' . $model->topicA . ')';
                $criteriaA = new CDbCriteria(array(
                            'condition' => $conditionA,
                            'order' => 'id DESC',
                        ));
                $dataProviderA = new CActiveDataProvider('TopicModel', array(
                            'pagination' => array(
                                'pageSize' => 40,
                            ),
                            'criteria' => $criteriaA,
                        ));

                //Ben B
                $conditionB = ' `id` IN (' . $model->topicB . ')';
                $criteriaB = new CDbCriteria(array(
                            'condition' => $conditionB,
                            'order' => 'id DESC',
                        ));
                $dataProviderB = new CActiveDataProvider('TopicModel', array(
                            'pagination' => array(
                                'pageSize' => 40,
                            ),
                            'criteria' => $criteriaB,
                        ));
                //render
                $this->render('product', array('dataProviderA' => $dataProviderA, 'dataProviderB' => $dataProviderB, 'mailTitle' => $mailTitle));
            } else {
                $this->render('errorData');
            }
        }
    }

}