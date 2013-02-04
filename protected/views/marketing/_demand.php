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
        <?php echo $data->demandTypeA; ?>
    </div>       
</td>
<td style="text-align: left;">
    <div class="title">
        <?php echo $data->demandTypeB; ?>
    </div>        
</td>
<td width="100px"><a  href="<?php echo Yii::app()->createUrl('marketing/product', array('id' => $data->id)); ?>">mail</a></td>
<td width="100px" id="run<?php echo $data->id; ?>"><a onclick="searchByKey(<?php echo $data->id; ?>);" href="javascript:void(0);">Quét dữ liệu</a></td>
<td width="100px"><?php
        if ($data->lastSearch) {
            echo $data->lastSearch;
        } else {
            echo '<i style="color: green">Chưa quét</i>';
        }
        ?></td>
<td width="40px"><a href="<?php echo Yii::app()->createUrl('marketing/demand', array('id' => $data->id)); ?>"><i>( sửa )</i></a></td>
<td width="40px"><a href="<?php echo Yii::app()->createUrl('marketing/demandRemove', array('id' => $data->id)); ?>">X</a></td>
</tr>