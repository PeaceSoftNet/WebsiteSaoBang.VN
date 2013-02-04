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
$this->pageTitle = 'Trang cá nhân';
$form = $this->beginWidget('CActiveForm');
?>
<div class="form-popup" id="administratorForm">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="items">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('readonly' => 'readonly')); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('readonly' => 'readonly')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="sumitButton">
        <?php echo CHtml::submitButton('Cập nhật', array('onclick' => 'submitForm();')); ?>
    </div>
</div>    
<?php $this->endWidget(); ?>    