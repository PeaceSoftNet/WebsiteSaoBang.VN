<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'changer-password-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="grid_12">

    <div class="grid_12">

        <div class="pathway">
            <ul class="clearfix">
                <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
                <li><a class="active" href="<?php echo Yii::app()->createUrl('user/profile'); ?>">Đổi mật khẩu</a></li>
            </ul>
        </div>
        <?php
        if ($this->msg == 'saobang') {
            echo '<p style="height: 300px;">Hệ thống đang nâng cấp chức năng, vui lòng thử lại sau hoặc liên hệ với chúng tôi để được hỗ trợ đầy đủ hơn.</p>';
        } elseif ($this->msg != 'Success') {
            ?>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        <?php echo $form->label($model, 'password'); ?>
                    </div>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'inp-sminfo', 'onclick' => 'this.value=\'\'')); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        <?php echo $form->label($model, 'password2'); ?>
                    </div>
                    <?php echo $form->passwordField($model, 'password2', array('class' => 'inp-sminfo')); ?>
                    <?php echo $form->error($model, 'password2'); ?>
                </div>
            </div>
            <div><?php echo $this->msg; ?></div>
            <div class="lgbtn clearfix">
                <a class="btn-skblue fl" onclick="$('#changer-password-form').submit()" href="javascript:void(0);"><span>Đổi mật khẩu</span></a>
            </div>
            <?php
        } elseif ($this->msg == 'Success') {
            echo 'Đổi mật khẩu thành công!';
        }
        ?>
    </div>

</div>
<?php $this->endWidget(); ?>