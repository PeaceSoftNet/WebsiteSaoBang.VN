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
<li>

    <h3 class="title-Br-NewsRv wfull"><a href="<?php echo GlobalComponents::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId); ?>"><?php echo ExtensionSearch::setHightLight($data->title, $keyword); ?></a></h3>

    <p class="Br-NewsRv-cont"><?php echo ExtensionSearch::setHightLight($data->description, $keyword); ?>
        <span class="green-clr">• <?php echo GlobalComponents::convertTimeValue($data->timestamp); ?><?php //if ($data->domain) echo ' tại ' . $data->domain;         ?></span>
    </p>
    <div class="Navi-Br-NewsRv clearfix">
        <div class="fl">
            <a class="detail-NewsRv" rel="<?php echo $data->id; ?>" id="viewdetail<?php echo $data->id; ?>" href="javascript:void(0);" onclick="previewTopicDetail('<?php echo $data->id; ?>')"><i class="gr-icon-expand"></i> <span>Chi tiết</span></a>
            <?php
            if (isset($data->mobileNumber)) {
                echo '&nbsp;&nbsp;•&nbsp;&nbsp;<i class="gr-icon-phone"></i> ' . $data->mobileNumber;
            }
            if (isset($data->locality)) {
                if ($data->locality && isset($locality[$data->locality])) {
                    echo ' • <i class="gr-icon-location"></i> ' . $locality[$data->locality];
                }
            }
            ?>
            <?php if (Yii::app()->user->id) { ?> 
                &nbsp;&nbsp;<a class="detail-NewsRv" onclick="removetopic('<?php echo $data->id ?>')" href="javascript:void(0);" ><i class="gr-icon-delete"></i> <span style="color: red;">Xóa tin</span></a>
                &nbsp;&nbsp;<a class="detail-NewsRv" onclick="topicIsVip('<?php echo $data->id ?>')" href="javascript:void(0);" >&nbsp;<span style="color: red;">VIP</span></a>
            <?php } ?>
        </div>
        <ul class="fr">
            <?php
            if (isset($data->demand) && isset($demand[$data->demand])) {
                if ($data->demand)
                    $currUrl = array_merge($currUrl, array('did' => $data->demand, 'demandName' => ExtensionClass::utf8_to_ascii(ExtensionClass::getCurrentDemand($data->demand))));
                echo '<li><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $demand[$data->demand] . '</a></li>';
            }
            ?>
            <?php
            $did = isset($_GET['did']) ? $_GET['did'] : '';
            if (!$did) {
                unset($currUrl['did']);
                unset($currUrl['demandName']);
            }
            if (isset($data->extension1) && isset($attributes[$data->extension1])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension1, 'ext' => 1, 'extName' => ExtensionClass::utf8_to_ascii(ExtensionClass::getAttributesByAid($data->extension1))));
                if ($data->extension1)
                    echo '<li><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $attributes[$data->extension1] . '</a></li>';
            }
            ?>
            <?php
            if (isset($data->extension2) && isset($attributes[$data->extension2])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension2, 'ext' => 2, 'extName' => ExtensionClass::utf8_to_ascii(ExtensionClass::getAttributesByAid($data->extension2))));
                if ($data->extension2)
                    echo '<li><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $attributes[$data->extension2] . '</a></li>';
            }
            ?>
            <?php
            if (isset($data->extension3) && isset($attributes[$data->extension3])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension3, 'ext' => 3, 'extName' => ExtensionClass::utf8_to_ascii(ExtensionClass::getAttributesByAid($data->extension3))));
                if ($data->extension3)
                    echo '<li><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $attributes[$data->extension3] . '</a></li>';
            }
            ?>
            <?php
            if (isset($data->extension4) && isset($attributes[$data->extension4])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension4, 'ext' => 4, 'extName' => ExtensionClass::utf8_to_ascii(ExtensionClass::getAttributesByAid($data->extension4))));
                if ($data->extension4)
                    echo '<li><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $attributes[$data->extension4] . '</a></li>';
            }
            ?>
            <?php
            if (isset($data->extension5) && isset($attributes[$data->extension5])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension5, 'ext' => 5, 'extName' => ExtensionClass::utf8_to_ascii(ExtensionClass::getAttributesByAid($data->extension5))));
                if ($data->extension5)
                    echo '<li><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $attributes[$data->extension5] . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <style type="text/css">
        .falseDetail{display: none;}
        .trueDetail{display:block;}
    </style>
    <div class="clear"></div>
    <div id="preview<?php echo $data->id; ?>">

    </div>
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