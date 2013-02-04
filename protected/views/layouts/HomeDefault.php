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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vn" lang="vn">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="vn" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title> 
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadify/uploadify.css">
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/fontend/css/style.css" />
            <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/uploadify/jquery.uploadify-3.1.min.js"></script>
            <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/editor/nicEdit.js"></script>
            <script type="text/javascript">
                bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
                $(function() {
                    $('#file_upload').uploadify({
                        'swf'      : '/uploadify/uploadify.swf',
                        'uploader' : '/uploadify/uploadify.php',
                        // Your options here
                        'onUploadSuccess' : function(file, data, response) {
                            $('#file_upload-queue').append('<p><img height="100px" src='+data+' /><input type="text" value="'+data+'" name="TopicDetail[images][]" /></p>');
                        } 
                    });
                });
            </script>
            <?php echo Yii::app()->params['googleAnalytics']; ?>
    </head>
    <body>
        <div class="homeHeader">            
            <?php
            echo '<h1>' . CHtml::link(CHtml::encode('Sàn rao vặt'), Yii::app()->createUrl('home/index')) . '<h1>';
            if (!Yii::app()->session['userId']) {
                echo '<span>' . CHtml::link(CHtml::encode('Đăng ký'), Yii::app()->createUrl('user/register')) . '</span>';
                echo '<span>' . CHtml::link(CHtml::encode('Đăng nhập'), Yii::app()->createUrl('user/login')) . '</span>';
            } else {
                echo '<span>' . CHtml::link(CHtml::encode('Đăng xuất'), Yii::app()->createUrl('user/logout')) . '</span>';
                echo '<span>' . CHtml::link(CHtml::encode(Yii::app()->session['email']), Yii::app()->createUrl('user/profile')) . '</span>';
            }
            echo '<span>' . CHtml::link(CHtml::encode('Đăng rao vặt'), Yii::app()->createUrl('topic/step1')) . '</span>';
            echo CHtml::dropDownList('location', Yii::app()->session['location'], ExtensionClass::getListLocality(), array('onchange' => 'setLocation(this.value);'));
            ?>
        </div>
        <br /><br /><br />
        <div class="content">
            <?php echo Yii::app()->params['ad700x90']; ?>
            <?php echo $content; ?>
        </div>
        <script type="text/javascript">        
            function setLocation(locality){
                $.post('<?php echo Yii::app()->createUrl('home/SetLocation') ?>', {'location' : locality}, function(){
                    window.location.reload();
                });
            }
        </script>
        <?php echo Yii::app()->params['chat']; ?>
        <?php echo Yii::app()->params['popnet']; ?>

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
        </script>
    </body>
</html>