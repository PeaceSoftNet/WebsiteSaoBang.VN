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
$this->breadcrumbs = array(
    'Quản trị viên' => array('administrator/view'),
    'Quản trị danh mục' => array('category/view'),
    'Quản trị tỉnh, thành phố' => array('site/localityView'),
    'Quản trị site' => array('site/crawlerSite'),
    'Quản trị từ khóa tìm kiếm' => array('seo/add'),
);
$this->pageTitle = 'Thêm từ khóa';
$form = $this->beginWidget('CActiveForm');
?>
<div class="block">
    <style type="text/css">
        .formKey input{width: 800px; padding: 3px;}
        .formSubmit input{border: 1px solid #ccc; padding: 3px 10px; margin: 10px 40px;}
        .viewItem{margin: 2px 8px;}
        .listKey{display: block;}
    </style>
    <div class="formKey">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>&nbsp;&nbsp;&nbsp;
        <i style="color: blue;">(Nhập nhiều từ khóa cùng lúc cách nhau bởi dấu ;)</i>
    </div>
    <div class="formSubmit">
        <?php echo CHtml::submitButton('Cập nhật'); ?>
    </div>

    <div class="clear"></div>
    <div class="listKey">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_add',
            'template' => "{items}",
            'emptyText' => '',
                )
        );
        ?>
    </div>
    <div class="clear"></div>
</div>
<?php $this->endWidget(); ?>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_add',
    'template' => "{pager}",
    'emptyText' => '',
        )
);
?>