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
$listShopUyTin = ExtensionSearch::listShopUyTin();
?>

<div class="grid_12">
    <div class="green-block">
        <div class="grbl-title">
            <a class="close" href="">Đóng</a>
            <h4>Hỏi mua - mua ngay giá đúng</h4>
        </div>
        <div class="block-content" align="center"><img src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/Asktobuy.png" /></div>
    </div>
</div>

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
                    ?>
                    <li>
                        <div class="image"><a href="<?php echo Yii::app()->createUrl('ask/shop', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['name']))); ?>"><img width="70px" src="<?php echo $value['logo']; ?>" /></a></div>
                        <a class="name-seller" href="<?php echo Yii::app()->createUrl('ask/shop', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['name']))); ?>"><?php echo $value['name']; ?></a>
                    </li>
                    <?php
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
            <li><a href="<?php echo Yii::app()->createUrl('ask/view'); ?>" >Hỏi mua</a></li>
            <li><a href="javascript:void(0);" class="active"><?php echo $shop->name; ?></a></li>
        </ul>
    </div>
    <div class="title-page">
        <h3><?php echo $shop->name; ?></h3>
    </div> 
    <div>
        <?php echo $shop->description; ?>
    </div>
</div>