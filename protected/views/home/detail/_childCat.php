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
$currUrlNew = array('catId' => $catId);
$currUrlNew = array_merge($currUrlNew, array('childCat' => $data['id']));
$countVal = ExtensionClass::statisticDetail($statistic, $currUrlNew);
$countVal = GlobalComponents::numberFomat($countVal);
if ($childCatId == $data['id'])
    echo '<li><a class="active" href="' . Yii::app()->createUrl('home/category', array('catId' => $catId, 'childCat' => $data['id'], 'name' => ExtensionClass::utf8_to_ascii($catName), 'childName' => ExtensionClass::utf8_to_ascii($data['name']))) . '">' . $data['name'] . '</a>&nbsp;<span>(' . $countVal . ')</span></li>';
else
    echo '<li><a href="' . Yii::app()->createUrl('home/category', array('catId' => $catId, 'childCat' => $data['id'], 'name' => ExtensionClass::utf8_to_ascii($catName), 'childName' => ExtensionClass::utf8_to_ascii($data['name']))) . '">' . $data['name'] . '</a>&nbsp;<span>(' . $countVal . ')</span></li>';