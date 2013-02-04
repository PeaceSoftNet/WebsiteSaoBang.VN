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
echo '<h3>Hiển thị danh sách các bài viết đã được crawler về</h3>';
echo '<div style="magin: 20px;">';
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_tranf',
    'template' => "{pager}\n{items}\n{pager}",
    'emptyText' => '',
        )
);
echo '</div>';