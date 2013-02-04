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
$this->pageTitle = 'Quản lý hướng dẫn';
$form = $this->beginWidget('CActiveForm');
$this->breadcrumbs = array(
    'Quản trị thông báo' => array('administrator/notify'),
    'Quản trị quảng cáo' => array('administrator/banner'),
    'Quản trị hỗ trợ' => array('administrator/help'),
    'Tin đã xóa' => array('topic/manager'),
);
?>
<table width="100%">
    <tr>
        <td>
            <div class="form-popup" id="administratorForm">
                <h3><?php echo $this->pageTitle; ?></h3>
                <div class="items">
                    <?php echo $form->labelEx($model, 'title'); ?>
                    <?php echo $form->textField($model, 'title'); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
                <div class="items">
                    <?php echo $form->labelEx($model, 'content'); ?>
                    <?php echo $form->textArea($model, 'content', array('id' => 'area1', 'cols' => '86', 'rows' => '15')); ?>
                    <?php echo $form->error($model, 'content'); ?>
                </div>
                <div class="sumitButton">
                    <?php echo CHtml::submitButton('Cập nhật', array('onclick' => 'submitForm();')); ?>
                </div>
            </div>  
        </td>
        <td>
            <div style="width: 100%">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '_help',
                    'template' => "{items}\n",
                ));
                ?> 
            </div>

        </td>
    </tr>
</table>
<div style="width: 100%">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_help',
        'template' => "{pager}",
    ));
    ?> 
</div>
<?php $this->endWidget(); ?>