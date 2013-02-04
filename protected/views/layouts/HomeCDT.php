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
        <link rel="stylesheet" type="text/css" href="<?php echo SERVER_DATA; ?>/themes/homepage/style/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo SERVER_DATA; ?>/themes/homepage/style/skin.css" />
        <!--<script type="text/javascript" src="<?php echo SERVER_DATA; ?>/themes/homepage/scripts/saobang.js"></script>-->
        <script type="text/javascript" src="<?php echo SERVER_DATA; ?>/themes/homepage/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo SERVER_DATA; ?>/themes/homepage/scripts/jquery.jcarousel.min.js"></script>
        <script type="text/javascript">

            jQuery(document).ready(function() {
                jQuery('#mycarousel').jcarousel({
                    wrap: 'circular'
                });
            });

        </script>
    </head>
    <body>  	
        <?php echo $content; ?>  
    </body>
</html>