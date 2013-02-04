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
$yii = dirname(__FILE__) . '/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

$debug = isset($_GET['debug']) ? $_GET['debug'] : '';
if ($debug) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
}

defined('SERVER_MEDIA') or define('SERVER_MEDIA', 'http://media.saobang.vn');
defined('SERVER_DATA') or define('SERVER_DATA', '/data');
defined('YII_MEMCACHE') or define('YII_MEMCACHE', true);
defined('YII_ROOT_FOLDER') or define('YII_ROOT_FOLDER', dirname(__FILE__));
//Set default timezone
date_default_timezone_set('Asia/Saigon');

ini_set('upload_max_filesize', '4M');

Class SQLInjection {

    static function Check() {
        $query_string = strtolower($_SERVER['QUERY_STRING']);
        if (strpos($query_string, 'union') > 0) {
            die('Access denied!!!');
        } else {
            if (strpos($query_string, 'showthread.php') > 0) {
                header("url=http://saobang.vn");
            }
            if (strpos($query_string, 'market_id') > 0) {
                header("url=http://saobang.vn");
            }
        }
    }

}

SQLInjection::Check();

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once($yii);
Yii::createWebApplication($config)->run();