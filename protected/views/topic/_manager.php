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
$listParentCategory = ExtensionClass::getListParentCategory();
?>
<tr id="topic-edit-<?php echo $data->id; ?>">
    <td>#<?php echo $index + 1; ?></td>
    <td style="text-align: left;">
        <?php
        echo '<h3>' . $data->title . '</h3>';
        ?>
    </td>   
    <td>
        <a style="color: red;" class="addNew" onclick="releaseTopic('<?php echo $data->id; ?>');" href="javascript:void(0);"><span>Release</span></a>      
    </td>
    <td>
        <a style="color: red;" class="addNew" onclick="deleteTopic('<?php echo $data->id; ?>');" href="javascript:void(0);"><span>Delete</span></a>    
    </td>
</tr>
