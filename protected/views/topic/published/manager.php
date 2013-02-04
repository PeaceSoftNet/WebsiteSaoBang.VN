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
$this->pageTitle = 'Quản lý tin rao vặt';
$this->breadcrumbs = array(
    'Quản lý tin rao vặt' => array('topic/manager'),
    'Tin rao vặt đã duyệt' => array('topic/PublishedTopic'),
);
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter">
    <div style="margin:10px 0">
        <a href="javascript:void(0);" onclick="history.go(0);" class="addNew"><span>refresh</span></a>
        <a href="<?php echo Yii::app()->createUrl('topic/manager'); ?>" class="addNew"><span>Tin rao vặt chưa duyệt</span></a>
        <a href="<?php echo Yii::app()->createUrl('site/CrawlerSite'); ?>" class="addNew"><span>Danh sách crawler site</span></a>
    </div>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'published/_manager',
        'template' => "{pager}",
        'ajaxUpdate' => false,
        'pager' => array(
            'header' => '',
        ),
        'viewData' => array(
            'listParentCategory' => ExtensionClass::getListParentCategory(),
        )
            )
    );
    ?>
</div>

<table cellpadding="0" cellspacing="0" width="100%" class="table-content no-border">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Nội dung</td>
        <td>Chuyển chuyên mục</td>
        <td>Hình ảnh</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'published/_manager',
        'template' => "{items}",
        'emptyText' => '',
            )
    );
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => 'published/_manager',
    'template' => "{pager}",
    'ajaxUpdate' => false,
    'pager' => array(
        'header' => '',
    ),
        )
);
?>
<script type="text/javascript">
    function updateTopic(content, filter, tid){
        $.post('<?php echo Yii::app()->createUrl('topic/update'); ?>', {'content':content, 'filter':filter, 'tid':tid});
    }
    
    function deleteTopic(tid){
        $.post('<?php echo Yii::app()->createUrl('topic/Delete'); ?>', {'tid':tid}, function(){
            $('#topic-buttom-'+tid).fadeOut('slow');
            $('#topic-edit-'+tid).fadeOut('slow');
        });
    }
    
    function complateTopic(tid){
        $.post('<?php echo Yii::app()->createUrl('topic/Complate'); ?>', {'tid':tid}, function(){
            $('#topic-buttom-'+tid).fadeOut('slow');
            $('#topic-edit-'+tid).fadeOut('slow');
        });
    }
    
    function getParentCategory(categoryId, catNameId){
        $('#'+catNameId).load('<?php echo Yii::app()->createUrl('topic/manager'); ?> #'+catNameId, {'parentCatId' : categoryId});
    }
    
    function changeCategory(parentId, childId, topicId){
        $.post('<?php echo Yii::app()->createUrl('topic/changeCategory'); ?>', {'catParentId': parentId, 'catChildId': childId, 'topicId':topicId});
    }
</script>