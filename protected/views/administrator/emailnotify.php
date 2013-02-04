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
$this->pageTitle = 'Quản lý Shop uy tín';

$this->breadcrumbs = array(
    'Quản lý tag' => array('administrator/tag'),
    'Quản lý Shop' => array('administrator/shopview'),
    'Quản lý Shop uy tín' => array('administrator/shopvipview'),
    'Quản lý danh mục ngành hàng' => array('administrator/shopcategory'),
    'Email thông báo' => array('administrator/emailNotify'),
);
?>
<style type="text/css">
    a:hover .buttomAdd{text-decoration: none; background: #fefefe; color: blue;}
    .buttomAdd{ border: 1px solid #ccc; padding: 2px 8px !important; cursor: pointer;}
</style>

<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Tiêu đề email</td>
        <td width="200px">Người nhận</td>
        <td width="200px">Ngày gửi</td>
        <td width="200px">Ngày đọc</td>        
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_emailnotify',
        'template' => "{items}\n",
    ));
    ?> 
</table>

<div style="width: 100%">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'ajaxUpdate' => FALSE,
        'itemView' => '_emailnotify',
        'template' => "{pager}",
    ));
    ?> 
</div>