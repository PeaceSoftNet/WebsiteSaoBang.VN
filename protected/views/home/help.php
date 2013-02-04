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
Yii::app()->clientScript->registerMetaTag('Hướng dẫn đăng tin rao vặt, ' . $model->title . ', saobang.vn một trong những website đăng tin rao vặt uy tín lớn nhất Việt Nam', 'description');
?>
<div class="grid_3">
    <div class="Mysb-Categ">
        <h4>Hướng dẫn</h4>
        <?php $this->widget('zii.widgets.CMenu', ExtensionClass::getListHelp()); ?>
    </div>
</div>
<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a class="active" href="<?php echo Yii::app()->createUrl('home/help', array('id' => $model->id, 'title' => ExtensionClass::utf8_to_ascii($model->title))); ?>"><?php echo $model->title; ?></a></li>
        </ul>
    </div>
    <div class="ntc-title clearfix">
        <h4><?php echo $model->title; ?></h4>
    </div>
    <div class="br-noticebox">
        <?php echo $model->content; ?>

    </div>
</div>