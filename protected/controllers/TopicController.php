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
class TopicController extends Controller {

    public $layout = 'Administrator';
    public $keyword = '';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'maxLength' => 3,
                'minLength' => 2,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * create id topic 
     */
    public function createTopicId() {
        return date('Y') . date('m') . date('d') . date('h') . date('i') . date('s') . rand(11, 99);
    }

    public function actionIndex() {
        
    }

    /**
     * new topic 
     */
    public function actionNew() {
        $this->layout = 'HomeTopic';
        $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';
        $childCatId = isset($_POST['childCatId']) ? $_POST['childCatId'] : '';
        $localityId = isset($_POST['localityId']) ? $_POST['localityId'] : '0';
        $demand = isset($_POST['demand']) ? $_POST['demand'] : '0';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $duration = 4;
        $modelTopicLocality = new TopicLocalityModel;
        if ($id) {
            $model = Yii::app()->cache->get('TopicModel_' . $id);
            if ($model === false) {
                $model = TopicModel::model()->cache($duration, NULL)->findByPk($id);
                Yii::app()->cache->set('TopicModel_' . $id, $model, 5 * 60);
            }

            $modelDetail = Yii::app()->cache->get('TopicDetail_' . $id);
            if ($modelDetail === false) {
                $modelDetail = TopicDetail::model()->cache($duration, NULL)->findByPk($id);
                Yii::app()->cache->set('TopicDetail_' . $id, $modelDetail, 5 * 60);
            }
        } else {
            $model = new TopicModel;
            $modelDetail = new TopicDetail;
            //set value by post ajax
            if ($categoryId)
                $model->categoryId = $categoryId;
            if ($childCatId)
                $model->childCatId = $childCatId;
            if ($localityId)
                $model->locality = $localityId;
            if ($demand)
                $model->demand = $demand;
        }
        //list category and locality
        $listParentCategory = ExtensionClass::getListChildCategory(0);
        unset($listParentCategory['0']); //remove value 0
        $listLocatily = ExtensionClass::getListLocality();

        $listCurrLocality = isset($_POST['TopicLocalityModel']) ? $_POST['TopicLocalityModel'] : array();
        $topicLocality = array();

        /**
         * after submit 
         */
        if (isset($_POST['TopicModel']) && isset($_POST['TopicDetail'])) {
            $model->attributes = $_POST['TopicModel'];
            $modelDetail->attributes = $_POST['TopicDetail'];
            if (!$id) {
                $currentId = $model->id = $modelDetail->id = $this->createTopicId();
            } else {
                $currentId = $model->id;
            }
            $model->price = str_replace('.', '', $model->price);
            $model->title = str_replace(array('<', '>'), '', $model->title);
            $model->description = $modelDetail->content;

            $model->hash1 = md5($model->authorId . $model->title);
            $model->hash2 = md5($model->authorId . $model->description);

            $modelDetail->images = json_encode($modelDetail->images);

            preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $modelDetail->content, $matches);
            if (isset($matches[1])) {
                foreach ($matches[1] as $key => $img) {
                    $info = getimagesize($img);
                    if (isset($info[1])) {
                        if ($info[1] > 80) {
                            $model->icon = $img;
                            break;
                        }
                    }
                }
            }

            if ($model->validate() && $modelDetail->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $model->save();
                    $modelDetail->save();
                    $transaction->commit();

                    /**
                     * topic locality proccess 
                     */
                    if (isset($listLocality['localityId'])) {
                        $condition = '';
                        if (is_array($listLocality['localityId'])) {
                            foreach ($listLocality['localityId'] as $key => $value) {
                                $condition .= ', (NULL, ' . $currentId . ', ' . $value . ')';
                            }
                            $condition = substr($condition, 2);
                        }
                        TopicLocalityModel::SaveToDB($condition, $currentId);
                    }
                } catch (Exception $e) { // an exception is raised if a query fails
                    $transaction->rollback();
                }
                $categoryName = ExtensionClass::utf8_to_ascii(ExtensionClass::getCategoryNameById($model->categoryId));
                $this->redirect(array('home/category', 'catId' => $model->categoryId, 'name' => $categoryName));
            }
        }
        $this->render('new', array('model' => $model, 'modelDetail' => $modelDetail, 'modelTopicLocality' => $modelTopicLocality, 'listParentCategory' => $listParentCategory, 'listLocatily' => $listLocatily, 'listCurrLocality' => $listCurrLocality));
    }

    /**
     * topic manager 
     */
    public function actionManager() {
        $condition = '`isDelete` = 1';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` ASC',
                ));

        $dataProvider = new CActiveDataProvider('TopicSlaveModel', array(
                    'pagination' => array(
                        'pageSize' => 15,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('manager', array('dataProvider' => $dataProvider));
    }

    /**
     * topic published 
     */
    public function actionPublishedTopic() {
        $condition = '`isPublished` = 1 AND `isDelete` = 0';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` ASC',
                ));

        $dataProvider = new CActiveDataProvider('TopicModel', array(
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('published/manager', array('dataProvider' => $dataProvider));
    }

    /**
     * update content of topic 
     */
    public function actionUpdate() {
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $tid = isset($_POST['tid']) ? $_POST['tid'] : '';
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
        if ($content && $tid && $filter) {
            if ($filter == 'content') {
                $model = TopicDetail::model()->findByPk($tid);
            } else {
                $model = TopicModel::model()->findByPk($tid);
            }
            $model->$filter = $content;
            $model->save();
        } else {
            return false;
        }
    }

    /**
     * delete topic 
     */
    public function actionDelete() {
        $topicId = isset($_POST['tid']) ? $_POST['tid'] : '';
        if ($topicId) {
            $model = TopicModel::model()->findByPk($topicId);
            $model->delete();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @author  Chienlv
     * @return  Action xóa tin đã đăng của user
     * @method  dl xóa tin đã đăng của user
     */
    public function actionDl() {
        $userId = Yii::app()->session['userId'];
        if ($userId) {
            $topicId = (INT) isset($_POST['id']) ? $_POST['id'] : 0;
            $model = TopicModel::model()->findByAttributes(array('id' => $topicId, 'authorId' => $userId));
            if ($model) {
                $model->isDelete = 1;
                $model->endDate = time() + 10 * 24 * 60 * 60;
                $model->update();
                echo 1;
            }else
                echo 0;
        }
    }

    /**
     * Complate 
     */
    public function actionRelease() {
        $topicId = isset($_POST['tid']) ? $_POST['tid'] : '';
        if ($topicId) {
            $model = TopicModel::model()->findByPk($topicId);
            $model->isDelete = 0;
            $model->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * change category 
     */
    public function actionChangeCategory() {
        $catParentId = isset($_POST['catParentId']) ? $_POST['catParentId'] : '';
        $catChildId = isset($_POST['catChildId']) ? $_POST['catChildId'] : '';
        $topicId = isset($_POST['topicId']) ? $_POST['topicId'] : '';
        if ($catChildId && $catParentId && $topicId) {
            $model = TopicModel::model()->findByPk($topicId);
            $model->childCatId = $catChildId;
            $model->categoryId = $catParentId;
            $model->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * topic ad homepage
     */
    public function actionAd() {
        $topicId = isset($_POST['topicId']) ? $_POST['topicId'] : '';
        //process limit time up vip by cache
        if (Yii::app()->session['userId'] && !Yii::app()->user->id) {
            $key = 'ad_' . date('Ymd') . '_' . Yii::app()->session['userId'];
            $value = Yii::app()->cache->get($key);
            if ($value === false) {
                Yii::app()->cache->set($key, 1);
            } else {
                $value++;
                Yii::app()->cache->set($key, $value);
            }
            if ($value > 5) {
                return true;
                exit();
            }
        }
        $model = TopicModel::model()->findByPk($topicId);
        if ($model) {
            $topicAd = TopicAd::model()->findByPk($topicId);
            if (!$topicAd)
                $topicAd = new TopicAd;
            $categoryId = isset($_POST['catId']) ? $_POST['catId'] : $model->categoryId;
            $topicAd->id = $model->id;
            $topicAd->title = $model->title;
            $topicAd->categoryId = $categoryId;
            $topicAd->icon = $model->icon;
            if ($topicAd->timeValue > time()) {
                $topicAd->timeValue += 3 * 24 * 60 * 60;
            } else {
                $topicAd->timeValue = time() + 3 * 24 * 60 * 60;
            }
            $topicAd->price = $model->price;
            $topicAd->authorId = $model->authorId;
            if ($topicAd->validate()) {
                $topicAd->save();
                echo 'Success';
                return 'Success';
            }
        } else {
            echo 'Err';
            return 'false';
        }
    }

    /**
     * append 
     */
    public function actionAppendSolr() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';
        $childCatId = isset($_POST['childCatId']) ? $_POST['childCatId'] : '';
        $locality = isset($_POST['locality']) ? $_POST['locality'] : 0;
        $demand = isset($_POST['demand']) ? $_POST['demand'] : 0;
        $extension1 = isset($_POST['extension1']) ? $_POST['extension1'] : 0;
        $extension2 = isset($_POST['extension2']) ? $_POST['extension2'] : 0;
        $extension3 = isset($_POST['extension3']) ? $_POST['extension3'] : 0;
        $extension4 = isset($_POST['extension4']) ? $_POST['extension4'] : 0;
        $extension5 = isset($_POST['extension5']) ? $_POST['extension5'] : 0;
        $site = isset($_POST['site']) ? $_POST['site'] : 0;
        $isVip = isset($_POST['isVip']) ? $_POST['isVip'] : 0;
        $domain = isset($_POST['domain']) ? $_POST['domain'] : 0;
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $doc = new ASolrDocument;
        $doc->id = $id;
        $doc->title = $title;
        if ($domain)
            $doc->domain = $domain;
        if ($categoryId)
            $doc->categoryId = $categoryId;
        if ($childCatId)
            $doc->childCatId = $childCatId;
        if ($locality)
            $doc->locality = $locality;
        if ($demand)
            $doc->demand = $demand;
        if ($extension1)
            $doc->extension1 = $extension1;
        if ($extension2)
            $doc->extension2 = $extension2;
        if ($extension3)
            $doc->extension3 = $extension3;
        if ($extension4)
            $doc->extension4 = $extension4;
        if ($extension5)
            $doc->extension5 = $extension5;
        if ($site)
            $doc->site = $site;
        if ($isVip) {
            $doc->priority = 3;
        } else {
            $doc->priority = 2;
        }
        $doc->description = $description;
        $locationModel = LocationModel::model()->findByPk($locality);
        if ($locationModel)
            $locaName = $locationModel->name;
        else
            $locaName = 'toan quoc';
        $doc->text = ExtensionClass::textProcessingSeach($title . ' ' . $locaName);
        $doc->save(); // adds the document to solr
        $doc->getSolrConnection()->commit();
    }

    public function actionDeleteSolr() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $doc = new ASolrDocument;
        $doc->id = $id;
        $doc->delete(); // adds the document to solr
        $doc->getSolrConnection()->commit();
    }

    /**
     * post ad step 1
     * select category
     */
    public function actionStep1() {
        $this->layout = 'HomeTopic';
        $defaultKey = isset($_POST['categoryKey']) ? $_POST['categoryKey'] : '';
        $keyword = isset($_GET['categoryKey']) ? $_GET['categoryKey'] : $defaultKey;
        $keyword = trim($keyword);

        $condition = '`isHidden` = 0 AND `isDelete` = 0';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                ));
        if ($keyword)
            $criteria->addSearchCondition('description', $keyword);

        $dataProvider = new CActiveDataProvider('CategoryModel', array(
                    'pagination' => array(
                        'pageSize' => 500,
                    ),
                    'criteria' => $criteria,
                ));
        $dataProvider = $dataProvider->getData();

        $this->render('step1', array('dataProvider' => $dataProvider, 'keyword' => $keyword));
    }

    /**
     * step 2
     */
    public function actionStep2() {
        $this->layout = 'HomeTopic';
        $categoryId = isset($_REQUEST['categoryId']) ? $_REQUEST['categoryId'] : '';
        $childCatId = isset($_REQUEST['childCatId']) ? $_REQUEST['childCatId'] : '';
        $localityId = isset($_POST['localityId']) ? $_POST['localityId'] : '0';
        $demand = isset($_POST['demand']) ? $_POST['demand'] : '0';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $duration = 4;
        $modelTopicLocality = new TopicLocalityModel;
        if ($id) {
            $model = Yii::app()->cache->get('TopicModel_' . $id);
            if ($model === false) {
                $model = TopicModel::model()->cache($duration, NULL)->findByPk($id);
                Yii::app()->cache->set('TopicModel_' . $id, $model, 5 * 60);
            }

            $modelDetail = Yii::app()->cache->get('TopicDetail_' . $id);
            if ($modelDetail === false) {
                $modelDetail = TopicDetail::model()->cache($duration, NULL)->findByPk($id);
                Yii::app()->cache->set('TopicDetail_' . $id, $modelDetail, 5 * 60);
            }
            if (Yii::app()->session['email'] && $model->email != Yii::app()->session['email']) {
                $model->email = Yii::app()->session['email'];
            }
        } else {
            $model = new TopicModel;
            $modelDetail = new TopicDetail;
            //set value by post ajax
            if ($categoryId)
                $model->categoryId = $categoryId;
            if ($childCatId)
                $model->childCatId = $childCatId;
            if ($localityId)
                $model->locality = $localityId;
            if ($demand)
                $model->demand = $demand;
        }
        //list category and locality
        $listParentCategory = ExtensionClass::getListChildCategory(0);
        unset($listParentCategory['0']); //remove value 0
        $listLocatily = ExtensionClass::getListLocality();

        $listCurrLocality = isset($_POST['TopicLocalityModel']) ? $_POST['TopicLocalityModel'] : array();
        $topicLocality = array();

        /**
         * after submit 
         */
        if (isset($_POST['TopicModel']) && isset($_POST['TopicDetail'])) {
            $model->attributes = $_POST['TopicModel'];
            $modelDetail->attributes = $_POST['TopicDetail'];
            if (!$id) {
                $currentId = $model->id = $modelDetail->id = $this->createTopicId();
            } else {
                $currentId = $model->id;
            }
            $model->price = str_replace('.', '', $model->price);
            $model->title = str_replace(array('<', '>'), '', $model->title);
            $model->description = $modelDetail->content;

            $model->hash1 = md5($model->authorId . $model->title);
            $model->hash2 = md5($model->authorId . $model->description);

            $modelDetail->images = json_encode($modelDetail->images);

            preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $modelDetail->content, $matches);
            if (isset($matches[1])) {
                foreach ($matches[1] as $key => $img) {
                    $info = getimagesize($img);
                    if (isset($info[1])) {
                        if ($info[1] > 80) {
                            $model->icon = $img;
                            break;
                        }
                    }
                }
            }

            if ($model->validate() && $modelDetail->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $model->save();
                    $modelDetail->save();
                    $transaction->commit();

                    /**
                     * topic locality proccess 
                     */
                    if (isset($listLocality['localityId'])) {
                        $condition = '';
                        if (is_array($listLocality['localityId'])) {
                            foreach ($listLocality['localityId'] as $key => $value) {
                                $condition .= ', (NULL, ' . $currentId . ', ' . $value . ')';
                            }
                            $condition = substr($condition, 2);
                        }
                        TopicLocalityModel::SaveToDB($condition, $currentId);
                    }
                } catch (Exception $e) { // an exception is raised if a query fails
                    $transaction->rollback();
                }
                $categoryName = ExtensionClass::utf8_to_ascii(ExtensionClass::getCategoryNameById($model->categoryId));
                $this->redirect(array('topic/step3', 'catId' => $model->categoryId, 'childCatId' => $model->childCatId, 'catname' => $categoryName, 'tid' => $model->id, 'title' => $model->title));
            }
        }
        $this->render('step2', array('model' => $model, 'modelDetail' => $modelDetail, 'modelTopicLocality' => $modelTopicLocality, 'listParentCategory' => $listParentCategory, 'listLocatily' => $listLocatily, 'listCurrLocality' => $listCurrLocality));
    }

    /**
     * step 3
     */
    public function actionStep3() {
        $this->layout = 'HomeTopic';

        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        $childCatId = isset($_GET['childCatId']) ? $_GET['childCatId'] : '';
        $catname = isset($_GET['catname']) ? $_GET['catname'] : '';
        $tid = isset($_GET['tid']) ? $_GET['tid'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';

        $this->render('step3', array('catId' => $catId, 'childCatId' => $childCatId, 'catname' => $catname, 'tid' => $tid, 'title' => $title));
    }

}