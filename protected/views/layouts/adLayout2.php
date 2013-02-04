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
<html xmlns="http://www.w3.org/1999/xhtml" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="content-language" content="vi" /><title><?php echo CHtml::encode($this->pageTitle); ?></title><meta http-equiv="REFRESH" content="1800" /><meta name="copyright" content="Công ty cổ phần giải pháp phần mềm Hòa Bình" /><meta name="author" content="PeaceTech" /><meta http-equiv="audience" content="General" /><meta name="resource-type" content="Document" /><meta name="distribution" content="Global" /><meta name="robots" content="noodp,index,follow" /><link rel="Shortcut Icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />         
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
        //set cache
        Header("Cache-Control: must-revalidate");
        $offset = 60 * 60 * 24 * 3;
        $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
        Header($ExpStr);
        $version = 1;
        //register css file
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/data/template/style/reset.css?v=' . $version);
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/uploadify/uploadify.css?v=' . $version);
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/data/template/style/grid_12.css?v=' . $version);
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/data/template/style/style.css?v=' . $version);
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/data/template/script/jquery.min.js?v=' . $version);
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/data/template/script/init.js?v=' . $version);
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/uploadify/jquery.uploadify-3.1.min.js?v=' . $version);
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/tiny_mce/tiny_mce.js?v=' . $version);
        ?>
        <script language="javascript" type="text/javascript">
            tinyMCE.init({
                theme : "advanced",
                mode: "exact",
                elements : "area1",
                content_css : "/themes/homepage/style/tiny.css?v=1",
                theme_advanced_toolbar_location : "top",
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,forecolor,backcolor    "
                    + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
                    + "bullist,numlist,outdent,indent,link,unlink,anchor,separator,"
                    +"undo,redo,cleanup,code,separator,sub,sup,charmap",
                theme_advanced_buttons3 : "",
                height:"350px",
                width:"700px"
            });
        </script>
        <script type="text/javascript">
            //upload image process
            $(function() {    
                var i = $('#number_countimg').val();
                $("#file_upload_1").uploadify({
                    height        : 23,
                    width         : 60,
                    swf           : '/uploadify/uploadify.swf',
                    uploader      : '/uploadify/uploadify.php',                    
                    'queueSizeLimit':20,
                    'onUploadSuccess' : function(file, data, response) {
                        insertImg('<?php echo Yii::app()->request->baseUrl; ?>'+data, 'are'+i);
                        i++;                        
                        $('#number_countimg').val(i)
                        $('#image_uploaded').append('<input type="hidden" name="imgUpload[]" value="<?php echo Yii::app()->request->baseUrl; ?>'+data+'">');
                        $('#image_uploaded').append('\
                        <div class="col-left fl" id="imgArea'+i+'">\
                        <div class="bl-image">\
                        <a href=""><img width="90px" height="90px" src="<?php echo Yii::app()->request->baseUrl; ?>'+data+'"></a>\
                        <span class="bdt-t"></span><span class="bdt-l"></span><span class="bdt-b"></span><span class="bdt-r"></span>\
                        </div>\
                        <p><a onclick="removeImg(\''+i+'\');" href="javascript:void(0);">Xóa </a> | <a onclick="insertImg(\'<?php echo Yii::app()->request->baseUrl; ?>'+data+'\', \'are'+i+'\');" href="javascript:void(0);">Chèn ảnh</a></p>\
                                            </div>');} });  });
        </script>
    </head>
    <body>
        <?php $this->topPage(); ?>
        <?php echo $content; ?>
        <?php $this->footerPage(); ?>
    </body>
</html>
