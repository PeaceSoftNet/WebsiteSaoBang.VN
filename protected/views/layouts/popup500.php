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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/facebok/jquery.js" type="text/javascript"></script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>  
        <div class="content-popup w500">
            <?php echo $content; ?>
        </div>
    </body>
</html>