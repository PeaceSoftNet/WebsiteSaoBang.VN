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

<div class="green-block" id="bannerA2btut">
    <div class="grbl-title">
        <a class="close" onclick="closeBanner();" href="javascript:void(0);">Đóng</a>
        <h4>Hỏi mua - mua ngay giá đúng</h4>
    </div>
    <div class="block-content" align="center"><img src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/Asktobuy.png" /></div>
</div>
<script type="text/javascript">
    function closeBanner(){
        $('#bannerA2btut').fadeOut('none', function(){
            $.post('<?php echo Yii::app()->createUrl('ask/hiddenbannerA2b'); ?>', {'isHidden': '1'}, function(){$('html, body').animate({ scrollTop: 120}, 'none');});
        });        
    }    
</script>