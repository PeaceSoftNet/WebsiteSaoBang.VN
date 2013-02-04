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
<div class="grid_3">
    <div class="block fil-browse">
        <div class="Sbox-title">
            <a href=""><i href="" class="icon-compact"></i>Người bán hàng đầu</a>
        </div>
        <div class="block-content">
            <ul class="list-seller">
                <?php
                foreach ($listShopUyTin as $key => $value) {
                    ?>
                    <li>
                        <div class="image"><a target="_blank" href="<?php echo Yii::app()->createUrl('ask/shop', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['name']))); ?>"><div style="width: 30px; height: 30px; background: url('<?php echo $value['logo']; ?>') no-repeat top left; background-size: 30px 30px;"></div></a></div>
                        <a class="name-seller" target="_blank" href="<?php echo Yii::app()->createUrl('ask/shop', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['name']))); ?>"><?php echo $value['name']; ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>