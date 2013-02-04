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
$this->pageTitle = 'Mật khẩu mới';
$form = $this->beginWidget('CActiveForm');
?>
<div class="form-popup" id="administratorForm">
    <h3><?php echo $this->pageTitle; ?></h3>    
    <div class="items">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('onclick' => 'this.value = ""')); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <div class="sumitButton">
        <?php echo CHtml::submitButton('Cập nhật', array('onclick' => 'submitForm();')); ?>
    </div>
</div>    
<?php $this->endWidget(); ?>