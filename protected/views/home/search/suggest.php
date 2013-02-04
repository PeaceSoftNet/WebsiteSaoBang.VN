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
$linkSuggest = 'http://google.com/complete/search?output=toolbar&q=' . urldecode($keyword);
$content = simplexml_load_file($linkSuggest);
if ($content) {
    echo '<div class="ntc-cont">Tìm kiếm liên quan đến <strong><em>' . $keyword . '</em></strong>: ';
    foreach ($content as $key => $value) {
        $value = $value->children()->attributes();
        foreach ($value as $key => $item) {
            $keyEncode = ExtensionSearch::utf8_to_ascii($item);
            echo '<a href="' . Yii::app()->createUrl('home/search', array('keyword' => ExtensionClass::utf8_to_ascii($item), 'catId' => 0, 'childCat' => 0)) . '">' . $item . '</a>, ';
        }
    }
    echo '... <a title="rao vặt khác" class="viewmore" target="_black" href="' . Yii::app()->createUrl('home/seo') . '">xem thêm</a>';
    echo '</div>';
}