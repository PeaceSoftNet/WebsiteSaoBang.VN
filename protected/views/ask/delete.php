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
<h2>Bạn có chắc chắn xóa hỏi mua: </h2><?php echo $askModel->title; ?>
<p>
    <a href="<?php echo Yii::app()->createUrl('ask/remove', array('id' => $askModel->id, 'isDelete' => 1)); ?>"><button style="padding: 5px 15px;" value="Có, tôi muốn xóa tin hỏi mua này">Tôi chắc chắn xóa tin hỏi mua này</button></a>
    <a style="margin-left: 50px;" href="javascript:history.go(-1);">Quay lại trước</a>
</p>