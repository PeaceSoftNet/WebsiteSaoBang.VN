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
        <?php echo '<a href="' . Yii::app()->createUrl('administrator/searchKey', array('catId' => $categoryId, 'childCat' => $childCatId, 'id' => $data->id)) . '">' . $data->name . '</a>'; ?>
    </div>
</td>
<td width="40px"><a href="<?php echo Yii::app()->createUrl('administrator/deletekey', array('id' => $data->id)); ?>">X</a></td>
</tr>