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
class AutorunController extends Controller {

    /**
     * Make thumbs from JPEG, PNG, GIF source file
     *
     * $tmpname = $_FILES['source']['tmp_name'];  
     * $size - max width size
     * $save_dir - destination folder
     * $save_name - tnumb new name
     * $maxisheight - is max for width (if not is for height)
     *
     * Author:  David Taubmann http://www.quidware.com (edited from LEDok - http://www.citadelavto.ru/)
     */
    /* /    // And now how using this function fast:
      if ($_POST[pic])
      {
      $tmpname  = $_FILES['pic']['tmp_name'];
      @img_resize( $tmpname , 600 , "../album" , "album_".$id.".jpg");
      @img_resize( $tmpname , 120 , "../album" , "album_".$id."_small.jpg");
      @img_resize( $tmpname , 60 , "../album" , "album_".$id."_maxheight.jpg", 1);
      }
      else
      echo "No Images uploaded via POST";
      /* */

    public function img_resize($tmpname, $size, $save_dir, $save_name, $maxisheight = 0) {
        $save_dir .= ( substr($save_dir, -1) != "/") ? "/" : "";
        $gis = getimagesize($tmpname);
        $type = $gis[2];
        switch ($type) {
            case "1": $imorig = imagecreatefromgif($tmpname);
                break;
            case "2": $imorig = imagecreatefromjpeg($tmpname);
                break;
            case "3": $imorig = imagecreatefrompng($tmpname);
                break;
            default: $imorig = imagecreatefromjpeg($tmpname);
        }

        $x = imagesx($imorig);
        $y = imagesy($imorig);

        $woh = (!$maxisheight) ? $gis[0] : $gis[1];

        if ($woh <= $size) {
            $aw = $x;
            $ah = $y;
        } else {
            if (!$maxisheight) {
                $aw = $size;
                $ah = $size * $y / $x;
            } else {
                $aw = $size * $x / $y;
                $ah = $size;
            }
        }
        $im = imagecreatetruecolor($aw, $ah);
        if (imagecopyresampled($im, $imorig, 0, 0, 0, 0, $aw, $ah, $x, $y))
            if (imagejpeg($im, $save_dir . $save_name))
                return $save_dir . $save_name;
            else
                return false;
    }

    /**
     * find demand and process
     */
    public function actionDemand() {
        //get value
        $demand = isset($_GET['demand']) ? $_GET['demand'] : '';
        $categoryId = isset($_GET['catId']) ? $_GET['catId'] : '';
        $childCat = isset($_GET['childCat']) ? $_GET['childCat'] : '';
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $recordSpace = 100;
        $key = base64_encode($demand . '_' . $categoryId . '_' . $childCat . '_' . ($keyword));

        //run set model
        $model = AutorunModel::model()->find('`catId` = ' . $categoryId . ' AND `childCat` = ' . $childCat . ' AND `key` = "' . $key . '"');
        if (!$model) {
            $model = new AutorunModel;
            $condition = '`title` LIKE "%' . $keyword . '%" AND `categoryId` = ' . $categoryId . ' AND `childCatId` = ' . $childCat . ' ' . ' AND `code`<=' . $recordSpace;
            TopicModel::model()->updateAll(array('demand' => $demand), $condition);
            $model->catId = $categoryId;
            $model->childCat = $childCat;
            $model->key = $key;
            $model->keyword = $keyword;
            $model->value = $recordSpace;
            $model->save();
        } else {
            $condition = '`title` LIKE "%' . $keyword . '%" AND `categoryId` = ' . $categoryId . ' AND `childCatId` = ' . $childCat . ' ' . ' AND `code`<=' . $model->value . ' AND `code` >= ' . ($model->value + $recordSpace);
            TopicModel::model()->updateAll(array('demand' => $demand), $condition);
            $model->value = $model->value + $recordSpace;
            $model->update();
        }
    }

