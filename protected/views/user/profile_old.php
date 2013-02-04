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
$this->pageTitle = 'Profile';
$form = $this->beginWidget('CActiveForm');
?>
<div style="margin: 10px 100px;">
    <ul>
        <li><a href="#">Tin tôi đã đăng</a></li>
        <li><a href="#">Tin tôi đăng đã hết hạn</a></li>
    </ul>

    <?php echo $form->errorSummary($model); ?>
    <div class="items">
        <?php echo $form->labelEx($model, 'blog'); ?>
        <?php echo $form->textField($model, 'blog'); ?>
        <?php echo $form->error($model, 'blog'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textArea($model, 'address'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
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
<?php $this->endWidget(); ?>