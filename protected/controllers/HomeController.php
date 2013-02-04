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
class HomeController extends Controller {

    public $layout = 'adHome';
    public $keyword = '';

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
     * homepage 
     *
     */
    public function actionIndex() {
        $this->layout = 'HomePage';
        $duration = 6;
        $isAdmin = isset($_GET['isAdmin']) ? $_GET['isAdmin'] : '';
        if (!$isAdmin)
            $this->redirect(array('ad/index'));
        $homeCategory = ExtensionClass::getHomeCategory();

        $localKey = isset($_POST['localKey']) ? $_POST['localKey'] : '';
        $dataProvider = new CArrayDataProvider($homeCategory, array(
                    'id' => 'CategoryModel',
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));

        $condition = '`parentId` = 0';
        $dataProviderLocality = Yii::app()->cache->get('get_loCal_' . $localKey);
        if ($dataProviderLocality === false) {

            $criteriaLocality = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`order` DESC',
                    ));

            if ($localKey)
                $criteriaLocality->addSearchCondition('name', $localKey);

            $dataProviderLocality = new CActiveDataProvider(LocationSlaveModel::model()->cache(200, NULL), array(
                        'pagination' => array(
                            'pageSize' => 100,
                        ),
                        'criteria' => $criteriaLocality,
                    ));
            $dataProviderLocality = $dataProviderLocality->getData();

            Yii::app()->cache->set('get_loCal_' . $localKey, $dataProviderLocality, 60 * 60);
        }

        $dataProviderSite = Yii::app()->cache->get('home_index_dataProviderSite');
        if ($dataProviderSite === false) {
            $criteriaSite = new CDbCriteria(array(
                        'order' => '`order` DESC',
                        'condition' => 'isHidden=0'
                    ));

            $dataProviderSite = new CActiveDataProvider(CrawlerSlaveSite::model()->cache(200, NULL), array(
                        'pagination' => array(
                            'pageSize' => 50,
                        ),
                        'criteria' => $criteriaSite,
                    ));

            $dataProviderSite = $dataProviderSite->getData();

            Yii::app()->cache->set('home_index_dataProviderSite', $dataProviderSite, 10 * 60);
        }

        $dataProviderAd = Yii::app()->cache->get('home_index_dataProviderAd');

        if ($dataProviderAd === false) {
            $listRand = array('0' => 'id', '1' => 'title', '2' => 'icon', '3' => 'createDate', '4' => 'categoryId', '5' => 'timeValue', '6' => 'id',);
            $typeRand = array('0' => 'ASC', '1' => 'DESC', '2' => 'ASC');
            $conditionAd = '`timeValue` >= ' . time();
            $criteriaAd = new CDbCriteria(array(
                        'condition' => $conditionAd,
                        'order' => '`sms` DESC, ' . $listRand[rand(0, 6)] . ' ' . $typeRand[rand(0, 2)],
                    ));

            $dataProviderAd = new CActiveDataProvider(TopicSlaveAd::model()->cache(6, NULL), array(
                        'pagination' => array(
                            'pageSize' => 8,
                        ),
                        'criteria' => $criteriaAd,
                    ));

            $dataProviderAd = $dataProviderAd->getData();

            Yii::app()->cache->set('home_index_dataProviderAd', $dataProviderAd, 6);
        }

        /**
         * get last news
         */
        $endDate = Yii::app()->cache->get('actionIndex_endDate');
        if ($endDate === false) {
            $endDate = (int) time() + 30 * 24 * 60 * 60 - 13 * 60 * 60; //lay tin trong 11 gio
            Yii::app()->cache->set('actionIndex_endDate', $endDate, 600);
        }

        $notify = Yii::app()->cache->get('home_notify_value');
        if ($notify === false) {
            $criteriaNotify = new CDbCriteria(array(
                        'order' => '`id` DESC',
                    ));

            $dataProviderNotify = new CActiveDataProvider(NotifySlaveModel::model()->cache(6, NULL), array(
                        'pagination' => array(
                            'pageSize' => 15,
                        ),
                        'criteria' => $criteriaNotify,
                    ));
            $notify = $dataProviderNotify->getData();

            Yii::app()->cache->set('home_notify_value', $notify, 3600);
        }

        $this->render('homepage/view', array('dataProvider' => $dataProvider, 'dataProviderLocality' => $dataProviderLocality, 'dataProviderSite' => $dataProviderSite, 'dataProviderAd' => $dataProviderAd, 'dataProviderNotify' => $notify));
    }

    /**
     * topic home by category 
     */
    public function actionCategory() {
        $this->layout = 'HomeLayout';
        $duration = 4;
        $catId = isset($_GET['catId']) ? $_GET['catId'] : '';
        $childCat = isset($_GET['childCat']) ? $_GET['childCat'] : '';
        $location = Yii::app()->session['location'];
        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['TopicSlaveModel_sort']) ? $_GET['TopicSlaveModel_sort'] : 'createDate';
        $dId = isset($_GET['did']) ? $_GET['did'] : '';
        $aid = isset($_GET['aid']) ? $_GET['aid'] : '';
        $ext = isset($_GET['ext']) ? $_GET['ext'] : '';
        $site = isset($_GET['site']) ? $_GET['site'] : '';
        $page = isset($_GET['TopicSlaveModel_page']) ? $_GET['TopicSlaveModel_page'] : 1;
        $limitByPage = $page * $postPerPage + 2;
        /**
         * current Url 
         */
        $condition = '';

        $currUrl = array('catId' => $catId);

        if ($catId || $childCat) {
            $condition .= ' AND `categoryId` = ' . $catId;
//category name
            $categoryNameVal = isset($_GET['name']) ? $_GET['name'] : '';
            $catName = ExtensionClass::utf8_to_ascii(ExtensionClass::getCategoryNameById($catId));
            if ($catName) {
                $currUrl = array_merge($currUrl, array('name' => $catName));
                if ($catName != $categoryNameVal)
                    $this->redirect(Yii::app()->createUrl('home/category', $currUrl));
            }
            if ($childCat) {
                $condition .= ' AND `childCatId` = ' . $childCat;
                $currUrl = array_merge($currUrl, array('childCat' => $childCat));
//child category name
                $childName = ExtensionClass::utf8_to_ascii(ExtensionClass::getCategoryNameById($childCat));
                if ($childName) {
                    $currUrl = array_merge($currUrl, array('childName' => $childName));
                    if ($childName != $_GET['childName'])
                        $this->redirect(Yii::app()->createUrl('home/category', $currUrl));
                }
            }
        }
        if ($dId) {
            $condition .= ' AND `demand` = ' . $dId;
            $demandName = ExtensionClass::getCurrentDemand($dId);
            $currUrl = array_merge($currUrl, array('did' => $dId, 'demandName' => ExtensionClass::utf8_to_ascii($demandName)));
        }
        if ($aid && $ext) {
            $condition .= ' AND `extension' . $ext . '` = ' . $aid;
            $currUrl = array_merge($currUrl, array('ext' => $ext, 'aid' => $aid));
        } else {
            $condition .= isset($_GET['extension1']) ? ' AND `extension1` = ' . $_GET['extension1'] : '';
            if (isset($_GET['extension1']))
                $currUrl = array_merge($currUrl, array('extension1' => $_GET['extension1']));
            $condition .= isset($_GET['extension2']) ? ' AND `extension2` = ' . $_GET['extension2'] : '';
            if (isset($_GET['extension2']))
                $currUrl = array_merge($currUrl, array('extension2' => $_GET['extension2']));
            $condition .= isset($_GET['extension3']) ? ' AND `extension3` = ' . $_GET['extension3'] : '';
            if (isset($_GET['extension3']))
                $currUrl = array_merge($currUrl, array('extension3' => $_GET['extension3']));
            $condition .= isset($_GET['extension4']) ? ' AND `extension4` = ' . $_GET['extension4'] : '';
            if (isset($_GET['extension4']))
                $currUrl = array_merge($currUrl, array('extension4' => $_GET['extension4']));
            $condition .= isset($_GET['extension5']) ? ' AND `extension5` = ' . $_GET['extension5'] : '';
            if (isset($_GET['extension5']))
                $currUrl = array_merge($currUrl, array('extension5' => $_GET['extension5']));
        }

        if ($site) {
            $condition .= ' AND `site` = ' . $site;
            $siteName = ExtensionClass::getCurrentSite($site);
            $currUrl = array_merge($currUrl, array('site' => $site, 'siteName' => ExtensionClass::utf8_to_ascii($siteName)));
        }
        if ($location) {
            $condition .= ' AND `locality` = ' . $location;
        }

        $currentTime = Yii::app()->cache->get('actionCategory_currentTime');
        if ($currentTime === false) {
            $currentTime = (int) time();
            Yii::app()->cache->set('actionCategory_currentTime', $currentTime, 600);
        }

        $dtime = (24 * 60 * 60);
        if ($childCat)
            $dtime = 36 * 60 * 60;

        $condition .= ' AND `isDelete` = 0';
