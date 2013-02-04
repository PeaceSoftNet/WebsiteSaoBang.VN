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
class ExternalController extends CController {

    /**
     * process link 
     */
    public function actionLink() {
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        $link = base64_decode($code);
        $this->redirect($link);
    }

    /**
     * process image 
     */
    public function actionImage() {
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        $img = base64_decode($code);
        $image = Yii::app()->CURL->run($img);
        //end cache
        if ($image) {
            $info = pathinfo($img);
            if (isset($info['extension'])) {
                if ($info['extension'] == 'png') {
                    header("Content-Type: image/png");
                } else if ($info['extension'] == 'gif') {
                    header('Content-Type: image/gif');
                } else {
                    header("Content-Type: image/jpeg");
                }
                echo $image;
            }
        }
    }

    /**
     * test 
     */
    public function actionTest() {
        GlobalComponents::processContent();
    }

    /**
     *  get suggest by xml content
     */
    public function actionGetSuggest() {
        $content = simplexml_load_file('http://google.com/complete/search?output=toolbar&q=dg');
        foreach ($content as $key => $value) {
            $value = $value->children()->attributes();
            foreach ($value as $key => $item) {
                echo $item;
            }
        }
//        var_dump($content);
    }

    /**
     * api xuat du lieu
     */
    public function actionApi() {
        $condition = '`endDate` >= ' . (int) (time());
        $condition = '`endDate` >= ' . (int) (time() + 30 * 24 * 60 * 60 - 5 * 60 * 60);
        $condition .= ' AND `icon` != \'\' AND `price` > 10000';
        $conditionMd5 = md5($condition);
        $listKey = Yii::app()->cache->get('apiExternal');
        if ($listKey === false) {
            $orderArr = array('0' => 'id', '1' => 'title', '2' => 'categoryId', '3' => 'childCatId', '4' => 'createDate');
            $orderTp = array('0' => 'ASC', '1' => 'DESC');
            $sql = 'SELECT `id` ,`title`, `icon`, `price` FROM {{topic}} WHERE ' . $condition . ' ORDER BY ' . $orderArr[rand(0, 4)] . ' ' . $orderTp[rand(0, 1)] . ' LIMIT 0 , 8';
            $command = Yii::app()->dbSlave->createCommand($sql);
            $listKey = $command->queryAll();
            Yii::app()->cache->set('apiExternal', $listKey, 20);
        }
        var_dump($listKey);
        echo json_encode($listKey);
    }

    /**
     *  write html
     */
    public function actionAd() {
        $this->layout = 'popup';
        $condition = '`endDate` >= ' . (int) (time() + 30 * 24 * 60 * 60 - 5 * 60 * 60);
        $condition = '`endDate` >= ' . (int) time();
        $catTitle = isset($_GET['title']) ? $_GET['title'] : 'khac';

        if ($catTitle == 'giao-duc') {
            $condition .= ' AND (`categoryId` = 296 OR `categoryId` = 164)';
        } else if ($catTitle == 'thoi-trang') {
            $condition .= ' AND `categoryId` = 133';
        } else if ($catTitle == 'cong-nghe') {
            $condition .= ' AND `categoryId` = 122';
        } else if ($catTitle == 'o-to-xe-may') {
            $condition .= ' AND (`categoryId` = 15 OR `categoryId` = 36)';
        } else if ($catTitle == 'du-lich') {
            $condition .= ' AND `categoryId` = 99';
        } else {
            $condition .= '';
        }
        $condition .= ' AND `icon` != \'\' AND `price` > 10000';
        $orderArr = array('0' => 'id', '1' => 'title', '2' => 'categoryId', '3' => 'childCatId', '4' => 'createDate');
        $orderTp = array('0' => 'ASC', '1' => 'DESC');
        $sql = 'SELECT `id` ,`title`, `icon`, `price` FROM {{topic}} WHERE ' . $condition . ' ORDER BY ' . $orderArr[rand(0, 4)] . ' ' . $orderTp[rand(0, 1)] . ' LIMIT 0 , 8';
        $command = Yii::app()->dbSlave->createCommand($sql);
        $listKey = $command->queryAll();
        $this->render('ad', array('data' => $listKey, 'catTitle' => $catTitle));
    }

    /**
     * map category from chodientu
     */
    public function actionMapCategoryChodientu() {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        var_dump($referer);
        $fromUrl = isset($_GET['url']) ? $_GET['url'] : $referer;
        if ($fromUrl) {
            preg_match("|\d+|", $fromUrl, $m);
            $idTranf = isset($m[0]) ? $m[0] : 0;
            $type = isset($_GET['type']) ? $_GET['type'] : 'topic';
            if ($idTranf > 0 && $type = 'category') {
                $model = CategoryMapFromChodientu::model()->find('`id` = ' . $idTranf);
                if ($model) {
                    $sbCategory = CategoryModel::model()->findByPk($model->sb_id);
                    if ($model->sb_parent) {
                        $sbCategoryRedirect = Yii::app()->createUrl('home/category', array('catId' => $sbCategory->id, 'name' => ExtensionClass::utf8_to_ascii($sbCategory->name), 'childCat' => $sbCategory->id, 'childName' => ExtensionClass::utf8_to_ascii($sbCategory->name)));
                    } else {
                        $sbCategoryRedirect = Yii::app()->createUrl('home/category', array('catId' => $sbCategory->id, 'name' => ExtensionClass::utf8_to_ascii($sbCategory->name)));
                    }
                    $this->redirect($sbCategoryRedirect);
                } elseif ($idTranf > 0) {
                    $data = TopicSlaveModel::model()->findByPk($idTranf);
                    if ($data) {
                        $topicLink = Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title)));
                        $this->redirect($topicLink);
                    } else {
                        $this->redirect('http://saobang.vn');
                    }
                } else {
                    $this->redirect('http://saobang.vn');
                }
            } else {
                $this->redirect('http://saobang.vn');
            }
        }
    }

    /**
     * shop
     */
    public function actionShop() {
        $this->layout = 'popup';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = ShopModel::model()->findByPk($id);
            $modelIdentify = ShopIdentify::model()->findByPk($id);
            $model->tag = json_decode($model->tag);
        } else {
            $model = new ShopModel;
            $modelIdentify = new ShopIdentify;
        }
        $modelTag = new tagModel();
        if (isset($_POST['ShopModel']) && isset($_POST['ShopIdentify'])) {
            echo '<pre>';
            var_dump($_POST['ShopModel']);
            var_dump($_POST['ShopIdentify']);
            echo '</pre>';
            $model->attributes = $_POST['ShopModel'];
            $modelIdentify->attributes = $_POST['ShopIdentify'];
            $model->tag = json_encode($model->tag);
            if ($model->validate() && $modelIdentify->validate()) {
                $model->save();
                $modelIdentify->save();
                var_dump($model->attributes);
                var_dump($modelIdentify->attributes);
                exit();
            } else {
                echo 'Errror';
            }
        }
        $this->render('shop', array('model' => $model, 'modelTag' => $modelTag, 'modelIdentify' => $modelIdentify));
    }

    /**
     * read email
     */
    public function actionReadEmail() {
        header('Content-Type: image/png');
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $emailModel = AskEmail::model()->findByPk($id);
            $emailModel->isOpen = 1;
            $emailModel->openDate = new CDbExpression('NOW()');
            $emailModel->hash = md5($askId . '_' . $email . $emailModel->openDate);
            $emailModel->update();
        }
        $data = Yii::app()->CURL->run('http://data.saobang.vn/themes/homepage/images/logo-Rv-beta.png');
        echo $data;
    }

}