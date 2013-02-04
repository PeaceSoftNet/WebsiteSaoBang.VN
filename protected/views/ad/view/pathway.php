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
<div class="pathway fl">
    <ul class="clearfix">
        <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
        <?php
        if (!$childCategoryModel->id) {
            $current = ' class="active"';
        } else {
            $current = '';
        }
        echo '<li><a ' . $current . ' href="' . Yii::app()->createUrl('ad/category', array('categoryId' => $categoryModel->id, 'title' => ExtensionClass::utf8_to_ascii($categoryModel->name))) . '">' . $categoryModel->name . '</a></li>';

        if ($childCategoryModel->id) {
            echo '<li><a href = "' . Yii::app()->createUrl('ad/category', array('categoryId' => $categoryModel->id, 'title' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'childCategoryId' => $childCategoryModel->id, 'childTitle' => ExtensionClass::utf8_to_ascii($childCategoryModel->name))) . '" class = "active">' . $childCategoryModel->name . '</a></li>';
        }
        ?>        
    </ul>
</div>