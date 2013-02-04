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
    <?php echo $data->phone; ?>
</td>
<td>
    <?php echo $data->service; ?>
</td>
<td>
    <?php echo $data->msg; ?>
</td>
<td>
    <?php echo $data->createDate; ?>
</td>
</tr>