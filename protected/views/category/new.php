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
?>
<div class="category">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="left-popup w300">
        <div class="items">
            <?php echo $form->labelEx($model, 'parentId'); ?>
            <?php echo $form->dropDownList($model, 'parentId', $listCategory, array('size' => 17)); ?> 
            <div class="errorCategory" class="errorMessage">
                <?php echo $form->error($model, 'parentId'); ?>
            </div>
        </div>
    </div>
    <div class="right-popup w500">
        <div class="items">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <div id="errorSummary" class="errorMessage">
                <?php echo $form->error($model, 'name'); ?>
            </div>            
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'displayUrl'); ?>
            <?php echo $form->textField($model, 'displayUrl'); ?>            
            <?php echo $form->error($model, 'displayUrl'); ?>            
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textArea($model, 'description'); ?>
            <div id="errorDescription" class="errorMessage">
                <?php echo $form->error($model, 'description'); ?>
            </div>
        </div>
        <div class="checkbox">            
            <?php echo $form->checkBox($model, 'isHidden'); ?>
            <?php echo $form->labelEx($model, 'isHidden'); ?>
        </div>
        <div class="checkbox">            
            <?php echo $form->checkBox($model, 'isPrice'); ?>
            <?php echo $form->labelEx($model, 'isPrice'); ?>
        </div>
        <div class="checkbox">            
            <?php echo $form->checkBox($model, 'isChildLocality'); ?>
            <?php echo $form->labelEx($model, 'isChildLocality'); ?>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'icon'); ?>
            <?php echo $form->textField($model, 'icon'); ?>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'classCss'); ?>
            <?php echo $form->textField($model, 'classCss'); ?>
        </div>
        <div class="order">
            <?php echo $form->labelEx($model, 'order'); ?>
            <?php echo $form->textField($model, 'order'); ?>
        </div>
        <div class="sumitButton">
            <?php echo CHtml::button('Cập nhật', array('onclick' => 'submitCategoryForm();')); ?>
        </div>
    </div>
    <div class="clear"></div>
</div>    
<?php $this->endWidget(); ?>
<script type="text/javascript">
    function submitCategoryForm(){
        var parentId = $('#CategoryModel_parentId').val();
        var catName = $('#CategoryModel_name').val();
        var catDescription = $('#CategoryModel_description').val();
        if(!parentId){
            $('#errorCategory').html('Yêu cầu chọn danh mục');
            return false;
        }
        if(catName){
            $('#errorSummary').html('');
        }else{
            $('#errorSummary').html('Yêu cầu nhập tên danh mục');
            return false;
        }
        if(catDescription.length >128){
            $('#errorDescription').html('Miêu tả của bạn quá dài, yêu cầu ít hơn 128 ký tự.');
            return false;
        }else{
            $('#errorDescription').html('');
        }
        $('#newCategoryForm').submit();
        $('#newCategoryForm').attr("disabled", "true");
    }
</script>