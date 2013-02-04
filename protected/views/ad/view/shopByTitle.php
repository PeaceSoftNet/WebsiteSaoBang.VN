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
<div class="fr trust-price">
    <h3>NHận báo giá từ người bán uy tín</h3>
    <div class="tb-scroll" id="listShopItem">
        <ul class="clearfix" style="height: 72px;">

        </ul>
        <script type="text/javascript">
            loadShop('<?php echo $string; ?> #listShopItem');
        </script>
    </div>
    <div class="post-buy">
        <p style="width:154px;margin:0">Chọn để yêu cầu nhận báo giá</p>
        <div class="postNews-Rv" style="top:12px"><a class="postBuys-Rv" href="<?php echo Yii::app()->createUrl('ask/new') ?>">Đăng hỏi mua</a> </div>     
    </div>
</div>