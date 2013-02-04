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
$listShopVip = ExtensionSearch::listShopVip();
$endTimeShopVip = ExtensionSearch::ShopVipendTime();

$this->pageTitle = 'Quản lý Shop';

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
<div>
    <a href="<?php echo Yii::app()->createUrl('administrator/shop') ?>"><input class="buttomAdd" value="Thêm Shop" type="button" name="Thêm Shop" /></a>
</div>
<p>
<form id="yw0" action="<?php echo Yii::app()->createUrl('administrator/shopview'); ?>" method="GET">
    Đăng ký từ ngày
    <?php echo CHtml::textField('beginDate', $beginDate, array("id" => "beginDate")); ?> &nbsp;
    <?php
    $this->widget('application.extensions.calendar.SCalendar', array(
        'inputField' => 'beginDate',
        'ifFormat' => '%Y-%m-%d',
    ));
    ?>
    &nbsp;đến ngày&nbsp;
    <?php
    echo CHtml::textField('endDate', $endDate, array("id" => "endDate"));
    $this->widget('application.extensions.calendar.SCalendar', array(
        'inputField' => 'endDate',
        'ifFormat' => '%Y-%m-%d',
    ));
    echo '<span style="padding: 0px 10px">Từ khóa:</span>' . CHtml::textField('name');
    echo '&nbsp;&nbsp;&nbsp;' . CHtml::submitButton('Xem');
    ?>
</form>    
</p>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Tên Shop</td>
        <td width="200px">Shop uy tín</td>
        <td width="200px">Tình trạng</td>
        <td width="40px">Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'viewData' => array('listShopVip' => $listShopVip, 'endTimeShopVip' => $endTimeShopVip),
        'itemView' => '_shopview',
        'template' => "{items}\n",
    ));
    ?> 
</table>

<div style="width: 100%">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'ajaxUpdate' => FALSE,
        'itemView' => '_shopview',
        'template' => "{pager}",
    ));
    ?> 
</div>
<div>
    <a href="<?php echo Yii::app()->createUrl('administrator/shop') ?>"><input class="buttomAdd" value="Thêm Shop" type="button" name="Thêm Shop" /></a>
</div>
<script type="text/javascript">
    function setInfo(sid){
        $('#shopUytin_'+sid).load('<?php echo Yii::app()->createUrl('administrator/shopSetting'); ?>', {'sid':sid});
    }
</script>