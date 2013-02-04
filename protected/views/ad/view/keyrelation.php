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
<div style="margin-top: 5px;" class="grayModule">
    <ul class="detail-categ clearfix">
        <?php
        $categoryModel = AdExtension::getCategoryById($categoryId);
        foreach ($keyRelation as $index => $data) {
            $linkSearch = Yii::app()->createUrl('ad/search', array('categoryId' => $categoryId, 'categoryName' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'keyword' => $data->name));
            if ($index < 2) {
                echo '<li class="no-bg"><span class="fl"><a href="' . $linkSearch . '">' . $data->name . '</a></span></li>';
            } else {
                echo '<li><span class="fl"><a href="' . $linkSearch . '">' . $data->name . '</a></span></li>';
            }
        }
        ?>
    </ul>
</div>