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
$this->pageTitle = 'Quản lý nhu cầu';
$this->breadcrumbs = array(
    'Quản lý nhu cầu' => array('crawler/demand'),
);

if ($dataProvider->totalItemCount > 10) {
    ?>
    <div style="float: right; text-align: right;">    
        <i>Chương trình đang trong quá trình thực hiện, <span style="color: red;">vui lòng chờ</span>...</i>  
        <p><img src="/data/loading.gif" /></p>
        <p><i>Còn lại <b><?php echo $dataProvider->totalItemCount; ?></b></i></p>
        <p>Danh mục: <strong><?php echo ExtensionClass::getCategoryNameById($catId); ?></strong> *** Nhu cầu: <?php echo isset($_GET['title']) ? $_GET['title'] : 'none'; ?></p>
        <div>
            <a onclick="saveLink();" href="javascript:void(0);"><span style="background: #CCC; padding: 5px 10px;">Lưu lại tiến trình</span></a>
        </div>
    </div>

    <?php
}
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('crawler/processDemand'); ?>" class="addNew"><span>Tìm kiếm nhu cầu</span></a>
</div>
<div style="clear: both"></div>
<?php
$form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl('crawler/demand'), 'method' => 'get'));
echo CHtml::hiddenField('categoryId', $catId);

echo CHtml::hiddenField('title', $keyword);

echo CHtml::radioButtonList('demand', $demand, $listDemand, array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;'));
echo CHtml::submitButton('Cập nhật');
$this->endWidget();
?>
<table cellpadding="0" cellspacing="0" width="100%" class="table-content">
    <tr class="title-list">
        <td width="35px">STT</td>
        <td width="150px">ID</td>        
        <td>Tiêu đề</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'demand/_processView',
        'template' => "{items}",
        'emptyText' => '',
        'viewData' => array(
            'demand' => $demand,
        ),
            )
    );
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => 'demand/_processView',
    'template' => "{pager}",
    'emptyText' => '',
        )
);
?>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('crawler/processDemand'); ?>"  class="addNew"><span>Tìm kiếm nhu cầu</span></a>
</div>
<?php if ($dataProvider->totalItemCount > 0) header("refresh:10;"); ?>    
<script type="text/javascript">
    function saveLink(){
        $.post('<?php echo Yii::app()->createUrl('Crawler/SaveToCron'); ?>', {'url':'<?php echo $_SERVER['REQUEST_URI']; ?>'}, function(){
            alert('Save success');
        });
    }
</script>
