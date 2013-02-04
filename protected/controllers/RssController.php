<?php

/**
 * @author  Chienlv
 * @param   Rss
 * @return  Class xử lý rss và site map
 */
class RssController extends Controller {

    /**
     * set layout
     * @return type 
     */
    public $layout = 'popup';

    public function init() {
        return parent::init();
    }

    public function filters() {
        header("Content-Type: text/xml");
    }

    /**
     * @author  Chienlv
     * @param   SiteMap
     * @return  Action tạo site map
     */
    public function actionSiteMapXml() {
        $ip = $_SERVER["REMOTE_PORT"];
        $host = Yii::app()->request->getHostInfo() . Yii::app()->request->getBaseUrl();
        #all categories
        $categories = ExtensionClass::allCategories();
        $limit = rand(1, 1000);
        //get list keyword
        $sql = 'SELECT * FROM {{search_key}} WHERE `id` > ' . $limit . ' AND `googleActive` = 0 LIMIT 0, 30';
        $command = Yii::app()->db->createCommand($sql);
        $listKey = $command->queryAll();
        $this->renderPartial('xml', array(
            'categories' => $categories,
            'host' => $host,
            'listKey' => $listKey
        ));
    }

    /**
     * create site map content 
     */
    public function actionSiteContent() {
        $host = Yii::app()->request->getHostInfo() . Yii::app()->request->getBaseUrl();
        #all categories
        $categories = ExtensionClass::allCategories();
        $sql = 'SELECT `url` FROM `tbl_sitemap`';
        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryColumn();
        $this->renderPartial('content', array(
            'categories' => $categories,
            'host' => $host,
            'content' => $rs,
        ));
    }

    /**
     * create site map content 
     */
    public function actionTopicContent() {

        $value = Yii::app()->cache->get('cache123sitemaontent112012');
        if ($value === false) {
            // regenerate $value because it is not found in cache
            // and save it in cache for later use:
            $value = 0;
            Yii::app()->cache->set('cache123sitemaontent112012', $value, 60 * 60 * 24);
        } else {
            $value++;
            Yii::app()->cache->set('cache123sitemaontent112012', $value, 60 * 60 * 24);
        }
        $page = $value;
        $host = Yii::app()->request->getHostInfo() . Yii::app()->request->getBaseUrl();
        #all categories
        $code = $value * 5000;

        $sql = 'SELECT `id`,`title` FROM `{{topic}}` WHERE `code` >= ' . $code . ' ORDER BY `code` DESC LIMIT 5000';

        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryAll();
        
        $this->renderPartial('topic', array(
            'host' => $host,
            'content' => $rs,
            'page' => $page
        ));
    }

}

?>
