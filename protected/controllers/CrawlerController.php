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
class CrawlerController extends Controller {

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
            array('allow',
                'actions' => array('attributes', 'demand'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * public function add 
     */
    public function actionDemand() {
        $keyword = isset($_GET['title']) ? $_GET['title'] : '';
        $catId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
        $demand = isset($_GET['demand']) ? $_GET['demand'] : '';
        $func = isset($_GET['func']) ? $_GET['func'] : '';
        if ($func) {
            $func = '-';
        }
        $condition = '';
        if ($keyword) {
            $listDemand = array();
            $condition .= '(' . $func . 'title:("' . $keyword . '")^100 OR ' . $func . 'description:("' . $keyword . '"))';
            if ($catId != 0) {
                $condition .= ' AND categoryId:' . $catId;
                $listDemand = ExtensionClass::getDemandByCategory($catId);
            }
            $condition .= ' AND -demand:*';

            $dataProvider = new ASolrDataProvider("ASolrDocument");
            $criteria = $dataProvider->getCriteria()->query = $condition;

            $dataProvider->pagination = array(
                'pageSize' => 20,
            );
            if ($dataProvider->getSolrQueryResponse() === null) {
                $dataProvider->getData();
            }
            if ($demand) {
                $this->render('demand/processView', array('dataProvider' => $dataProvider, 'listDemand' => $listDemand, 'keyword' => $keyword, 'catId' => $catId, 'demand' => $demand));
                exit();
            }
            $this->render('demand/view', array('dataProvider' => $dataProvider, 'listDemand' => $listDemand, 'keyword' => $keyword, 'catId' => $catId));
        } else {
            $this->render('demand/demandNone');
        }
    }

    /**
     * xu ly nhu cau 
     */
    public function actionProcessDemand() {
        $model = new TopicModel;
        $this->render('demand/processDemand', array('model' => $model));
    }

    /**
     * process attributes 
     */
    public function actionAttributes() {
        $keyword = isset($_GET['title']) ? $_GET['title'] : '';
        $catId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
        $func = isset($_GET['func']) ? $_GET['func'] : ''; // tim khac
        $ext = isset($_GET['ext']) ? $_GET['ext'] : '';
        if ($func) {
            $func = '-';
        }
        $condition = '';
        if ($keyword) {
            $listDemand = array();
            $condition .= '(' . $func . 'title:(' . $keyword . ')^100 OR ' . $func . 'description:(' . $keyword . '))';
            if ($catId != 0) {
                $condition .= ' AND categoryId:' . $catId;
                $listDemand = ExtensionClass::getDemandByCategory($catId);
            }

            $condition .= ' AND -extension' . $ext . ':* AND -extension' . $ext . ':0';

            $dataProvider = new ASolrDataProvider("ASolrDocument");
            $criteria = $dataProvider->getCriteria()->query = $condition;

            $dataProvider->pagination = array(
                'pageSize' => 20,
            );
            $extension1 = isset($_GET['extension1']) ? $_GET['extension1'] : '';
            $extension2 = isset($_GET['extension2']) ? $_GET['extension2'] : '';
            $extension3 = isset($_GET['extension3']) ? $_GET['extension3'] : '';
            $extension4 = isset($_GET['extension4']) ? $_GET['extension4'] : '';
            $extension5 = isset($_GET['extension5']) ? $_GET['extension5'] : '';
            if ($extension1 || $extension2 || $extension3 || $extension4 || $extension5) {
                $this->render('attributes/processView', array('dataProvider' => $dataProvider, 'ext' => $ext, 'keyword' => $keyword, 'catId' => $catId, 'extension1' => $extension1, 'extension2' => $extension2, 'extension3' => $extension3, 'extension4' => $extension4, 'extension5' => $extension5));
                exit();
            }
            $this->render('attributes/view', array('dataProvider' => $dataProvider, 'ext' => $ext, 'keyword' => $keyword, 'catId' => $catId));
        } else {
            $this->render('attributes/none');
        }
    }

    /**
     * xu ly thuoc tinh
     */
    public function actionSearchAttributes() {
        $model = new TopicModel;
        $this->render('attributes/searchAttributes', array('model' => $model));
    }

    /**
     * save to crontab 
     */
    public function actionSaveToCron() {
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        if ($url) {
            $model = new AttributesCrontab;
            $model->url = $url;
            $model->save();
        }
    }

    /**
     * create link saobang throught crawler
     */
    public function actionCreateSBUrl() {
        $this->layout = 'HomePage';
        $value = Yii::app()->cache->get('crawler_CreateSBUrl');
        if ($value === false) {
            $value = 0;
            $url = 'http://saobang.vn';
            Yii::app()->cache->set('crawler_CreateSBUrl', $value, 24 * 60 * 60);
        } else {
            $value++;
            $urlModel = SystemLink::model()->findByPk($value);
            $url = $urlModel->link;
            Yii::app()->cache->set('crawler_CreateSBUrl', $value, 24 * 60 * 60);
        }

        $content = Yii::app()->CURL->run($url);

        $model = new SystemLink();

        $list = $condition = '';

        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?\.html)\\1[^>]*>(.*)<\/a>";
        if (preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $link = $match[2];
                $link = str_replace('http://saobang.vn', '', $link);
                $link = 'http://saobang.vn' . $link;
                if (self::checkSystemLink($link)) {
                    $model->link = $link;
                    if ($model->validate()) {
                        $condition .= ', (NULL, \'' . $link . '\')';
                        $list .= $link . '<br />';
                    }
                }
            }
        }

        if (strlen($condition) > 5) {
            $condition = substr($condition, 1);
            $sql = "INSERT INTO `tbl_system_link`(`id`, `link`) VALUES " . $condition;
            $command = Yii::app()->db->createCommand($sql);
            $command->execute();
        }
        $this->render('createSBUrl', array('list' => $list));
    }

    /**
     * check link is system
     */
    public function checkSystemLink($query_string) {
        if (strpos($query_string, 'c.html') > 0) {
            return false;
        } elseif (strpos($query_string, 'http://') > 0) {
            return false;
        } elseif (strpos($query_string, '-page50.html') > 0) {
            return false;
        } else {
            return true;
        }
    }

}