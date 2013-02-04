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
$this->pageTitle = $keySearchValue;
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix" >
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="javascript:void(0);" class="active">Tìm kiếm</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <!--end pathway-->
        <div class="grid_3">
            <?php $this->leftCategory($categoryModel, $childCategoryId = 0); ?>
            <div id="adChodientu" onload="loadAdChodientu(6);"></div>
            <?php $this->bannerAd(); ?>
        </div>
        <!--end grid 3-->
        <div class="grid_9">       

            <div class="lbl-text ">
                <span class="fl">Từ khóa tìm kiếm:  &nbsp;</span><h1 style="font-size: 14px;"><?php echo $keySearchValue; ?></h1>
            </div>
            <?php $this->googleAd(); ?>
            <ul class="list-Browse-NewsRv" id="listViewAd">
                <?php
                $i = rand(5, 10);
                foreach ($dataProvider as $index => $data) {
                    if (isset($data->categoryId) && isset($data->childCatId)) {
                        $categoryUnit = AdExtension::getCategoryById($data->categoryId);
                        $childUnit = AdExtension::getCategoryById($data->childCatId);
                        $linkDetail = Yii::app()->createUrl('ad/detail', array('categoryName' => ExtensionClass::utf8_to_ascii($categoryUnit->name), 'id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title)));
                        $linkPriview = Yii::app()->createUrl('ad/preview', array('categoryName' => ExtensionClass::utf8_to_ascii($categoryUnit->name), 'id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title)));
                        ?>
                        <li>
                            <h2 class="title-Br-NewsRv">
                                <a class="fl" href="<?php echo $linkDetail; ?>"><?php echo $data->title; ?></a>
                            </h2>
                            <p class="Br-NewsRv-cont">
                                <a href="<?php echo $linkPriview; ?>" rel="facebox" class="text-unline">Xem nhanh</a>
                                <?php if (isset($data->domain)) echo '<span class="gray-clr">&nbsp;&nbsp;• Đăng tại &nbsp;' . $data->domain . '</span>'; ?>
                                <?php
                                echo '<span class="gray-clr">&nbsp;&nbsp;• ';
                                echo $categoryUnit->name;
                                echo '&nbsp;&nbsp;• ' . $childUnit->name;
                                echo '</span>';
                                ?>
                            </p>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
            <a class="viewMore-news" id="loadContentSearch" href="javascript:void(0);">Xem thêm...</a>
            <input type="hidden" value="1" id="currentPage" /> 
        </div>	

    </div>
</div>
