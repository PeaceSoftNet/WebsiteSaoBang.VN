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
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/styles/include.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/styles/styles.css" type="text/css" rel="stylesheet" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div id="login">
            <div class="login">
                <div class="login-l">
                    <h1><a href="<?php echo Yii::app()->createUrl('ad/index') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/data/template/images/logo-Rv.png" /></a></h1>
                    <?php echo $content; ?>
                </div>
                <div class="login-r">
                    <h4>Thông tin đăng nhập</h4>
                    <ul>
                        <?php
                        if (isset($_SERVER["HTTP_X_REAL_IP"]))
                            echo '<li>Bạn đang đăng nhập hệ thống từ địa chỉ ' . $_SERVER["HTTP_X_REAL_IP"] . '</li>';
                        echo '<li>' . $_SERVER["HTTP_USER_AGENT"] . '</li>';
                        echo '<li>' . date('d/m/Y h:i:s') . '</li>';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
    <style type="text/css">
        li{padding: 15px; font-size: 13px;}
    </style>
</html>
