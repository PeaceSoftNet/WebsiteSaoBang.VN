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

<a href="<?php echo Yii::app()->createUrl('administrator/tag', array('id' => $data->id)) ?>"><span style="display: block; height: 20px; line-height: 20px; background: #cfcfcf; border: 1px solid #ccc; margin: 5px; float: left; padding: 1px 6px;"><?php echo $data->name; ?></span></a>