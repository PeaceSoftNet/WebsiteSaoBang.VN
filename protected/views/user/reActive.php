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
?>
<div class="block clearfix">
    <div class="lgbl-left" style="height: 192px; width: 700px">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'forgot-password-form',
            'enableAjaxValidation' => false,
                ));
        ?>
        <h2>Gửi lại yêu cầu kích hoạt tài khoản qua email</h2>
        <div class="formlg">
            <div class="title">Địa chỉ email đăng ký <code style="color: red;" title="Bắt buộc">*</code></div>
            <?php echo CHtml::textField('email', '', array('class' => 'inp-formlg')); ?>
            <br /><br />
            <div class="lgbtn clearfix">
                <a class="btn-skblue fl" onclick="$('#forgot-password-form').submit()" href="javascript:void(0);"><span>Gửi lại email</span></a>
                <span class="fl">Hoặc <a href="<?php echo Yii::app()->createUrl('user/register'); ?>">Đăng ký tài khoản mới</a></span>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>