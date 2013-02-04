<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'changer-password-form',
    'action' => Yii::app()->createUrl('user/changerPassword'),
    'enableAjaxValidation' => false,
        ));
?>
<div class="grid_3">

    <div class="Mysb-Categ">
        <h4>Cá nhân</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::accountPublisherMenu()); ?>
    </div>

    <div class="Mysb-Categ">
        <h4>Tin rao vặt</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::publisherMenu()); ?>
    </div>

</div>

<div class="grid_9">

    <div class="grid_9">

        <div class="pathway">
            <ul class="clearfix">
                <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
                <li><a class="active" href="<?php echo Yii::app()->createUrl('user/profile'); ?>">Đổi mật khẩu</a></li>
            </ul>
        </div>
        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="title">
                    <label for="UserModel_oldPass">Mật khẩu cũ</label>
                </div>
                <?php echo $form->passwordField($model, 'oldPass', array('class' => 'inp-sminfo')); ?>
                <?php echo $form->error($model, 'oldPass'); ?>
            </div>
        </div>
        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="title">
                    <label for="UserModel_password">Mật khẩu mới</label>
                </div>
                <?php echo $form->passwordField($model, 'password', array('class' => 'inp-sminfo')); ?>
                <?php echo $form->error($model, 'password'); ?>
            </div>
        </div>
        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="title">
                    <label for="UserModel_password2">Nhập lại mật khẩu</label>
                </div>
                <?php echo $form->passwordField($model, 'password2', array('class' => 'inp-sminfo')); ?>
                <?php echo $form->error($model, 'password2'); ?>
            </div>
        </div>
        <div class="lgbtn clearfix">
            <a class="btn-skblue fl" onclick="$('#changer-password-form').submit()" href="javascript:void(0);"><span>Đổi mật khẩu</span></a>
        </div>    
    </div>

</div>
<?php $this->endWidget(); ?>