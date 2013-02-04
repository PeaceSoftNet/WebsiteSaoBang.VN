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
$this->pageTitle = 'Quản lý thuộc tính';
$this->breadcrumbs = array(
    'Quản lý thuộc tính' => array('crawler/attributes'),
);
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('crawler/searchAttributes'); ?>" class="addNew"><span>Tìm kiếm thuộc tính</span></a>
</div>

<?php
$form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl('crawler/attributes'), 'method' => 'get'));

echo CHtml::hiddenField('categoryId', $catId);
echo CHtml::hiddenField('ext', $ext);
echo CHtml::hiddenField('title', $keyword);
$attrArr = ExtensionClass::getListAttributesAjax($catId);
/**
 * list extension by category parent
 */
$num = 0;
if ($attrArr) {
    foreach ($attrArr as $key => $value) {
        $num++;
        if ($num <= 5) {
            $extension = 'extension' . $num;
            echo '<div class="sltboxnone" style="margin: 10px;"><strong>' . $value['name'] . '</strong><br />';
            echo CHtml::radioButtonList($extension, 0, $value['attr'], array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;'));
            echo '</div>';
        }
    }
}

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
        'itemView' => 'attributes/_view',
        'template' => "{items}",
        'emptyText' => '',
            )
    );
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => 'attributes/_view',
    'template' => "\n{pager}",
    'emptyText' => '',
        )
);
?>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('crawler/searchAttributes'); ?>"  class="addNew"><span>Tìm kiếm nhu cầu</span></a>
</div>