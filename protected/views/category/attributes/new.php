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
$this->pageTitle = 'Quản lý thuộc tính';
$form = $this->beginWidget('CActiveForm');
if ($catId)
    $model->categoryId = $catId;
$listAttributes = ExtensionClass::getAttributesByCategory($catId);
$listCategory = ExtensionClass::getListCategory();
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
        <div class="items" id="groupAttributesDetail">
            <?php echo $form->labelEx($model, 'group'); ?>
            <?php echo $form->dropDownList($model, 'group', $listAttributes); ?>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="sumitButton">
            <?php echo CHtml::submitButton('Cập nhật'); ?>
        </div>
    </div>
</div>    
<?php $this->endWidget(); ?>
<script type="text/javascript">
    function changeCategory(catId){
        $('#groupAttributesDetail').load('<?php echo Yii::app()->createUrl('category/AttributesNew'); ?>?catId='+catId+' #groupAttributesDetail');
    }
</script>