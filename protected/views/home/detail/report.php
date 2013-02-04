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
$form = $this->beginWidget('CActiveForm', array('id' => 'emailnotify'));

echo $form->textField($reportTopic, 'content');

$this->endWidget();