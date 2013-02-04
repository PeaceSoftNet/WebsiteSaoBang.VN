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
$this->pageTitle = 'Quản lý Shop';

$form = $this->beginWidget('CActiveForm');

$this->breadcrumbs = array(
    'Quản lý tag' => array('administrator/tag'),
    'Quản lý Shop' => array('administrator/shopview'),
    'Quản lý Shop uy tín' => array('administrator/shopvipview'),
    'Quản lý danh mục ngành hàng' => array('administrator/shopcategory'),
    'Email thông báo' => array('administrator/emailNotify'),
);
?>
<div class="form-popup" id="administratorForm">
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="items">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'logo'); ?>
        <?php echo $form->textField($model, 'logo', array('id' => 'fileImg', 'onclick' => 'openFileBrowser("fileImg")')); ?>
        <?php echo $form->error($model, 'logo'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'email'); ?>
        <p style="color: #666; font-size: 9px;">Bạn có sử dụng nhiều email đồng thời bằng cách nhau bởi dấu chấm phẩy (;)</p>
        <?php echo $form->textArea($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>        
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('id' => 'area1', 'cols' => '86', 'rows' => '15')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="items">
        <?php
        echo $form->labelEx($model, 'rank');
        $listRankArr = GlobalComponents::rankList();
        echo $form->dropDownList($model, 'rank', $listRankArr);
        ?>
    </div>
    <style type="text/css">
        .inline-box{display: block; height: 22px; line-height: 22px; float: left;}
        .inline-box label{float: left;}
        .inline-box input{float: left; margin: 5px 2px;}
        .submitButtonTag{width: 120px !important; height: 22px; line-height: 22px; border: 1px solid #666; background: #ccc; font-weight: 700; cursor: pointer;}
    </style>
    <div class="items" id="currentListTag">
        <?php
        $listTag = ExtensionSearch::getListTag();
        echo $form->checkBoxList($model, 'tag', $listTag, array('separator' => '', 'template' => '<div class="inline-box"> {input}&nbsp;{label} &nbsp;&nbsp;</div>'));
        ?>
    </div>
    <div style="clear: both !important;"><br /></div>   
    <div class="items">
        <?php echo $form->labelEx($modelTag, 'name'); ?>
        <p style="color: #666; font-style: italic; font-size: 9px;">Bạn có thể nhập nhiều từ cùng lúc cách nhau bởi dấu chấm phẩy (;). </p>
        <?php echo $form->textField($modelTag, 'name', array('id' => 'quickTag')); ?>
        <?php echo $form->error($modelTag, 'name'); ?>
        <?php echo CHtml::button('Thêm tag', array('onclick' => 'addTag();', 'class' => 'submitButtonTag')); ?>
    </div>

    <strong>Thông tin về Shop:</strong>
    <div class="items">
        <?php echo $form->labelEx($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'url'); ?>
        <?php echo $form->textField($model, 'url'); ?>
    </div>
    <div class="items">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textArea($model, 'address'); ?>
    </div>

    <div class="items">
        <?php
        echo $form->labelEx($model, 'zone');
        $listLocalArr = ExtensionClass::getListLocality();
        $listLocalArr[0] = 'Toàn quốc';
        echo $form->dropDownList($model, 'zone', $listLocalArr);
        ?>
    </div>

    <div class="items">
        <?php echo $form->labelEx($modelIdentify, 'content'); ?>
        <p style="color: #666; font-style: italic; font-size: 9px !important;">(Nhập các từ khóa bạn mong muốn để người dùng tìm thấy shop của bạn khi có nhu cầu đăng tin)</p>
        <?php echo $form->textArea($modelIdentify, 'content', array('id' => 'area2', 'cols' => '86', 'rows' => '15')); ?>
        <?php echo $form->error($modelIdentify, 'content'); ?>
    </div>

    <div class="sumitButton" style="margin: 5px 30px; font-weight: 700;">
        <?php echo CHtml::submitButton('Cập nhật', array('onclick' => 'submitForm();')); ?>
    </div>
    <div style="clear: both;"> </div>
</div>  

<?php $this->endWidget(); ?>

<script type="text/javascript">
    function openFileBrowser(id){
        fileBrowserlink = "<?php echo Yii::app()->request->baseUrl; ?>/fileBrowser/index.php?editor=standalone&returnID=" + id;
        window.open(fileBrowserlink,'pdwfilebrowser', 'width=1000,height=650,scrollbars=no,toolbar=no,location=no');
    }

    function addTag(){
        var tagName = $('#quickTag').val();
        $.post('<?php echo Yii::app()->createUrl('administrator/tag'); ?>', {'tagModel[name]': tagName}, function() {
            $('#currentListTag').load('<?php echo Yii::app()->createUrl('administrator/shop'); ?> #currentListTag');
        });
    }
</script>