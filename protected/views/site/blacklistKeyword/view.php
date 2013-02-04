<?php
/* * 
 * @author Chienlv
 */
$this->pageTitle = 'Danh sách từ khóa cảnh báo';
$this->breadcrumbs = array();
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('site/BlacklistKeywordNew'); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<!--<table cellpadding="0" cellspacing="0" width="100%" class="table-content">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Từ khóa</td>
        <td>Xóa</td>
    </tr>
<?php
//$this->widget('zii.widgets.CListView', array(
//    'dataProvider'=>$dataProvider,
//    'itemView'=>'blacklistKeyword/_view',
//    'template'=>"{items}",
//    'emptyText'=>'',
//    )
//);
?>
</table>-->
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => 'blacklistKeyword/_view',
    'template' => "<tr><td colspan='4' class='childLocalityItems'>{items}</td></tr>",
    'emptyText' => '',
        )
);
?>
<script type="text/javascript">
    function updateOrder(cvalue, cid){
        $.post('<?php echo Yii::app()->createUrl('site/BlacklistKeywordNew'); ?>', {'cid':cid, 'cvalue':cvalue}, function(){
            window.location.reload();
        });
    }
    function removeSite(id){
        var answer = confirm("Bạn có chắc chắn muốn xóa không?")
        if (answer){
            $.post('<?php echo Yii::app()->createUrl('site/blacklistKeywordRemove'); ?>', {'id': id}, function(){
                window.location.reload();
            });
        }
    }
</script>