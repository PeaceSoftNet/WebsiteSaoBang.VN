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
?>