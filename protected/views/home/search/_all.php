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
    <h3 class="title-Br-NewsRv wfull">
        <a class="fl" href="<?php echo GlobalComponents::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId); ?>"><?php echo ExtensionSearch::setHightLight($data->title, $keyword); ?></a>
        <?php if ($data->price) echo '<span class="Br-price fr">' . GlobalComponents::numberFomat($data->price) . ' VNĐ</span>'; ?>    
    </h3>
    <?php
    if ($data->icon) {
        echo '<div class="bl-image">
                        <a href=""><img src="' . $data->icon . '"></a>
                        <span class="bdt-t"></span>
                        <span class="bdt-l"></span>
                        <span class="bdt-b"></span>
                        <span class="bdt-r"></span>
                    </div>';
    }
    ?>

    <p class="Br-NewsRv-cont"><?php echo ExtensionSearch::setHightLight($data->description, $keyword); ?>..<br /><span class="green-clr">• <?php echo GlobalComponents::convertTimeValue($data->createDate); ?><?php if ($data->domain) echo ' tại ' . $data->domain; ?></span></p>
    <div class="Navi-Br-NewsRv">
        <div class="fl">
            <a class="detail-NewsRv" rel="<?php echo $data->id; ?>" href="javascript:void(0);" onclick="$.topicDetail(this);"><i class="gr-icon-expand"></i> <span>Chi tiết</span></a>
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
                if ($data->extension1)
                    echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension1] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension2 && isset($attributes[$data->extension2])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension2, 'ext' => 2));
                if ($data->extension2)
                    echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension2] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension3 && isset($attributes[$data->extension3])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension3, 'ext' => 3));
                if ($data->extension3)
                    echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension3] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension4 && isset($attributes[$data->extension4])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension4, 'ext' => 4));
                if ($data->extension4)
                    echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributes[$data->extension4] . '</a></li>';
            }
            ?>
            <?php
            if ($data->extension5 && isset($attributes[$data->extension5])) {
                $currUrl = array_merge($currUrl, array('aid' => $data->extension5, 'ext' => 5));
                if ($data->extension5)
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
    <div  id="Chienlv-<?php echo $data->id; ?>" class="falseDetail" rel="false">
        <?php
        $modelDetail = Yii::app()->cache->get('TopicDetail_' . $data->id);
        if ($modelDetail === false) {
            $modelDetail = TopicDetail::model()->findByPk($data->id);
            Yii::app()->cache->set('TopicDetail_' . $data->id, $modelDetail, 5 * 60);
        }
        $this->renderPartial('options', array('data' => $data, 'dataDetail' => $modelDetail));
        ?>
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