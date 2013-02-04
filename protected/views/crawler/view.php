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
echo '<h1>Thông tin crawler</h1>';

echo '<a href="' . Yii::app()->createUrl('crawler/view', array('domain' => 'none')) . '">Sắp xếp theo domain</a>';
echo '<p> Tổng :' . $dataProvider->totalItemCount . '</p>';

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => "{pager}\n{items}\n{pager}",
//    'emptyText'=>'',
        )
);