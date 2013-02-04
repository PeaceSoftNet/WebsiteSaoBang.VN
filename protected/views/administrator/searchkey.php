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
$this->pageTitle = 'Quản lý từ khóa chuyên mục ' . ExtensionClass::getCategoryNameById($categoryId) . '&nbsp;
    --- &nbsp;' . ExtensionClass::getCategoryNameById($childCatId);
$form = $this->beginWidget('CActiveForm');
?>
<div class="form-popup" id="administratorForm">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="items left" style="margin: 3px 15px;">
        <?php echo $form->labelEx($model, 'name', array('class' => 'left')); ?>&nbsp;&nbsp;&nbsp;
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="sumitButton left">
        <?php echo CHtml::submitButton('Cập nhật', array('style' => 'margin: -2px;')); ?>
    </div>
    <div style="clear: both; color: blue; padding: 10px;"><i>Bạn có thêm mới đồng thời nhiều từ khóa, mỗi từ cách nhau bởi dấu ;</i></div>
</div>    
<?php $this->endWidget(); ?>

<table cellpadding="0" cellspacing="0" class="table-content" width="100% ">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Từ khóa</td>
        <td width="40px">Xóa</td>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_searchkey',
        'template' => "{items}\n",
        'emptyText' => '',
        'viewData' => array(
            'categoryId' => $categoryId,
            'childCatId' => $childCatId,
        ),
    ));
    ?>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_searchkey',
    'template' => "{pager}",
));
?>