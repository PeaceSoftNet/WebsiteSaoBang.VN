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
foreach ($dataProvider as $index => $data) {
    if (isset($data->categoryId)) {
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