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
$userActive = UserVipModel::model()->find('`userId` = ' . $data->id);

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
        echo CHtml::link(CHtml::encode($data->email), Yii::app()->createUrl('Administrator/EditUser', array('id' => $data->id)), array("rel" => "facebox"));
        ?>
    </div>
</td>
<td>
    <a href="<?php echo Yii::app()->createUrl('Administrator/userAction', array('uId' => $data->id)) ?>" ><span>Log tài khoản</span></a>
</td>
<?php if (!$userActive) { ?>
    <td id="user<?php echo $data->id; ?>"><a href="javascript:void(0);" onclick="activeVIPuser('<?php echo $data->id; ?>');">Active VIP</a></td>
    <?php
} else {
    ?>
    <td><span style="color: red">VIP</span></td>
    <?php
}
?>
<td>
    <p>
        <?php echo $data->createDate; ?>
    </p>
</td>
<td><?php echo CHtml::checkBox('isActive', $data->isActive, array('onchange' => 'changeStatic("' . $data->id . '");')); ?></td>
</tr>