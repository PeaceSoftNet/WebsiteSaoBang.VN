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
$categoryId = isset($data->categoryId) ? $data->categoryId : 0;
$childCatId = isset($data->childCatId) ? $data->childCatId : 0;
?>
<li>
    <h3 class="title-Br-NewsRv wfull"><a href="<?php echo GlobalComponents::topicDetail($data->id, $data->title, $categoryId, $childCatId); ?>"><?php echo ExtensionSearch::setHightLight($data->title, $keyword); ?></a></h3>
    <p class="Br-NewsRv-cont"><?php echo ExtensionSearch::setHightLight($data->description, $keyword); ?></p>
    <div class="Navi-Br-NewsRv clearfix">
        <div class="fl">
            <a class="detail-NewsRv" rel="<?php echo $data->id; ?>" id="viewdetail<?php echo $data->id; ?>" href="javascript:void(0);" onclick="previewTopicDetail('<?php echo $data->id; ?>')"><i class="gr-icon-expand"></i> <span>Chi tiết</span></a>
            <?php
            if (isset($data->mobile)) {
                echo '&nbsp;&nbsp;•&nbsp;&nbsp;<i class="gr-icon-phone"></i> ' . $data->mobile;
            }
            if (isset($data->locality)) {
                if ($data->locality && isset($locality[$data->locality])) {
                    echo '&nbsp;&nbsp;•&nbsp;&nbsp;<i class="gr-icon-location"></i> ' . $locality[$data->locality];
                }
            }
            ?>
            <?php if (Yii::app()->user->id) { ?> 
                &nbsp;&nbsp;<a class="detail-NewsRv" onclick="removetopic('<?php echo $data->id ?>')" href="javascript:void(0);" ><i class="gr-icon-delete"></i> <span style="color: red;">Xóa tin</span></a>
                &nbsp;&nbsp;<a class="detail-NewsRv" onclick="topicIsVip('<?php echo $data->id ?>')" href="javascript:void(0);" >&nbsp;<span style="color: red;">VIP</span></a>
            <?php } ?>
        </div>
    </div>
    <style type="text/css">
        .falseDetail{display: none;}
        .trueDetail{display:block;}
    </style>
    <div class="clear"></div>
    <div id="preview<?php echo $data->id; ?>">
</li>
<?php
if ($index == 4) {
    ?>
    <!-- LeaderBoard_728x90 -->
    <div id='div-gpt-ad-1352106844912-0' style="margin-top: 1px;">
        <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1352106844912-0'); });
        </script>
    </div>
<?php } ?>