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
echo '<h2 style="margin: 50px 0px;">Nội dung bạn yêu cầu không có. Vui lòng quay lại sau.</h2>';
?>
<div class="error" style="display: block; height: 250px; width: 100%; text-align: center;">
    <?php
    echo CHtml::encode($message);
    echo '<br /><br /><p>Click <a href="javascript:void(0);" onclick="history.go(-1);">vào đây</a> để chuyển về trang trước</p>';
    ?>
</div>