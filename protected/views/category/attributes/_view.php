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
    echo '<tr class="parentCat odd">';
} else {
    echo '<tr class="parentCat">';
}
?>
<td>#<?php echo $index + 1; ?></td>
<td style="text-align: left;">
    <div class="title">
        <?php
        echo CHtml::link(CHtml::encode($data->name), Yii::app()->createUrl('category/AttributesNew', array('id' => $data->id)), array('rel' => "facebox"));
        echo '<span class="categoryLink">' . CHtml::link(CHtml::encode('< Thêm thuộc tính con >'), Yii::app()->createUrl('category/AttributesNew', array('catId' => $data->categoryId, 'group' => $data->id)), array("rel" => "facebox")) . '</span>';
        ?>
    </div>
</td>
<td>
    <?php
    echo CHtml::link(CHtml::encode(ExtensionClass::getCategoryNameById($data->categoryId)), Yii::app()->createUrl('category/AttributesView', array('catId' => $data->categoryId)));
    echo '<span class="categoryLink">' . CHtml::link(CHtml::encode('< Thêm thuộc tính danh mục >'), Yii::app()->createUrl('category/AttributesNew', array('catId' => $data->categoryId)), array("rel" => "facebox")) . '</span>';
    ?>
</td>
<td><input type="text" name="sort" class="sort" onchange="changeAttributes(this.value, <?php echo $data->id; ?>);" value="<?php echo $data->order; ?>" /></td>
<td><a href="javascript:void(0);" onclick="removeAttributes(<?php echo $data->id . ', ' . $data->categoryId; ?>);">X</a></td>
</tr>
<?php
$dataProvider = ExtensionClass::getListChildArticlesByCategory($data->categoryId, $data->id);
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => 'attributes/_viewChild',
    'template' => "{items}\n{pager}",
    'emptyText' => '',
        )
);
?>