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
$this->pageTitle = 'Danh sách nhu cầu';
$this->breadcrumbs = array(
    'Quản lý chuyên mục' => array('category/view'),
    'Quản lý nhu cầu' => array('category/DemandView'),
);
if ($catId) {
    $catName = ExtensionClass::getCategoryNameById($catId);
    $this->pageTitle = 'Nhu cầu danh mục ' . $catName;
}
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('category/DemandNew', array('catId' => $catId)); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td>STT</td>
        <td>Tên nhu cầu</td>
        <td>Danh mục</td>
        <td width="120px">Sắp xếp</td>
        <td width="40px">Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'demand/_view',
        'template' => "{items}\n{pager}",
        'emptyText' => '',
            )
    );
    ?>
</table>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('category/DemandNew', array('catId' => $catId)); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<script type="text/javascript">
    function removeDemand(dId){
        var answer = confirm("Bạn có chắc chắn muốn xóa nhu cầu này không?")
        if (answer){
            $.post('<?php echo Yii::app()->createUrl('category/DemandDelete'); ?>', {'did' : dId}, function (){
                window.location.reload();
            });            
        }
    }
    function changeDemand(dval, dId){
        $.post('<?php echo Yii::app()->createUrl('category/changeDemand'); ?>', {'did' : dId, 'dval':dval}, function (){
            window.location.reload();
        });    
    }
</script>