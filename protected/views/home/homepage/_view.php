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
if ($index == 0) {
    echo '<li class="no-bdt">';
} else if (in_array($index, array('3', '6', '9', '12', '15', '18'))) {
    echo '</li><li>';
} else if ($index == '21') {
    echo '</li><li class="no-bdb">';
}
?>
<div class="bl-col holder">
    <div class="Categ-title"><span class="<?php echo $data['classCss']; ?>"></span><?php echo '<a href="' . Yii::app()->createUrl('home/category', array('catId' => $data['id'], 'name' => ExtensionClass::utf8_to_ascii($data['name']))) . '">' . $data['name'] . '</a>'; ?></div>
    <div class="Categ-cont">
        <?php if (!in_array($index, array('1', '15', '22', '23'))) echo '<span class="hidd-trans"></span>'; ?>
        <div class="scroll-pane">        
            <ul>
                <?php
                foreach ($data['child'] as $key => $value) {
                    echo '<li><a href="' . Yii::app()->createUrl('home/category', array('catId' => $data['id'], 'name' => ExtensionClass::utf8_to_ascii($data['name']), 'childCat' => $value['id'], 'childName' => ExtensionClass::utf8_to_ascii($value['name']))) . '">' . $value['name'] . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>