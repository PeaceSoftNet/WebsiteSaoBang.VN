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
if ($success)
    echo '<script type="text/javascript">window.location.reload();</script>';
$this->pageTitle = 'Quản lý thành viên';
$form = $this->beginWidget('CActiveForm');
?>
<div class="form-popup" id="administratorForm">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="items">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('onclick' => 'this.value = ""')); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <div class="sumitButton">
        <?php echo CHtml::button('Cập nhật', array('onclick' => 'submitForm();')); ?>
    </div>
</div>    
<?php $this->endWidget(); ?>
<script type="text/javascript">    
    function submitForm(){
        var username = $('#AdministratorModel_username').val();
        var email = $('#AdministratorModel_email').val();
        var password = $('#AdministratorModel_password').val();
        $('#administratorForm').load('<?php echo Yii::app()->createUrl('Administrator/new'); ?>', {'AdministratorModel[username]': username, 'AdministratorModel[email]': email, 'AdministratorModel[password]': password});
    }
</script>