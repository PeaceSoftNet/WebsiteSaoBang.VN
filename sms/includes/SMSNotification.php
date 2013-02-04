<?php
   /*****
    *    class SMS để gửi tin nhắn đi
    *
    * description: Lop Sms 
    * 
    * @project chodientu
    * @package commerce.sms
    * @author BangTD
    * @copyright: (C) 2009 Peacesoft Solution System
    * @date 25/4/10
    * @version 2.0      
    *****/
	defined('IN_CDT') or die('Restricted Access');
    class SMSNotification
    {
		/**
        * @ desc Gui sms notification
        * @ param: $mobile - type data string, So dien thoai can gui toi (format chuan so dien thoai ex: 0946515359)
        * @ param: $content - Noi dung tin nhan can gui di (format la tieng viet khong dau va ko qua 160 ky tu)
        * @ param: $applicationCode - Tên dịch vụ ứng dụng, dùng để tra cứu và lọc: Ví dụ UpgradeEstore
        * @ param: $service - Tên dịch vụ sẽ gửi SMS đi, mặc định để failse trừ khi muốn chỉ định 1 dịch vụ cụ thể
        * * @ return boolean
        */
        static public function send($mobile,$content,$applicationCode,$service=false)
        {            
			require_once 'mobile.php';
			/*
			global $mobile_array;
			if (!in_array($mobile,$mobile_array))			
            	return;
        	*/
			require_once ROOT_PATH.DS.'config/sms.config.php';
        	// Đọc cấu hình gửi SMS mặc định nếu ko truyền vào $service
        	if (!$service)
				$service=DEFAULT_SMS_GATEWAY;
			$serviceID=DEFAULT_SMS_SERVICE;	        
        	// Khởi tạo class để gửi nội dung
        	$smsClassFile=ROOT_PATH.DS.'commerce/sms/includes/sms.'.strtolower($service).'.class.php';
        	if (!file_exists($smsClassFile))
        		return false;
        	// Nếu gửi thành công thì ghi Log gửi thành công, nếu ko thì đưa vào Vòng đợi
        	require_once $smsClassFile;
        	$service = 'SMS'.$service;
        	$smsCls=new $service();
        	$result=$smsCls->sendSMS($mobile,$content,$serviceID);
        	// Ghi log
        	return $result;
        }
    }
?>