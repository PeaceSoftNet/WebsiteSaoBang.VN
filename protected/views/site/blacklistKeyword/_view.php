<?php

/**
 * @author Chienlv
 */
echo '<span class="chirlLocalityForm">' . CHtml::link(CHtml::encode($data['keyword']), Yii::app()->createUrl('site/BlacklistKeywordNew', array('id' => $data['id'])), array("rel" => "facebox")) . ' <a style="color:red;" href="javascript:void(0);" onclick="removeSite(' . $data['id'] . ');" title="Xóa">x</a> </span>';
?>