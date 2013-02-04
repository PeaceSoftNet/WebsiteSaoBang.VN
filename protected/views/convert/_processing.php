<?php
/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
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
    <?php echo base64_decode($data->title); ?>
</td>
<td>
    <?php echo $data->domain . ' ' . base64_decode($data->categoryId); ?>
</td>
<td>
    <?php echo base64_decode($data->categoryChildId); ?>
</td>
<td>
    Xử lý <?php echo $this->convert($data->id, $endCat, $siteId, $locality); ?>
</td>    
</tr>