//set time value
        $day30 = $currentTime + 30 * 24 * 60 * 60;
        $day2 = $day30 - $dtime;
        $day9 = $day2 - (4 * 24 * 60 * 60);
        $listDay = array(
            '0' => $day2,
            '1' => $day9,
            '3' => $currentTime,
        );
//end set day and begin set data cache for conditon
        $keyCache = 'cond_' . md5($condition) . '_' . $page;
        $condition2 = Yii::app()->cache->get($keyCache);
        if ($condition2 === false) {
            foreach ($listDay as $key => $value) {
                $param = ' `endDate` >=' . $value . ' ';
                $condition2 = $param . $condition;

                $criteria = new CDbCriteria(array(
                            'condition' => $condition2,
                            'order' => '`isSms` DESC, `createDate` DESC',
                        ));

                $criteria->limit = $postPerPage;
                $criteria->select = '`id`, `title`, `categoryId`, `childCatId`, `locality`, `address`, `email`, `authorId`, `mobileNumber`, `price`, `description`, `icon`, `createDate`, `endDate`, `demand`, `extension1`, `extension2`, `extension3`, `extension4`, `extension5`, `site`, `domain`, `isSms`';

                $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                            'pagination' => array(
                                'pageSize' => $postPerPage,
                            ),
                            'criteria' => $criteria,
                        ));

                if ($dataProvider->totalItemCount >= $limitByPage)
                    break;
            }
            Yii::app()->cache->set($keyCache, $condition2, 12 * 60 * 60);
        }else {
            $criteria = new CDbCriteria(array(
                        'condition' => $condition2,
                        'order' => '`isSms` DESC, `createDate` DESC',
                    ));

            $criteria->limit = $postPerPage;
            $criteria->select = '`id`, `title`, `categoryId`, `childCatId`, `locality`, `address`, `email`, `authorId`, `mobileNumber`, `price`, `description`, `icon`, `createDate`, `endDate`, `demand`, `extension1`, `extension2`, `extension3`, `extension4`, `extension5`, `site`, `domain`, `isSms`';

            $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                        'pagination' => array(
                            'pageSize' => $postPerPage,
                        ),
                        'criteria' => $criteria,
                    ));
        }

        /**
         * get attributes by category 
         */
        $listAttr = $listChildAttr = $listDemand = $listChirlByCat = array();
        if ($catId) {
            $listAttr = ExtensionClass::getHomeAttributes($catId);
        }

        /**
         * get statistic 
         */
        $statistic = ExtensionClass::getStatistic($catId);
