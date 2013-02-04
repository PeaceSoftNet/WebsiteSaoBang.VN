<?php

$rss = '<?xml version="1.0" encoding="utf-8" ?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

if (isset($content)) {
    foreach ($content as $data) {
        if(isset($data['id'])  && isset($data['title']))
        $rss .= '<url>
                    <loc>' . $host . Yii::app()->createUrl('home/TopicDetail', array('id' => $data['id'], 'name' => ExtensionClass::utf8_to_ascii($data['title']))) . '</loc>
                    <changefreq>hourly</changefreq>
                    <priority>0.5</priority>
                </url>';
    }
}
$rss .= '</urlset>';

echo $rss;

$filePath = 'data/sitemap_' . $page . '.xml';
$fp = fopen($filePath, 'w');
fwrite($fp, $rss);
fclose($fp);

header("refresh:8;url=" . Yii::app()->createUrl('rss/topicContent'));


