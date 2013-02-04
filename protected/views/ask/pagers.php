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
echo '<div class="pagination clearfix">';

$this->widget('CLinkPagerSaoBang', array(
    'currentPage' => $pages->getCurrentPage(),
    'itemCount' => $resultCount,
    'pageSize' => 30,
    'header' => '',
    'htmlOptions' => array(
        'class' => '',
    ),
    'prevPageLabel' => '',
    'nextPageLabel' => '',
));

echo '</div>';
?>