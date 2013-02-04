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
        echo '<div style="text-align: left;"><a href="' . Yii::app()->createUrl('administrator/shop', array('id' => $data->id)) . '">' . $data->name . '</a></div>';
        ?>
    </td>
    <td width="200px">  <?php echo $data->createDate; ?>  </td>
    <td width="200px">  <?php echo date('d-m-y', $data->endTime); ?>  </td>
    <td width="40px"></td>
</tr>
