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
$form = $this->beginWidget('CActiveForm', array('id' => 'emailnotify', 'action' => '#emailNotifyReg'));
$emailNotify->email = 'Địa chỉ Email';
?>
<div class="RegEmail-br-NewsRv clearfix" id="emailNotifyReg">
    <span class="blicon-mail fl"></span>
    <span class="title fl">Đăng ký nhận mail thông báo khi có tin rao vặt mới trong mục này</span>
    <p><?php echo $form->error($emailNotify, 'email'); ?></p>
    <span class="fl"><?php echo $form->textField($emailNotify, 'email', array('class' => 'regEmail', 'onclick' => 'this.value=""')); ?></span>
    <span class="fl omega">
        <a class="btn-skblue" onclick="$('#emailnotify').submit();" href="javascript:void(0);"><span>Đăng ký</span></a></span>
</div>
<?php $this->endWidget(); ?>