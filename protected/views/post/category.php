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
    'Quản trị site rao vặt' => array('post/site'),
    'Quản trị danh mục rao vặt' => array('post/category'),
);
$this->pageTitle = 'Quản trị danh mục rao vặt';

$listCat = ExtensionClass::getListCategory();
$listCat[0] = 'Tất cả danh mục';

$form = $this->beginWidget('CActiveForm');
?>
<style type="text/css">
    .wadm500 .items input[type="text"]{width: 500px; padding: 5px; display: block;}
    .wadm500 .items select{width: 510px; display: block;}
    .wadm500 .items option{padding: 5px;}
    .wadm500 .sumitButton input[type="submit"]{width: 90px; padding: 2px; display: block; margin: auto; margin: 10px 0px;}
</style>
<div>
    <h3><?php echo $this->pageTitle; ?></h3>
    <table  cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="50%">
                <div class="wadm500">
                    <div class="items">
                        <?php echo $form->labelEx($model, 'name'); ?>
                        <?php echo $form->textField($model, 'name'); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </div>
                    <div class="items">
                        <?php echo $form->labelEx($model, 'categoryId'); ?>
                        <?php echo $form->dropDownList($model, 'categoryId', $listCat, array('size' => 15)); ?>
                    </div>
                    <div class="items">
                        <?php echo $form->labelEx($model, 'url'); ?>
                        <?php echo $form->textField($model, 'url'); ?>
                        <?php echo $form->error($model, 'url'); ?>
                    </div>
                    <div class="sumitButton">
                        <?php echo CHtml::submitButton('Cập nhật'); ?>
                    </div>
                </div>
            </td>
            <td width="50%">
                <table cellpadding="0" cellspacing="0" width="100%" class="table-content">
                    <tr class="title-list">
                        <td width="40px">STT</td>
                        <td>Tên danh mục</td> 
                        <td width="80px">Chức năng</td>        
                    </tr>
                    <?php
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $dataProvider,
                        'itemView' => '_category',
                        'template' => "{items}",
                        'emptyText' => '',
                            )
                    );
                    ?>
                </table>
            </td>
        </tr>

    </table>
</div>    
<?php $this->endWidget(); ?>