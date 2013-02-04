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
echo '<span class="chirlLocalityForm">' . CHtml::link(CHtml::encode($data['name']), Yii::app()->createUrl('site/LocalityNew', array('id' => $data['id'])), array("rel" => "facebox")) . ' <a style="color:red;" href="javascript:void(0);" onclick="deleteChildLocal(' . $data['id'] . ');">x</a> </span>';

