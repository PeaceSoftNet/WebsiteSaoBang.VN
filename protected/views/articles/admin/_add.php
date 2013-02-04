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
echo '<div style="display: block; width: 400px; border: 1px solid #ccc; padding: 10px; margin: 10px 0px; ">';
echo '<div style="width: 150px">';
echo '<img style="width: 100px; height: 100px;" src="' . $data->avata . '"></div>';
echo '<div><a href="' . Yii::app()->createUrl('articles/add', array('id' => $data->id)) . '">' . $data->title . '</a></p>';
echo '</div></div><div style="clear: both"></div>';