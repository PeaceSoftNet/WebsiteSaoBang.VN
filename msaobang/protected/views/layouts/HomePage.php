<?php
/**
 * 
 * @author              Linhnt
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$path = $this->_assetsUrl;
$keyword = 'Tìm kiếm..';
$dataProvince = $this->_rawProvinceData;
$dataMainContent = $this->_rawContentData;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="format-detection" content="telephone=no" />
        <meta http-equiv="x-rim-auto-match" content="none" />
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
        <meta http-equiv="expires" content="0"/>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="pragma" content="no-cache"/>
        <meta name = "viewport" content = "initial-scale = 1.0"/>
        <meta content="240" name="MobileOptimized" />
        <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport" />
        <meta name="MobileOptimized" content="100" />
        <meta name="robots" content="noindex,nofollow" />
                
        <title>Bản mobile Saobang.vn</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>/styles/reset.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $path; ?>/styles/stylemobile.css"/>
        <script type="text/javascript" src="<?php echo SERVER_DATA; ?>/themes/homepage/scripts/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $path; ?>/js/msb.js"/></script>
        <script type="text/javascript">
                $(document).ready(function(){
                        maxCss = <?php echo $this->_maxCss .';'?>
                        defKey = '<?php echo $keyword ?>';
                        $("#headSeach")
                                .focus(function() { if ($(this).val() === defKey) $(this).val(''); })
                                .blur(function() { if ($(this).val() == '') $(this).val(defKey); });
                });
        </script>
     
    </head>
    <body>  	
        <div id="header">
           <div class="topbar clearfix">         <!-- icon saobang & select city -->                    
            <a class="Back-homepage" href="/"></a>
            <div class="slt-location" id="dropLocal">
                        
                        <!-- <div id="sub-sltbox" class="sub-sltbox" style="display">-->
<!--                                <div class="inner-sub-sltbox">-->
                                    <?php echo $dataProvince;     ?>     
<!--                                </div>-->
<!--                        </div>-->
                    </div> 
            </div>
            <div class="head-search clearfix">
                <span class="corner"></span>
                      <?php $this->beginWidget('CActiveForm', array('id' => 'searchHomepage', 'method' => 'POST', 'action' => Yii::app()->createUrl('mobile/search'))); ?>
                        <input type="button" value="" onclick="return searchContent();" id="btnSubmit" name="btnSubmit" class="submit">
                        <div class="search-box">
                             <input class="enter-text" type="text" name="keyword" id="headSeach" value="<?php echo $keyword; ?>" />
                        </div>
                      <?php $this->endWidget(); ?>
            </div>   
        </div>
        <div id="pathway"><!-- pathway-->
        <?php echo $this->_rawPathway; ?>
        </div> 
        <div id="wrapper">
           <?php 
             echo $content;
           ?>
        </div>
        <div id="footer">
                <ul class="ft-link">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="http://saobang.vn/huong-dan.html">Hỗ trợ</a></li>
                    <li><a href="<?php  echo Yii::app()->request->url.'?skin=d' ?>">SaoBăng.vn bản đầy đủ</a></li>
<!--                    <li><a href="http://saobang.vn/?skin=def">SaoBăng.vn bản đầy đủ</a></li>-->
                </ul>
                <div class="copyright"><?php echo Yii::app()->params['copyright']; ?><a href="/">SaoBăng.vn</a></div>
        </div>
    </body>
</html>

