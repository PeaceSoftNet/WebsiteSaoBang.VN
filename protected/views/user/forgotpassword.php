<div class="block clearfix">
    <div class="lgbl-left" style="height: 192px;">
        <?php if (Yii::app()->user->hasFlash('login')) { ?>
            <div id="top-message"><?php echo Yii::app()->user->getFlash('login'); ?></div>            
        <?php } ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'forgot-password-form',
            'action' => Yii::app()->createUrl('user/forgotpassword'),
            'enableAjaxValidation' => false,
                ));
        ?>
        <input type="hidden" value="<?php echo (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''); ?>" name="lastUrl"/>

        <h2>Quyên mật khẩu</h2>
        <div class="formlg">
            <div class="title">Địa chỉ email đăng ký :</div>
            <?php echo $form->textField($model, 'email', array('class' => 'inp-formlg')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
        <div class="lgbtn clearfix">
            <a class="btn-skblue fl" onclick="$('#forgot-password-form').submit()" href="javascript:void(0);"><span>Gửi mật khẩu</span></a>
            <span class="fl">Hoặc <a href="<?php echo Yii::app()->createUrl('user/register'); ?>">Đăng ký tài khoản mới</a></span>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <div class="lgbl-right">
        <h2>Hoặc sử dụng tài khoản:</h2>
        <p>
            <a class="lg-partners" href="?openSite=facebook">
                <span class="left"><i class="icon-facebook"></i></span>
                <span class="right">Facebook</span>
            </a>
        </p>
        <p>
            <a class="lg-partners" href="?openSite=google">
                <span class="left"><i class="icon-google"></i></span>
                <span class="right">Google</span>
            </a>
        </p>
        <p>
            <a class="lg-partners" href="?openSite=yahoo">
                <span class="left"><i class="icon-yahoo"></i></span>
                <span class="right">Yahoo!</span>
            </a>
        </p>
    </div>
</div>     
<script type="text/javascript">
    $('body').addClass('login-page');
</script>