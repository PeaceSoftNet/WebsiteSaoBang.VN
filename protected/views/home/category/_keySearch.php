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
if ($index < 3) {
    echo '<li class="no-bg"><span class="fl"><a href="' . Yii::app()->createUrl('home/search', array('sid' => $data->id, 'catId' => $catId, 'childCat' => $data->childCatId, 'title' => ExtensionClass::utf8_to_ascii($data->name))) . '">' . ucfirst($data->name) . '</a></span></li>';
} else {
    echo '<li><span class="fl"><a href="' . Yii::app()->createUrl('home/search', array('sid' => $data->id, 'catId' => $catId, 'childCat' => $data->childCatId, 'title' => ExtensionClass::utf8_to_ascii($data->name))) . '">' . ucfirst($data->name) . '</a></span></li>';
}