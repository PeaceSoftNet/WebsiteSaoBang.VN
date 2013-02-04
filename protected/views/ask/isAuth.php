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
if ($isOk) {
    echo '<div style="height: 350px;">';
    echo '<h4>Bài viết của bạn đã được kích hoạt thành công.</h4>';
    echo '<p style="margin: 30px 10px;"><a href="' . Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')) . '"><button style="padding: 5px 20px;" value="Xem lại hỏi mua saobang.vn">Xem lại hỏi mua saobang.vn</button></a>';
    echo '<a style="margin-left: 20px;" href="' . Yii::app()->createUrl('ad/index') . '">Quay trở lại trang chủ saobang.vn</a></p>';
    echo '</>';
} else {
    echo '<h4>Bài viết của bạn kích hoạt không thành công. </h4>';
    echo '<p>Vui lòng liên hệ lại với quản trị website saobang.vn. Cảm ơn!</p>';
}