//        var_dump($statistic);//dgthien da ky
        /**
         * send email notify 
         */
        $emailNotify = new EmailModel;
        if (isset($_POST['EmailModel'])) {
            $emailNotify->attributes = $_POST['EmailModel'];
            $emailNotify->obj = json_encode($currUrl);
            if ($emailNotify->validate()) {
                $emailNotify->save();
                $this->redirect(array('user/emailnotify', array('email' => $emailNotify->email)));
            }
        }

// tu khoa lien quan
        $dataProviderKeyword = Yii::app()->cache->get('home_category_dataProviderKeyword_cat' . $catId . '_childCat_' . $childCat);
        if ($dataProviderKeyword === false) {
            $listRand2 = array('0' => 'id', '1' => 'name', '2' => 'order', '3' => 'id');
            $typeRand = array('0' => 'ASC', '1' => 'DESC', '2' => 'ASC');

            $conditionKeyword = '`categoryId` = ' . $catId;
            if ($childCat)
                $conditionKeyword .= ' AND `childCatId` = ' . $childCat;

            $criteriaKeyword = new CDbCriteria(array(
                        'condition' => $conditionKeyword,
                        'order' => '`' . $listRand2[rand(0, 2)] . '`' . ' ' . $typeRand[rand(0, 2)],
                    ));

            $dataProviderKeyword = new CActiveDataProvider(SearchKeyModel::model()->cache(200, NULL), array(
                        'pagination' => array(
                            'pageSize' => 20,
                        ),
                        'criteria' => $criteriaKeyword,
                    ));

            $dataProviderKeyword = $dataProviderKeyword->getData();

            Yii::app()->cache->set('home_category_dataProviderKeyword_cat' . $catId . '_childCat_' . $childCat, $dataProviderKeyword, 5 * 60);
        }

        $this->render('category/view', array('dataProvider' => $dataProvider, 'listChildAttr' => $listChildAttr, 'listAttr' => $listAttr, 'postPerPage' => $postPerPage, 'dId' => $dId, 'catId' => $catId, 'childCat' => $childCat, 'currUrl' => $currUrl, 'sort' => $sort, 'aid' => $aid, 'site' => $site, 'statistic' => $statistic, 'emailNotify' => $emailNotify, 'dataProviderKeyword' => $dataProviderKeyword));
    }

    /**
     * action all category 
     */
    public function actionAll() {
        $duration = 4;
        $this->layout = 'HomeLayout';
        $site = isset($_GET['site']) ? $_GET['site'] : 0;
        $location = Yii::app()->session['location'] ? Yii::app()->session['location'] : 0;
        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['TopicSlaveModel_sort']) ? $_GET['TopicSlaveModel_sort'] : 'createDate';
        $page = isset($_GET['TopicSlaveModel_page']) ? $_GET['TopicSlaveModel_page'] : 1;
        $limitByPage = $page * $postPerPage + 5;
        $condition = '';

        if ($location && $location != 0) {
            $condition .= ' AND `locality` = ' . $location . ' ';
        }

        if ($site)
            $condition .= ' AND `site` = ' . $site;

        $condition .= ' AND `isDelete` = 0';

//set time value
        $currentTime = Yii::app()->cache->get('actionCategory_currentTime');
        if ($currentTime === false) {
            $currentTime = (int) time();
            Yii::app()->cache->set('actionCategory_currentTime', $currentTime, 10 * 60);
        }

        $day30 = $currentTime + 30 * 24 * 60 * 60;
        $day2 = $day30 - (2 * 24 * 60 * 60);
        $day9 = $day2 - (7 * 24 * 60 * 60);
        $listDay = array(
            '0' => $day2,
            '1' => $day9,
        );
