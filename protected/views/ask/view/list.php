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

<?php
foreach ($dataProvider as $index => $data) {
    ?>
    <li>
        <div class="fl">
            <span class="corner"></span><div class="col"><b><?php echo $data->visit; ?></b><br />lượt xem</div><div class="col green"><b><?php echo $data->report; ?></b><br />Báo giá</div>
        </div>
        <div class="fr">
            <div class="cont">
                <h2 class="title"><b class="name"><?php echo GlobalComponents::hiddenEmail($data->email); ?></b><a target="_blank" href="<?php echo Yii::app()->createUrl('ask/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))); ?>"><?php echo $data->title; ?></a></h2>
                <p style="display: none;" id="descriptionAsk_<?php echo $data->id; ?>"><?php echo $data->content; ?></p>
                <p id="functionAsk_<?php echo $data->id; ?>">
                    <a href="javascript:void(0);" onclick="loadAskContent('<?php echo $data->id; ?>');">Xem nhanh</a> 
                    <span class="fs11">
                        <span class="cl99">&nbsp;&nbsp;• <?php echo GlobalComponents::convertTimeValue($data->createDate); ?> </span>&nbsp;&nbsp; 
                        <?php
                        $tags = json_decode($data->tag);
                        if ($tags) {
                            foreach ($tags as $key => $tag) {
                                echo '<a href="' . Yii::app()->createUrl('ask/tag', array('id' => $key)) . '">• ' . ucfirst($tag) . '</a>&nbsp;&nbsp;';
                            }
                        }
                        ?>
                    </span></p>
            </div>
            <div class="clear"></div>
            <div class="quote-box" id="askPreview_<?php echo $data->id; ?>" style="display: none;">
                <?php
                $this->ViewPlus($data->id);
                $this->ListComment($data->id);
                ?>
            </div>
        </div>
    </li>
<?php } ?>