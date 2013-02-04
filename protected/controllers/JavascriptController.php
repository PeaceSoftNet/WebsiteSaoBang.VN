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
class JavascriptController extends Controller {

    public function init() {
        return parent::init();
    }

    public function filters() {
        Header("content-type: application/x-javascript");
    }

    /**
     * test 
     */
    public function actionSb230tranfer() {
        $condition = '`endDate` >= ' . (int) (time() + 30 * 24 * 60 * 60 - 5 * 3600);
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

        $conditionMd5 = md5($condition);
        $listKey = Yii::app()->cache->get('js_Sb230tranferAd' . $conditionMd5);
        if ($listKey === false) {
            $orderArr = array('0' => 'id', '1' => 'title', '2' => 'categoryId', '3' => 'childCatId', '4' => 'createDate');
            $orderTp = array('0' => 'ASC', '1' => 'DESC');
            $sql = 'SELECT `id` ,`title`, `icon`, `price` FROM {{topic}} WHERE ' . $condition . ' ORDER BY ' . $orderArr[rand(0, 4)] . ' ' . $orderTp[rand(0, 1)] . ' LIMIT 0 , 8';
            $command = Yii::app()->dbSlave->createCommand($sql);
            $listKey = $command->queryAll();
            Yii::app()->cache->set('js_Sb230tranferAd' . $conditionMd5, $listKey, 12 * 60 * 60);
        }
        $this->render('sb230tranfer', array('data' => $listKey, 'catTitle' => $catTitle));
    }

    /**
     *  widgets chodientu.vn
     */
    public function actionWidgetsCDT() {
        $domain = 'http://saobang.vn';
        $categoryCDT = isset($_GET['category']) ? $_GET['category'] : '';
        $withValue = isset($_GET['w']) ? $_GET['w'] : '190';
        $withValue = (int) $withValue;
        $category = '';
        $value = Yii::app()->cache->get('cdt_category_map_' . $categoryCDT);
        if ($value === false) {
            if ($categoryCDT) {
                $modelCDT = CategoryMapFromChodientu::model()->find('`id` = ' . $categoryCDT);
                if (isset($modelCDT->sb_id)) {
                    $category = $modelCDT->sb_id;
                }
            }
            Yii::app()->cache->set('cdt_category_map_' . $categoryCDT, $category, 24 * 60 * 60);
        } else {
            $category = $value;
        }

        $datatime = time() + 30 * 24 * 60 * 60 - 2 * 60 * 60;

        $condition = '`endDate` > ' . $datatime;
        if ($category)
            $condition .= ' AND `categoryId` = ' . $category;
        $dataProvider = Yii::app()->cache->get('javascript_WidgetsCDT_' . $category);
        if ($dataProvider === false) {
            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`isSms` DESC, `createDate` DESC',
                    ));

            $criteria->select = '`id`, `title`, `icon`, `price`, `createDate`, `domain`';

            $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache(6, NULL), array(
                        'pagination' => array(
                            'pageSize' => 16,
                        ),
                        'criteria' => $criteria,
                    ));

            $dataProvider = $dataProvider->getData();

            Yii::app()->cache->set('javascript_WidgetsCDT_' . $category, $dataProvider, 6 * 60 * 60);
        }

        $this->render('widthgetCDT', array('dataProvider' => $dataProvider, 'domain' => $domain, 'withValue' => $withValue));
    }

}