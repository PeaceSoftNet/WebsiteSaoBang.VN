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

echo '<div style="padding: 0px 10px; display: block; height: 30px; line-height: 30px; color: #000; ' . $background . '"><a href="' . Yii::app()->createUrl('administrator/help', array('id' => $data->id)) . '">' . $data->title . '</a></div><div><a style="margin-right: 30px; color: blue;" target="_back" href="' . Yii::app()->createUrl('home/help', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '">(Xem hướng dẫn trên saobang.vn)</a></div>';