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
if (isset($tagId)) {
    $pageTitle = ucfirst(ExtensionSearch::getTagNameByTagId($tagId));
} else {
    $tagId = false;
    $pageTitle = 'Mua nhanh - Đúng giá - Chất lượng tốt';
}
$this->pageTitle = $pageTitle;
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix" >
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index') ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view'); ?>" class="active">Hỏi mua</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <div class="grid_12">
            <?php $this->getListShopVip(); ?>
            <div class="Tab-br-NewsRv clearfix" >
                <?php $this->widget('zii.widgets.CMenu', GlobalComponents::askTypelMenu()); ?>
                <div class="arrang fr">
                    <span class="fl" style="line-height:22px;margin:4px 10px 0 0">Sắp xếp theo </span>
                    <a class="slted" href="javascript:void(0);">Mới nhất</a>
                    <div style="display: none; width:96px" class="sub-sltbox">
                        <div class="inner-sub-sltbox"></div>
                    </div>
                </div>
            </div>
            <ul class="list-Asktobuy" id="listViewAd">
                <?php $this->listAsk($dataProvider); ?>
            </ul>
            <a id="loadContent" href="javascript:void(0);" class="viewMore-news">Xem thêm...</a>
            <input type="hidden" value="1" id="currentPage" />
        </div>
    </div>
</div>