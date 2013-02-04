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
$this->pageTitle = 'Quản lý tỉnh';
$listLocality = ExtensionClass::getListLocality();
$form = $this->beginWidget('CActiveForm', array('id' => 'localityForm'));
?> 
<?php echo $form->errorSummary($model); ?>
<div class="locality">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="left-popup w200">
        <div class="items">
            <?php echo $form->labelEx($model, 'parentId'); ?>
            <?php echo $form->dropDownList($model, 'parentId', $listLocality, array('size' => 10, 'class' => 'w200')); ?>
        </div>
    </div>
    <div class="right-popup w500">
        <div class="items">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <div id="localityName" class="errorMessage">
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'alias'); ?>
            <?php echo $form->textField($model, 'alias'); ?>
        </div>
        <div class="order">
            <?php echo $form->labelEx($model, 'order'); ?>
            <?php echo $form->textField($model, 'order'); ?>
        </div>
        <div class="sumitButton">
            <?php echo CHtml::button('Cập nhật', array('onclick' => 'submitLocalityForm();')); ?>
        </div>
    </div>
    <div class="clear"></div>
</div>    
<?php $this->endWidget(); ?>
<script type="text/javascript">
    function submitLocalityForm(){
        var name = $('#LocationModel_name').val();
        if(name){
            $('#localityName').html('');
        }else{
            $('#localityName').html('Yêu cầu nhập tên');
            return false;
        }
        $('#localityForm').submit();
    }
</script>