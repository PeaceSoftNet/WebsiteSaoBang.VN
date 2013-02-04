<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <?php
    echo '<url>
            <loc>' . $host . '/tim-kiem-rao-vat.html</loc>
            <changefreq>hourly</changefreq>
            <priority>1</priority>
        </url>';
    echo '<url>
            <loc>' . $host . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.9</priority>
        </url>';
    if (isset($listKey)) {
        foreach ($listKey as $key => $keyword) {
            if ($key < 50)
                echo '<url>
                    <loc>' . $host . Yii::app()->createUrl('home/search', array('sid' => $keyword['id'], 'catId' => $keyword['categoryId'], 'childCat' => $keyword['childCatId'], 'title' => ExtensionClass::utf8_to_ascii($keyword['name']))) . '</loc>
                    <changefreq>hourly</changefreq>
                    <priority>0.9</priority>
                </url>';
        }
    }

    if (isset($categories)) {
        foreach ($categories as $category) {
            echo '<url>
                    <loc>' . $host . $category . '</loc>
                    <changefreq>hourly</changefreq>
                    <priority>0.9</priority>
                </url>';
        }
    }

    # Các link fix cứng 
    # Đăng nhập
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('user/login') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    # Đăng ký
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('user/register') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    # Hướng dẫn
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'huong-dan-dang-ky-dang-nhap')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    # Giới thiệu
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/aboutUs') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    #Liên hệ quảng cáo
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/contactAd') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    # Quy chế
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/regulation') . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    #Quy định đăng tin
    echo '<url>
            <loc>' . $host . '/home/publishedRules</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    #Huong dẫn đăng ký đăng nhập
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'huong-dan-dang-ky-dang-nhap')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    #Huong dẫn đăng tin vip
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'dang-tin-rao-vat')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    #Hướng dẫn mua tin vip
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'huong-dan-mua-tin-vip')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    #Hướng dẫn quản lý tin giao vặt
    echo '<url>
            <loc>' . $host . Yii::app()->createUrl('home/help', array('contentCode' => 'quan-ly-tin-rao-vat')) . '</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>';
    ?>
</urlset>