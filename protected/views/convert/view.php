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
);
$this->pageTitle = 'Chuyển dữ liệu';
$listParentCategory = ExtensionClass::getListCategory();
$listSite = ExtensionClass::dropdownlistsite();
$listLocality = ExtensionClass::getListLocality();
?>
<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => "{pager}",
    'ajaxUpdate' => false,
    'pager' => array(
        'header' => '',
    )
        )
);
?>
<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td colspan="4">Chuyên mục hiện tại</td>
        <td colspan="3">Chuyển tới chuyên mục</td>
        <td>Chức năng</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'template' => "{items}",
        'emptyText' => '',
        'viewData' => array(
            'listParentCategory' => $listParentCategory,
            'listSite' => $listSite,
            'listLocality' => $listLocality
        ),
            )
    );
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => "{pager}",
    'ajaxUpdate' => false,
    'pager' => array(
        'header' => '',
    )
        )
);
?>