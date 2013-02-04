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
<td>#<?php echo $index + 1; ?></td>
<td style="text-align: left;">
    <div class="title">
        <?php
        echo CHtml::link(CHtml::encode($data->name), Yii::app()->createUrl('category/DemandNew', array('id' => $data->id)), array("rel" => "facebox"));
        ?>
    </div>
</td>
<td>
    <?php
    echo CHtml::link(CHtml::encode(ExtensionClass::getCategoryNameById($data->categoryId)), Yii::app()->createUrl('category/DemandView', array('catId' => $data->categoryId)));
    ?>
</td>
<td><input type="text" name="sort" class="sort" onchange="changeDemand(this.value, '<?php echo $data->id; ?>');" value="<?php echo $data->order; ?>" /></td>
<td><a href="javascript:void(0);" onclick="removeDemand(<?php echo $data->id; ?>);">X</a></td>
</tr>