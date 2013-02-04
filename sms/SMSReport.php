<?php
/**
 * @desc			Thống kê SMS
 * @author 			TuatNH<tuatnh@peacesoft.net> 
 * @package 		commerce
 * @subpackage 		sms
 * @version 		Id: SMSReport.php v1.0 08/10/2010 tuatnh
 * @since 			ChoDienTu 2.0
 * @copyright 		PeaceSoft (c) 2010
 *
 */
defined('IN_CDT') or die('Restricted Access');
// Check Quyen

// 
class SMSReport extends Module
{
	function __construct($row)
	{
		Module::__construct($row);
		$this->add_form(new SMSReportForm);
	}
}
class SMSReportForm extends Form
{
	function __construct()
	{
		Form::__construct('SMSReportForm');
	}
	function on_submit()
	{
		
	}    
    function draw(){
        Page::$current->registerFile('Module JS', Module::$current->path() . 'PaymentUser.js','js','footer');
        // DatePicker  
        Page::$current->registerFile('jquery.datePicker.min.js', 'webskins'.DS.'javascripts'.DS.'jquery.datePicker.min.js', 'js', 'footer' );
        Page::$current->registerFile('date.js', 'webskins'.DS.'javascripts'.DS.'date.js', 'js', 'footer' );
        Page::$current->registerFile('datepicker.css', CDT20_SKIN_PATH.'datepicker.css', 'css', 'header' );
        
 		Page::$current->setHeader('SMS Report | ChoDienTu.VN',false,false);
    	skn()->set_file('SMSReport', Module::$current->tem_file('list'));
    	skn()->set_block('SMSReport','BlockOneRow','BlockOneRow');
    	
    	$urlObj = new ClassLink();
    	
        skn()->set_var('begin_form',$this->begin(true));
		skn()->set_var('end_form',$this->end(false));         
        // Tổng phiếu thanh toán khởi tạo trong ngày
        
        require_once 'commerce/payment/includes/payment.API.class.php';
        include_once 'commerce/payment/includes/payment.config.php';
        $arrPaymentStatus = array(
        		"0" =>'Chọn trạng thái',
        		"1" => 'Chưa Thanh toán', 
        		"2" => 'Đã Thanh toán', 
        		"3" => 'Đã Thanh toán trực tiếp',
        		"4" => 'Đã Thanh toán NL',
        		"5" => 'Đã Trả lại tiền', 
        		"6" => 'Đã bị hủy');
		global $serviceNameArr;
        $paymentStatusArrayClass=array('-1'=>'icon-disagree','0'=>'icon-pay-1','1'=>'icon-agree','2'=>'icon-return-pay');
        skn()->set_var('service_option', ObjInput::getOption($serviceNameArr,ObjInput::get('service', 'str', '0')));
        
        $payment_status	= (int)ObjInput::get('payment_status','str' , '0', 'GET');
        skn()->set_var('option_payment_status', ObjInput::getOption($arrPaymentStatus,$payment_status));

		// Lấy các tham số tìm kiếm
		$s_keyword=ObjInput::get('s_keyword','str','','GET');
		skn()->set_var('s_keyword',$s_keyword);
		$s_start_date=ObjInput::get('s_start_date','str',date('d/m/Y',time()-30*24*3600),'GET');
		skn()->set_var('s_start_date',$s_start_date);
		$s_end_date=ObjInput::get('s_end_date','str',date('d/m/Y'),'GET');
		skn()->set_var('s_end_date',$s_end_date);
		$s_refer_code=ObjInput::get('s_refer_code','str','','GET');
		skn()->set_var('s_refer_code',$s_refer_code);
		$s_start_money=ObjInput::get('s_start_money','str','','GET');
		skn()->set_var('s_start_money',$s_start_money);
		$s_end_money=ObjInput::get('s_end_money','str','','GET');
		skn()->set_var('s_end_money',$s_end_money);

        // Thống kê   
        $cond=' user_id='.UserCurrent::$current->data['id'];
        
        $start_date 	= strtotime(str_replace("/" , "-" , $s_start_date));
        $end_date 		= strtotime(str_replace("/" , "-" , $s_end_date));
        
        $code 			= $s_keyword;
        $code_tt		= $s_refer_code;
        
        $serviceCode	= ObjInput::get('service','str' , '', 'GET');
         $start_money	= $s_start_money;
        $end_money		= $s_end_money;
        
        $end_date 	= strtotime(str_replace("/" , "-" , ObjInput::get('s_end_date','str' , '', 'GET')));
        
        if($code != "") $cond .= " AND id='$code'";
        if($code_tt != "") $cond .= " AND refer_code='$code_tt'";
        if($serviceCode !="") $cond .= " AND service_name='$serviceCode'";        
        if($payment_status > 0) 
        switch ($payment_status)
        {
        	case 1:	
        			$cond .= " AND payment_status = 0";    // Chưa TT
        			break;
        	case 2:
        			$cond .= " AND payment_status = 1";    // Đã TT
        			break;
        	case 3:
        			$cond .= " AND payment_status = 1 and payment_type=3";    // TT TT
        			break;
        	case 4:
        			$cond .= " AND payment_status = 1 and (payment_type=1 or payment_type=2)";    //  TT NL
        			break;
        	case 5:
        			$cond .= " AND payment_status = 2";    // Trả lại tiền
        			break;
        	case 6:
        			$cond .= " AND payment_status = -1";    // Bị hủy
        			break;								
        }
        // caculator time for search    
       $message = "";
        
       if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $s_start_date))           
	       $start_date 	= strtotime(str_replace("/" , "-" , $s_start_date));
        else 
        {
        	$start_date = strtotime(date("d/m/Y"));
        	$message = "<b>Ngày bắt đầu không hợp lệ(dd/mm/YYY).</b>";
        }
        
        if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $s_end_date))
        	$end_date 	= strtotime(str_replace("/" , "-" , $s_end_date));
        else 
        {
        	$end_date = (int)strtotime(date("d/m/Y")) + 86399;
        	$message = "<b>Ngày kết thúc không hợp lệ(dd/mm/YYY).</b>";
        }
        
       	if($end_date < $start_date)	        
        	$message .= "<b>Ngày bắt đầu phải nhỏ hơn ngày kết thúc.</b></br>";
        else
        {
        	$end_date += 86399;
        	$cond .= " AND time_created > $start_date AND time_created < $end_date";
        }
       
        // money search
        if($end_money != "" && $start_money != "")
        {
	        if(is_numeric($start_money) && $start_money > 0)
	        	$cond .= " AND money >= $start_money";
	        else 
	        	$message .= "<b>Giá bắt đầu không hợp lệ.</b><br />";
	        if(is_numeric($end_money) && $end_money > 0)
	        	$cond .= " AND money <= $end_money";
	        else 
	        	$message .= "<b>Giá kết thúc không hợp lệ.</b><br />";
        }
        
		if($message != "")
				skn()->set_var('message' , '<div class="buy-theme mar-10">'.$message.'</div>');
		else 
				skn()->set_var('message' , '');
       
		require_once 'includes/payment.object.class.php';
		$cls=new Payment();
		//echo $cond;
		$cls->query('select count(id) as totalAll,sum(money_checkout) as totalMoney from payment where '.$cond.' and payment_status=0');
		$totalWaiting=$cls->fetchAll();
		
		skn()->set_var('totalWaiting',$totalWaiting[0]['totalAll']);
		skn()->set_var('totalMoney',number_format($totalWaiting[0]['totalMoney'],0, ',', '.'));
		
		//for pagination
        $item_per_page=20;
        $page=ObjInput::get('page_no','int',1);
        $limit=($page-1)*$item_per_page.' , '.$item_per_page;
        $total=PaymentAPI::countPayment($cond);
        
 		require_once ROOT_PATH.DS.'system/utils/class.paging.php';
        skn()->set_var('pagging','<li>Tổng số: '.$total.' phiếu</li>'.ClassPaging::paging ($total,$item_per_page,5, 'page_no' , '' , '',''));
        
        skn()->set_var('total',$total);
        $payments=PaymentAPI::searchPayment('*',$cond,' id desc',$limit);
        
        $stt=($page-1)*$item_per_page+1;
        
        if ($payments)
        {
	        foreach ($payments as $payment)
	        {
	        	skn()->set_var('stt',$stt);
	        	$stt++;
	       		if ($payment['payment_status']==0)
	        		$style=' style="background-color:#FFFFFF"';
	        	elseif ($payment['payment_status']==1)
	        		$style=' style="background-color:#B6C2E4"';
	        	else
	        		$style=' style="background-color:#ECCADA"';
	        	if ($stt%2==0)
	        		skn()->set_var('row_class','class="bg"'.$style);
	        	else
	        		skn()->set_var('row_class',$style);
	        	skn()->set_var('id',$payment['id']);
	        	skn()->set_var('detail_link',PaymentAPI::detailLink($payment['id']));
	        	skn()->set_var('service_code',$payment['service_code']);
	        	skn()->set_var('service_name',$payment['service_name']);
				skn()->set_var('service_link',PaymentAPI::serviceLink($payment['service_code'],$payment['service_name']));
				skn()->set_var('service_description',$serviceNameArr[$payment['service_name']]);
	        	skn()->set_var('refer_code',($payment['refer_code']!='')?$payment['refer_code']:'-');
	        	skn()->set_var('money_checkout',number_format($payment['money_checkout'],0, ',', '.'));
	        	skn()->set_var('payment_status',$paymentStatusArray[$payment['payment_status']]);
				skn()->set_var('payment_status_class',$paymentStatusArrayClass[$payment['payment_status']]);
	         	skn()->set_var('time_create',date('d/m/Y h:i',$payment['time_created']));
				// Thao tac
				$button='-';
				if ($payment['payment_status']==0)
					$button='<a class="button-1" href="javascript:cancelPayment('.$payment['id'].');"><span><b>Hủy</b></span></a><a class="button-1" href="'.PaymentAPI::detailLink($payment['id']).'"><span><b>Thanh toán</b></span></a>';
	        	skn()->set_var('operator_link',$button);
	        	$html.=skn()->output('BlockOneRow');
	        }
        }
		skn()->set_var('BlockOneRow',$html);
        $html = skn()->output('SMSReport');
        skn()->vreset();
        return $html;       
    }
}