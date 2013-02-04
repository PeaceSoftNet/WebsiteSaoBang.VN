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
$currentCategory = base64_decode($data->categoryId);
$childCategory = base64_decode($data->categoryChildId);
if ($index % 2) {
    echo '<tr class="odd">';
} else {
    echo '<tr>';
}
$form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl('convert/Processing'), 'method' => 'GET'));
?>
<td>#<?php echo $index + 1; ?></td>
<td style="text-align: left;">
    <?php
    echo $data->domain;
    echo CHtml::hiddenField('domain', $data->domain);
    ?>
</td>
<td style="text-align: left;">
    <?php
    echo $currentCategory;
    echo CHtml::hiddenField('pCategory', $data->categoryId);
    ?>
</td>
<td style="text-align: left;">
    <?php
    echo $childCategory;
    echo CHtml::hiddenField('cCategory', $data->categoryChildId);
    ?>
</td>
<td style="text-align: left;">
<?php
echo base64_decode($data->Location);
echo CHtml::hiddenField('oLocation', $data->Location);
?>
</td>
<td>
    <?php
    echo CHtml::dropDownList('categoryNew', 0, $listParentCategory, array('class' => 'multiOption w200'));
    ?>
</td>   
<td>
    <?php
    echo CHtml::dropDownList('siteId', 0, $listSite, array('class' => 'multiOption w200'));
    ?>
</td> 
<td>
    <?php
    echo CHtml::dropDownList('Locality', 0, $listLocality, array('class' => 'multiOption w200'));
    ?>
</td>  
<td>
<?php echo CHtml::submitButton('Chuyển đổi ngay', array('style' => 'border: 1px solid #008EC4; padding: 2px 10px; cursor: pointer; background: #fcfcfc;')); ?>
</td>
<?php $this->endWidget(); ?>
</tr>