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
header("refresh:4;url=" . Yii::app()->createUrl('seo/createLinkDetail'));


$list = explode(',', $linkTopic);
echo '<pre>';
var_dump($list);
echo '</pre>';