    /**
     * create site map content
     */
    public function actionCreateSitemap() {
        $sqlmaxcode = 'SELECT MAX(`lastCode`) FROM `tbl_sitemap`';
        $commandMc = Yii::app()->db->createCommand($sqlmaxcode);
        $code = $commandMc->queryScalar() ? $commandMc->queryScalar() : 0;
        $limit = 10000;
        $sql = 'SELECT `id`, `title`, `code` FROM `tbl_topic` WHERE `code` > ' . $code . ' LIMIT ' . $limit;
        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryAll();
        if ($rs) {
            foreach ($rs as $key => $value) {
                $list[] = Yii::app()->createUrl('home/TopicDetail', array('id' => $value['id'], 'name' => ExtensionClass::utf8_to_ascii($value['title'])));
                $newCode = isset($value['code']) ? $value['code'] : $limit;
            }
            $model = new SitemapModel;
            $model->url = json_encode($list);
            $model->lastCode = $newCode;
            $model->save();
        } else {
            echo 'Limited';
        }
    }

    /**
     *  write file html
     */
    public function actionWriteFile() {
        $filePath = 'data/ad.html';
        $content = Yii::app()->CURL->run('http://saobang.vn/external/ad');
        $fp = fopen($filePath, 'w');
        fwrite($fp, $content);
        fclose($fp);
        echo 'okie';
    }

    /**
     *  write file html
     */
    public function actionWriteJsWg() {
        $filePath = 'wg250.js';
        $content = Yii::app()->CURL->run('http://saobang.vn/Javascript/WidgetsCDT');
        $fp = fopen($filePath, 'w+');
        fwrite($fp, $content);
        fclose($fp);
        echo 'okie';
    }

    /**
     * auto uptin vip
     */
    public function actionUpVip() {
        //find a vip topic from slave
        $vipTopic = TopicSlaveAd::model()->findAll('`timeValue` > ' . time());
        foreach ($vipTopic as $key => $modelAd) {
            Yii::app()->CURL->run('http://saobang.vn/home/updateTopic?topicId=' . $modelAd->id);
        }
        return true;
    }

    /**
     * check replicate
     */
    public function actionCheckDatabase() {
        $analy = 'ANALYZE TABLE tbl_topic;';
        $command = Yii::app()->db->createCommand($analy);
        $command->execute();
        //check db
        $sql = 'SELECT MAX(`code`) FROM {{topic}}';
        $commandSlave = Yii::app()->dbSlave->createCommand($sql);
        $rsSlave = $commandSlave->queryColumn();
        $commandMaster = Yii::app()->db->createCommand($sql);
        $rsMaster = $commandMaster->queryColumn();
        $current = date('d-m-Y h:m:s');
        if ($rsMaster != $rsSlave) {
            //replicate error
            $content = '<h4>Chào bạn.</h4><p>Bạn nhận được email này do hệ thống không đồng bộ khi tự động kiểm tra liệu trên master và slave lúc ' . $current . '. Vui lòng kiểm tra lại hệ thống dữ liệu để chắc chắn là website của bạn đang chạy ổn định. Cảm ơn. </p>';
            ExtensionClass::mailSend('saobang@peacesoft.net', 'Lỗi dữ liệu trên SaoBang.vn', $content);
            echo 'Check error';
        } else {
            echo 'Check okie';
        }
    }

    /**
     * send email notify
     */
    public function actionEmailNotify() {
        $criteria = new CDbCriteria(array(
                    'condition' => '`isSend` = 0',
                ));
        $criteria->limit = 5;

        $dataProvider = new CActiveDataProvider('AskEmail', array(
                    'pagination' => false,
                    'criteria' => $criteria,
                ));
        $dataProvider = $dataProvider->getData();

        if ($dataProvider) {
            foreach ($dataProvider as $index => $data) {
                $content = $data->content;
                $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head>
                    <body>  	
                        ' . $data->content . '
                        <div style="position: fixed; bottom: 30px; right: 200px;"><img height="30px" src="http://saobang.vn' . Yii::app()->createUrl('external/readEmail', array('id' => $data->id)) . '" alt="saobang.vn"></div>
                    </body>                    
                </html>';
                ExtensionClass::mailSend($data->email, $data->title, $content);
                $askEmail = AskEmail::model()->findByPk($data->id);
                $askEmail->isSend = 1;
                $askEmail->update();
                echo $content;
                echo $data->email . '<br />';
            }
            echo '<pre>';
            var_dump($dataProvider);
            echo '</pre>Success';
        } else {
            echo 'Eror';
        }
    }

}