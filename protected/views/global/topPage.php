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
<div id="header">
    <div class="tophead pos-fix" id="topbarGlobal" style="display: none;">
        <div class="main clearfix">
            <?php $this->widget('zii.widgets.CMenu', GlobalComponents::homepageMenu()); ?>            
            <div class="support-thead"><span class="hotline">Hotline: <b>(04)36 321 125</b> - <b>093 696 6263</b></span>&nbsp;&nbsp;Hỗ trợ:<a href="ymsgr:sendim?saobangvn_cskh&amp;m=Xin chao, saobangvn_cskh"><i class="icon-yahoo"></i>&nbsp;Yahoo!</a><a href="skype:saobangvn_cskh?chat"><i class="icon-skype"></i>&nbsp;Skype</a></div>
            <div class="postNews-Rv"><a href="<?php echo Yii::app()->createUrl('ask/new'); ?>" class="postBuys-Rv">Đăng hỏi mua</a> <a href="<?php echo Yii::app()->createUrl('ad/step1'); ?>">Đăng rao vặt</a></div>
        </div>
    </div>

    <div class="tophead">
        <div class="main clearfix">
            <?php $this->widget('zii.widgets.CMenu', GlobalComponents::homepageMenu()); ?>
            <div class="Navi-tophead">
                <ul class="clearfix">
                    <li<?php if (Yii::app()->controller->id == 'ad') echo ' class="active"'; ?>>
                        <a href="<?php echo Yii::app()->createUrl('ad/index'); ?>"><span><b>Rao vặt</b></span></a>
                    </li>
                    <li<?php if (Yii::app()->controller->id == 'ask') echo ' class="active"'; ?>>
                        <a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>"><span><b>Hỏi mua <i class="icon-new">&nbsp;</i></b></span></a>
                    </li>
                    <li<?php if (Yii::app()->controller->id == 'home' || Yii::app()->controller->id == 'user') echo ' class="active"'; ?>>
                        <a href="<?php echo Yii::app()->createUrl('home/published'); ?>"><span><b>Tin của tôi</b></span></a>
                    </li>
                </ul>
            </div>
            <div class="postNews-Rv"><a href="<?php echo Yii::app()->createUrl('ask/new'); ?>" class="postBuys-Rv">Đăng hỏi mua</a> <a href="<?php echo Yii::app()->createUrl('ad/step1'); ?>">Đăng rao vặt</a></div>
        </div>
    </div>
    <div class="browse-head">
        <div class="main clearfix">
            <div class="logoRv">
                <a href="<?php echo Yii::app()->createUrl('ad/index'); ?>" >&nbsp;</a>
            </div>
            <?php
            if (Yii::app()->controller->id == 'ad') {
                $categoryModel = AdExtension::getCategoryById($categoryId);

                $action = Yii::app()->createUrl('ad/search', array('categoryId' => $categoryId, 'categoryName' => ExtensionClass::utf8_to_ascii($categoryModel->name)));
            } else {
                $action = Yii::app()->createUrl('ask/search');
            }
            $this->beginWidget('CActiveForm', array('id' => 'topsearchAd', 'method' => 'get', 'action' => $action));
            ?>
            <div class="boxsearch">
                <span class="corner-left"></span>
                <span class="corner-right"></span>
                <input class="search-head" name="keyword" type="text" value="<?php echo $keyword; ?>" onclick="this.value=''" />
            </div>
            <a class="submit-head" onclick="$('#topsearchAd').submit();" href="javascript:void(0);">Tìm ngay</a>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>