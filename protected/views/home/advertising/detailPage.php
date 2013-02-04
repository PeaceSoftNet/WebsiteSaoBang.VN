<?php
/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$list = ExtensionClass::getAdBanner(2);
$maxValue = 0;
foreach ($list as $key => $value) {
    $listAdvertising[] = '<a target="_black" href="' . $value['url'] . '"><img src="' . $value['img'] . '" width="218px" border="0" /></a>';
    $maxValue = $key;
}

$random = rand(0, $maxValue);
?>
<div class="grid_3">
    <div class="block cls-bl">
        <div class="bl-title">
            <h4>Tin nổi bật</h4>
        </div>
        <div class="block-content">
            <ul class="listRv-hot">
                <?php
                foreach ($dataProviderAd as $index => $data) {
                    ?>
                    <li>
                        <?php if ($data->icon) { ?>
                            <div class="bl-image">
                                <a href="<?php echo Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title))); ?>"><img style="width: 70px; overflow: hidden;" height="70px" src="<?php echo GlobalComponents::processIcon($data->icon); ?>" /></a>
                                <span class="bdt-t"></span>
                                <span class="bdt-l"></span>
                                <span class="bdt-b"></span>
                                <span class="bdt-r"></span>
                            </div>
                        <?php } ?>
                        <p>
                            <a href="<?php echo Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title))); ?>"><?php echo $data->title; ?></a>
                            <?php if (Yii::app()->user->id) echo '<a style="color:red; font-size:10px;" href="javascript:void(0);" onclick="removeAdTopic(\'' . $data->id . '\');">( xóa )</a>'; ?>
                        </p>    
                        <?php if ($data->price) echo '<p><span class="org-clr">' . GlobalComponents::numberFomat($data->price) . ' VNĐ</span></p>'; ?>    
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="regisRV-Hot-sms">
                Soạn tin <b>SB VIP <?php echo $code; ?></b> gửi <b>8708</b><br />
                để hiển thị tin tại đây (Phí: 15.000đ/sms)
            </div>
        </div>
    </div>
    <?php if (isset($listAdvertising)) {
        ?>
        <div class="boxModule" style="margin-bottom: 10px; display: block; clear: both">
            <?php echo $listAdvertising[$random]; ?>
        </div>
        <?php
    }
    ?>
    <div class="paper-notice">
        <strong style="color: #F00; text-transform: uppercase; text-align: center;">Lưu ý khi mua hàng</strong><br />
        &nbsp;&nbsp;&FilledVerySmallSquare; Giao dịch với người bán có thông tin rõ ràng<br />
        &nbsp;&nbsp;&FilledVerySmallSquare; KHÔNG trả tiền trước khi nhận hàng.<br />
        &nbsp;&nbsp;&FilledVerySmallSquare; Nên thanh toán qua cổng thanh toán uy tín<br />
        &nbsp;&nbsp;&FilledVerySmallSquare; Nếu bạn mua hàng hiệu, hãy gặp mặt tại cửa hàng để nhờ xác minh, tránh mua phải hàng giả.
    </div>
    <div class="clear"></div>
    <div id="postionAd"></div>
    <div style="clear: both;"></div>
    <div style="position: relative; display: block; height: 365px; width: 220px;">
        <div id="advertising" style="position: relative;">
            <?php $this->renderPartial('advertising/facebook'); ?>
        </div>
    </div>
    <div style="clear: both"></div>
</div>
<!--<script type="text/javascript">
    var positionAd = $("#postionAd").position();
    var topAd =positionAd.top;    
    $(window).scroll(function(){
        if(topAd>0){
            $("#advertising").css("position", 'fixed');       
            $("#advertising").css("top",Math.max(0,topAd-$(this).scrollTop()));
        }        
    });    

</script>-->