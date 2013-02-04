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
$totalLink = ExtensionClass::getTotalCrawlerLink();
$locality = ExtensionClass::getListLocality();
?>
<div class="block list-Wfind">
    <div class="bl-title"><h1>Hiện có <span class="org-clr" id="totalCrawlerLink"><?php echo GlobalComponents::numberFomat($totalLink); ?></span> rao vặt từ nhiều nguồn website</h1></div>
    <div class="block-content clearfix">
        <ul>
            <?php
            foreach ($dataProviderSite as $index => $data) {
                if ($index < 14) {
                    ?>
                    <li<?php if (in_array($index, array('0', '1', '2'))) echo ' class="no-bg"'; ?>>
                        <span class="fl"><a href="<?php echo Yii::app()->createUrl('home/all', array('site' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->name))) ?>"><i <?php if ($data->classCss) echo 'class="' . $data->classCss . '"'; ?>></i><?php echo $data->name; ?></a></span>
                        <span class="fr"><?php if (isset($data->totalLink)) echo GlobalComponents::numberFomat($data->totalLink); ?></span>
                    </li>

                    <?php
                }else if ($index == 14) {
                    echo '<li><a class="more-Wfind" href="' . Yii::app()->createUrl('home/all') . '">Các website khác</a></li>';
                }
            }
            ?>    
            <li class="homeLastNews"> 
                <div style="float: left; padding: 0px 10px;"><a href="javascript:void(0);">Thông báo</a> <img style="padding: 3px;" src="/data/new.gif" />:</div>
                <div style="overflow: hidden; position: relative; height: 126px;" id="news-container">

                    <ul style="position: absolute; margin: 0px; padding: 0px; top: 0px;">
                        <?php
                        foreach ($dataProviderNotify as $key => $data) {
                            ?>
                            <li style="margin: 0px; padding: 0px; height: 22px; display: list-item; width: 680px;">
                                <div>
                                    <a class="lastNewsLink" href="<?php echo Yii::app()->createUrl('home/notify', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))); ?>"><?php echo $data->title; ?></a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
</div>
<script type="text/javascript">
    function homeLayout(item){
        if(item!=1){
            $('.list-Wfind').removeClass('none');
            $('.list-hotNews').addClass('none');
        }else{
            $('.list-hotNews').removeClass('none');
            $('.list-Wfind').addClass('none');
        }
    }
</script>
