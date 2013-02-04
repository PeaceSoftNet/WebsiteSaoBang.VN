<?php
 /*****
    *    class SMSObject
    *
    * description: Lop cơ bản nhận / gửi SMS 
    * 
    * @project chodientu
    * @package commerce.sms
    * @author BangTD
    * @copyright: (C) 2009 Peacesoft Solution System
    * @date 25/04/10
    * @version 2.0      
    *****/
	defined('IN_CDT') or die('Restricted Access');
    class SMSObject extends DataObjectBase 
    {
    	private $serviceID; // đầu số dịch vụ
    	private $requestId; // Request dịch vụ
    	private $userId; // Mobile nhắn tin đến
    	private $message; // Nội dung nhắn tin đến
    	private static $default = 8199;
    	private static $arrService = array(8208 => 'sms.centech.class',8708 => 'sms.centech.class',8008 => 'sms.centech.class', 8714 => 'sms.vna.class', 8199 => 'sms.vasc.class');
    	private static $arrObject = array('sms.centech.class' => 'SMSCentech', 'sms.vna.class' => 'SMSVna', 'sms.vasc.class' => 'SMSVasc');
   		/**
        * @ desc Gui sms service
        * @ param $userId  - type data int, so dien thoai do nguoi dung nhan tin den co dinh dang 84946515359
        * @ param $content - Noi dung tin nhan can gui di 
        * @ param $serviceId - Dau ma dich vu nguoi dung da nhan tin den (8208,8708,8714..)
        * @ param $requestId - ma id ngau nhien do ben nha dich vu sms gui sang
        * @ param $mobileOperator - Ma nha dich vu mobile nguoi dung dang su dung
        * @ return boolean true la gui duoc, false khong gui thanh cong
        */
    	function __construct()
    	{
    		$this->setProperty('comdb','log_sms');
    	}
    	function send($mobile,$content,$service=false,$requestId=0,$providerId = 'CDT',$isFree=true,$mobileOperator='')
        {      
			/*    
			require_once 'mobile.php';
			global $mobile_array;
			if (!in_array($mobile,$mobile_array))			
            	return;
			*/
			//return true;  
			$mobile = $this -> CheckPhone($mobile);
        	require_once ROOT_PATH.DS.'config/sms.config.php';
        	// Khởi tạo class để gửi nội dung
        	$smsClassFile=ROOT_PATH.DS.'commerce/sms/includes/'.self::$arrService[$service].'.php';
        	if (!file_exists($smsClassFile))
        		return false;
        	// Nếu gửi thành công thì ghi Log gửi thành công, nếu ko thì đưa vào Vòng đợi
        	require_once $smsClassFile;
        	//$service = 'SMS'.$service;
        	$smsCls=new self::$arrObject[self::$arrService[$service]]();
        	$result=$smsCls->sendSMS($mobile,$content,$service,$requestId,$providerId,$isFree,$mobileOperator);
        	return $result;
        }
     	/**
        * @ desc Xử lý nội dung SMS được gửi đến
        * @ return array ('result'=>true/false,'content'=>'Nội dung sẽ gửi đi nếu là true')
        */
    	function processSMS($userId,$serviceId,$content,$requestId=0,$providerId = 'CDT',$isFree=true,$mobileOperator='')
    	{
    		// Ghi log
    		//$this->insertSMS($userId,$serviceId,$content,$requestId,0);
    		// Parse content để lấy mã dịch vụ
    		$content = str_replace(array('   ','  '),' ',$content);
    		if(!$isFree)
    		{	
				$str = explode(' ',$content);
				//return ROOT_PATH.DS.'commerce'.DS.'sms'.DS.'includes'.DS.'process.'.strtoupper($str[0]).'.'.$str[1].'.php';die;
	            if(!file_exists(ROOT_PATH.DS.'commerce'.DS.'sms'.DS.'includes'.DS.'process.'.strtoupper($str[0]).'.'.strtoupper($str[1]).'.php')){
	                $replyContent = "Ma dich vu khong ton tai, xin vui long kiem tra lai!";
	            }
				$processFile= ROOT_PATH.DS.'commerce'.DS.'sms'.DS.'includes'.DS.'process.'.strtoupper($str[0]).'.'.strtoupper($str[1]).'.php';
				$ok = @file_exists($processFile);
				if (!$ok)
				{
					$replyContent='Ma dich vu ban yeu cau khong ton tai. Xin vui long thu lai';
				}
				else
				{
					$processCls=$str[0].$str[1];
					include_once($processFile); 
					$cls=new $processCls;
					$mobile = self::convertPhone($userId);
					$replyContent=$cls->process($mobile,$serviceId,$content);
					unset($cls);   	
				}
	    		// Gửi nội dung đi
	    		$ok=$this->send($userId,$replyContent,$serviceId,$requestId,$providerId,$isFree,$mobileOperator);
	    		if ($requestId>0)
	    			$this->updateSMS($ok,$requestId,$replyContent,$serviceId);
	    		return $ok;
    		}
    		else // gui mien phi
    		{
    			$serviceId = self::$default;
    			//$this -> send($userId, $content, $serviceId);
    			self::insertSMS($userId, $serviceId, $content);	
    		}
    	}
    	// Lưu các sms được nhận / gửi đi
    	function insertSMS($userId,$serviceId,$message,$requestId = 0,$success = 0)
    	{
    		$temp=explode(' ',$message);
			if (!$temp[1])
				$temp[1]='NA';
    		$data=array(
    				'phone'			=>	$userId,
    				'service'		=>	$serviceId,
    				'request_id'	=>	$requestId,
    				'msg'			=>	$message,
    				'code'			=>	$temp[0],
					'sub_code'		=>	$temp[1],
    				'time_receive'	=> 	time(),
    				'success'		=>	$success,
    				'tele_name'		=>	$this->getTeleName($userId)
    		);
    		$this->setNewData($data);
		    $id=$this->insert();
		    //print_r($this -> arrNewData);die;
			return $id;
    	}
    	function checkSms($serviceId, $requestId)
    	{
    		$row = $this -> selectOne('id',0, 'service="'.$serviceId.'" AND request_id = '.$requestId);
    		return $row;	
    	}
    	// Lưu các SMS gửi đi bị failse hoặc ko đúng giờ và sẽ gửi lại bằng cronjob
    	function insertLog($id = 0,$success = 0)
    	{
    		if ($success==0)
    			$this->query('update log_sms set resend=resend+1 where id='.$id);
    		else	
    			$this->query('update log_sms set total_mt=total_mt+1,success=1 where id='.$id);
    	}
    	// Cập nhật lại trạng thái tin nhắn gửi đi
    	function updateSMS($success = 0,$requestId, $reply_msg, $serviceId = 0)
    	{
    		$request=$this->selectOne('*',false,'request_id='.$requestId.' and `service` = "'.$serviceId.'"');
    		if (!$request)
    			return 'NOT_EXISTS';
    		if ($success==1)
    		{
    			$total_mt=$request['total_mt']+1;
    			$resend=$request['resend'];
    		}
    		else
    		{
    			$total_mt=$request['total_mt'];
    			$resend=$request['resend']+1;
    		}	
    		$data=array(
    				'reply_msg'		=>	$reply_msg,
    				'time_reply'	=> 	time(),
    				'success'		=>	$success,
    				'total_mt'		=>	$total_mt,
    				'resend'		=>	$resend
    		);
    		$this->setNewData($data);
    		return $this->update($request['id']);
    	}
		// Lấy tên nhà cung cấp Di động dựa trên đầu số điện thoại
		function getTeleName($phone)
		{
			$teleNameArray=array('VIETTEL'=>array('098','097','0168','0168','0165','0167','0169'),
								 'VMS'=>array('090','0123','0122'),
								 'GPC'=>array('091','094'),
								 'SFONE'=>array('091','092'),
								 'EVN'=>array('062','052','061','046','050','022','057','040','019','049','055','028','025','057','063','048','019','021','016','051','058','024','047','042','045','027','043','018','054','030','031','044','059','060','023','056'),
								 'HT'=>array('091','092'),
								);
			$phone1=substr($phone,0,3);
			$phone2=substr($phone,0,4);
			foreach ($teleNameArray as $teleName=>$value)
				if (isset($value[$phone1]) or isset($value[$phone2]))
					return $teleName;// Tên dịch vụ
			return 'NA';// Ko xác định
		}
    	// Kiểm tra số điện thoại có hợp lệ hay ko và convert về số hợp lệ
    	protected function CheckPhone($phone)
        {
            $arr_Mobile = array('090','091','092','093','094','095','096','097','098','099','0168','0169','0123','0122','0167','0166','0125','012','016');
            $array2 = array('08','04');
            $array3 = array('062','052','061','046','050','022','057','040','019','049','055','028','025','057','063','048','019','021','016','051','058','024','047','042','045','027','043','018','054','030','031','044','059','060','023','056');
            $array4 = array('0160','0161','0424','0425','0329','0233','0208','0209','0232','0136','0328','0137');
            $check = true;        
            if(substr($phone,0,2)=='84') {
                $Mobile = substr($phone,2,strlen($phone));
                $str2 = '0'.substr($Mobile,0,1);
                $str3 = '0'.substr($Mobile,0,2);
                $str4 = '0'.substr($Mobile,0,3);
                if(!in_array($str2,$array2)&&!in_array($str3,$array3)&&!in_array($str4,$array4)&&!in_array($str3,$arr_Mobile)&&!in_array($str4,$arr_Mobile))
                    $check = false;
            }
            if (substr($phone,0,1)=='0') 
            {
                $str2 = substr($phone,0,2);
                $str3 = substr($phone,0,3);
                $str4 = substr($phone,0,4);
                if(!in_array($str2,$array2)&&!in_array($str3,$array3)&&!in_array($str4,$array4)&&!in_array($str3,$arr_Mobile)&&!in_array($str4,$arr_Mobile))
                    $check = false;
                $phone = '84'.substr($phone,1,strlen($phone)-1);
            }
            if($check)
                return $phone;
            else
                return false;
        }
        protected function convertPhone($phone)
        {
        	$phone = '0'.substr($phone,2,strlen($phone) - 1);
        	return $phone;
        }
    }
?>