<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *  1.. chay http://saobang.vn/statistic/crawlerMyself de lay link
 *  2.. chay saobang.vn/statistic/runStatistic tu dong thong ke
 */
class StatisticController extends Controller {

    public $layout = 'popup700';

    /**
     * set value 
     */
    public function actionCategory() {
        $duration = 2;
        $catId = isset($_GET['catId']) ? $_GET['catId'] : 0;
        $childCat = isset($_GET['childCat']) ? $_GET['childCat'] : '';
        $location = Yii::app()->session['location'] ? Yii::app()->session['location'] : 0;
        $location = isset($_GET['location']) ? $_GET['location'] : $location;
        $dId = isset($_GET['did']) ? $_GET['did'] : '';
        $aid = isset($_GET['aid']) ? $_GET['aid'] : '';
        $ext = isset($_GET['ext']) ? $_GET['ext'] : '';
        $site = isset($_GET['site']) ? $_GET['site'] : '';
        if ($ext > 5)
            exit();
        /**
         * current Url 
         */
        $condition = '1';

        $currUrl = array('catId' => $catId);

        if ($location && $location != 0) {
            $condition .= ' AND `locality` = ' . $location;
        }

        if ($catId || $childCat) {
            $condition .= ' AND `categoryId` = ' . $catId;
            //category name
            $catName = isset($_GET['name']) ? $_GET['name'] : '';
            if ($catName)
                $currUrl = array_merge($currUrl, array('name' => $catName));

            if ($childCat) {
                $condition .= ' AND `childCatId` = ' . $childCat;
                $currUrl = array_merge($currUrl, array('childCat' => $childCat));
                //child category name
                $childName = isset($_GET['childName']) ? $_GET['childName'] : '';
                if ($childName)
                    $currUrl = array_merge($currUrl, array('childName' => $childName));
            }
        }
        if ($dId) {
            $condition .= ' AND `demand` = ' . $dId;
            $currUrl = array_merge($currUrl, array('did' => $dId));
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
            $currUrl = array_merge($currUrl, array('site' => $site));
        }
        if ($location) {
            $condition .= ' AND `locality` = ' . $location;
        }
        $condition .= ' AND `isDelete` = 0';

        //end set day
        $condition2 = $condition;
        $dependecy = new CDbCacheDependency('SELECT MAX(`code`) FROM {{topic}}');
        $criteria = new CDbCriteria(array(
                    'select' => 'id',
                    'condition' => $condition2,
                    'order' => '`order` DESC, `createDate` DESC',
                ));

        $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache($duration, $dependecy, 2), array(
                    'criteria' => $criteria,
                ));

        $keyStatic = $currUrl;
        if (isset($keyStatic['name']))
            unset($keyStatic['name']);
        if (isset($keyStatic['childName']))
            unset($keyStatic['childName']);

