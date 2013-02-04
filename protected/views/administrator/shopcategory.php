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
$this->pageTitle = 'Quản lý danh mục ngành hàng';

$form = $this->beginWidget('CActiveForm');

$this->breadcrumbs = array(
    'Quản lý tag' => array('administrator/tag'),
    'Quản lý Shop' => array('administrator/shopview'),
    'Quản lý Shop uy tín' => array('administrator/shopvipview'),
    'Quản lý danh mục ngành hàng' => array('administrator/shopcategory'),
    'Email thông báo' => array('administrator/emailNotify'),
);
?>
<table width="100%">
    <tr>
        <td>
            <div class="form-popup" id="administratorForm">
                <h3><?php echo $this->pageTitle; ?></h3>
                <div class="items">
                    <?php echo $form->labelEx($model, 'name'); ?>
                    <?php echo $form->textField($model, 'name'); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </div>
                <div class="sumitButton" style="float: right; margin: 5px 30px;">
                    <?php echo CHtml::submitButton('Cập nhật'); ?>
                </div>

            </div>  
        </td>
        <td>
            <div style="width: 500px; display: block;">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '_shopcategory',
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
        'ajaxUpdate' => FALSE,
        'itemView' => '_shopcategory',
        'template' => "{pager}",
    ));
    ?> 
</div>
<?php $this->endWidget(); ?>