//end set day and set cache for conditon
        $keyCache = 'home_all_' . md5($condition) . '_' . $page;
        $condition2 = Yii::app()->cache->get($keyCache);
        if ($condition2 === false) {
            foreach ($listDay as $key => $value) {
                $param = ' `endDate` >=' . $value . ' ';
                $condition2 = $param . $condition;

                $criteria = new CDbCriteria(array(
                            'condition' => $condition2,
                            'order' => '`isSms` DESC, `createDate` DESC',
                        ));
                $criteria->limit = $postPerPage;
                $criteria->select = '`id`, `title`, `categoryId`, `childCatId`, `locality`, `address`, `email`, `authorId`, `mobileNumber`, `price`, `description`, `icon`, `createDate`, `endDate`, `demand`, `extension1`, `extension2`, `extension3`, `extension4`, `extension5`, `site`, `domain`, `isSms`';
                $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                            'pagination' => array(
                                'pageSize' => $postPerPage,
                            ),
                            'criteria' => $criteria,
                        ));

                if ($dataProvider->totalItemCount >= $limitByPage)
                    break;
            }
            Yii::app()->cache->set($keyCache, $condition2, 12 * 60 * 60);
        }else {
            $criteria = new CDbCriteria(array(
                        'condition' => $condition2,
                        'order' => '`isSms` DESC, `createDate` DESC',
                    ));
            $criteria->limit = $postPerPage;
            $criteria->select = '`id`, `title`, `categoryId`, `childCatId`, `locality`, `address`, `email`, `authorId`, `mobileNumber`, `price`, `description`, `icon`, `createDate`, `endDate`, `demand`, `extension1`, `extension2`, `extension3`, `extension4`, `extension5`, `site`, `domain`, `isSms`';
            $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                        'pagination' => array(
                            'pageSize' => $postPerPage,
                        ),
                        'criteria' => $criteria,
                    ));
        }

        $currUrl = array();
        if ($site)
            $currUrl = array_merge($currUrl, array('site' => $site));
        /**
         * send email notify 
         */
        $emailNotify = new EmailModel;
        if (isset($_POST['EmailModel'])) {
            $emailNotify->attributes = $_POST['EmailModel'];
            $emailNotify->obj = json_encode($currUrl);
            if ($emailNotify->validate()) {
                $emailNotify->save();
                $this->redirect(array('user/emailnotify', array('email' => $emailNotify->email)));
            }
        }
        $this->render('category/all', array('dataProvider' => $dataProvider, 'postPerPage' => $postPerPage, 'site' => $site, 'sort' => $sort, 'emailNotify' => $emailNotify));
    }

    /**
     * topic home detail 
     */
    public function actionTopicDetail() {
        $this->layout = 'HomeDetail';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $categoryName = isset($_GET['categoryName']) ? $_GET['categoryName'] : '';
        $duration = 6;
        if (!$id)
            $this->redirect(array('home/index'));

        $model = Yii::app()->cache->get('home_index_topicDetail_model' . $id);
        if ($model === false) {
            $model = TopicSlaveModel::model()->cache($duration, NULL)->findByPk($id);
            Yii::app()->cache->set('home_index_topicDetail_model' . $id, $model, 10);
        }

        if (!$categoryName)
            $this->redirect(GlobalComponents::topicDetail($model->id, $model->title, $model->categoryId, $model->childCatId));
        //redirect new version
        if (!Yii::app()->user->id)
            $this->redirect(array('ad/detail', 'categoryName' => $categoryName, 'id' => $id, 'title' => ExtensionClass::utf8_to_ascii($model->title)));

        $modelDetail = Yii::app()->cache->get('home_detail_modelDetail_' . $id);
        if ($modelDetail === false) {
            $modelDetail = TopicSlaveDetail::model()->cache($duration, NULL)->findByPk($id);
            Yii::app()->cache->set('home_detail_modelDetail_' . $id, $modelDetail, 10);
        }


        /**
         * advertising 
         */
        $listRand = array('0' => 'id', '1' => 'title', '2' => 'icon', '3' => 'createDate', '4' => 'categoryId', '5' => 'timeValue', '6' => 'id',);
        $typeRand = array('0' => 'ASC', '1' => 'DESC', '2' => 'ASC');

        $dataProviderAd = Yii::app()->cache->get('home_detail_topic_ad');
        if ($dataProviderAd === false) {

            $conditionAd = '`timeValue` >= ' . time();
            $criteriaAd = new CDbCriteria(array(
                        'condition' => $conditionAd,
                        'order' => '`sms` DESC, ' . $listRand[rand(0, 6)] . ' ' . $typeRand[rand(0, 2)],
                    ));

            $dataProviderAd = new CActiveDataProvider(TopicSlaveAd::model()->cache(6, NULL), array(
                        'pagination' => array(
                            'pageSize' => 8,
                        ),
                        'criteria' => $criteriaAd,
                    ));

            $dataProviderAd = $dataProviderAd->getData();

            Yii::app()->cache->set('home_detail_topic_ad', $dataProviderAd, 6);
        }
        $reportTopic = new ReportModel();
        if (isset($_POST['ReportModel'])) {
            $reportTopic->attributes = $_POST['ReportModel'];
            if ($reportTopic->validate()) {
                $reportTopic->save();
                $this->refresh();
            }
        }

// tu khoa lien quan
        $dataProviderKeyword = Yii::app()->cache->get('home_detail_dataProviderKeyword_' . $id);
        if ($dataProviderKeyword === false) {

            $listRand2 = array('0' => 'id', '1' => 'name', '2' => 'order', '3' => 'id');

            if (isset($model->categoryId)) {
                $conditionKeyword = '`categoryId` = ' . $model->categoryId;
                if (isset($model->childCatId)) {
                    $conditionKeyword .= ' AND `childCatId` = ' . $model->childCatId;
                }
            } else {
                $conditionKeyword = '';
            }


            $criteriaKeyword = new CDbCriteria(array(
                        'condition' => $conditionKeyword,
                        'order' => '`' . $listRand2[rand(0, 2)] . '`' . ' ' . $typeRand[rand(0, 2)],
                    ));

            $dataProviderKeyword = new CActiveDataProvider(SearchKeyModel::model()->cache(600, NULL), array(
                        'pagination' => array(
                            'pageSize' => 20,
                        ),
                        'criteria' => $criteriaKeyword,
                    ));
            $dataProviderKeyword = $dataProviderKeyword->getData();

            Yii::app()->cache->set('home_detail_dataProviderKeyword_' . $id, $dataProviderKeyword);
        }

        if ($model->isDelete)
            $modelDetail->content = '<p>Nội dung này không tồn tại hoặc đã xóa</p>';
        $this->render('detail/view', array('data' => $model, 'dataDetail' => $modelDetail, 'dataProviderAd' => $dataProviderAd, 'reportTopic' => $reportTopic, 'dataProviderKeyword' => $dataProviderKeyword));
    }

    /**
     * topic preview 
     */
    public function actionTopicPreview() {
        $this->layout = 'topicPreview';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $duration = 2;
        if ($id) {
            $model = Yii::app()->cache->get('TopicModel_' . $id);
            if ($model === false) {
                $model = TopicSlaveModel::model()->cache($duration, NULL)->findByPk($id);
                Yii::app()->cache->set('TopicModel_' . $id, $model, 5 * 60);
            }

            $modelDetail = Yii::app()->cache->get('TopicDetail_' . $id);
            if ($modelDetail === false) {
                $modelDetail = TopicDetail::model()->cache($duration, NULL)->findByPk($id);
                Yii::app()->cache->set('TopicDetail_' . $id, $modelDetail, 5 * 60);
            }
            $this->render('detail/preview', array('data' => $model, 'dataDetail' => $modelDetail));
        }
    }

    /**
     * tin lien quan
     *  topic similar
     */
    public function actionSimilarTopic() {
        $this->layout = 'HomeAjax';
        $topicId = isset($_POST['topicId']) ? $_POST['topicId'] : '';
        $model = TopicModel::model()->findByPk($topicId);
        if ($model) {
            $condition = '`locality` = ' . $model['locality'] . ' AND ';
            $condition .= '`categoryId` = ' . $model['categoryId'];
            $condition .= ' AND `childCatId` = ' . $model['childCatId'];
            if (isset($model['demand']))
                $condition .= ' AND `demand` = ' . $model['demand'];
            if (isset($model['extension1']))
                $condition .= ' AND `extension1` = ' . $model['extension1'];
            if (isset($model['extension2']))
                $condition .= ' AND `extension2` = ' . $model['extension2'];
            if (isset($model['extension3']))
                $condition .= ' AND `extension3` = ' . $model['extension3'];
            if (isset($model['extension4']))
                $condition .= ' AND `extension4` = ' . $model['extension4'];
            if (isset($model['extension5']))
                $condition .= ' AND `extension5` = ' . $model['extension5'];

            $value = $model->endDate - 14 * 60 * 60;
            $condition .= ' AND `id` < ' . $topicId;
            $param = ' `endDate` >=' . $value . ' AND ';
            $condition = $param . $condition;
            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`isSms` DESC, `id` DESC',
                    ));
            $criteria->limit = 8;
            $duration = 6;
            $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache($duration, NULL), array(
                        'pagination' => array(
                            'pageSize' => 8,
                        ),
                        'criteria' => $criteria,
                    ));
            $this->render('detail/similar', array('dataProvider' => $dataProvider, 'catId' => $model['categoryId']));
        }
    }

    /**
     * help 
     */
    public function actionHelp() {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $model = Yii::app()->cache->get('homepage_Help_' . $id);
        if ($model === false) {
            $model = HelpModel::model()->findByPk($id);
            Yii::app()->cache->set('homepage_Help_' . $id, $model, 24 * 60 * 60);
        }
        $this->render('help', array('model' => $model));
    }

    /**
     * site crawler static 
     */
    public function actionCrawlerStatistic() {
        $rs = ExtensionClass::getTotalCrawlerLink();
        echo GlobalComponents::numberFomat($rs);
    }

    /**
     * set post per page 
     */
    public function actionPostPerPage() {
        $postNum = isset($_POST['postNum']) ? $_POST['postNum'] : 15;
        Yii::app()->session['postPerPage'] = $postNum;
        return true;
    }

    /**
     * set location 
     */
    public function actionSetLocation() {
        $location = isset($_POST['location']) ? $_POST['location'] : false;
        Yii::app()->session['location'] = $location;
        return $location;
    }

    /**
     * error site 
     */
    public function actionError() {
        $this->render('statistic/error');
    }

    /**
     * contact Us 
     */
    public function actionAboutUs() {
        $this->render('content/aboutUs');
    }

    /**
     * contact Advertising 
     */
    public function actionContactAd() {
        $this->render('content/contactAd');
    }

    /**
     * regulation 
     */
    public function actionRegulation() {
        $this->render('content/regulation');
    }

    /**
     * published Rules 
     */
    public function actionPublishedRules() {
        $this->render('content/publishedRules');
    }

    /**
     * published Help 
     */
    public function actionPublishedHelp() {
        $contentCode = isset($_GET['contentCode']) ? $_GET['contentCode'] : '';
        $this->render('content/publishedHelp', array('contentCode' => $contentCode));
    }

    /**
     * search 
     * &hl=true&hl.fl=title
     */
    public function actionSearch() {
        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $keyword = isset($_GET['keyword']) ? urldecode($_GET['keyword']) : '';
        $catId = isset($_GET['catId']) ? $_GET['catId'] : 0;
        $childCat = isset($_GET['childCat']) ? $_GET['childCat'] : 0;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
        $dId = isset($_GET['did']) ? $_GET['did'] : '';
        $aid = isset($_GET['aid']) ? $_GET['aid'] : '';
        $ext = isset($_GET['ext']) ? $_GET['ext'] : '';
        $sid = isset($_GET['sid']) ? $_GET['sid'] : '';
        $site = isset($_GET['site']) ? $_GET['site'] : '';
        $seoId = isset($_GET['seoId']) ? $_GET['seoId'] : '';
        $keySearchValue = $keyword;
        $location = Yii::app()->session['location'] ? Yii::app()->session['location'] : 0;
        $keyword = strip_tags($keyword);
        if ($keyword) {
            $keyEncode = ExtensionSearch::utf8_to_ascii($keyword);
            $value = Yii::app()->cache->get(md5($_SERVER['REMOTE_ADDR']) . $keyEncode);
            if ($value === false) {
                Yii::app()->cache->set(md5($_SERVER['REMOTE_ADDR']) . $keyEncode, $keyword, 60 * 60);
            } else {
                $keySearchValue = Yii::app()->cache->get(md5($_SERVER['REMOTE_ADDR']) . $keyEncode);
            }
        }

        $query_string = strtolower($_SERVER['REQUEST_URI']);
        if (strpos($query_string, 'home/search?keyword=') > 0) {
            $this->redirect(array('home/search', 'keyword' => $keyEncode, 'catId' => $catId, 'childCat' => $childCat));
        }

        if ($sid) {
            $keyModel = SearchKeyModel::model()->findByPk($sid);
            $keyword = $keySearchValue = $keyModel->name;
            $keyEncode = ExtensionSearch::utf8_to_ascii($keyword);
            $value = Yii::app()->cache->get(md5($_SERVER['REMOTE_ADDR']) . $keyEncode);
            if ($value === false) {
                Yii::app()->cache->set(md5($_SERVER['REMOTE_ADDR']) . $keyEncode, $keyword, 60 * 60);
            }
        } elseif ($seoId) {
            $seoModel = SeoModel::model()->findByPk($seoId);
            $keyword = $keySearchValue = $seoModel->name;
            $keyEncode = ExtensionSearch::utf8_to_ascii($keyword);
            $value = Yii::app()->cache->get(md5($_SERVER['REMOTE_ADDR']) . $keyEncode);
            if ($value === false) {
                Yii::app()->cache->set(md5($_SERVER['REMOTE_ADDR']) . $keyEncode, $keyword, 60 * 60);
            }
        }

        $condition = '';
        if ($keySearchValue) {
            $condition .= '(title:("' . $keySearchValue . '")^100 OR title:(' . $keySearchValue . ')^50 OR description:(' . $keySearchValue . '))';
            if ($catId != 0 && $childCat != 0) {
                $condition .= ' AND (categoryId:"' . $catId . '" OR childCatId:"' . $childCat . '")';
            } else if ($catId != 0) {
                $condition .= ' AND categoryId:"' . $catId . '"';
            } else {
                $condition .= ' OR -categoryId:"' . $catId . '"';
            }
//check neu co nhu cau
            if ($dId != 0) {
                $condition .= ' AND demand:"' . $dId . '"';
            }
            if ($location) {
                $condition .= ' AND locality:"' . $location . '"';
            }

            $dataProvider = new ASolrDataProvider("ASolrDocument");
            $criteria = $dataProvider->getCriteria()->query = $condition;

            $dataProvider->pagination = array(
                'pageSize' => $postPerPage,
            );
        } else {
            $this->render('search/empty');
            exit();
        }

        $currUrl = array();
        if ($keyword)
            $currUrl = array_merge($currUrl, array('keyword' => $keyEncode));
        if ($catId) {
            $categoryName = ExtensionClass::getCurrentCategory($catId);
            $currUrl = array_merge($currUrl, array('catId' => $catId, 'catName' => ExtensionClass::utf8_to_ascii($categoryName)));
        }
        if ($childCat) {
            $catChildName = ExtensionClass::getCurrentCategory($childCat);
            $currUrl = array_merge($currUrl, array('childCat' => $childCat, 'childName' => ExtensionClass::utf8_to_ascii($catChildName)));
        }

        if ($ext && $aid) {
            $extName = ExtensionClass::getAttributesByAid($aid);
            $currUrl = array_merge($currUrl, array('ext' => $ext, 'aid' => $aid, 'extName' => ExtensionClass::utf8_to_ascii($extName)));
        }

        if ($dId) {
            $demandName = ExtensionClass::getCurrentDemand($dId);
            $currUrl = array_merge($currUrl, array('did' => $dId, 'demandName' => ExtensionClass::utf8_to_ascii($demandName)));
        }

        if ($site) {
            $siteName = ExtensionClass::getCurrentSite($site);
            $currUrl = array_merge($currUrl, array('site' => $site, 'siteName' => ExtensionClass::utf8_to_ascii($siteName)));
        }
        /**
         * send email notify 
         */
        $emailNotify = new EmailModel;
        if (isset($_POST['EmailModel'])) {
            $emailNotify->attributes = $_POST['EmailModel'];
            $emailNotify->obj = json_encode($currUrl);
            if ($emailNotify->validate()) {
                $emailNotify->save();
                $this->redirect(array('user/emailnotify', array('email' => $emailNotify->email)));
            }
        }
        /**
         * get attributes by category 
         */
        $listAttr = $listChildAttr = $listDemand = $listChirlByCat = array();
        if ($catId) {
            $listAttr = ExtensionClass::getHomeAttributes($catId);
        }

        /**
         * get statistic 
         */
        $this->keyword = $keyword;
        $statistic = ExtensionClass::getStatistic($catId);
        $site = isset($_GET['site']) ? $_GET['site'] : '';

        if ($catId) {
            $this->render('search/byCategory', array('dataProvider' => $dataProvider, 'keyword' => $keyword, 'listChildAttr' => $listChildAttr, 'listAttr' => $listAttr, 'postPerPage' => $postPerPage, 'dId' => $dId, 'catId' => $catId, 'childCat' => $childCat, 'currUrl' => $currUrl, 'sort' => $sort, 'aid' => $aid, 'site' => $site, 'statistic' => $statistic, 'emailNotify' => $emailNotify));
        } else {
            $this->render('search/view', array('dataProvider' => $dataProvider, 'keyword' => $keyword, 'emailNotify' => $emailNotify, 'postPerPage' => $postPerPage, 'site' => $site, 'currUrl' => $currUrl, 'catId' => $catId, 'childCat' => $childCat));
        }
    }

    /**
     * published topic 
     */
    public function actionPublished() {
//Check Logged-in
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['TopicSlaveModel_sort']) ? str_replace('.desc', '', $_GET['TopicSlaveModel_sort']) : 'createDate';

        $condition = '`authorId` = ' . $userId . ' ';
        $condition .= 'AND `isPublished` = 0 AND isDelete = 0';

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC',
                ));

        $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                    'pagination' => array(
                        'pageSize' => $postPerPage,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('published/view', array(
            'dataProvider' => $dataProvider,
            'sort' => $sort,
//            'emailNotify' => $emailNotify,
            'postPerPage' => $postPerPage,
        ));
    }

    /**
     * @return  DeletedTopic action xử lý tin đã xóa của publisher
     * @author  Chienlv
     */
    public function actionDeletedTopic() {
        $this->pageTitle = 'Sao Băng - Rao vặt - Rao vặt đã xóa';
//Check Logged-in
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['TopicSlaveModel_sort']) ? str_replace('.desc', '', $_GET['TopicSlaveModel_sort']) : 'createDate';

        $condition = ' 1 ';
        $condition .= 'AND `authorId` = ' . $userId . ' ';
        $condition .= 'AND `isDelete` = 1';

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC',
                ));

        $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                    'pagination' => array(
                        'pageSize' => $postPerPage,
                    ),
                    'criteria' => $criteria,
                ));

        $emailNotify = new EmailModel;
        if (isset($_POST['EmailModel'])) {
            $emailNotify->attributes = $_POST['EmailModel'];
            $emailNotify->obj = json_encode($currUrl);
            if ($emailNotify->validate()) {
                $emailNotify->save();
                $this->redirect(array('user/emailnotify', array('email' => $emailNotify->email)));
            }
        }

        $this->render('published/deletedtopic', array(
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'emailNotify' => $emailNotify,
            'postPerPage' => $postPerPage,
        ));
    }

    /**
     * @return  PendingApprovalTopic action xử lý rao vặt chờ duyệt của publisher
     * @author  Chienlv
     * tin da dang
     */
    public function actionPendingApprovalTopic() {
        $this->pageTitle = 'Tin đã đăng';
//Check Logged-in
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['TopicSlaveModel_sort']) ? str_replace('.desc', '', $_GET['TopicSlaveModel_sort']) : 'createDate';

        $condition = '`authorId` = ' . $userId . ' ';
        $condition .= ' AND `isPublished` = 0 ';
        $condition .= ' AND `isDelete` = 0';

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC',
                ));

        $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                    'pagination' => array(
                        'pageSize' => $postPerPage,
                    ),
                    'criteria' => $criteria,
                ));

        $emailNotify = new EmailModel;
        if (isset($_POST['EmailModel'])) {
            $emailNotify->attributes = $_POST['EmailModel'];
            $emailNotify->obj = json_encode($currUrl);
            if ($emailNotify->validate()) {
                $emailNotify->save();
                $this->redirect(array('user/emailnotify', array('email' => $emailNotify->email)));
            }
        }

        $this->render('published/pendingapprovaltopic', array(
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'emailNotify' => $emailNotify,
            'postPerPage' => $postPerPage,
        ));
    }

    /**
     * @return  ApprovedTopic action xử lý rao vặt đã duyệt của publisher
     * @author  Chienlv
     * tin het han
     */
    public function actionApprovedTopic() {
        $this->pageTitle = 'Tin hết hạn';
//Check Logged-in
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['TopicSlaveModel_sort']) ? str_replace('.desc', '', $_GET['TopicSlaveModel_sort']) : 'createDate';


        $condition = '`authorId` = ' . $userId . ' ';

        $condition .= ' AND `endDate` <= \'' . time() . '\'';

        $condition .= ' AND `isDelete` = 0';

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC',
                ));

        $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                    'pagination' => array(
                        'pageSize' => $postPerPage,
                    ),
                    'criteria' => $criteria,
                ));

        $emailNotify = new EmailModel;
        if (isset($_POST['EmailModel'])) {
            $emailNotify->attributes = $_POST['EmailModel'];
            $emailNotify->obj = json_encode($currUrl);
            if ($emailNotify->validate()) {
                $emailNotify->save();
                $this->redirect(array('user/emailnotify', array('email' => $emailNotify->email)));
            }
        }
        $this->render('published/approvedtopic', array(
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'emailNotify' => $emailNotify,
            'postPerPage' => $postPerPage,
                )
        );
    }

    /**
     * @return  SavedTopic action xử lý rao vặt đã lưu của publisher
     * @author  Chienlv
     */
    public function actionSavedTopic() {
        $this->pageTitle = 'Sao Băng - Rao vặt - Tin đã lưu';
//Check Logged-in
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $emailNotify = new EmailModel;
        if (isset($_POST['EmailModel'])) {
            $emailNotify->attributes = $_POST['EmailModel'];
            $emailNotify->obj = json_encode($currUrl);
            if ($emailNotify->validate()) {
                $emailNotify->save();
                $this->redirect(array('user/emailnotify', array('email' => $emailNotify->email)));
            }
        }
        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $ids = '0';
        $topicSaves = TopicSaves::model()->findByPk($userId, array('select' => 'topicIds'));
        if ($topicSaves) {
            $ids = substr($topicSaves->topicIds, 0, -1);
        }

        $condition = ' 1 ';
        $condition .= ' AND id IN(' . $ids . ')';

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC',
                ));
        $dataProvider = new CActiveDataProvider('TopicSlaveModel', array(
                    'pagination' => array(
                        'pageSize' => $postPerPage,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('published/savedtopic', array(
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'postPerPage' => $postPerPage,
            'emailNotify' => $emailNotify
        ));
    }

    /**
     * update topic 
     */
    public function actionUpdateTopic() {
        $id = isset($_GET['topicId']) ? $_GET['topicId'] : 0;
        $code = isset($_GET['code']) ? $_GET['code'] : 'true';
        if ($id) {
            $value = Yii::app()->cache->get('ab_upload_' . $id);
            if ($value === false && $code == 'true') {
                $rand = rand(1, 30 * 60);
                $value = (int) time() - $rand;
                $model = TopicModel::model()->findByPk($id);
                $model->createDate = new CDbExpression('NOW()');
                $model->order = $value;
                $model->update();
                Yii::app()->cache->set('ab_upload_' . $id, $value, 30 * 60);
                echo 'Upload success';
            } else {
                echo 'Rao vặt đã upload, vui lòng chờ 30 phút sau để upload lại';
            }
        } else {
            echo 'Yêu cầu không hợp lệ! Bạn chưa chọn rao vặt cần upload';
        }
    }

    /**
     *  tinvip
     */
    public function actionVip() {
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $condition = '`authorId` = ' . $userId;

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`id` DESC',
                ));

        $dataProvider = new CActiveDataProvider('TopicSlaveAd', array(
                    'pagination' => array(
                        'pageSize' => 15,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('published/vip', array('dataProvider' => $dataProvider));
    }

    /**
     *  super vip
     */
    public function actionSuperVip() {
        if (Yii::app()->session['userId'])
            $this->redirect(array('user/login'));
        $this->render('published/superVip');
    }

    /**
     *  seo
     */
    public function actionSeo() {
        $condition = '`isIndex` = 0';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => 'id DESC',
                ));
        $criteria->limit = 2000;

        $dataProvider = new CActiveDataProvider(SeoModel::model()->cache(200, NULL), array(
                    'pagination' => array(
                        'pageSize' => 2000,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('content/seo', array('dataProvider' => $dataProvider));
    }

    /**
     * vip rules
     * chinh sach tin vip
     */
    public function actionVipRules() {
        $this->layout = 'popup';

        $this->render('content/vipRules');
    }

    /**
     *  load suggest
     */
    public function actionLoadSuggest() {
        $this->layout = 'popup';
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $this->render('search/suggest', array('keyword' => $keyword));
    }

    /**
     * published topic 
     */
    public function actionBlog() {
//Check Logged-in        
        $userId = isset($_GET['id']) ? $_GET['id'] : '0';
        $isVip = GlobalComponents::checkVipMember($userId);

        if (!$userId)
            $this->redirect(array('home/index'));

        if ($isVip === false) {
            $this->render('published/superVip');
            exit();
        }

        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['TopicSlaveModel_sort']) ? str_replace('.desc', '', $_GET['TopicSlaveModel_sort']) : 'createDate';

        $userInfo = UserModel::model()->findByPk($userId);

        $condition = '`authorId` = ' . $userId . ' ';
        $condition .= 'AND `isPublished` = 0';

        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => '`order` DESC',
                ));

        $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                    'pagination' => array(
                        'pageSize' => $postPerPage,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('blog/view', array(
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'postPerPage' => $postPerPage,
            'userInfo' => $userInfo
        ));
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
            $this->render('content/notify', array('model' => $model));
        }
    }

    /*
     * load product from chodientu.vn
     */

    public function actionLoadProductCDT() {
        $this->layout = 'HomeCDT';
        $category_id = isset($_POST['category']) ? $_POST['category'] : '0';
        $item_per_page = 20;
        $page_no = 1;
        $result = Yii::app()->cache->get('home_loadProductCDT_' . $category_id . '_' . $item_per_page . '_' . $page_no);
        if ($result === false) {
            $nusoap = new nusoapclient('http://chodientu.vn/item_webservice.php?wsdl', true);
            $erro = $nusoap->getError();
            $parram = array('password' => '!!!@@@', 'category_id' => $category_id, 'item_per_page' => $item_per_page, 'page_no' => $page_no, 'order' => 'TIME_UPDATE');
            $result = $nusoap->call('searchItem', $parram);
            Yii::app()->cache->set('home_loadProductCDT_' . $category_id . '_' . $item_per_page . '_' . $page_no, $result, 24 * 60 * 60);
        }
        $this->render('loadProductCDT', array('result' => $result));
    }

}
