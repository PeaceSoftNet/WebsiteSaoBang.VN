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
$this->pageTitle = 'Đăng nhập | Saobang.vn ';
Yii::app()->clientScript->registerMetaTag('Trang đăng nhập thành viên Saobang.vn.', 'description');
?> 

<div class="block clearfix">
    <div class="lgbl-left">
        <?php if (Yii::app()->user->hasFlash('login')) { ?>
            <div id="top-message"><?php echo Yii::app()->user->getFlash('login'); ?></div>            
        <?php } ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'loginForm',
            'action' => Yii::app()->createUrl('user/login'),
            'enableAjaxValidation' => false,
                ));
        echo $form->errorSummary($model);
        ?>
        <input type="hidden" value="<?php echo (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''); ?>" name="lastUrl"/>

        <h2>Đăng nhập</h2>
        <div class="formlg">
            <div class="title"> Địa chỉ Email <code style="color: red;" title="Bắt buộc">*</code> </div>
            <?php echo $form->textField($model, 'email', array('class' => 'inp-formlg', 'tabindex' => 1)); ?>
        </div>
        <div class="formlg">
            <div class="title">
                Mật khẩu <code style="color: red;" title="Bắt buộc">*</code>
                <span class="fr"><a tabindex="2" href="<?php echo Yii::app()->createUrl('user/forgotpassword'); ?>">Quên mật khẩu ?</a></span>
            </div>
            <?php echo $form->passwordField($model, 'password', array('class' => 'inp-formlg', 'tabindex' => 3)); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
        <p>
            <?php echo $form->checkbox($model, 'remember_me', array('id' => 'rulesOkie', 'tabindex' => 4)); ?>
            <label for="rulesOkie">Lưu mật khẩu</label>
        </p>
        <div class="lgbtn clearfix">
            <input style="width: 110px !important; cursor: pointer;" class="btn-skblue fl" tabindex="5" type="submit" name="loginForm" value="Đăng nhập"/>
<!--            <a class="btn-skblue fl" onclick="$('#loginForm').submit()" href="javascript:void(0);"><span>Đăng nhập</span></a>-->
            <span class="fl">Hoặc <a href="<?php echo Yii::app()->createUrl('user/register'); ?>">Đăng ký tài khoản mới</a></span>
            <div style="color: #c6c6c6"><span class="fl">Hoặc <a style="color: #c6c6c6" href="<?php echo Yii::app()->createUrl('user/reActive'); ?>">Gửi lại yêu cầu kích hoạt tài khoản</a></span></div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <div class="lgbl-right">
        <h2>Hoặc sử dụng tài khoản:</h2>
<!--        <p>
            <a class="lg-partners" href="javascript:void(0);">
                <span class="left"><i class="icon-CDT"></i></span>
                <span class="right">ChợĐiệnTử</span>
            </a>
        </p>-->
        <p>
            <a class="lg-partners" href="?openSite=facebook" tabindex="6">
                <span class="left"><i class="icon-facebook"></i></span>
                <span class="right">Facebook</span>
            </a>
        </p>
        <p>
            <a class="lg-partners" href="?openSite=google" tabindex="7">
                <span class="left"><i class="icon-google"></i></span>
                <span class="right">Google</span>
            </a>
        </p>
        <p>
            <a class="lg-partners" href="?openSite=yahoo"  tabindex="8">
                <span class="left"><i class="icon-yahoo"></i></span>
                <span class="right">Yahoo!</span>
            </a>
        </p>
    </div>
</div>     
<script type="text/javascript">
    $('body').addClass('login-page');
</script>