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
    <td>#<?php echo $index + 1; ?></td>
    <td style="text-align: left;"><?php echo CHtml::link(CHtml::encode($data->name), Yii::app()->createUrl('site/CrawlerNew', array('id' => $data->id)), array("rel" => "facebox")); ?></td> 
    <td><?php echo GlobalComponents::numberFomat($data->totalLink); ?></td>
    <td><input type="text" name="sort" class="sort" onchange="updateOrder(this.value, '<?php echo $data->id; ?>');" value="<?php echo $data->order; ?>" /></td>
    <td><?php echo $data->hidenAction(); ?></td>
    <td><a onclick="removeSite('<?php echo $data->id; ?>');" href="javascript:void(0);">x</a></td>
</tr>