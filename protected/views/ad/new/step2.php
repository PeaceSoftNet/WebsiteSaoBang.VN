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
$model->locality = 0;
$form = $this->beginWidget('CActiveForm', array('id' => 'topicSubmitForm'));
$this->pageTitle = 'Đăng tin rao vặt - Bước 2: Đăng tin';
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix">
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ad/step1'); ?>">Bước 1: Chọn danh mục đăng tin</a></li>
                    <li><a class="active" href="javascript:void(0);">Bước 2: Đăng tin</a></li>
                </ul>
            </div>
        </div>
        <?php $this->uploadImg($imgUpload); ?>
        <style type="text/css">
            .sm-forminfo .report-error{width: 290px;}
            .errorSummary{color: red; font-style: italic; margin:5px 20px;}
        </style>
        <div class="grid_9">
            <div class="title-page">
                <h1 class="fl">Đăng tin rao vặt</h1>
                <span class="cl99 fr">Bước <b>2</b>/3</span>
            </div>
            <?php $this->step2Cateogry(); ?>   

            <?php echo $form->hiddenField($model, 'locality'); ?>

            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        Tiêu đề <code style="color: red;" title="Bắt buộc">*</code>
                        <span class="Notes">Tối đa 140 ký tự: <span id="titleCharNumber">0</span>/140</span>
                        <?php echo $form->error($model, 'title', array('class' => 'report-error')); ?>
                    </div>
                    <?php echo $form->textField($model, 'title', array('class' => 'inp-sminfo')); ?>
                </div>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="fl" style="padding-right: 50px;">
                        <div class="title">
                            Email
                            <code style="color: red;" title="Bắt buộc">*</code>
                            <?php
                            if (!Yii::app()->session['userId']) {
                                echo '<span class="Notes">Hoặc <a rel="Chienlv-Login-Ajax" href="' . Yii::app()->createUrl('user/login') . '">Đăng nhập</a></span>';
                            }
                            ?>
                        </div>
                        <?php echo $form->textField($model, 'email', array('class' => 'inp-sminfo')); ?>
                    </div>
                    <div class="fr">
                        <div class="title">
                            <label for="TopicModel_mobileNumber">Số điện thoại</label>
                            <?php echo $form->error($model, 'email', array('class' => 'report-error')); ?>
                        </div>
                        <?php echo $form->textField($model, 'mobileNumber', array('class' => 'inp-sminfo floatOnly', 'style' => 'width: 390px;')); ?>
                    </div>
                </div>                
            </div>
            <div class="boxModule edt-user">
                <h4 class="title" title="Tối thiểu 100 ký tự">Nội dung
                    <code style="color: red;" title="Bắt buộc">*</code>
                </h4>
                <?php echo $form->textArea($modelDetail, 'content', array('id' => 'area1', 'cols' => '84', 'rows' => '15')); ?>
            </div>
            <?php echo $form->error($modelDetail, 'content', array('class' => 'report-error')); ?>
            <?php
            $model->site = 25;
            echo $form->hiddenField($model, 'site');
            $model->domain = 'Saobang.vn';
            echo $form->hiddenField($model, 'domain');
            ?>
            <?php if (extension_loaded('gd')): ?>
                <div class="row sm-forminfo clearfix">
                    <div class="cont">
                        <div class="title">
                            <?php echo $form->labelEx($model, 'verifyCode'); ?>
                            <?php $this->widget('CCaptcha'); ?>
                        </div>
                    </div>
                    <?php echo $form->textField($model, 'verifyCode', array('class' => 'inp-sminfo', 'style' => 'width: 150px; float:left; margin:0px 15px;')); ?>

                    <div class="hint">Vui lòng nhập các ký tự xác thực ở hình bên!</div>    
                </div>
            <?php endif; ?>

            <div id="top-message">
                <?php if ($form->errorSummary($model) OR $form->errorSummary($modelDetail)): ?>
                    <div class="msg-error">
                        <?php
                        echo $form->errorSummary($model);
                        echo $form->errorSummary($modelDetail);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="grayModule">
                <div class="clearfix">
                    <span class="fl" style="margin-top: 8px;"><?php echo $form->checkBox($model, 'checkBoxRules', array('id' => 'rulesOkie')); ?><label for="rulesOkie"><code style="color: red;" title="Bắt buộc">*</code> Tôi chấp nhận các <a target="_black" href="<?php echo Yii::app()->createUrl('home/publishedRules'); ?>">Điều khoản và Quy định</a> của SaoBăng.vn</label></span>
                    <a class="btn-postNews fr" onclick="$('#topicSubmitForm').submit()" href="javascript:void(0);"><span>Đăng rao vặt</span></a>
                </div>
            </div>

        </div>	

    </div>
</div>
<?php $this->endWidget(); ?>