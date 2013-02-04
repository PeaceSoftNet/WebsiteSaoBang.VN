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
<div class="box-filter clearfix grayModule">
    <ul class="detail-categ clearfix">
        <?php
        foreach ($listChildCategory as $index => $data) {
            $_current = ($data->id == $childCategoryId) ? 'class="active"' : '';
            $childCategoryLink = Yii::app()->createUrl('ad/category', array('categoryId' => $categoryModel->id, 'title' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'childCategoryId' => $data->id, 'childTitle' => ExtensionClass::utf8_to_ascii($data->name)));
            echo '<li><a ' . $_current . ' href="' . $childCategoryLink . '">' . $data->name . '</a>&nbsp;</li>';
//            echo '<li><a ' . $_current . ' href="' . $childCategoryLink . '">' . $data->name . '</a>&nbsp;<span>(' . GlobalComponents::numberFomat($data->totalItem) . ')</span></li>';
        }
        ?>
    </ul>
    <?php if ($childCategoryId) { ?>
        <a href="<?php echo Yii::app()->createUrl('ad/category', array('categoryId' => $categoryModel->id, 'title' => ExtensionClass::utf8_to_ascii($categoryModel->name))) ?>" class="dtback">Tất cả <?php echo $categoryModel->name; ?></a>
    <?php } else { ?>
        <a href="<?php echo Yii::app()->createUrl('ad/index') ?>" class="dtback">Quay trở lại Trang chủ</a>
        <?php
    }
    ?>

    <div class="lbl-text ">
        <span class="fl">Danh mục:  &nbsp;</span>
        <?php
        if ($childCategoryId) {
            $childCategoroModel = AdExtension::getCategoryById($childCategoryId);
            echo '<h1>' . $childCategoroModel->name . '</h1>';
        } else {
            echo '<h1>' . $categoryModel->name . '</h1>';
        }
        ?>
    </div>
    <?php $this->aSort(); ?>
</div>