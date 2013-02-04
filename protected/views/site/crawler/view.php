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
$this->pageTitle = 'Danh sách trang crawler';
$this->breadcrumbs = array(
    'Quản trị viên' => array('administrator/view'),
    'Quản trị danh mục' => array('category/view'),
    'Quản trị tỉnh, thành phố' => array('site/localityView'),
    'Quản trị site' => array('site/crawlerSite'),
    'Quản trị từ khóa tìm kiếm' => array('seo/add'),
);
?>

<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('site/CrawlerNew'); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="table-content">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Tên trang</td> 
        <td>Thống kê link crawler</td> 
        <td width="120px">Sắp xếp</td>
        <td width="70px">Trạng thái</td>
        <td width="40px">Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'crawler/_view',
        'template' => "{items}",
        'emptyText' => '',
            )
    );
    ?>
</table>
<script type="text/javascript">
    function changerisHidden(obj){
        var $obj = $(obj);
        var $id = $obj.attr('rel');
        $.post("<?php echo Yii::app()->createUrl('site/updateIsHidden') ?>", {'id': $id}, function(rs){
            var fileName = 'display';
            if(rs==1) fileName = 'hindden';
            $('#Chienlv-'+$id).attr('src','<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/'+fileName+'.png');
        });
    }
    
    function updateOrder(cvalue, cid){
        $.post('<?php echo Yii::app()->createUrl('site/CrawlerChange'); ?>', {'cid':cid, 'cvalue':cvalue}, function(){
            window.location.reload();
        });
    }
    
    function removeSite(cid){
        var answer = confirm("Bạn có chắc chắn muốn xóa không?")
        if (answer){
            $.post('<?php echo Yii::app()->createUrl('site/CrawlerRemove'); ?>', {'cid': cid}, function(){
                window.location.reload();
            });
        }
    }
</script>