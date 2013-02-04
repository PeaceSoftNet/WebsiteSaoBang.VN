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
$this->pageTitle = 'Quản lý chủng loại, nhu cầu sản phẩm';

$this->breadcrumbs = array(
    'Quản trị sản phẩm' => array('articles/add'),
    'Chiến lược marketing' => array('marketing/demand'),
);

$form = $this->beginWidget('CActiveForm');
?>
<div class="form-popup" id="administratorForm">
    <h3><?php echo $this->pageTitle; ?></h3>
    <table width="100%">
        <tr>
            <td>
                <div class="items" style="margin: 3px 15px;">
                    <?php echo $form->labelEx($model, 'demandTypeA'); ?>
                    <?php echo $form->textArea($model, 'demandTypeA', array('rows' => '5')); ?>
                    <i><?php echo $form->error($model, 'demandTypeA'); ?></i>
                </div>                
            </td>
            <td>
                <div class="items" style="margin: 3px 15px;">
                    <?php echo $form->labelEx($model, 'demandTypeB'); ?>
                    <?php echo $form->textArea($model, 'demandTypeB', array('rows' => '5')); ?>
                    <i><?php echo $form->error($model, 'demandTypeB'); ?></i>
                </div>                
            </td>
        </tr>
        <tr>
            <td>
                <div class="sumitButton">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::submitButton('Cập nhật', array('style' => 'margin: 0;')); ?>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
    <br /><br /><br />
</div>    
<?php $this->endWidget(); ?>

<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Bên A</td>
        <td>Bên B</td>
        <td width="100px">Gửi email</td>
        <td width="100px">Xử lý</td>
        <td width="100px">Quét lần cuối</td>
        <td width="40px">Sửa</td>
        <td width="40px">Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_demand',
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
    'itemView' => '_demand',
    'template' => "{pager}",
    'ajaxUpdate' => FALSE,
    'enablePagination' => true,
));
?>

<script type="text/javascript">
    function searchByKey(did){
        $('#run'+did).html('<img src="/data/loading.gif" />');
        $('#run'+did).load('<?php echo Yii::app()->createUrl('marketing/searchTopic'); ?>', {'did':did}, function(){
            $('#run'+did).html('Success');
        });
    }
</script>