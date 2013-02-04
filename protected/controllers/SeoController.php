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
class SeoController extends Controller {

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
     *  action add keyword
     */
    public function actionAdd() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = SeoModel::model()->findByPk($id);
        } else {
            $model = new SeoModel;
        }

        if (isset($_POST['SeoModel'])) {
            $model->attributes = $_POST['SeoModel'];
            $list = explode(';', $model->name);
            foreach ($list as $key => $value) {
                $model2 = new SeoModel();
                $model2->name = trim($value);
                $model2->save();
            }
            if ($id) {
                $this->redirect(array('seo/add'));
            } else {
                $this->refresh();
            }
        }

        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('SeoModel', array(
                    'pagination' => array(
                        'pageSize' => 2000,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('add', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * insert link topic detail to database
     */
    public function actionCreateLinkDetail() {
        $this->layout = 'popup';
        $numberRecord = 1000;
        $nuberCurrent = Yii::app()->cache->get('seo_action_CreateLinkDetail');
        if ($nuberCurrent === false) {
            $nuberCurrent = 0;
            Yii::app()->cache->set('seo_action_CreateLinkDetail', $nuberCurrent);
        } else {
            $nuberCurrent = $nuberCurrent + $numberRecord;
            Yii::app()->cache->set('seo_action_CreateLinkDetail', $nuberCurrent);
        }

        $condition = '`code` > ' . $nuberCurrent . ' AND `code`< ' . ($nuberCurrent + $numberRecord);
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));

        $criteria->condition = $condition;

        $dataProvider = new CActiveDataProvider('TopicSlaveModel', array(
                    'pagination' => array(
                        'pageSize' => $numberRecord,
                    ),
                    'criteria' => $criteria,
                ));

        $dataProvider = $dataProvider->getData();

        $linkTopic = '';

        foreach ($dataProvider as $index => $data) {
            $link = GlobalComponents::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId);

            $link = 'http://saobang.vn' . $link;

            $linkTopic .= ", (NULL, '" . $link . "')";
        }

        $linkTopic = substr($linkTopic, 1);

        $sql = "INSERT INTO `saobang`.`tbl_topic_link` (`id`, `link`) VALUES " . $linkTopic;
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
        $this->render('createLinkDetail', array('linkTopic' => $linkTopic));
    }

    /**
     * create sitemap
     */
    public function actionCreateSiteMap() {
        $numberRecord = 10000;
        $nuberCurrent = Yii::app()->cache->get('seo_action_CreateSiteMap');
        if ($nuberCurrent === false) {
            $nuberCurrent = 0;
            Yii::app()->cache->set('seo_action_CreateSiteMap', $nuberCurrent);
        } else {
            $nuberCurrent = $nuberCurrent + $numberRecord;
            Yii::app()->cache->set('seo_action_CreateSiteMap', $nuberCurrent);
        }

        $condition = '`id` > ' . $nuberCurrent . ' AND `id`< ' . ($nuberCurrent + $numberRecord);
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $criteria->condition = $condition;

        $dataProvider = new CActiveDataProvider('TopicLink', array(
                    'pagination' => array(
                        'pageSize' => $numberRecord,
                    ),
                    'criteria' => $criteria,
                ));

        $dataProvider = $dataProvider->getData();

        $this->render('createSiteMap', array('dataProvider' => $dataProvider));
    }

    /**
     * create system map
     */
    public function actionCreateSystemMap() {
        $numberRecord = 10000;
        $nuberCurrent = Yii::app()->cache->get('seo_action_createSystemMap');
        if ($nuberCurrent === false) {
            $nuberCurrent = 0;
            Yii::app()->cache->set('seo_action_createSystemMap', $nuberCurrent);
        } else {
            $nuberCurrent = $nuberCurrent + $numberRecord;
            Yii::app()->cache->set('seo_action_createSystemMap', $nuberCurrent);
        }

        $condition = '`id` > ' . $nuberCurrent . ' AND `id`< ' . ($nuberCurrent + $numberRecord);
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $criteria->condition = $condition;

        $dataProvider = new CActiveDataProvider('SystemLink', array(
                    'pagination' => array(
                        'pageSize' => $numberRecord,
                    ),
                    'criteria' => $criteria,
                ));

        $dataProvider = $dataProvider->getData();

        $this->render('createSystemMap', array('dataProvider' => $dataProvider));
    }

}