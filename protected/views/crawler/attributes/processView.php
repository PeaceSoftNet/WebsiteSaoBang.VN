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

if ($dataProvider->totalItemCount > 10) {
    ?>
    <div style="float: right; text-align: right;">    
        <i>Chương trình đang trong quá trình thực hiện, <span style="color: red;">vui lòng chờ</span>...</i>  
        <p><img src="/data/loading.gif" /></p>
        <i>Còn lại <b><?php echo $dataProvider->totalItemCount; ?></b></i>
        <p>Danh mục: <strong><?php echo ExtensionClass::getCategoryNameById($catId); ?></strong> *** Thuộc tính tìm và xử lý: <?php echo isset($_GET['title']) ? $_GET['title'] : 'none'; ?></p>
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
        switch ($num) {
            case 1:
                $current = $extension1;
                break;
            case 2:
                $current = $extension2;
                break;
            case 3:
                $current = $extension3;
                break;
            case 4:
                $current = $extension4;
                break;
            case 5:
                $current = $extension5;
                break;
        }
        if ($num <= 5) {

            $extension = 'extension' . $num;
            echo '<div class="sltboxnone" style="margin: 10px;"><strong>' . $value['name'] . '</strong><br />';
            echo CHtml::radioButtonList($extension, $current, $value['attr'], array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;'));
            echo '</div>';
        }
    }
}

echo CHtml::submitButton('Cập nhật');
$this->endWidget();
$list = '';
foreach ($dataProvider->getData() as $key => $value) {
    $list .= ', ' . $value->id;
}

$condition = '';
$extension1 = isset($_GET['extension1']) ? $_GET['extension1'] : '';
if ($extension1)
    $condition = ', `extension1` = ' . $extension1;
$extension2 = isset($_GET['extension2']) ? $_GET['extension2'] : '';
if ($extension2)
    $condition = ', `extension2` = ' . $extension2;
$extension3 = isset($_GET['extension3']) ? $_GET['extension3'] : '';
if ($extension3)
    $condition = ', `extension3` = ' . $extension3;
$extension4 = isset($_GET['extension4']) ? $_GET['extension4'] : '';
if ($extension4)
    $condition = ', `extension4` = ' . $extension4;
$extension5 = isset($_GET['extension5']) ? $_GET['extension5'] : '';
if ($extension5)
    $condition = ', `extension5` = ' . $extension5;

$list = substr($list, 1);
$condition = substr($condition, 1);
if ($list) {
    $sql = 'UPDATE `tbl_topic` SET ' . $condition . ' WHERE `id` IN (' . $list . ');';
    $command = Yii::app()->db->createCommand($sql);
    $command->execute();
}
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
        'itemView' => 'attributes/_viewProcess',
        'template' => "{items}",
        'emptyText' => '',
        'viewData' => array(
            'extension1' => $extension1,
            'extension2' => $extension2,
            'extension3' => $extension3,
            'extension4' => $extension4,
            'extension5' => $extension5,
        ),
            )
    );
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => 'attributes/_viewProcess',
    'template' => "\n{pager}",
    'emptyText' => '',
        )
);
?>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('crawler/searchAttributes'); ?>"  class="addNew"><span>Tìm kiếm nhu cầu</span></a>
</div>
<?php
header("refresh:10;");
?>       
<script type="text/javascript">
    function saveLink(){
        $.post('<?php echo Yii::app()->createUrl('Crawler/SaveToCron'); ?>', {'url':'<?php echo $_SERVER['REQUEST_URI']; ?>'}, function(){
            alert('Save success');
        });
    }
</script>