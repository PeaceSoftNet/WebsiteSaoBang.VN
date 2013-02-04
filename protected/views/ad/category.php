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
if (!$childCategoryId) {
    $this->pageTitle = $categoryModel->name;
} else {
    $childModel = AdExtension::getCategoryById($childCategoryId);
    $this->pageTitle = $childModel->name;
}
?>

<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix" >
            <?php $this->pathWay($categoryModel, $childCategoryId); ?>
            <?php $this->setLocal(); ?>
        </div>
        <!--end pathway-->
        <div class="grid_3">
            <?php $this->leftCategory($categoryModel, $childCategoryId); ?>
            <?php $this->filterValue($categoryId, $childCategoryId); ?>
            <div id="adChodientu" onload="loadAdChodientu(6);"></div>
            <?php $this->bannerAd(); ?>
        </div>
        <!--end grid 3-->
        <div class="grid_9">
            <?php $this->listChildCategoryItem($listChildCategory, $categoryModel, $childCategoryId); ?>
            <!--end filter-->
            <?php $this->googleAd(); ?>

            <ul class="list-Browse-NewsRv" id="listViewAd">
                <?php
                $this->listAdView($dataProvider, $categoryModel);
                ?>
            </ul>
            <a class="viewMore-news" id="loadContent" href="javascript:void(0);">Xem thêm...</a>
            <input type="hidden" value="1" id="currentPage" />            
        </div>
    </div>
</div>