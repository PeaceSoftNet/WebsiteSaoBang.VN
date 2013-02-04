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
?>
<tr>
    <td><?php echo $index; ?></td>
    <td>
        <?php
        echo '<div style="text-align: left;">' . $data->title . '</div>';
        ?>
    </td>
    <td width="200px"><?php echo $data->email; ?></td>
    <td width="200px"><?php echo $data->createDate; ?></td>
    <td width="200px"><?php echo $data->openDate; ?></td>    
</tr>
