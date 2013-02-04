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
        echo CHtml::link(CHtml::encode($data->name), Yii::app()->createUrl('site/LocalityNew', array('id' => $data->id)), array("rel" => "facebox"));
        ?>
    </div>
</td>
<td><input type="text" name="sort" class="sort" onchange="" value="<?php echo $data->order; ?>" /></td>
<td><a href="javascript:void(0);" onclick="removeLocality('<?php echo $data->id; ?>');">X</a></td>
</tr>
<?php
$dataProvider = ExtensionClass::getListChildLocality($data->id);
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => 'location/_viewChild',
    'template' => "<tr><td colspan='4' class='childLocalityItems'>{items}</td></tr>",
    'emptyText' => '',
        )
);
?>