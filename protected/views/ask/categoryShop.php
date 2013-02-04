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
<div class="block fil-browse">
    <div class="Sbox-title">
        <a href="javascript:void(0);">Danh mục nghành hàng</a>
    </div>
    <div class="block-content">
        <ul class="list-merchant">
<?php
foreach ($listShopCategory as $key => $value) {
    $link = Yii::app()->createUrl('ask/listShop', array('categoryId' => $value->id, 'name' => ExtensionClass::utf8_to_ascii($value->name)));
    $curr = '';
    if ($value->id == $categoryId)
        $curr = 'class="active"';
    ?>
                <li><a <?php echo $curr; ?> href="<?php echo $link; ?>"><?php echo $value->name; ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>