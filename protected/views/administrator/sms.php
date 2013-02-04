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
    'Thống kê sms' => array('administrator/sms'),
    'Thống kê thành viên đăng ký' => array('administrator/userView'),
);
$this->pageTitle = 'Thống kê sms';
?>

<div class="navi-right">
    <div style="float: left">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_sms',
            'template' => "{summary}",
        ));
        ?>
    </div>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_sms',
        'template' => "{pager}",
    ));
    ?>
    <table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
        <tr class="title-list">
            <td width="40px">STT</td>
            <td>Phone</td>
            <td>Đầu số</td>
            <td>Nội dung</td>
            <td width="200px">Ngày tạo</td>
        </tr>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_sms',
            'template' => "{items}",
        ));
        ?>
    </table>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'ajaxUpdate' => FALSE,
        'itemView' => '_sms',
        'template' => "{pager}",
    ));
    ?>
</div>
<div class="clear"></div>