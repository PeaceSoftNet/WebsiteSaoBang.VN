<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'changer-profile-form',
    'action' => Yii::app()->createUrl('user/profile'),
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
                <li><a class="active" href="<?php echo Yii::app()->createUrl('user/profile'); ?>">Tài khoản</a></li>
            </ul>
        </div>

        <?php if (Yii::app()->user->hasFlash('profile')) { ?>
            <div id="top-message"><?php echo Yii::app()->user->getFlash('profile'); ?></div>            
        <?php } ?>

        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="title">
                    <b><?php echo $form->labelEx($model, 'email'); ?></b> : 
                    <?php echo $model->email; ?>
                </div>
            </div>
        </div>
        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="title">
                    <?php echo $form->labelEx($model, 'mobile'); ?>
                </div>
                <?php echo $form->textField($model, 'mobile', array('class' => 'inp-sminfo floatOnly', 'maxlenght' => '13')); ?>
            </div>
        </div>
        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="title">
                    <?php echo $form->labelEx($model, 'address'); ?>
                </div>
                <?php echo $form->textField($model, 'address', array('class' => 'inp-sminfo')); ?>
            </div>
        </div>
        <div class="sm-forminfo clearfix">
            <div class="cont">
                <div class="title">
                    <?php echo $form->labelEx($model, 'info'); ?>
                </div>
                <?php echo $form->textArea($model, 'info', array('style' => 'width: 534px;height:200px')); ?>
            </div>
        </div>
        <div class="lgbtn clearfix">
            <a class="btn-skblue fl" onclick="$('#changer-profile-form').submit()" href="javascript:void(0);"><span>Lưu</span></a>
        </div> 
    </div>

</div>
<?php $this->endWidget(); ?>