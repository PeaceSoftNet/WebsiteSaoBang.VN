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
<div class="boxModule">
    <div class="bM-title"><h4>Hỏi mua mới</h4></div>
    <div class="boxModule-content">
        <ul class="listRv-hot">
            <?php
            foreach ($dataProvider as $index => $data) {
                $link = Yii::app()->createUrl('ask/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title)));
                ?>
                <li>                
                    <a href="<?php echo $link; ?>">&blacktriangleright;&nbsp; <?php echo $data->title; ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
