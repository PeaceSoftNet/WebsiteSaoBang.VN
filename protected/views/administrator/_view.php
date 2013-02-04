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
        <?php
        echo CHtml::link(CHtml::encode($data->username), Yii::app()->createUrl('Administrator/New', array('id' => $data->id)), array("rel" => "facebox"));
        ?>
    </div>
</td>
<td><?php echo $data->email; ?></td>
<td><a href="javascript:void(0);" onclick="removeUser('<?php echo $data->id; ?>');">X</a></td>
</tr>
