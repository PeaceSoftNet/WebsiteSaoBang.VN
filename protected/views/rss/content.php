<?php

$data = '<?xml version="1.0" encoding="utf-8" ?>';
$data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	  xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$data .= '<url>
            <loc>' . $host . '</loc>
            <changefreq>hourly</changefreq>
            <priority>1</priority>
        </url>';
if (isset($categories)) {
    foreach ($categories as $category) {
        $data .= '<url>
                    <loc>' . $host . $category . '</loc>
                    <changefreq>hourly</changefreq>
                    <priority>0.8</priority>
                </url>';
    }
}
# Các link fix cứng 
# Đăng nhập
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('user/login') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
# Đăng ký
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('user/register') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
# Hướng dẫn
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'huong-dan-dang-ky-dang-nhap')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
# Giới thiệu
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/aboutUs') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
#Liên hệ quảng cáo
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/contactAd') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
# Quy chế
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/regulation') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
#Quy định đăng tin
$data .= '<url>
            <loc>' . $host . '/home/publishedRules</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
#Huong dẫn đăng ký đăng nhập
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'huong-dan-dang-ky-dang-nhap')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
#Huong dẫn đăng tin vip
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'dang-tin-rao-vat')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
#Hướng dẫn mua tin vip
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'huong-dan-mua-tin-vip')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
#Hướng dẫn quản lý tin giao vặt
$data .= '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'quan-ly-tin-rao-vat')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
if (isset($content)) {
    foreach ($content as $value) {
        
    }
    $topic = json_decode($value);
    foreach ($topic as $key => $link) {
        $data .= '<url>
                    <loc>' . $host . $link . '</loc>
                    <changefreq>hourly</changefreq>
                    <priority>0.5</priority>
                </url>';
    }
}
$data .= '</urlset>';

echo $data;
?>
