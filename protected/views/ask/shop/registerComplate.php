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
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="clearfix">
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>" >Hỏi mua</a></li>
                    <li><a href="javascript:void(0);" class="active"><?php echo $this->pageTitle; ?></a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <div class="clear"></div>
        <?php $this->listShopViewColum(); ?>
        <div class="grid_9">

            <div class="title-page">
                <h1>Đăng ký người bán đảm bảo</h1>
                <div>
                    Bạn đã đăng ký thành công người bán hàng trên Hỏi mua của saobang.vn
                </div>
            </div>
        </div>
    </div>
</div>