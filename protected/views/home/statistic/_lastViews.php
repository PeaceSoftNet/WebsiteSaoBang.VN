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
if ($data->locality && isset($locality[$data->locality])) {
    $localityName = $locality[$data->locality];
} else {
    $localityName = 'Toàn quốc';
}
?>
<li>    
    <span class="array1 org-clr"></span>
    <span class="array2"><?php echo $localityName; ?>: <a href="<?php echo GlobalComponents::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId); ?>"><?php echo $data->title; ?><img src="/data/new.gif" /></a></span>
    <span class="array4"><?php echo $data->domain; ?></span>
    <span class="array5 org-clr"><?php echo GlobalComponents::convertTimeValue($data->createDate); ?></span>
</li>