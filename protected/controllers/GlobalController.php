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
class GlobalController extends Controller {

    /**
     * header
     */
    public function topPage($keyword = '') {
        $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : 0;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        if (!$keyword && Yii::app()->controller->id == 'ad') {
            $keyword = 'Tìm kiếm rao vặt..';
        } elseif (!$keyword && Yii::app()->controller->id == 'ask') {
            $keyword = 'Tìm kiếm hỏi mua..';
        }
        $this->renderPartial('topPage', array('categoryId' => $categoryId, 'keyword' => $keyword));
    }

    /**
     * footer page
     */
    public function footerPage() {
        $this->renderPartial('footer');
    }

    /**
     * banner ad
     */
    public function bannerAd() {
        $list = self::getbannerAd();
        $maxValue = 0;
        $listAdvertising = array();
        foreach ($list as $key => $value) {
            $listAdvertising[] = '<a target="_black" href="' . $value['url'] . '"><img src="' . $value['img'] . '" width="217px" border="0" /></a>';
            $maxValue = $key;
        }
        $random = rand(0, $maxValue);
        $this->renderPartial('bannerAd', array('listAdvertising' => $listAdvertising, 'random' => $random));
    }

    /**
     * gooogle ad
     */
    public function googleAd() {
        $this->renderPartial('googleAd');
    }

    /**
     * set local
     */
    public function setLocal() {
        $this->renderPartial('setLocal');
    }

    /**
     * get banner ad
     * 
     */
    public static function getbannerAd() {
        $rs = Yii::app()->cache->get('ext_getAdBanner');
        if ($rs === false) {
            $listRand = array('0' => 'id', '1' => 'url', '2' => 'createDate', '3' => 'img');
            $typeRand = array('0' => 'ASC', '1' => 'DESC', '2' => 'ASC');
            $sql = 'SELECT `url`, `img` FROM {{banner}} WHERE `endDate` > \'' . date('Y-m-d h:i:s') . '\' ORDER BY `' . $listRand[rand(0, 2)] . '`' . ' ' . $typeRand[rand(0, 2)];
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getAdBanner', $rs, AdExtension::_btime);
        }
        return $rs;
    }

}