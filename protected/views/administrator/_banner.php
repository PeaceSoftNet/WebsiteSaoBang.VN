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
echo '<div style="display: block; width: 600px">';
echo '<div style="float: left; width: 150px"> <img style="width: 100px; height: 100px;" src="' . $data->img . '"></div>';
echo '<div><p>Đường dẫn quảng cáo: <i>' . $data->url . '</i></p>';
echo '<p>Ngày hết hạn: ' . $data->endDate . '</p></div>';
echo '<p><a href="' . Yii::app()->createUrl('administrator/banner', array('id' => $data->id)) . '">Sửa</a></p>';
echo '</div><div style="clear: both"></div>';