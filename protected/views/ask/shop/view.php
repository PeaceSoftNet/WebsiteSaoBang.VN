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
if (!$categoryId) {
    $this->pageTitle = 'Danh sách người bán';
} else {
    $categoryShopModel = AdExtension::getShopCategoryById($categoryId);
    $this->pageTitle = $categoryShopModel->name;
}
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix" >
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>">Hỏi mua</a></li>
                    <li><a href="javascript:void(0);"  class="active">Danh sách người bán</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <!--end pathway-->
        <div class="grid_3">
            <?php $this->categoryShop(); ?>
            <!--end block-->
            <?php $this->bannerAd(); ?>
        </div>
        <!--end grid 3-->
        <div class="grid_9">
            <div class="title-page">
                <h1><?php echo $this->pageTitle; ?></h1>                
            </div>
            <ul class="same-shopPro clearfix">
                <?php
                foreach ($dataProvider as $key => $data) {
                    $link = Yii::app()->createUrl('ask/shop', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->name)));
                    $rage = $data->rank * 10;
                    ?>
                    <li>                    	
                        <a href="<?php echo $link; ?>" class="disp-lg"><img width="80px" height="80px" src="<?php echo $data->logo; ?>" alt="<?php echo $data->name; ?>"></a>
                        <p><a href="<?php echo $link; ?>"><?php echo $data->name; ?></a></p>
                        <p><span class="starRate"><span style="width:<?php echo $rage . '%'; ?>" class="starVote">&nbsp;</span></span></p>                                
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php $this->googleAd(); ?>
            <a href="#" class="viewMore-news">Xem thêm...</a>                                 
        </div>
        <!--end grid 9-->
    </div>
</div>