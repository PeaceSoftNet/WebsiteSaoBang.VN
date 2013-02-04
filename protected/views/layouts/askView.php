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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo SERVER_DATA; ?>/themes/homepage/style/reset.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo SERVER_DATA; ?>/themes/homepage/style/grid_12.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo SERVER_DATA; ?>/themes/homepage/style/style.css?v=111" media="all" />
        <script type="text/javascript" src="<?php echo SERVER_DATA; ?>/themes/homepage/scripts/jquery.min.js?v=29"></script>
        <script type="text/javascript" src="<?php echo SERVER_DATA; ?>/themes/homepage/scripts/saobang.js?v=02"></script>
        <script type="text/javascript" src="<?php echo SERVER_DATA; ?>/themes/homepage/scripts/keypress.js?v=02"></script>
        <?php echo Yii::app()->params['googleAnalytics']; ?>
    </head>
    <body>  
        <div class="topbar" style="display: none;">
            <?php $this->topBar(); ?>
        </div>
        <div id="header">
            <div class="tophead">
                <div class="main newyear-event clearfix">
                    <a class="logoRv beta" href="<?php echo Yii::app()->createUrl('ad/index'); ?>"></a>
                    <div class="Navi-tophead">
                        <ul class="clearfix">
                            <li <?php if (Yii::app()->controller->id == 'home' && Yii::app()->controller->action->id != 'published') echo 'class="active"'; ?>>
                                <a href="<?php echo Yii::app()->createUrl('home/search'); ?>"><span><b>Tìm kiếm</b></span></a>
                            </li>
                            <li <?php if (Yii::app()->controller->action->id == 'published') echo 'class="active"'; ?>>
                                <a href="<?php echo Yii::app()->createUrl('home/published'); ?>"><span><b>Tin đã đăng</b></span></a>
                            </li>
                            <li <?php if (Yii::app()->controller->id == 'ask') echo 'class="active"'; ?>>
                                <a href="<?php echo Yii::app()->createUrl('ask/view'); ?>"><span><b>Hỏi mua<i class="icon-new"></i></b></span></a>
                            </li>
                        </ul>
                    </div>
                    <?php echo Yii::app()->params['contact']; ?>
                    <?php $this->widget('zii.widgets.CMenu', GlobalComponents::homepageMenu()); ?>	
                    <div class="postNews-Rv"><a href="<?php echo Yii::app()->createUrl('topic/step1'); ?>">Đăng rao vặt</a></div>
                    <div class="Asktobuy-btn"><a href="<?php echo Yii::app()->createUrl('ask/new'); ?>">Đăng hỏi mua</a></div>
                </div>
            </div>
            <div class="browse-head">
                <div class="main clearfix">
                    <div class="locationRv" id="dropLocal">
                        <a class="slted" href="javascript:void(0);">
                            <?php
                            echo ExtensionClass::getCurrentLocality();
                            ?>
                        </a>
                        <div id="_dropLocal" class="none">
                            <div class="sub-sltbox">
                                <div class="inner-sub-sltbox scroll-auto">
                                    <?php $this->widget('zii.widgets.CMenu', ExtensionClass::homepageLocality()); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->searchForm(); ?>
                </div>
            </div>
        </div>    
        <div id="wrapper">
            <div class="main clearfix">   
                <style type="text/css">
                    #div-gpt-ad-1352106844912-0 iframe{max-width: 700px !important}
                </style>
                <?php echo Yii::app()->params['ad700x90']; ?>
                <?php echo $content; ?>            
            </div>
        </div>

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
        <div style="background: #4e585d">
            <div class="footerLink"><?php GlobalComponents::extensionFooterLink(); ?></div>
            <style type="text/css">
                .footerLink{margin: auto; width: 980px;}
                .footerLink a{color: #839198; padding: 0px 5px;}
            </style>
        </div>        
        <a class="to-top" onclick="gotoTop()" href="javascript:void(0)"></a>
        <script type="text/javascript">
            function gotoTop(){
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }        
            $(window).scroll(function () { 
                if($(window).scrollTop() > 125){
                    $('.topbar').fadeIn(300);
                }else{
                    $('.topbar').fadeOut(300);
                }
            });
        </script>
    </body>
</html>

