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
<div class="block list-Wfind">
    <div class="bl-title"><h1>Từ khóa rao vặt được tìm nhiều nhất</h1></div>
    <div class="clearfix">
        <ul>
            <?php
            foreach ($dataProvider->getData() as $index => $data) {
                ?>
                <li<?php if ($index < 4) echo ' class="no-bg"'; ?>>
                    <span class="fl"><a href="<?php echo Yii::app()->createUrl('home/search', array('seoId' => $data->id, 'title' => ExtensionSearch::utf8_to_ascii($data->name))); ?>"><?php echo ucfirst($data->name); ?></a></span>
                    <span class="fr"><?php echo rand(800, 99999); ?></span>
                </li>
                <?php
            }
            ?>    
        </ul>
    </div>
</div>