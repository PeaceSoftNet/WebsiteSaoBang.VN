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
<div id="footer">
    <div class="main clearfix">
        <div class="fl"><span class="regis-TMDT"></span></div>
        <div class="fr">
            <h4><?php echo Yii::app()->params['copyright']; ?></h4>
            <?php $this->widget('zii.widgets.CMenu', GlobalComponents::homepageFooter()); ?>
            <div class="clearfix">
                <div class="ft-col">
                    <p>
                        <?php echo Yii::app()->params['hanoiaddress']; ?>
                    </p>
                    <?php echo GlobalComponents::footerLinkLeft(); ?>
                </div>
                <div class="ft-col">
                    <p>
                        <?php echo Yii::app()->params['saigonaddress']; ?>
                    </p>
                    <?php echo GlobalComponents::footerLinkRight(); ?>
                </div>
            </div>
        </div>
        <?php echo Yii::app()->params['chat']; ?>
        <?php echo Yii::app()->params['popnet']; ?>                 
    </div>
</div>           
<?php echo Yii::app()->params['googleAnalytics']; ?>
<a class="to-top" onclick="gotoTop()" href="javascript:void(0)"></a>

