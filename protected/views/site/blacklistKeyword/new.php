<?php
/* * 
 * @author Chienlv
 */
$this->pageTitle = 'Quản lý trang từ khóa cảnh báo';
$form = $this->beginWidget('CActiveForm', array('id' => 'blacklistForm'));
?>
<div class="attibutesModel">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="right-popup w500">    
        <div class="items">
            <?php echo $form->labelEx($model, 'keyword'); ?>
            <?php echo $form->textField($model, 'keyword'); ?>
            <div id="crawlerNameErr" class="errorMessage">
                <?php echo $form->error($model, 'keyword'); ?>
            </div>
        </div>
        <div class="sumitButton">
            <?php echo CHtml::button('Cập nhật', array('onclick' => 'submitForm();')); ?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    function submitForm(){
        var name= $('#TblBlacklist_keyword').val();
        if(name.length){
            $('#blacklistForm').submit();
        }else{
            $('#crawlerNameErr').html('Từ khóa cảnh báo không được bỏ trống');
        }
    }
</script>