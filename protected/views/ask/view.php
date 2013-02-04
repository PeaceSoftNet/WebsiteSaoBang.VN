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
if (isset($tagId)) {
    $pageTitle = ucfirst(ExtensionSearch::getTagNameByTagId($tagId));
} else {
    $tagId = false;
    $pageTitle = 'Mua nhanh - Đúng giá - Chất lượng tốt';
}
$this->pageTitle = $pageTitle;
?>
<div class="grid_12">
    <?php
    $this->bannerA2b();
    ?>

    <div class="title-page">
        <h1><?php echo ucfirst($pageTitle); ?></h1>
    </div>

    <div class="Tab-br-NewsRv">
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::askTypelMenu()); ?>	
    </div>
    <div class="btbar-Tab-br-NewsRv"></div>
    <div class="Opt-Tab-br-NewsRv clearfix">
        <?php $this->bannerSort(); ?>
    </div>

    <ul class="list-Asktobuy">
        <?php
        foreach ($dataProvider as $index => $data) {
            ?>
            <li id="show_comment_<?php echo $data->id; ?>" onload="visitPlus(<?php echo $data->id; ?>);">
                <div class="fl">
                    <span class="corner"></span>
                    <div class="col">
                        <b><?php echo $data->visit; ?></b>
                        <br />
                        lượt xem
                    </div>
                    <div class="col">
                        <b><?php echo $data->report; ?></b>
                        <br />
                        Báo giá
                    </div>
                    <div class="avatar">
                        <a href="mailto:<?php echo $data->email; ?>"><img title="<?php echo $data->email; ?>" alt="<?php echo $data->email; ?>" height="40px" src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/mailbox.jpg" /></a>
                    </div>
                </div>
                <div class="fr">
                    <div class="cont">
                        <h2 class="title">
                            <b class="name"><?php echo GlobalComponents::hiddenEmail($data->email); ?></b>
                            <a target="_blank" href="<?php echo Yii::app()->createUrl('ask/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))); ?>"><?php echo $data->title; ?></a>
                        </h2>
                        <p><?php echo $data->content; ?> <span class="hint">• <?php echo GlobalComponents::convertTimeValue($data->createDate); ?> </span></p>
                    </div>
                    <ul class="keyword">
                        <?php
                        $tags = json_decode($data->tag);
                        if ($tags) {
                            foreach ($tags as $key => $tag) {
                                echo '<li><a href="' . Yii::app()->createUrl('ask/tag', array('id' => $key)) . '">' . ucfirst($tag) . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                    <div class="clear"></div>                    
                    <div class="quote-box">
                        <?php
                        $this->ViewPlus($data->id);
                        $this->ListComment($data->id);
                        ?>                        
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php $this->pagers(); ?>
</div>

<script type="text/javascript">
    function loadCommentAll(askId){
        $('#list_comment_all_'+askId).load('<?php echo Yii::app()->createUrl('ask/listCommentAll') ?>', {'askId':askId}, function(){
            $('#orderByCreateDate'+askId).addClass('active'); $('#orderByPrice'+askId).removeClass();
        });
    }
    function loadCommentPrice(askId){
        $('#list_comment_all_'+askId).load('<?php echo Yii::app()->createUrl('ask/listCommentPrice') ?>', {'askId':askId}, function(){
            $('#orderByPrice'+askId).addClass('active'); $('#orderByCreateDate'+askId).removeClass();
        });
    }
</script>