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
$this->breadcrumbs = array(
    'Quản lý nhu cầu' => array('crawler/demand'),
);
$form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl('crawler/demand'), 'method' => 'get'));
$listCategory = ExtensionClass::getListParentCategory();
?>
<div class="form-popup">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="left-popup w300">
        <div class="items">
            <?php echo $form->labelEx($model, 'categoryId'); ?>
            <?php echo CHtml::dropDownList('categoryId', 0, $listCategory, array('size' => 22)); ?> 
        </div>
    </div>
    <div class="right-popup w500">        
        <div class="items">
            <p>Nhập từ khóa liên quan</p>
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo CHtml::textField('title'); ?> 
        </div>
        <div class="sumitButton">
            <?php echo CHtml::submitButton('Cập nhật'); ?>
        </div>
    </div>
    <div class="clear"></div>
</div>    
<?php $this->endWidget(); ?>