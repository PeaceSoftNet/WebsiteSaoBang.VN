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
$data = '<?xml version="1.0" encoding="utf-8" ?>';
$data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	  xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';


foreach ($dataProvider as $index => $dataValue) {
    $data .= '<url>
                    <loc>' . $dataValue->link . '</loc>
                    <changefreq>always</changefreq>
                    <priority>0.9</priority>
                </url>';
}

$data .= '</urlset>';

echo $data;

$value = Yii::app()->cache->get('currentSiteMapTopicDetail');
if ($value === false) {
    $value = 0;
    Yii::app()->cache->set('currentSiteMapTopicDetail', $value);
} else {
    $value++;
    Yii::app()->cache->set('currentSiteMapTopicDetail', $value);
}

$filePath = 'data/sitemap_' . (200 - $value) . '.xml';
$fp = fopen($filePath, 'w+');
fwrite($fp, $data);
fclose($fp);

header("refresh:6;url=" . Yii::app()->createUrl('seo/createSystemMap'));