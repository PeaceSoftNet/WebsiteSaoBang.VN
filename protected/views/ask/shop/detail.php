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
$this->pageTitle = $shop->name;
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix" >
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index') ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>">Hỏi mua</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/listShop'); ?>"  class="active">Danh sách người bán</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <!--end pathway-->
        <?php $this->getListShopVip(); ?>
        <!--end nguoi ban tieu bieu-->
        <div class="grid_3">
            <?php $this->categoryShop(); ?>
            <!--end block-->
            <?php $this->bannerAd(); ?>
        </div>
        <!--end grid 3-->
        <div class="grid_9">
            <div class="title-page">
                <h1><?php echo $shop->name; ?></h1>
            </div>
            <div class="avar-merchant"><img src="<?php echo $shop->logo; ?>" alt="<?php $shop->name; ?>"/></div>
            <div class="des-merchant">
                <div class="infor clearfix">
                    <p class="clearfix">
                        <span class="starRate"><span style="width:<?php echo $shop->rank . '%'; ?>" class="starVote">&nbsp;</span></span></p> 
                    <p>
                        <b class="lbw128">Điện thoại <span class="fr">:</span></b>
                        <span class="lbw422"> - <?php echo $shop->phone; ?></span>
                    </p>
                    <p>
                        <b class="lbw128">Email<span class="fr">:</span></b>
                        <span class="lbw422"> - <?php echo $shop->email; ?></span>
                    </p>

                    <p>
                        <b class="lbw128">Địa chỉ <span class="fr">:</span></b>
                        <span class="lbw422"> - <?php $shop->address; ?></span>
                    </p>
                </div>
                <div class="clearfix">
                    <p><?php echo $shop->description; ?></p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <!--end grid 9-->
    </div>
</div>