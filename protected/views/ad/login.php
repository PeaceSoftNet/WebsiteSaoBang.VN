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
<div id="wrapper" style="background: #fff;">
    <div class="main clearfix">

        <div class="block clearfix">
            <div class="lgbl-left">
                <?php if (Yii::app()->user->hasFlash('login')) { ?>
                    <div id="top-message"><?php echo Yii::app()->user->getFlash('login'); ?></div>            
                <?php } ?>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'loginForm',
                    'action' => Yii::app()->createUrl('ad/login'),
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
                        <span class="fr"><a tabindex="2" href="<?php echo Yii::app()->createUrl('user/reActive'); ?>">Chưa nhận được email kích hoạt ?</a></span>
                    </div>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'inp-formlg', 'tabindex' => 3)); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
                <p>
                    <?php echo $form->checkbox($model, 'remember_me', array('id' => 'rulesOkie', 'tabindex' => 4)); ?>
                    <label for="rulesOkie">Lưu mật khẩu</label>
                    <a style="color: #333; text-align: right; float: right;" tabindex="2" href="<?php echo Yii::app()->createUrl('user/forgotpassword'); ?>">Quên mật khẩu ?</a>
                </p>
                <div class="lgbtn clearfix">
                    <input style="width: 110px !important; cursor: pointer;" class="btn-skblue fl" tabindex="5" type="submit" name="loginForm" value="Đăng nhập"/>
                    <span class="fl">Hoặc <a href="<?php echo Yii::app()->createUrl('user/register'); ?>">Đăng ký tài khoản mới</a></span>
                </div>
                <?php $this->endWidget(); ?>
                <p class="mgt20">Hoặc đăng nhập bằng tài khoản..</p>
                <p>
                    <a class="lg-partners" href="?openSite=facebook">
                        <span class="left"><i class="icon-facebook"></i></span>
                        <span class="right">Facebook</span>
                    </a>
                    <a class="lg-partners" href="?openSite=google">
                        <span class="left"><i class="icon-google"></i></span>
                        <span class="right">Google</span>
                    </a>

                    <a class="lg-partners" href="?openSite=yahoo">
                        <span class="left"><i class="icon-yahoo"></i></span>
                        <span class="right">Yahoo!</span>
                    </a>

                </p>
            </div>
            <div class="lgbl-right">
                <h2>Đăng ký người bán đảm bảo</h2>
            </div>
        </div>        

    </div>
</div>