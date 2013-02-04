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
?>

<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Bên A</td>
        <td>Sản phẩm</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProviderA,
        'itemView' => '_product',
        'template' => "{items}\n",
        'emptyText' => '',
        'viewData' => array(
            'dataProviderB' => $dataProviderB,
            'mailTitle' => $mailTitle,
        ),
    ));
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProviderA,
    'itemView' => '_product',
    'ajaxUpdate' => FALSE,
    'enablePagination' => true,
    'template' => "{pager}",
));
?>