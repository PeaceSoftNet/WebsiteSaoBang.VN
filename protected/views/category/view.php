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
$this->pageTitle = 'Quản lý chuyên mục';
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
    <a href="<?php echo Yii::app()->createUrl('category/new'); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="table-content">
    <tr class="title-list">
        <td>STT</td>
        <td colspan="2">Tên danh mục</td>        
        <td>Quản lý tìm kiếm</td>
        <td>Quản lý bộ lọc</td>
        <td>Quản lý nhu cầu</td>
        <td>Quản lý thuộc tính</td>
        <td>Sắp xếp</td>
        <td>Trạng thái</td>
        <td>Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'template' => "{items}",
        'emptyText' => '',
            )
    );
    ?>
</table>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('category/new'); ?>"  rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<script type="text/javascript">
    function changerisHidden(obj){
        var $obj = $(obj);
        var $id = $obj.attr('rel');
        $.post("<?php echo Yii::app()->createUrl('category/updateIsHidden') ?>", {'id': $id}, function(rs){
            var fileName = 'display';
            if(rs==1) fileName = 'hindden';
            $('#Chienlv-'+$id).attr('src','/themes/backend/images/'+fileName+'.png');
        });
    }
    function updateOrder(orderValue, categoryId){
        $.post("<?php echo Yii::app()->createUrl('category/updateOrder') ?>", {'orderVal': orderValue, 'categoryId': categoryId}, function(){
            window.location.href = '<?php echo Yii::app()->createUrl('category/view'); ?>#cat'+categoryId;
        }); 
    }
    function removeCategory(categoryId){
        var answer = confirm("Bạn có chắc chắn muốn xóa danh mục này không?")
        if (answer){
            window.location.href = '<?php echo Yii::app()->createUrl('category/Delete'); ?>?id='+categoryId;
        }
    }
    function updateDs(idcat){
        $('#categoryUpdate'+idcat).load('<?php echo Yii::app()->createUrl('category/updateDescription'); ?>?id='+idcat);
    }
</script>
