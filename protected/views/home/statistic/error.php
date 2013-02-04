<?php
/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
header("refresh:3;url=" . Yii::app()->createUrl('home/index'));
$this->pageTitle = Yii::app()->name . ' - Error';
?>
<h2>Error <?php if (isset($code)) echo $code; ?></h2>
<div class="error" style="display: block; height: 250px; width: 100%;">
    <?php
    if (isset($message))
        echo CHtml::encode($message);
    echo '<p>Click <a href="javascript:void(0);" onclick="history.go(-1);">vào đây</a> để chuyển về trang trước, hoặc tự động chuyển về trang chủ sau 3 giây</p>';
    ?>
</div>