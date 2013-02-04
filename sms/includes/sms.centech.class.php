<?php
  /*****
    *    class SMSCentech
    *
    * description: Lop Sms của Centech 
    * 
    * @project chodientu
    * @package commerce.sms
    * @author BangTD
    * @copyright: (C) 2009 Peacesoft Solution System
    * @date 25/11/09
    * @version 2.0      
    *****/
	defined('IN_CDT') or die('Restricted Access');
    class SMSCentech
    {
    	private $password='ps8x08';
    	private $userName='peacesoft';
    	private $url='http://118.69.195.236:9215/smsmt';
    	private $serviceIds=array(8208 => 1, 8508 => 1, 8608 => 1, 8708 => 1,8008=>1);
    	/**
        * @ desc Gui sms service
        * @ param $userId  - type data int, so dien thoai do nguoi dung nhan tin den co dinh dang 84946515359
        * @ param $content - Noi dung tin nhan can gui di 
        * @ param $serviceId - Dau ma dich vu nguoi dung da nhan tin den (8208,8708,8714..)
        * @ param $requestId - ma id ngau nhien do ben nha dich vu sms gui sang
        * @ return boolean true la gui duoc, false khong gui thanh cong
        */
    	function sendSMS($userId,$content,$serviceId,$requestId=0,$serviceCode='CDT',$isFree=true,$mobileOperator='')
    	{
    		$userName = $this->userName;
    		$password = $this->password;
            $url = $this->url;
            if($this->serviceIds[$serviceId] == 1)
            {
                $msgtitle = '';
                //kiểm tra số điện thoại nhận SMS
                $result = 0;                                
                $arr_param = array(
                    'src'             	=> $serviceId,    // đầu số sử dụng
                    'dest'             	=> $userId,    // số điện thoại nhận sms
                    'mtseq'            	=> time(),    //
                    'msgtype'         	=> 'text',    // kiểu dữ liệu
                    'msgtitle'        	=> urlencode($msgtitle), // title tin nhắn (phải encode)
                    'msgbody'         	=> urlencode($content), //SMS text message (phải encode)        
                    'moseq'         	=> $requestId, // int 32, MO message number
                    'procresult'    	=> $isFree,
                    'mttotalseg'    	=> 1,
                    'mtsegref'        	=> 1,
                    'cpid'            	=> '10036',
                    'serviceid'        	=> 1,            
                    'username'         	=> $userName, //varchar(20)
                    'password'         	=> $password, //varchar(20)
                );
                $params = '';
                foreach ($arr_param as $key=>$value)
                {
                    if ($params === '')
                        $params .= '?'.$key.'='.$value;
                    else
                        $params .= '&'.$key.'='.$value;
                }    
                
                $url = $url.$params;  
                //$cache = Cache::getCache('file');
			    //$cache->set('centech',$url,10000000000,'centech', CACHE_FILE_PATH);
               // echo $url;            
                $ch = curl_init(); 
                curl_setopt($ch, CURLOPT_HTTPGET,TRUE);        //CENTECH chỉ chấp nhận phương thức HTTP GET
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_HEADER, 'Content-type: application/x-www-form-urlencoded');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE); 
                curl_exec($ch);
                $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);            
                curl_close ($ch);            
                // $response_code = 200: gửi thành công
                // $response_code = 400: sai tham số hoặc cú pháp
                // $response_code = 403: sai username hoặc password
                //return $response_code;             
                if ($response_code == 200)
                { 
                   // $result = 1;
                   return 1;
                }
                else
                {
                    //$result = -1;    //không gửi được tin nhắn     
                	return -1;
                }                                           
                //return $result;
            }
            else
                return false;
           
    	}
    }
?>