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
    'Quản trị người dùng' => array('post/user'),
);
$this->pageTitle = 'Quản trị người dùng';


$form = $this->beginWidget('CActiveForm');
?>
<style type="text/css">
    .wadm500 .items input{width: 500px; padding: 5px; display: block;}
    .wadm500 .sumitButton input[type="submit"]{width: 90px; padding: 2px; display: block; margin: auto; margin: 10px 0px;}
</style>
<div>
    <h3><?php echo $this->pageTitle; ?></h3>
    <div class="wadm500">
        <div class="items">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password'); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
        <div class="sumitButton">
            <?php echo CHtml::submitButton('Cập nhật'); ?>
        </div>
    </div>
</div>    
<?php $this->endWidget(); ?>

<table cellpadding="0" cellspacing="0" width="100%" class="table-content">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Tên tài khoản</td> 
        <td>Lần đăng nhập cuối</td>
        <td width="80px">Chức năng</td>        
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_user',
        'template' => "{items}",
        'emptyText' => '',
            )
    );
    ?>
</table>