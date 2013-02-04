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
$this->breadcrumbs = array(
    'Xem log người dùng' => array('Administrator/userAction'),
    'Quản trị viên' => array('administrator/view'),
    'Quản trị thành viên đăng ký' => array('administrator/UserView'),
);
$this->pageTitle = 'Xem log người dùng';
?>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Email</td>
        <td>Thời gian</td>
        <td>Địa chỉ IP</td>
        <td>Action</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_viewAction',
        'template' => "{items}\n{pager}",
    ));
    ?>
</table>