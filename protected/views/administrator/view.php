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
    'Quản trị viên' => array('administrator/view'),
    'Quản trị danh mục' => array('category/view'),
    'Quản trị tỉnh, thành phố' => array('site/localityView'),
    'Quản trị site' => array('site/crawlerSite'),
    'Quản trị từ khóa tìm kiếm' => array('seo/add'),
);
$this->pageTitle = 'Quản trị viên';
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('Administrator/New'); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Tên quản trị viên</td>
        <td width="200px">Email</td>
        <td width="40px">Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'template' => "{items}",
    ));
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => "{pager}",
));
?>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('Administrator/New'); ?>" rel="facebox" class="addNew"><span>Thêm mới</span></a>
</div>
<script type="text/javascript">
    function removeUser(userId){
        var answer = confirm("Bạn có chắc chắn muốn xóa không?")
        if (answer){
            $.post('<?php echo Yii::app()->createUrl('Administrator/Remove'); ?>', {'userId': userId}, function(){
                window.location.reload();
            });
        }    
        return false;         
    }
</script>