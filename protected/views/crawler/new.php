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
$this->pageTitle = 'Quản lý chuyên mục';
$form = $this->beginWidget('CActiveForm', array('id' => 'newCategoryForm'));
$listCategory = ExtensionClass::getListParentCategory();
$listCategoryAll = ExtensionClass::getListCategory();
?>
<div class="category">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="items">
        <?php echo $form->labelEx($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
        <?php echo $form->error($model, 'id'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'categoryId'); ?>
        <?php echo $form->textField($model, 'categoryId'); ?>             
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'categoryChildId'); ?>
        <?php echo $form->textField($model, 'categoryChildId'); ?>             
    </div>
    <div class="items">
        <?php echo $form->labelEx($modelDetail, 'content'); ?>
        <?php echo $form->textArea($modelDetail, 'content'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'Location'); ?>
        <?php echo $form->textField($model, 'Location'); ?>
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
        <?php echo $form->labelEx($model, 'createDate'); ?>
        <?php echo $form->textField($model, 'createDate'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'domain'); ?>
        <?php echo $form->textField($model, 'domain'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'url'); ?>
        <?php echo $form->textField($model, 'url'); ?>
    </div>
    <div class="sumitButton">
        <?php echo CHtml::submitButton('Cập nhật'); ?>
    </div>
    <div class="clear"></div>
</div>    
<?php $this->endWidget(); ?>