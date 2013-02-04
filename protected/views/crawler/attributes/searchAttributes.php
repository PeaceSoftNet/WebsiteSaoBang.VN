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
    'Tìm kiếm thuộc tính' => array('crawler/searchAttributes'),
);
$form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl('crawler/attributes'), 'method' => 'get'));
$listCategory = ExtensionClass::getListParentCategory();
?>
<style type="text/css">
    #ext label,#ext input {display: inline; float: left; padding: 0px; margin: 0px;}
    #ext label{width: 130px;}
    #ext input{width: 30px;}
    .listOptionView{margin: 10px;}
</style>
<div class="form-popup">
    <h3><?php echo $this->pageTitle; ?></h3>
    <table>
        <tr>
            <td>
                <div class="left-popup w300">
                    <div class="items">
                        <?php echo $form->labelEx($model, 'categoryId'); ?>
                        <?php echo CHtml::dropDownList('categoryId', 0, $listCategory, array('size' => 15)); ?> 
                    </div>
                </div>
            </td>
            <td>
                <div class="left-popup w300">
                    <div>
                        <?php echo $form->labelEx($model, 'ext'); ?>
                        <?php echo CHtml::radioButtonList('ext', 0, array('1' => 'Extension1', '2' => 'Extension2', '3' => 'Extension3', '4' => 'Extension4', '5' => 'Extension5'), array('separator' => '', 'template' => '<div class="listOptionView">{input}&nbsp;{label} &nbsp;&nbsp;</div>')); ?> 
                    </div>
                </div>
            </td>
            <td>
                <div class="right-popup w500">        
                    <div class="items">
                        <p>Nhập từ khóa liên quan</p>
                        <?php echo $form->labelEx($model, 'title'); ?>
                        <?php echo CHtml::textField('title'); ?> 
                    </div>
                    <div class="sumitButton">
                        <?php echo CHtml::submitButton('Cập nhật'); ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="clear"></div>
</div>    
<?php $this->endWidget(); ?>