        //processing
        $keyValue = isset($_POST['key']) ? $_POST['key'] : json_encode($keyStatic);
        $model = StatisticModel::model()->find('LOWER(`key`)=?', array(strtolower($keyValue)));
        if (!$model)
            $model = new StatisticModel;
        $model->controller = 'home';
        $model->action = 'category';
        $model->category = $catId;
        $model->key = $keyValue;
        $model->value = $dataProvider->totalItemCount;
        $model->locality = $location;
        $model->url = Yii::app()->createUrl('statistic/category', $currUrl);
        if ($model->validate()) {
            $model->save();
            echo $dataProvider->totalItemCount;
        } else {
            echo '0';
        }
    }

    /**
     * statistic by site 
     */
    public function actionSite() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $model = CrawlerSite::model()->findByPk($id);
        if ($model) {
            $condition = '`isDelete` = 0  AND `site` = ' . $id;
            $criteria = new CDbCriteria(array(
                        'select' => 'id',
                        'condition' => $condition,
                    ));

            $dataProvider = new CActiveDataProvider('TopicSlaveModel', array(
                        'criteria' => $criteria,
                    ));

            $total = (int) $dataProvider->totalItemCount;

            $model->totalLink = $total;

            $model->save();

            return $total;
        } else {
            return 0;
        }
    }

    /**
     * auto update by site 
     */
    public function actionAutoBySite() {

        $sql = 'SELECT MAX(`id`) FROM `tbl_site`';
        $command = Yii::app()->db->createCommand($sql);
        $id = $command->queryScalar();
        $idFilePath = 'data/auto/siteId.txt';
        if (!file_exists($idFilePath)) {
            $fp = fopen($idFilePath, 'w');
            fwrite($fp, 1);
            fclose($fp);
        }
        $currentId = file_get_contents($idFilePath);
        $currentId = (int) $currentId;
        if (!$currentId || $currentId > $id)
            $currentId = 1;
        $data = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('statistic/site', array('id' => $currentId)));

        $name = 'site_' . date('Y') . date('m') . date('d') . '.html';
        $content = $data ? $data : '0';

        $text = ' Time: <i style="color:blue">' . date('h:i:s d/m/Y') . '</i>';
        $text .= ' id: <strong style="color:red">' . $currentId . '</strong>';
        $text .= ' Content: <p style="color:green">' . $content . '</p>';
        $text .= '<br />';
        //write log
        $fp = fopen('data/auto/' . $name, 'a+');
        fwrite($fp, $text);
        fclose($fp);
        //write site last update
        $fp = fopen($idFilePath, 'w');
        fwrite($fp, ($currentId + 1));
        fclose($fp);
        $dataSaoBang = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('statistic/site', array('id' => 25)));
    }

    public function actionAutoRun() {
        $sql = 'SELECT MAX(`id`) FROM `tbl_statistic`';
        $command = Yii::app()->db->createCommand($sql);
        $id = $command->queryScalar();
        $idFilePath = 'data/auto/currentId.txt';
        if (!file_exists($idFilePath)) {
            $fp = fopen($idFilePath, 'w');
            fwrite($fp, 1);
            fclose($fp);
        }
        $currentId = file_get_contents($idFilePath);
        $currentId = (int) $currentId;
        $currentId++;
        $fp = fopen($idFilePath, 'w');
        fwrite($fp, $currentId);
        fclose($fp);
        if (!$currentId || $currentId >= $id)
            $currentId = 1;

        for ($i = $currentId; $i < ($currentId + 10); $i++) {
            self::runById($i);
        }
        //write file last id update
        $fp = fopen('data/auto/currentId.txt', 'w');
        fwrite($fp, $i);
        fclose($fp);

        echo $currentId;
    }

    public function runById($id) {

        $model = StatisticModel::model()->findByPk($id);
        if ($model) {
            $url = $model->url;
            $key = $model->key;

            $data = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . $url, FALSE, array(
                'key' => $key
                    ));
            $name = date('Y') . date('m') . date('d') . '.html';
            $content = $data ? $data : '0';

            $text = ' Time: <i style="color:blue">' . date('h:i:s d/m/Y') . '</i>';
            $text .= ' id: <strong style="color:red">' . $id . '</strong>';
            $text .= ' key: ' . $key;
            $text .= ' Content: <p style="color:green">' . $content . '</p>';
            $text .= '<br />';
            //write log
            $fp = fopen('data/auto/' . $name, 'a+');
            fwrite($fp, $text);
            fclose($fp);
        }
    }

    /**
     * run by url 
     */
    public function actionRunStatistic() {
        $idFilePath = 'data/auto/statistic.txt';
        //check file, it not exit create new files
        if (!file_exists($idFilePath)) {
            $fp = fopen($idFilePath, 'w');
            fwrite($fp, 1);
            fclose($fp);
        }
        //get current content of file
        $currentId = file_get_contents($idFilePath);

        $model = StatisticUrl::model()->find('`id` = ' . $currentId);
        //set current id
        $currentId = (int) $currentId;
        if (!$currentId || !isset($model))
            $currentId = 1;
        //write new log
        $newId = $currentId + 1;
        $fp = fopen($idFilePath, 'w');
        fwrite($fp, $newId);
        fclose($fp);


        if (isset($model['name'])) {
            if ($model['type'] == 2) {
                $data = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . $model['name'] . '?isCount=1');
            } else {
                $data = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . $model['name'] . '&isCount=1');
            }
            $name = 'Statistic_' . date('Y') . date('m') . '.html';
            $text = ' Time: <i style="color:blue">' . date('h:i:s d/m/Y') . '</i>';
            $text .= ' id: <strong style="color:red">' . $currentId . '</strong>';
            $text .= ' url: <strong style="color:red">' . $model['name'] . '</strong>';
            $text .= '<br />';
            echo $text;
            $fp = fopen('data/auto/' . $name, 'a+');
            fwrite($fp, $text);
            fclose($fp);
        } else {
            $name = 'Statistic_' . date('Y') . date('m') . '.html';
            $text = ' Time: <i style="color:blue">' . date('h:i:s d/m/Y') . '</i>';
            $text .= ' id: <strong style="color:red">' . $currentId . '</strong>';
            $text .= ' url: <strong style="color:red"> ERR model</strong>';
            $text .= '<br />';
            echo $text;
            $fp = fopen('data/auto/' . $name, 'a+');
            fwrite($fp, $text);
            fclose($fp);
        }
    }

    /**
     * crawlse myself 
     */
    public function actionCrawlerMyself() {
        //truncate db
        $truncate = isset($_GET['truncate']) ? $_GET['truncate'] : '';
        if ($truncate) {
            $sql = 'TRUNCATE `tbl_statistic_url`';
            $command = Yii::app()->db->createCommand($sql);
            $command->execute();
        }
        $servername = 'http://' . $_SERVER['HTTP_HOST'];
        $url = $servername;
        $content = Yii::app()->CURL->run($url);
        $list = array();
        $patterm = '#<a href="(.*?)">#';
        preg_match_all($patterm, $content, $match);
        foreach ($match[1] as $key => $value) {
            if (stripos($value, "0.html") !== false || stripos($value, "1.html") !== false || stripos($value, "2.html") !== false || stripos($value, "3.html") !== false || stripos($value, "4.html") !== false || stripos($value, "5.html") !== false || stripos($value, "6.html") !== false || stripos($value, "0.html") !== false || stripos($value, "7.html") !== false || stripos($value, "8.html") !== false || stripos($value, "9.html") !== false) {
                $list[] = $value;
            }
        }
        foreach ($list as $key => $url) {
            $str = str_replace('.html', '', $url);
            $str = str_replace('/', '', $str);
            $url = $servername . $url;
            $content = Yii::app()->CURL->run($url);
            $patterm = '#<a href="(.*?)">#';
            preg_match_all($patterm, $content, $match);
            foreach ($match[1] as $key => $value) {
                if (stripos($value, "itemprop") === false && stripos($value, $str) !== false && stripos($value, "TopicSlaveModel_page") === false && stripos($value, "TopicSlaveModel_sort") === false) {
                    $model = new StatisticUrl;
                    $model->name = $value;
                    if (stripos($value, ".html?") !== false) {
                        $model->type = 1;
                    } else {
                        $model->type = 2;
                    }
                    if ($model->validate()) {
                        $model->save();
                        echo 'url: ' . $value . '<br />';
                    }
                }
            }
        }
    }

}