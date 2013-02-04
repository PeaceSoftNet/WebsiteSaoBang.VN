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
$totalLink = ExtensionClass::getTotalCrawlerLink();
$this->pageTitle = 'Rao vặt';
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="grid_9">
            <div class="block">
                <div class="bl-title"><h2>Hiện có <span class="org-clr"><?php echo GlobalComponents::numberFomat($totalLink); ?></span> tin rao vặt theo các lĩnh vực.</h2></div>
                <div class="block-content">
                    <?php $this->renderPartial('home/category', array('dataProvider' => $dataProvider)); ?>
                </div>
            </div>
            <div style="width: 700px; overflow: hidden;">
                <?php $this->googleAd(); ?>
            </div>            
        </div>
        <div class="grid_3">
            <?php $this->homeLocal(); ?>
            <?php $this->getTopAsk(); ?>
            <?php $this->homeNotify(); ?>            
            <?php $this->homeVip(); ?>
        </div>
    </div>
</div>