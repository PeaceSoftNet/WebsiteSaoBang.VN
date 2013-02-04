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
?>
<div style="height: 350px">
    <h4>Hỏi mua thành công</h4>
    <p>
        Bạn đã đăng hỏi mua thành công tại saobang.vn
    </p>
    <p style="padding: 20px 10px;">
        Vui lòng <strong style="color: green;"><em>kiểm tra lại email và kích hoạt</em></strong> nội dung đăng hỏi mua của bạn. Cảm ơn
    </p>
    <p style="margin: 20px;">
        <a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>"><button style="padding: 5px 15px;" value="Quay lại trang hỏi mua">Quay lại trang hỏi mua</button></a>
        <a style="margin-left: 50px;" href="<?php echo Yii::app()->createUrl('ad/index') ?>">Quay lại trang chủ saobang.vn</a>
    </p>
</div>