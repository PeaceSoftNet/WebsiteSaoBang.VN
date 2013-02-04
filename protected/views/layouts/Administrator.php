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
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/facebok/facebox.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/facebok/jquery.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/facebok/facebox.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('a[rel*=facebox]').facebox({
                    loadingImage : '<?php echo Yii::app()->request->baseUrl; ?>/themes/facebok/loading.gif',
                    closeImage   : '<?php echo Yii::app()->request->baseUrl; ?>/themes/facebok/closelabel.png'
                })
            })
        </script>
        <script language="javascript" type="text/javascript" src="/tiny_mce/tiny_mce.js"></script>
        <script language="javascript" type="text/javascript">
            tinyMCE.init({
                theme : "advanced",
                mode: "exact",
                elements : "area1, area2",
                content_css : "/themes/homepage/style/tiny.css?v=1",
                theme_advanced_toolbar_location : "top",
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
                    + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
                    + "bullist,numlist,outdent,indent,link,unlink,anchor,separator,"
                    +"undo,redo,cleanup,code,separator,sub,sup,charmap",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3 : "",
                height:"250px",
                width:"500px",
                file_browser_callback: "filebrowser"
            });
        </script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div id="hearder">
            <div class="menu-main">
                <?php $this->widget('zii.widgets.CMenu', GlobalComponents::topRightMenuAdmin()); ?>	
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="tabs">
            <?php $this->widget('zii.widgets.CMenu', GlobalComponents::topMenu()); ?>	
        </div>
        <div id="body">
            <div id="path">
                <?php
                $this->widget('zii.widgets.Breadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?>
            </div>
            <div class="col-97 mod">
                <div class="mod-ct">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        <div id="link-footer">
            <ul>
                <li>
                    <h3>Tin rao vặt</h3>
                    <?php $this->widget('zii.widgets.CMenu', GlobalComponents::footerTopicMenu()); ?>	
                </li>
                <li>
                    <h3>Danh mục</h3>
                    <?php $this->widget('zii.widgets.CMenu', GlobalComponents::footerCategoryMenu()); ?>
                </li>
                <li>
                    <h3>Quản trị viên</h3>
                    <?php $this->widget('zii.widgets.CMenu', GlobalComponents::footerAdministratorMenu()); ?>
                </li>
                <li>
                    <h3>Hệ thống</h3>
                    <?php $this->widget('zii.widgets.CMenu', GlobalComponents::footerSystemMenu()); ?>
                </li>
            </ul>
        </div>
        <?php echo GlobalComponents::footerContent(); ?>
        <script type="text/javascript">
            function filebrowser(field_name, url, type, win) {
		
                fileBrowserURL = "<?php echo Yii::app()->request->baseUrl; ?>/fileBrowser/index.php?filter=" + type;
			
                tinyMCE.activeEditor.windowManager.open({
                    title: "PDW File Browser",
                    url: fileBrowserURL,
                    width: 950,
                    height: 650,
                    inline: 0,
                    maximizable: 1,
                    close_previous: 0
                },{
                    window : win,
                    input : field_name
                });		
            }    
        </script>
    </body>
</html>
