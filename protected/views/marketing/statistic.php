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
$this->pageTitle = 'Thống kê Email';
$this->breadcrumbs = array(
    'Chiến lược marketing' => array('marketing/demand'),
    'Thống kê Email' => array('marketing/statistic'),
);
echo 'Total: ' . GlobalComponents::numberFomat($dataProvider->totalItemCount);
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_statistic',
    'ajaxUpdate' => FALSE,
    'enablePagination' => true,
    'template' => "{pager}",
));
?>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td><a href="<?php echo Yii::app()->createUrl('marketing/statistic', array('sort' => 'email', 'type' => $type)); ?>">Email</a></td>
        <td><a href="<?php echo Yii::app()->createUrl('marketing/statistic', array('sort' => 'categoryId', 'type' => $type)); ?>">Danh muc</a></td>
        <td><a href="<?php echo Yii::app()->createUrl('marketing/statistic', array('sort' => 'childCatId', 'type' => $type)); ?>">Danh muc con</a></td>
        <td width="100px"><a href="<?php echo Yii::app()->createUrl('marketing/statistic', array('sort' => 'locality', 'type' => $type)); ?>">Tỉnh/Thành phố</a></td>
        <td width="40px"><a href="<?php echo Yii::app()->createUrl('marketing/statistic', array('sort' => 'mobileNumber', 'type' => $type)); ?>">Phone</a></td>
        <td width="40px"><a href="<?php echo Yii::app()->createUrl('marketing/statistic', array('sort' => 'domain', 'type' => $type)); ?>">Nguồn</a></td>
        <td width="40px"><a href="<?php echo Yii::app()->createUrl('marketing/statistic', array('sort' => 'createDate', 'type' => $type)); ?>">Hoạt động</a></td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_statistic',
        'template' => "{items}\n",
        'emptyText' => '',
        'viewData' => array(
        ),
    ));
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_statistic',
    'ajaxUpdate' => FALSE,
    'enablePagination' => true,
    'template' => "{pager}",
));
?>