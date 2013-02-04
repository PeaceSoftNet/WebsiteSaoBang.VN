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
$this->pageTitle = 'Người bán đăng ký';
$listShopUyTin = ExtensionSearch::listShopUyTin();
$form = $this->beginWidget('CActiveForm');
?>
<div class="grid_12">
    <?php
    $this->bannerA2b();
    ?>
</div>
<style type="text/css">
    .dropdown-local select{height: 30px; line-height: 30px; width: 200px;}
    .dropdown-local select option{padding: 5px 10px;}
    .submitButtonTag{width: 120px !important; height: 22px; line-height: 22px; border: 1px solid #666; background: #ccc; font-weight: 700; cursor: pointer;}
</style>
<div class="clear"></div>

<div class="grid_3">
    <div class="block fil-browse">
        <div class="Sbox-title">
            <a href=""><i href="" class="icon-compact"></i>Người bán uy tín</a>
        </div>
        <div class="block-content">
            <ul class="list-seller">
                <?php
                foreach ($listShopUyTin as $key => $value) {
                    if ($key < 8) {
                        ?>
                        <li>
                            <div class="image"><a target="_blank" href="<?php echo Yii::app()->createUrl('ask/shop', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['name']))); ?>"><img width="30px" src="<?php echo $value['logo']; ?>" /></a></div>
                            <a class="name-seller" target="_blank" href="<?php echo Yii::app()->createUrl('ask/shop', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['name']))); ?>"><?php echo $value['name']; ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>" >Hỏi mua</a></li>
            <li><a href="javascript:void(0);" class="active"><?php echo $this->pageTitle; ?></a></li>
        </ul>
    </div>
    <div class="title-page">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <?php echo $form->labelEx($model, 'name', array('class' => 'title')); ?>
            <?php echo $form->textField($model, 'name', array('class' => 'inp-sminfo')); ?>
        </div>
        <?php echo $form->error($model, 'name', array('class' => 'report-error')); ?>
    </div>
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <?php echo $form->labelEx($model, 'logo', array('class' => 'title')); ?>
            <?php echo $form->textField($model, 'logo', array('class' => 'inp-sminfo')); ?>
        </div>
        <?php echo $form->error($model, 'logo', array('class' => 'report-error')); ?>
    </div>
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <div class="fl">
                <?php echo $form->labelEx($model, 'email', array('class' => 'title')); ?>
                <?php echo $form->textField($model, 'email', array('class' => 'inp-sminfo')); ?>
            </div>
            <div class="fr">
                <div class="title">
                    <label for="TopicModel_mobileNumber">Số điện thoại</label>
                </div>
                <?php echo $form->textField($model, 'phone', array('class' => 'inp-sminfo floatOnly')); ?>
            </div>
        </div>
        <?php echo $form->error($model, 'email', array('class' => 'report-error')); ?>
    </div>
    <p style="padding-left: 10px;">
        <?php echo $form->checkBox($model, 'isSMS', array('id' => 'isSMS')); ?><label for="isSMS">Tôi muốn đăng ký nhận tin hỏi mua qua sms</label>

    </p>
    <div class="sm-forminfo clearfix">        
        <div class="cont">
            <?php echo $form->labelEx($model, 'description', array('class' => 'title')); ?>
            <?php echo $form->textArea($model, 'description', array('class' => 'tarea-sminfo')); ?>
        </div>
        <?php echo $form->error($model, 'description', array('class' => 'report-error')); ?>
    </div>
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <?php echo $form->labelEx($model, 'url', array('class' => 'title')); ?>
            <?php echo $form->textField($model, 'url', array('class' => 'inp-sminfo')); ?>
        </div>
        <?php echo $form->error($model, 'url', array('class' => 'report-error')); ?>
    </div>
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <?php echo $form->labelEx($model, 'address', array('class' => 'title')); ?>
            <?php echo $form->textField($model, 'address', array('class' => 'inp-sminfo')); ?>
        </div>
        <?php echo $form->error($model, 'address', array('class' => 'report-error')); ?>
    </div>
    <div class="dropdown-local">
        <div class="cont">
            <?php
            echo $form->labelEx($model, 'zone') . '<br />';
            $listLocalArr = ExtensionClass::getListLocality();
            $listLocalArr[0] = 'Toàn quốc';
            echo $form->dropDownList($model, 'zone', $listLocalArr);
            ?>
        </div>
    </div>    
    <div class="sm-forminfo clearfix">
        <div class="cont">
            <div class="title">Sản phẩm cung cấp</div>
            <?php echo $form->textField($model, 'product', array('class' => 'inp-sminfo')); ?>
        </div>
        <?php echo $form->hiddenField($modelIdentify, 'content'); ?>
        <div id="listProduct"></div>
    </div>


    <div class="grayModule">
        <div class="clearfix">
            <a href="javascript:void(0);" onclick="submitAsk();" class="btn-postNews fr"><span>Cập nhật</span></a>
        </div>
    </div>
    <div style="clear: both;"> </div>
</div>  

<?php $this->endWidget(); ?>
