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
$currUrl = array('catId' => $catId);
$currUrl = array_merge($currUrl, array('name' => ExtensionClass::utf8_to_ascii(ExtensionClass::getCategoryNameById($data->categoryId))));
?>

<li>
    <h3 class="title-Br-NewsRv<?php if (!$data->price) echo ' wfull'; ?>">
        <a class="fl" href="<?php echo GlobalComponents::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId); ?>"><?php echo $data->title; ?></a>
        <?php if ($data->price) echo '<span class="Br-price fr">' . GlobalComponents::numberFomat($data->price) . ' VNĐ</span>'; ?>    
    </h3>
    <?php
    if ($data->icon) {
        echo '<div class="bl-image">
                        <a href=""><img src="' . GlobalComponents::processIcon($data->icon) . '"></a>
                        <span class="bdt-t"></span>
                        <span class="bdt-l"></span>
                        <span class="bdt-b"></span>
                        <span class="bdt-r"></span>
                    </div>';
    }
    ?>

    <p class="Br-NewsRv-cont"><?php echo $data->description; ?>..<br /><span class="green-clr">• <?php echo GlobalComponents::convertTimeValue($data->createDate); ?><?php if ($data->domain) echo ' tại ' . $data->domain; ?></span></p>
    <div class="Navi-Br-NewsRv clearfix">
        <div class="fl">
            <a class="detail-NewsRv" rel="<?php echo $data->id; ?>" id="viewdetail<?php echo $data->id; ?>" href="javascript:void(0);" onclick="previewTopicDetail('<?php echo $data->id; ?>')"><i class="gr-icon-expand"></i> <span>Chi tiết</span></a>
            <?php
            if ($data->mobileNumber) {
                echo '&nbsp;&nbsp;•&nbsp;&nbsp;<i class="gr-icon-phone"></i> ' . $data->mobileNumber;
            }

            if ($data->locality && isset($locality[$data->locality])) {
                echo '&nbsp;&nbsp;•&nbsp;&nbsp;<i class="gr-icon-location"></i> ' . $locality[$data->locality];
            }
            ?>
        </div>
        <ul class="fr">
            <?php
            if ($data->demand && isset($demand[$data->demand])) {
                $currUrl = array_merge($currUrl, array('did' => $data->demand));
                echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $demand[$data->demand] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension1 && isset($attributes[$data->extension1])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension1, 'ext' => 1));
                echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension1] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension2 && isset($attributes[$data->extension2])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension2, 'ext' => 2));
                echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension2] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension3 && isset($attributes[$data->extension3])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension3, 'ext' => 3));
                echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension3] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension4 && isset($attributes[$data->extension4])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension4, 'ext' => 4));
                echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension4] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension5 && isset($attributes[$data->extension5])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension5, 'ext' => 5));
                echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension5] . '</a></li>';
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