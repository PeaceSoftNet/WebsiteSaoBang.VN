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
<div class="fl">
    <span>Hiển thị:</span>
    <ul class="clearfix">
        <li <?php if ($item == 30) echo 'class="active"'; ?>><a onclick="setView('30');" href="javascript:void(0);">30</a></li>
        <li <?php if ($item == 60) echo 'class="active"'; ?>><a onclick="setView('60');" href="javascript:void(0);">60</a></li>
    </ul>
</div>
<div class="fr">
    <span>Sắp xếp theo:</span>
    <a href="javascript:void(0);" class="slted">Độ liên quan</a>
    <div style="display: none;" class="sub-sltbox">
        <div class="inner-sub-sltbox">
            <ul>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setView(item){
        $.post('<?php echo Yii::app()->createUrl('ask/setItem') ?>', {'item': item}, function(){
            location.reload();
        });
    }
</script>