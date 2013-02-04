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
    <?php
    if (in_array($data->id, $listShopVip)) {
        $endTime = $endTimeShopVip[$data->id];
        echo '<td>' . date('d-m-Y', $endTime) . '</td>';
    } else {
        ?>
        <td width="200px"> <a id="shopUytin_<?php echo $data->id; ?>" onclick="setInfo('<?php echo $data->id; ?>');" href="javascript:void(0);">Uy tín</a> </td>
        <?php
    }
    ?>

    <td width="200px">  Active    </td>
    <td width="40px"></td>
</tr>
