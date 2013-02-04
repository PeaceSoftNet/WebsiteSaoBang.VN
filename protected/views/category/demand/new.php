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
$this->pageTitle = 'Quản lý nhu cầu';
$form = $this->beginWidget('CActiveForm');
$listCategory = ExtensionClass::getListCategory();
unset($listCategory['0']);
?>
<div class="attibutesModel">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="left-popup w300">
        <div class="items">
            <?php echo $form->labelEx($model, 'categoryId'); ?>
            <?php echo $form->dropDownList($model, 'categoryId', $listCategory, $htmlOptions = array('size' => 10, 'onclick' => 'changeCategory(this.value);')); ?>
        </div>
    </div>
    <div class="right-popup w500">    
        <div class="items">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="order">
            <?php echo $form->labelEx($model, 'order'); ?>
            <?php echo $form->textField($model, 'order'); ?>
        </div>
        <div class="sumitButton">
            <?php echo CHtml::submitButton('Cập nhật'); ?>
        </div>
    </div>
</div>    
<?php $this->endWidget(); ?>