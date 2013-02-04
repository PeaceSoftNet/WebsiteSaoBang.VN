<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Saobang.vn - Tổng hợp thông tin mua bán, rao vặt, việc làm trên toàn quốc',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.solr.*', //import solr
        'application.extensions.solr.*', //sorl for ask to buy
    ),
    // user language (for Locale)
    'language' => 'vi',
    'defaultController' => 'ad',
    // application components
    'components' => array(
        'facebook' => array(
            'class' => 'application.extensions.SFacebook.SFacebook',
            'appId' => '390623044326695',
            'secret' => '501c429388b42d8a162edb4a34a66b48', // needed for the PHP SDK 
            'locale' => 'vi_VN',
            'oauth' => true,
            'status' => true,
            'cookie' => true,
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'CURL' => array(
            'class' => 'application.extensions.curl.Curl',
        ),
        'cache' => array(
            'class' => 'system.caching.CMemCache',
            'servers' => array(
                array(
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 60,
                ),
            ),
        ),
        //sorl
        'shopSearch' => array(
            'class' => 'CSolrComponent',
            'host' => 'localhost',
            'port' => 8984,
//            'indexPath' => '/solr'
        ),
        //sorl ask search
        'askSearch' => array(
            'class' => 'CSolrComponent',
            'host' => 'localhost',
            'port' => 8985,
//            'indexPath' => '/solr'
        ),
        //MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=saobang',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
        'dbSlave' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=saobang',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
        //solr config
        "solr" => array(
            "class" => "application.components.solr.ASolrConnection",
            "clientOptions" => array(
                "hostname" => "localhost",
                "port" => 8983,
            ),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                //ad
                'rao-vat.html' => 'ad/index',
                'rao-vat/dang-buoc-1.html' => 'ad/step1',
                'rao-vat-<categoryId:\d+>-<childCategoryId:\d+>/dang-buoc-2.html' => 'ad/step2',
                'rao-vat-d<id:\d+>/dang-buoc-3.html' => 'ad/step3',
                'tim-rao-vat-<categoryId:\d+>/<categoryName:[\w-]+>' => 'ad/search',
                'tim-rao-vat' => 'ad/search',
                'thong-bao-<id:\d+>/<title:[\w-]+>.html' => 'ad/notify',
                'rao-vat-d<id:\d+>/<categoryName:[\w-]+>/<title:[\w-]+>.html' => 'ad/detail',
                'rao-vat-<categoryId:\d+>-<childCategoryId:\d+>/<title:[\w-]+>/<childTitle:[\w-]+>.html' => 'ad/category',
                'rao-vat-<categoryId:\d+>/<title:[\w-]+>.html' => 'ad/category',
                //ask to buy
                'xac-thuc-hoi-mua-<id:\d+>' => 'ask/isAuth',
                'data/logo_<id:[\w-]+>.png' => 'external/readEmail',
                'dang-hoi-mua.htm' => 'ask/new',
                '<id:[\w-]+>.htm' => 'ask/tag',
                'hoi-mua/<title:[\w-]+>-ask<id:\d+>.htm' => 'ask/detail',
                'hoi-mua/<name:[\w-]+>-<type:\d+>.htm' => 'ask/view',
                'hoi-mua/<name:[\w-]+>.htm' => 'ask/view',
                'hoi-mua/trang-chu.htm' => 'ask/view',
                'nguoi-ban-dang-ky.html' => 'ask/shopRegister',
                'nguoi-ban-<id:\d+>/<title:[\w-]+>.html' => 'ask/shop',
                'nguoi-ban-nganh-<categoryId:\d+>/<name:[\w-]+>.html' => 'ask/listShop',
                'danh-sach-nguoi-ban.html' => 'ask/listShop',
                //user
                'tim-kiem-doi-tac-<tpid:\d+>.html' => 'email/autofind',
                '<title:[\w-]+>-tb<id:\d+>.html' => 'home/notify',
                'thong-bao.html' => 'home/notify',
                'chuyen.html' => 'external/mapCategoryChodientu',
                'tin-cung-nguoi-ban-<id:\d+>.html' => 'home/blog',
                'tin-da-dang.html' => 'home/published',
                'wg250.js' => 'Javascript/WidgetsCDT',
                'tin-dang-sieu-vip.html' => 'home/superVip',
                'tin-dang-vip.html' => 'home/vip',
                'tin-dang-da-het-han.html' => 'home/approvedTopic',
                'tin-dang.html' => 'home/pendingApprovalTopic',
                'tai-khoan-ca-nhan' => 'user/profile',
                'doi-mat-khau.html' => 'user/changerPassword',
                'dang-ky-nhan-email' => 'user/newsletter',
                'dang-rao-vat.html' => 'topic/new',
//                'tim-kiem-rao-vat.html'=>'home/seo',
                'tong-hop-rao-vat-<name:[\w-]+>-<site:\d+>' => 'home/all',
                'dang-nhap.html' => 'user/login',
                'dang-ky.html' => 'user/register',
                'ad-box-230.asb' => 'Javascript/sb230tranfer',
                //begin search
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>/<demandName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>/<demandName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName :[\w-]+>/<extName :[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName :[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName :[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName :[\w-]+>/<extName :[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName :[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName :[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                //search 1912
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<demandName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>/<demandName :[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-site<site:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-site<site:\d+>-ext<ext:\d+>.<aid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>/<demandName:[\w-]+>-p<catId:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<keyword:[\w-]+>/<demandName:[\w-]+>-p<catId:\d+>-d<did:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<keyword:[\w-]+>/<siteName:[\w-]+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>-site<site:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                //insert paging
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<demandName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>/<demandName :[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-site<site:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-site<site:\d+>-ext<ext:\d+>.<aid:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>/<demandName:[\w-]+>-p<catId:\d+>-d<did:\d+>-ext<ext:\d+>.<aid:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<keyword:[\w-]+>/<demandName:[\w-]+>-p<catId:\d+>-d<did:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<keyword:[\w-]+>/<siteName:[\w-]+>-p<catId:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>.html' => 'home/search',
                '<keyword:[\w-]+>/<siteName:[\w-]+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-ext<ext:\d+>.<aid:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>.html' => 'home/search',
                //search
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>-site<site:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>-d<did:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-ext<ext:\d+>.<aid:\d+>.html' => 'home/search',
                '<catName:[\w-]+>/<childName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>.html' => 'home/search',
                //end search 1812
                '<title:[\w-]+>-rao-vat-<seoId:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<childName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                '<title:[\w-]+>-cat<catId:\d+>-c<childCat:\d+>-s<sid:\d+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                'rao-vat-p<catId:\d+>-c<childCat:\d+>-<sid:\d+>/<keyword:[\w-]+>-page<ASolrDocument_page:\d+>.html' => 'home/search',
                //insert page
                '<title:[\w-]+>-rao-vat-<seoId:\d+>.html' => 'home/search',
                '<childName:[\w-]+>/<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>.html' => 'home/search',
                '<keyword:[\w-]+>-p<catId:\d+>-c<childCat:\d+>.html' => 'home/search',
                '<title:[\w-]+>-cat<catId:\d+>-c<childCat:\d+>-s<sid:\d+>.html' => 'home/search',
                'rao-vat-p<catId:\d+>-c<childCat:\d+>-<sid:\d+>/<keyword:[\w-]+>.html' => 'home/search',
                'rao-vat-tong-hop.html' => 'home/all',
                'quan-ly-tu-khoa-tim-kiem-theo-danh-muc' => 'administrator/searchKey',
                //hinh anh
                'dang-rao-vat-buoc-1.html' => 'topic/step1',
                'dang-rao-vat-buoc-2-cat<categoryId:\d+>-child<childCatId:\d+>.html' => 'topic/step2',
                'dang-rao-vat-buoc-3-t<tid:\d+>' => 'topic/step3',
//                'images/<code:(.*?)>.jpg' => 'external/image',
                'rao-vat/chuyen-<code:(.*?)>sb.html' => 'external/link',
                //tim kiem
                'chinh-sach-tin-vip.html' => 'home/vipRules',
                'huong-dan<id:\d+>/<title:(.*?)>sb.html' => 'home/help',
                'huong-dan.html' => 'home/help',
                'huong-dan.html' => 'home/help',
                'gioi-thieu-du-an-sao-bang.html' => 'home/aboutUs',
                'lien-he-quang-cao.html' => 'home/contactAd',
                'quy-che.html' => 'home/regulation',
                'quy-dinh-dang-tin.html' => 'home/publishedRules',
                'sitemap.xml' => 'rss/SiteMapXml',
                'thong-ke' => 'statistic/category',
                //administrator -- phan quan tri
                'quan-ly-tin-rao-vat.html' => 'topic/manager',
                'tin-rao-vat-da-duyet.html' => 'topic/PublishedTopic',
                'danh-sach-trang-crawler.html' => 'site/CrawlerSite',
                'them-moi-trang-crawler.html' => 'site/CrawlerNew',
                'quan-ly-thuoc-tinh.html' => 'category/AttributesView',
                'quan-ly-nhu-cau.html' => 'category/DemandView',
                'quan-ly-bo-loc.html' => 'category/FilterView',
                'quan-ly-chuyen-muc.html' => 'category/view',
                'them-chuyen-muc-con-<catId:\d+>-<name:[\w-]+>.html' => 'category/new',
                'cap-nhat-chuyen-muc-<id:\d+>.html' => 'category/new',
                'them-chuyen-muc.html' => 'category/new',
                'dang-xuat.html' => 'site/logout',
                //homepage
                //site login
                'login' => 'site/login',
                //chen them doan nay 18-12
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>-s<site:\d+>-d<did:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>-s<site:\d+>-d<did:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>-s<site:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>-s<site:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-s<site:\d+>-d<did:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-s<site:\d+>-d<did:\d+>.html' => 'home/category',
                //-------
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>-d<did:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>-d<did:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-s<site:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-<childCat:\d+>-s<site:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>-<catId:\d+>-<childCat:\d+>-d<did:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<childName:[\w-]+>/<demandName:[\w-]+>-<catId:\d+>-<childCat:\d+>-d<did:\d+>.html' => 'home/category',
                //-------------------------
                '<name:[\w-]+>-<catId:\d+>-<childCat:\d+>-d<did:\d+>-a<aid:\d+>.<ext:\d+>/<childName:[\w-]+>.html' => 'home/category',
                '<name:[\w-]+>-<catId:\d+>-<childCat:\d+>-a<aid:\d+>.<ext:\d+>/<childName:[\w-]+>.html' => 'home/category',
                '<name:[\w-]+>-<catId:\d+>-<childCat:\d+>-d<did:\d+>/<childName:[\w-]+>.html' => 'home/category',
                '<name:[\w-]+>-<catId:\d+>-<childCat:\d+>/<childName:[\w-]+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>-<catId:\d+>-<childCat:\d+>/<childName:[\w-]+>.html' => 'home/category',
                //parent category page
                '<name:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-a<aid:\d+>.<ext:\d+>-<did:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<demandName:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-a<aid:\d+>.<ext:\d+>-<did:\d+>.html' => 'home/category',
                //----------------------
                '<name:[\w-]+>/<siteName:[\w-]+>-<catId:\d+>-s<site:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-a<aid:\d+>.<ext:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<extName:[\w-]+>-<catId:\d+>-a<aid:\d+>.<ext:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<demandName:[\w-]+>-<catId:\d+>-d<did:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                '<name:[\w-]+>/<demandName:[\w-]+>-<catId:\d+>-d<did:\d+>.html' => 'home/category',
                '<name:[\w-]+>-<catId:\d+>-page<TopicSlaveModel_page:\d+>.html' => 'home/category',
                //bat-dong-san-6-d1-a10-e1.html.createDate
                '<name:[\w-]+>-<catId:\d+>-d<did:\d+>-a<aid:\d+>.<ext:\d+>.html' => 'home/category',
                //bat-dong-san-6.d1.html.createDate
//                '<name:[\w-]+>-<catId:\d+>-d<did:\d+>.html' => 'home/category',
//                '<name:[\w-]+>-<catId:\d+>-a<aid:\d+>-e<ext:\d+>.html' => 'home/category',
                '<name:[\w-]+>-<catId:\d+>.html' => 'home/category',
                //detail page
                '<categoryName:[\w-]+>/<childCatName:[\w-]+>/<name:[\w-]+>-t<id:\d+>c.html' => 'home/TopicDetail',
                '<categoryName:[\w-]+>/<name:[\w-]+>-t<id:\d+>c.html' => 'home/TopicDetail',
                '<name:[\w-]+>-t<id:\d+>c.html' => 'home/TopicDetail',
            ),
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error',),
//                'levels' => 'error, warning',),
                array(
                    'class' => 'CWebLogRoute',),
            ),
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);