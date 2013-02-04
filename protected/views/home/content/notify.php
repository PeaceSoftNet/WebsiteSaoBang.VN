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
$this->pageTitle = $model->title;
$description = 'Thông báo từ saobang.vn | Saobang.vn là website tổng hợp rao vặt lớn nhất Việt Nam, thông tin về đầy đầy đủ các ngành hàng và lĩnh vực, dữ liệu được trường hóa chi tiết.';
Yii::app()->clientScript->registerMetaTag($description, 'description');
?>
<div class="grid_3">
    <div class="Mysb-Categ">
        <h4>Các thông báo khác</h4>
        <?php $this->widget('zii.widgets.CMenu', ExtensionClass::listnotify()); ?>
    </div>
</div>
<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a class="active" style="overflow: hidden;" href="javascript:void(0);">Thông báo</a></li>
        </ul>
    </div>
    <div class="br-noticebox">
        <div class="ntc-title clearfix">
            <h4><?php echo $model->title; ?></h4>
        </div>
        <div class="html-content">      
            <?php echo $model->content; ?>
        </div>
    </div>
</div>