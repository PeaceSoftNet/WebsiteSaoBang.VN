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
$form = $this->beginWidget('CActiveForm', array('id' => 'askSubmitForm'));
$this->pageTitle = 'Đăng hỏi mua';
if (Yii::app()->session['email'])
    $model->email = Yii::app()->session['email'];
$model->isQuote = 1;
?>
<div id="wrapper">
    <div class="main clearfix">
        <style type="text/css">
            .sm-forminfo .report-error{width: 225px;}
        </style>
        <div class="clearfix">
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>" >Hỏi mua</a></li>
                    <li><a href="javascript:void(0);" class="active">Đăng hỏi mua</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <div class="clear"></div>

        <?php $this->listShopViewColum(); ?>

        <div class="grid_9">

            <div class="title-page">
                <h1>Đăng hỏi mua</h1>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        Tiêu đề <code style="color: red;" title="Bắt buộc">*</code>
                        <span class="Notes">Tối đa 140 ký tự: <span id="titleCharNumber">0</span>/140</span>
                        <?php echo $form->error($model, 'title', array('class' => 'report-error')); ?>
                    </div>
                    <?php echo $form->textField($model, 'title', array('class' => 'inp-sminfo', 'id' => 'askTitle', 'onkeypress' => 'checkCountTitle(this.value.length);', 'onchange' => 'getTitleTag(this.value)', 'onloadstart' => 'getTitleTag(this.value)')); ?>
                </div>
            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="fl">
                        <div class="title">
                            Email
                            <code style="color: red;" title="Bắt buộc">*</code>
                            <?php
                            if (!Yii::app()->session['userId']) {
                                echo '<span class="Notes">Hoặc <a href="' . Yii::app()->createUrl('user/login') . '">Đăng nhập</a></span>';
                            }
                            ?>
                        </div>
                        <?php echo $form->textField($model, 'email', array('class' => 'inp-sminfo')); ?>
                    </div>
                    <div class="fr" style="margin-left: 45px;">
                        <div class="title">
                            <label for="TopicModel_mobileNumber">Số điện thoại</label>
                            <?php echo $form->error($model, 'email', array('class' => 'report-error')); ?>
                        </div>
                        <?php echo $form->textField($model, 'mobileNumber', array('class' => 'inp-sminfo floatOnly', 'style' => 'width:400px;')); ?>
                    </div>
                </div>                
            </div>
            <div class="sm-forminfo clearfix">        
                <div class="cont">
                    <div class="title">
                        Nội dung hỏi:
                        <span class="Notes">Tối đa 300 ký tự: <span id="textContentNumber">0</span>/300</span>
                        <?php echo $form->error($model, 'content', array('class' => 'report-error')); ?>
                    </div>
                    <?php echo $form->textArea($model, 'content', array('class' => 'tarea-sminfo', 'id' => 'askContent', 'onkeypress' => 'checkCountContent(this.value.length);', 'onchange' => 'getShop(this.value);')); ?>
                </div>

            </div>
            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        Chủ đề:
                        <span class="Notes">Hệ thống tự động thêm chủ đề. Bạn có thể tùy biến nếu muốn.</span>
                    </div>

                    <ul class="select-key clearfix" id="runtimeGetTag">
                        <?php
                        $listTag = ExtensionSearch::getAllTag();
                        if ($listStack) {
                            foreach ($listStack as $key) {
                                if (isset($listTag[$key]))
                                    echo '<li id="tag_' . $key . '" class="selected-btn"><span>' . $listTag[$key] . '</span><a class="close" onclick="removeTag(\'' . $key . '\');" href="javascript:void(0);"></a><input type="hidden" name="AskModel[tag][]" value="' . $key . '" /></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="sm-forminfo clearfix">
                <div class="cont">
                    <div class="title">
                        Gửi nhu cầu của tôi tới các nhà cung cấp sản phẩm, dịch vụ:
                    </div>            
                    <div id="runtimeGetShop">  
                        <?php
                        if ($listShop) {
                            echo '<div class="previewShop">';
                            echo '<p style="margin: 10px 0px 5px 0px; font-style: italic; color: #666">Hệ thống tự động tìm kiếm và gửi yêu cầu của bạn tới các đơn vị cung cấp sản phẩm, dịch vụ.</p>';
                            echo '<ul class="check-seller clearfix">';

                            foreach ($listShop as $key => $value) {
                                $shop = ExtensionSearch::getShopByShopId($value);
                                echo '<li>
                        <div class="check"><input type="checkbox"name="AskModel[shop][]" checked="true" value="' . $value . '" id="shopIdentify_' . $value . '" /></div>
                        <div class="seller">
                        <span class="logo-seller"><img width="30px" src="' . $shop->logo . '" /></span>
                        <label for="shopIdentify_' . $value . '">' . $shop->name . '</label>
                    </div>
                </li>';
                            }
                            echo '</ul></div>';
                        }
                        ?>
                    </div>
                    <p style="padding-left: 10px;">
                        <?php echo $form->checkBox($model, 'isQuote', array('id' => 'isQuote')); ?><label for="isQuote">Tôi muốn nhận báo giá từ những người bán đã đăng ký với Saobang.vn.</label>

                    </p>
                </div>
            </div>
            <?php echo $form->error($model, 'checkBoxRules', array('class' => 'report-error ruleErr')); ?>
            <div class="grayModule">
                <div class="clearfix">            
                    <span class="fl" style="margin-top: 8px;"><?php echo $form->checkBox($model, 'checkBoxRules', array('id' => 'rulesOkie')); ?><label for="rulesOkie"><code style="color: red;" title="Bắt buộc">*</code> Tôi chấp nhận các <a target="_black" href="<?php echo Yii::app()->createUrl('home/publishedRules'); ?>">Điều khoản và Quy định</a> của SaoBăng.vn</label></span>
                    <a href="javascript:void(0);" onclick="submitAsk();" class="btn-postNews fr"><span>Đăng hỏi mua</span></a>
                </div>
            </div>           

        </div>

    </div>
</div>
<?php $this->endWidget(); ?>