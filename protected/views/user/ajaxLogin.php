<?php
/**
 * @author  Chienlv
 * @return  File hiển thị for đăng nhập
 */
?>
<div class="block clearfix" style="border: none !important; ">
    <div class="lgbl-left">
        <?php if (Yii::app()->user->hasFlash('ajaxLogin')) { ?>
            <div id="top-message"><?php echo Yii::app()->user->getFlash('ajaxLogin'); ?></div>            
        <?php } ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'loginForm',
            'action' => Yii::app()->createUrl('user/ajaxLogin'),
            'enableAjaxValidation' => false,
                ));
        ?>
        <h2>Đăng nhập</h2>
        <div class="formlg">
            <div class="title">Địa chỉ Email:</div>
            <?php echo $form->textField($model, 'email', array('class' => 'inp-formlg')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
        <div class="formlg">
            <div class="title">
                Mật khẩu:
                <span class="fr"><a href="<?php echo Yii::app()->createUrl('user/forgotpassword'); ?>">Quên mật khẩu ?</a></span>
            </div>
            <?php echo $form->passwordField($model, 'password', array('class' => 'inp-formlg')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
        <p>
            <?php echo $form->checkbox($model, 'remember_me', array('id' => 'rulesOkie', 'style' => 'float: left;')); ?>
            <label style="width: 90%;float: left;" for="rulesOkie">Lưu mật khẩu</label>
        </p>
        <div class="lgbtn clearfix">
            <input style="width: 110px !important;" class="btn-skblue fl" type="submit" name="loginForm" value="Đăng nhập"/>
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