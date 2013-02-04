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
class ConvertController extends Controller {

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
     *  view action
     */
    public function actionView() {
        $condition = '`is_insert` = 0';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`domain`, `categoryId`, `categoryChildId`, `id` DESC',
                ));
        $criteria->distinct = true;
        $criteria->select = '`categoryId`, `categoryChildId`, `domain`, `Location`';
        $dataProvider = new CActiveDataProvider('CrawlerContent', array(
                    'pagination' => array(
                        'pageSize' => 8,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('view', array('dataProvider' => $dataProvider));
    }

    /**
     * processing 
     */
    public function actionProcessing() {
        if (isset($_GET['categoryNew']) && isset($_GET['domain']) && isset($_GET['cCategory'])) {
            $criteria = new CDbCriteria;
            $endCat = $_GET['categoryNew'];
            $siteId = isset($_GET['siteId']) ? $_GET['siteId'] : '';
            $locality = isset($_GET['Locality']) ? $_GET['Locality'] : 0;
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 1;

            $limitTime = time() - $limit * 3 * 60 * 60;
            $limitRequest = self::createTopicId($limitTime);

            $criteria->condition = "`id` > '" . $limitRequest . "' AND `is_insert`=0 AND `categoryChildId`='" . $_GET['cCategory'] . "' AND `domain`='" . $_GET['domain'] . "'";

            $dataProvider = new CActiveDataProvider('CrawlerContent', array(
                        'pagination' => array(
                            'pageSize' => 8,
                        ),
                        'criteria' => $criteria,
                    ));
            $this->render('processing', array('dataProvider' => $dataProvider, 'endCat' => $endCat, 'siteId' => $siteId, 'locality' => $locality));
        }
    }

    /**
     *  convert
     */
    public function convert($topicId, $childCat, $siteId, $locality) {
        /**
         * find data 
         */
        $model = CrawlerContent::model()->findByPk($topicId);
        $modelDetail = CrawlerDetail::model()->findByPk($topicId);
        /**
         * new set 
         */
        $category = CategoryModel::model()->findByPk($childCat);
        $topicModel = new TopicModel;
        $topicDetail = new TopicDetail;
        /**
         * processing 
         */
        $time = strtotime(base64_decode($model->createDate));
        $topicDetail->id = $topicModel->id = self::createTopicId($time);
        $topicModel->title = base64_decode($model->title);
//        $topicModel->title = $topicModel->title;
        if (!$topicModel->email)
            $topicModel->email = 'crawler@saobang.vn';
        $topicModel->locality = $locality;
        if ($siteId) {
            $topicModel->site = $siteId;
            $topicModel->domain = ExtensionClass::getCurrentSite($siteId);
        }
        $topicModel->description = self::textProcess(base64_decode($modelDetail->content));
        $topicDetail->content = base64_decode($modelDetail->content);
        $topicModel->categoryId = $category->parentId;
        $topicModel->childCatId = $childCat;
        $topicModel->mobileNumber = $model->mobile;

        $topicDetail->save();
        $topicModel->save();

        $data = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . '/topic/AppendSolr', FALSE, array(
            'id' => $topicModel->id,
            'title' => $topicModel->title,
            'categoryId' => $topicModel->categoryId,
            'childCatId' => $topicModel->childCatId,
            'locality' => $topicModel->locality,
            'description' => $topicModel->description,
                )
        );
        $model->is_insert = 1;
        $model->save();
        echo ' ** Complate!';
    }

    /**
     * create date
     * @return type 
     */
    public function createTopicId($timeS) {
        return date('Y', $timeS) . date('m', $timeS) . date('d', $timeS) . date('h', $timeS) . date('i', $timeS) . date('s', $timeS) . rand(11, 99);
    }

    /**
     * string text process 
     */
    public function textProcess($text) {
        $numval = 250;
        $text = strip_tags($text);
        if (strlen($text) > $numval) {
            $text = substr($text, 0, $numval);
            $number = strlen(strrchr($text, ' '));
            $text = substr($text, 0, $numval - $number);
            return $text . '...';
        } else {
            return $text;
        }
    }

    /**
     *  update data
     */
    public function actionUpdateDate() {
        $sql = 'UPDATE `tbl_topic` SET `domain`= \'Nguồn rao vặt khác\' WHERE `site`= 2';
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
        echo 'Success';
        return true;
    }

}