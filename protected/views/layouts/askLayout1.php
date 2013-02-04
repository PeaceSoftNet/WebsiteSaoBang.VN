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
        <meta http-equiv="content-language" content="vi" />         
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
        //set cache
        Header("Cache-Control: must-revalidate");
        $offset = 60 * 60 * 24 * 3;
        $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
        Header($ExpStr);
        //register css file
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/data/template/style/reset.css');
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/data/template/style/grid_12.css');
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/data/template/style/style.css?v=2');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/data/template/script/jquery.min.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/data/template/script/init.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/data/template/script/pagging.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/data/template/script/askJs.js');
        $cs->registerScriptFile('//connect.facebook.net/en_US/all.js');
        ?>
        <meta name="robots" content="noodp,index,follow" />
    </head>
    <body>
        <?php $this->topPage(); ?>
        <?php echo $content; ?>
        <?php $this->footerPage(); ?>
    </body>
</html>
