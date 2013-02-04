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
$this->pageTitle = 'Thống kê thành viên đăng ký';
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div style="margin:10px 0">
    <a href="javascript:void(0);" onclick="history.go(0);" class="addNew"><span>refresh</span></a>
    <a href="<?php echo Yii::app()->createUrl('Administrator/userAction') ?>" class="addNew"><span>Lịch sử người dùng</span></a>
</div
<p>
<form id="yw0" action="/Administrator/UserView" method="GET">
    Thống kê từ ngày
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
    echo '<span style="padding: 0px 10px">Từ khóa:</span>' . CHtml::textField('title');
    echo '&nbsp;&nbsp;&nbsp;' . CHtml::submitButton('Xem');
    ?>
</form>    
</p>

<strong style="float: left; margin: 10px;">Tổng số: <?php echo $dataProvider->totalItemCount; ?></strong>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_userView',
    'ajaxUpdate' => FALSE,
    'enablePagination' => true,
    'template' => "{pager}",
));
?>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Email / thông tin</td>
        <td>Log người dùng</td>
        <td>Kích hoạt tài khoản VIP</td>
        <td>Ngày tạo</td>
        <td width="80px">Kích hoạt</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_userView',
        'template' => "{items}",
    ));
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_userView',
    'ajaxUpdate' => FALSE,
    'enablePagination' => true,
    'template' => "{pager}",
));
?>
<div style="margin:10px 0">
    <a href="javascript:void(0);" onclick="history.go(0);" class="addNew"><span>refresh</span></a>
</div>
<script type="text/javascript">
    function changeStatic(uId){
        $.post('<?php echo Yii::app()->createUrl('administrator/changeStatic'); ?>', {'uId' : uId});
    }
    function activeVIPuser(userId){
        $.post('<?php echo Yii::app()->createUrl('administrator/activeVipUser') ?>', {'userId':userId}, function(){
            $('#user'+userId).html('Success');            
        });
    }
</script>