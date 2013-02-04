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
    <strong><?php echo $data->name; ?></strong>
</td>
<td>
    <?php echo $data->url; ?>
</td>
<td>
    <a href="<?php echo Yii::app()->createUrl('post/category', array('siteid' => $data->id)); ?>">[Danh mục]</a>
</td>
<td><a href="<?php echo Yii::app()->createUrl('post/user', array('siteid' => $data->id)); ?>">[Người dùng]</a></td>
<td>
    <?php echo $data->createDate; ?>
</td>
<td>Stop</td>
</tr>