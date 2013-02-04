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
$this->pageTitle = 'Tạo nhanh người dung saobang';
$form = $this->beginWidget('CActiveForm');
?>
<div class="form-popup" id="administratorForm">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="items">
        Email
        <?php
        echo CHtml::textField('UserModel[email]');
        ?>
    </div>
    <div>
        <?php
        echo CHtml::submitButton();
        ?>
    </div>
</div>    
<?php $this->endWidget(); ?>