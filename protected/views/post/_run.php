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
    <a href="<?php echo Yii::app()->createUrl('post/viewSite', array('id' => $data->id)); ?>" target="_black"><?php echo $data->name; ?></a>
</td>
<td id="result<?php echo $data->id; ?>">
    <?php
//echo $this->getUrl('http://vizum.vn');
    ?>
</td>
<td id="func<?php echo $data->id; ?>"><a onclick="runPost('<?php echo $data->id; ?>')" href="javascript:void(0);"><input class="publishauto" type="button" value="Đăng tin" /></a></td>
</tr>