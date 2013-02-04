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
);
$this->pageTitle = 'Quản trị site rao vặt';


$form = $this->beginWidget('CActiveForm');
?>
<style type="text/css">
    .wadm500 .items input[type="text"]{width: 500px; padding: 5px; display: block;}
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
            <?php echo $form->labelEx($model, 'url'); ?>
            <?php echo $form->textField($model, 'url'); ?>
            <?php echo $form->error($model, 'url'); ?>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'urlLogin'); ?>
            <?php echo $form->textField($model, 'urlLogin'); ?>
            <?php echo $form->error($model, 'urlLogin'); ?>
        </div>
        <div class="items">
            <?php echo $form->labelEx($model, 'type'); ?>
            <?php echo $form->dropDownList($model, 'type', array('1' => 'VBB', '2' => 'Khác')); ?>
        </div>

        <div class="sumitButton">
            <?php echo CHtml::submitButton('Cập nhật'); ?>
        </div>
    </div>
</div>    
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#PostSiteModel_name').keyup(function(){
            $('#PostSiteModel_url').val('http://'+this.value);
        });
    });
</script>
<table cellpadding="0" cellspacing="0" width="100%" class="table-content">
    <tr class="title-list">
        <td width="40px">STT</td>
        <td>Tên trang</td> 
        <td>Đường dẫn</td> 
        <td>Quản trị danh mục</td>
        <td>Quản trị người dùng</td>
        <td>Ngày tạo</td>
        <td width="80px">Chức năng</td>        
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_site',
        'template' => "{items}",
        'emptyText' => '',
            )
    );
    ?>
</table>