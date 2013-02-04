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
if ($index % 2) {
    echo '<tr class="odd">';
} else {
    echo '<tr>';
}
?>
<td>--</td>
<td style="text-align: left;">
    <div class="title">
        <?php
        echo '---  ' . CHtml::link(CHtml::encode($data['name']), Yii::app()->createUrl('category/AttributesNew', array('id' => $data['id'])), array("rel" => "facebox"));
        ?>
    </div>
</td>
<td>
    <?php
    echo CHtml::link(CHtml::encode(ExtensionClass::getCategoryNameById($data['categoryId'])), Yii::app()->createUrl('category/AttributesView', array('catId' => $data['categoryId'])));
    echo '<span class="categoryLink">' . CHtml::link(CHtml::encode('< Thêm thuộc tính danh mục >'), Yii::app()->createUrl('category/AttributesNew', array('catId' => $data['categoryId'])), array("rel" => "facebox")) . '</span>';
    ?>
</td>
<td><input type="text" name="sort" class="sort" onchange="changeAttributes(this.value, <?php echo $data['id']; ?>);" value="<?php echo $data['order']; ?>" /></td>
<td><a href="javascript:void(0);" onclick="removeChildAttr(<?php echo $data['id']; ?>);">X</a></td>
</tr>

