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
$listCategory = AdExtension::getListCategory();
$listChildCategory = AdExtension::getListChildCategory($categoryModel->id);

if ($childCategoryModel->id) {
    $childName = $childCategoryModel->name;
} else {
    $childName = '-- Chọn --';
}
?>
<div class="block fil-browse">
    <div class="Sbox-title">
        <a href="javascript:void(0);">Chọn danh mục:</a>
    </div>
    <div class="block-content">
        <ul class="fil-br-slt">
            <li>
                <span class="fl">Danh mục</span>
                <div class="sltbox fr">
                    <a class="slted" onclick="dropdownMenu('leftCategoryView');" href="javascript:void(0);"><?php echo $categoryModel->name; ?></a>
                    <div class="sub-sltbox" id="leftCategoryView" style="display: none; width: 720px; left: 100px;">
                        <div class="inner-sub-sltbox" style="height: 195px;">
                            <ul>
                                <?php
                                foreach ($listCategory as $index => $data) {
                                    $link = Yii::app()->createUrl('ad/category', array('categoryId' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->name)));
                                    if (!$data->parentId && !$data->isHidden)
                                        echo '<li style="width: 230px;"><a href="' . $link . '">' . $data->name . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <span class="fl">Danh mục con</span>
                <div class="sltbox fr">
                    <a class="slted" onclick="dropdownMenu('leftChildCategoryView');" href="javascript:void(0);"><?php echo $childName; ?></a>
                    <div class="sub-sltbox" id="leftChildCategoryView" style="display: none; width: 720px; left: 100px;">
                        <div class="inner-sub-sltbox" style="height: auto;">
                            <ul>
                                <?php
                                if ($categoryModel->id) {
                                    foreach ($listChildCategory as $cindex => $cData) {
                                        $link = Yii::app()->createUrl('ad/category', array('categoryId' => $categoryModel->id, 'title' => $categoryModel->name, 'childCategoryId' => $cData->id, 'childTitle' => $cData->name));
                                        echo '<li style="width: 230px;"><a href="' . $link . '">' . $cData->name . '</a></li>';
                                    }
                                }else{
                                    echo '<li style="padding: 15px; color: #666;">Vui lòng chọn danh mục trước</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>