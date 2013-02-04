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
$this->pageTitle = 'Quản lý trang crawler';
$form = $this->beginWidget('CActiveForm', array('id' => 'crawlerForm'));
?>
<div class="attibutesModel">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="right-popup w500">    
        <div class="items">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <div id="crawlerNameErr" class="errorMessage">
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'classCss'); ?>
            <?php echo $form->textField($model, 'classCss'); ?>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'url'); ?>
            <?php echo $form->textField($model, 'url'); ?>
        </div>
        <div class="order">
            <?php echo $form->labelEx($model, 'order'); ?>
            <?php echo $form->textField($model, 'order'); ?>
        </div>
        <div class="sumitButton">
            <?php echo CHtml::button('Cập nhật', array('onclick' => 'submitForm();')); ?>
        </div>
    </div>
</div>    
<?php $this->endWidget(); ?>
<script type="text/javascript">
    function submitForm(){
        var name= $('#CrawlerSite_name').val();
        if(name.length){
            $('#crawlerForm').submit();
        }else{
            $('#crawlerNameErr').html('Tên site không được bỏ trống');
        }
    }
</script>