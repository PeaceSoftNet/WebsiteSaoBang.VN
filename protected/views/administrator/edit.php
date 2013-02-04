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
$this->pageTitle = 'Sửa thông tin thành viên';
$form = $this->beginWidget('CActiveForm');
?>
<div class="form-popup">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="items">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('readonly' => 'readonly')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('onclick' => 'this.value = ""')); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textField($model, 'address'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'avata'); ?>
        <?php echo $form->textField($model, 'avata'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info'); ?>
    </div>
    <div class="sumitButton">
        <?php echo CHtml::submitButton('Cập nhật'); ?>
    </div>
</div>    
<?php
$this->endWidget();
?>