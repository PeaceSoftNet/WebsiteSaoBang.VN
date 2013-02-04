<?php
/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$this->breadcrumbs = array(
    'Chuyển dữ liệu' => array('convert/view'),
    'Quá trình xử lý' => array('convert/Processing'),
);
$this->pageTitle = 'Quá trình xử lý';
$listParentCategory = ExtensionClass::getListFilterCategory();
$limit = isset($_GET['limit']) ? $_GET['limit'] : 1;
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<a class="addNew" onclick="history.go(0);" href="javascript:void(0);"><span>refresh</span></a>
<a class="addNew" href="<?php echo $_SERVER['REQUEST_URI'] . '&limit=' . ($limit + 1); ?>"><span>Tiếp tục tìm và chuyển</span></a>
<a class="addNew" href="<?php echo $_SERVER['REQUEST_URI'] . '&limit=' . ($limit + 1000); ?>"><span>Tìm và chuyển không giới hạn</span></a>
<div class="fillter"></div>
<div id="contentRefresh">
    <center><img height="100px" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/loading.gif" /></center>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_processing',
        'template' => "{pager}",
        'ajaxUpdate' => false,
        'pager' => array(
            'header' => '',
        ),
            )
    );
    ?>
    <table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
        <tr class="title-list">
            <td width="40px">STT</td>
            <td>Tiêu đề</td>
            <td>Danh mục</td>
            <td>Danh mục con</td>
            <td>Quá trình</td>
        </tr>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_processing',
            'template' => "{items}",
            'emptyText' => '',
            'viewData' => array(
                'endCat' => $endCat,
                'siteId' => $siteId,
                'locality' => $locality
            ),
                )
        );
        ?>
    </table>
    <div class="fillter"></div>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_processing',
        'template' => "{pager}",
        'ajaxUpdate' => false,
        'pager' => array(
            'header' => '',
        ),
            )
    );
    ?>
</div>
<script type="text/javascript">
    autoload();
    function autoload(){ 
        var t = setTimeout("autoload()", 3000); 
        //$('#convertForm').submit();
        $('#contentRefresh').load('<?php echo $_SERVER['REQUEST_URI']; ?> #contentRefresh');
    }
</script>