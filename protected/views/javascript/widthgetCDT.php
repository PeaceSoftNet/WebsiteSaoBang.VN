<?php

echo 'document.write(\'<link rel="stylesheet" type="text/css" href="http://' . $_SERVER['HTTP_HOST'] . '/themes/app/css/wiget-saobang.css">\');';
$itemPrint = '<div class="box-wsb" style="width:' . $withValue . 'px"><div class="g-title"><h3><span style="text-transform: none"> Saobang.vn - Số 1 rao vặt</span></h3></div><div class="wsb-cosnt"><ul>';
foreach ($dataProvider as $index => $data) {
    if ($index == 14) {
        $itemPrint .= '<li class="clearfix bottom last">';
    } else {
        $itemPrint .= '<li class="clearfix">';
    }
    if ($data->icon)
        $itemPrint .= '<a target="_black" href="' . $domain . Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title))) . '" class="img80"><img style="max-height: 80px" width="80px" src="' . GlobalComponents::processIcon($data->icon) . '"/></a>';
    $itemPrint .= '<h2><a target="_black" href="' . $domain . Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title))) . '">' . $data->title . '</a></h2>';
    if ($data->price && $data->price > 10000)
        $itemPrint .= '<p class="price">' . GlobalComponents::numberFomat($data->price) . ' vnd</p>';
    $itemPrint .= '<p class="timeup">' . GlobalComponents::convertTimeValue($data->createDate) . ' tại <a href="' . $domain . Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title))) . '">' . $data->domain . '</a></p>';
    $itemPrint .= '</li>';
}
$itemPrint .= '</ul></div></div>';

echo 'document.write(\'' . $itemPrint . '\')';
