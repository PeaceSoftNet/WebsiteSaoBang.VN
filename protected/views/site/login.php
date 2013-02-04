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
$this->pageTitle = 'Đăng nhập';
$form = $this->beginWidget('CActiveForm');
?> 
<?php echo $form->errorSummary($model); ?>
<ul>
    <li>
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('class' => 'key-login')); ?>
    </li>
    <li>
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('class' => 'key-login')); ?>
    </li>
    <li>
        <?php echo CHtml::submitButton('', array('class' => 'btn-login')); ?>
    </li>
</ul>
<?php $this->endWidget(); ?>