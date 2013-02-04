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
//$content = '<div style="border: 1px sold red;">';
//$content .= '<p>Referer link ' . $_SERVER['HTTP_REFERER'] . '</p>';
//$content .= '<p>Error ' . $code . '</p>';
//$content .= '<p>Message ' . $message . '</p>';
//$content .= '<p>AT: '.  date('h:i:s').' FROM '. $_SERVER['REMOTE_ADDR'] .'</p>';
//$content .= '<hr /></div>';
//$name = date('Ymd');
//$filePath = 'data/log/error_' . $name . '.html';
//$fp = fopen($filePath, 'a+');
//fwrite($fp, $content);
//fclose($fp);
//header("refresh:3;url=" . Yii::app()->createUrl('ad/index'));
$this->pageTitle = Yii::app()->name . ' - Error';
?>
<h2>Error <?php echo $code; ?></h2>
<div class="error" style="display: block; height: 250px; width: 100%;">
    Trang bạn yêu cầu không tim thấy.
    <?php
    // echo CHtml::encode($message);
    echo '<br /><br /><p>Click <a href="javascript:void(0);" onclick="history.go(-1);">vào đây</a> để chuyển về trang trước, hoặc tự động chuyển về trang chủ sau 3 giây</p>';
    ?>
</div>