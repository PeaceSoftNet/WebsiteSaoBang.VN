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
$this->pageTitle = 'Danh sách thuộc tính';
$this->breadcrumbs = array(
    'Quản lý chuyên mục' => array('category/view'),
    'Quản lý thuộc tính' => array('category/AttributesView'),
);
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('category/AttributesNew'); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td>STT</td>        
        <td>Tên thuộc tính</td>
        <td>Danh mục</td>
        <td>Sắp xếp</td>
        <td>Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'attributes/_view',
        'template' => "{items}\n{pager}",
        'emptyText' => '',
            )
    );
    ?>
</table>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('category/AttributesNew'); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<script type="text/javascript">
    function removeAttributes(aid, catId){
        var answer = confirm("Bạn có chắc chắn muốn xóa thuộc tính này không?")
        if (answer){
            window.location.href = '<?php echo Yii::app()->createUrl('category/AttributeDelete'); ?>?aid='+aid+'&catId='+catId;
        }
    }
    
    function removeChildAttr(aid){
        var answer = confirm("Bạn có chắc chắn muốn xóa thuộc tính này không?")
        if (answer){
            $.post('<?php echo Yii::app()->createUrl('category/ChildAttrDelete'); ?>', {'aid': aid}, function(){
                window.location.reload();
            });
        }
    }
    
    function changeAttributes(aval ,aid){
        $.post('<?php echo Yii::app()->createUrl('category/changeAttributes'); ?>', {'aid': aid, 'aval' : aval}, function(){
            window.location.reload();
        });
    }
</script>
