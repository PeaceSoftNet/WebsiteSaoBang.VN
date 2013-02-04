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
$this->pageTitle = 'Thêm từ khóa';
$form = $this->beginWidget('CActiveForm');
?>
<div>
    <?php echo $form->labelEx($model, 'keyword'); ?>
    <?php echo $form->textField($model, 'keyword'); ?>
</div>
<div>
    <?php echo CHtml::submitButton('Cập nhật'); ?>
</div>
<?php $this->endWidget(); ?>