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
        <?php echo $data->email; ?>
    </div>       
</td>
<td style="text-align: left;"><?php echo ExtensionClass::getCategoryNameById($data->categoryId); ?></td>
<td style="text-align: left;"><?php echo ExtensionClass::getCategoryNameById($data->childCatId); ?></td>
<td><?php echo ExtensionClass::getLocalityById($data->locality); ?></td>
<td><?php echo $data->mobileNumber; ?></td>
<td><?php echo $data->domain; ?></td>
<td><?php echo $data->createDate; ?></td>
</tr>