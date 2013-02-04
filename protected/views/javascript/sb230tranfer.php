<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *  target="_blank"
 * "_gaq.push(['_trackEvent','saobang.vn','detail-page','title-link'])" 
 *
 */
echo 'document.write(\'<link rel="stylesheet" type="text/css" href="http://' . $_SERVER['HTTP_HOST'] . '/themes/app/css/style.css">\');';
if (isset($data)) {
    $content = '<div class="wd-saobang" style="width: 144px;"><h3 class="wd-sb-title"><span class="logo-sb"></span></h3><ul class="wd-sb-content">';
    foreach ($data as $key => $keyword) {
        if (strpos($keyword['icon'], "http") !== FALSE) {
            $icon = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('external/image', array('code' => base64_encode($keyword['icon'])));
        } else if (strpos($keyword['icon'], "data/images") !== FALSE) {
            $icon = 'http://' . $_SERVER['HTTP_HOST'] . $keyword['icon'];
        } else {
            $icon = $keyword['icon'];
        }
        $ga = "_gaq.push([\'_trackEvent\',\'saobang.vn\',\'" . $catTitle . "\',\'" . $keyword['title'] . "\'])";
        $content .= '<li><div class="wd-sb-img"><a onclick = "' . $ga . '"  target="_blank" href="http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('home/TopicDetail', array('id' => $keyword['id'], 'name' => ExtensionClass::utf8_to_ascii($keyword['title']))) . '"><img width="80px" src="' . $icon . '" /></a></div><p class="wd-sb-name"><a target="_blank" onclick = "' . $ga . '" href="http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('home/TopicDetail', array('id' => $keyword['id'], 'name' => ExtensionClass::utf8_to_ascii($keyword['title']))) . '">' . $keyword['title'] . '</a></p><p class="wd-sb-price">' . GlobalComponents::numberFomat($keyword['price']) . ' đ</p></li>';
    }
    $content .= '</ul></div>';
    echo 'document.write(\'' . $content . '\')';
}