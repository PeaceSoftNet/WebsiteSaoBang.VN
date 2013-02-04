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
?>
<div class="main clearfix">
    <div class="fl"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">SaoBăng.vn</a></div>
    <?php $this->widget('zii.widgets.CMenu', GlobalComponents::homepageMenu()); ?>
    <?php echo Yii::app()->params['contact']; ?>
</div>