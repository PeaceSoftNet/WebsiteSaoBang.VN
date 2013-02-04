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
if (!$index % 2) {
    $background = '';
} else {
    $background = ' background: #eee;';
}

echo '<div style="padding: 0px 5px; display: block; height: 30px; line-height: 30px; color: #000; ' . $background . '"><a href="' . Yii::app()->createUrl('administrator/notify', array('id' => $data->id)) . '">' . $data->title . '</a></div><div><a style="text-align: right; color: blue;" target="_back" href="' . Yii::app()->createUrl('home/notify', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '">(xem thông báo trên saobang.vn)</a></div>';