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
<td id="cat<?php echo $data->id; ?>"><strong>#<?php echo $index + 1; ?></strong></td>
<td colspan="2" style="text-align: left;">
    <div class="title">
        <?php
        echo CHtml::link(CHtml::encode($data->name), Yii::app()->createUrl('category/new', array('id' => $data->id)), array("rel" => "facebox"));
        echo '<span class="categoryLink">' . CHtml::link(CHtml::encode('< Thêm danh mục con >'), Yii::app()->createUrl('category/new', array('catId' => $data->id, 'name' => $data->displayUrl)), array("rel" => "facebox")) . '</span>';
        ?>
    </div>
</td>    
<td><?php echo '<span class="categoryLink" id="categoryUpdate' . $data->id . '"><a onclick="updateDs(\'' . $data->id . '\')" href="javascript:void(0);">Cập nhật miêu tả</a></span>'; ?></td>
<td><?php if ($data->isPrice) echo '<span class="categoryLink"><a href="' . Yii::app()->createUrl('category/FilterView', array('catId' => $data->id)) . '">Bộ lọc</a></span>'; ?></td>
<td><span class="categoryLink"><a href="<?php echo Yii::app()->createUrl('category/DemandView', array('catId' => $data->id)); ?>">Nhu cầu</a></span></td>
<td><span class="categoryLink"><a href="<?php echo Yii::app()->createUrl('category/AttributesView', array('catId' => $data->id)); ?>">Thuộc tính</a></span></td>
<td><input type="text" name="sort" class="sort" onchange="updateOrder(this.value, '<?php echo $data->id; ?>');" value="<?php echo $data->order; ?>" /></td>
<td><?php echo $data->hiddenName(); ?></td>
<td><a href="javascript:void(0);" onclick="removeCategory('<?php echo $data->id; ?>');">X</a></td>
</tr>
<?php
$dataProvider = ExtensionClass::getListChildCategory($data->id);
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_viewChild',
    'template' => "{items}",
    'emptyText' => '',
        )
);
?>