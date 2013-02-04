<?php

class ListSMS extends Module
{
	function __construct($row)
	{
		Module::__construct($row);
		$this->add_form(new ListSMSForm());
	}
}
class ListSMSForm extends Form
{
	function __construct()
	{
		Form::__construct('ListSMSForm');
		
	}
	function on_submit()
	{
	
	}
	function draw()
	{
		require_once 'system/utils/date_time.helper.php';
		skn() -> set_var('begin', $this ->begin(true));
		
		$html='';
		skn()->set_file('ListSMSForm',Module::tem_file('list_sms'));
		$timeFrom = ObjInput::get('time_from', 'def', '');
		$timeTo = ObjInput::get('time_to', 'def', '');
		skn() -> set_var('time_from',$timeFrom);
		skn() -> set_var('time_to',$timeTo);
		if($timeFrom)
			$timeFrom = DateTimeHelper::toTime($timeFrom);
		else
			$timeFrom = 0;
		if($timeTo)
			$timeTo = DateTimeHelper::toTime($timeTo) + 86400;
		else
			$timeTo = time();
		//echo date('d/m/Y',$timeFrom),',',date('d/m/Y',$timeTo);
		//Time_Receive, Service_ID
		$sql = 'select success, count(id) as total, service from log_sms where time_receive >= '.$timeFrom.' and time_receive < '.$timeTo.' and service like "%08" group by service,success';
		comdb() -> query($sql);
		$sms = comdb() -> fetchall();
		//$arrTotalVietel = array();//VIETEL,VMS
		//$arrTotalVMS = array();
		//$arrTotalOrther = array();
		$arrTotal = array();
		if($sms)
		{
			foreach($sms as $row)
			{
				/*if($row['mobi_operator'] == 'VIETEL')
					$arrTotalVietel[$row['Service_ID']]['VIETEL'][$row['Success']] += $row['total'];
				elseif($row['mobi_operator'] == 'VMS')
					$arrTotalVMS[$row['Service_ID']]['VMS'][$row['Success']] += $row['total'];
				else
					$arrTotalOrther[$row['Service_ID']][$row['ORTHER']][$row['Success']] += $row['total'];*/
				$arrTotal[$row['service']][$row['success']] += $row['total'];
			}
		}
		
		$list = '<br>Đầu số 8208: <br>';
		/*$list .= '- Viettel: </br>'.($arrTotalVietel['8208']['VIETEL'][1] + $arrTotalVietel['8208']['VIETEL'][0]);
		$list .= '		-- Thanh cong: '.$arrTotalVietel['8208']['VIETEL'][1].'</br>'; 
		$list .= '		-- That bai: '.$arrTotalVietel['8208']['VIETEL'][0].'</br>';
		// vms 
		$list .= '- Vms: </br>'.($arrTotalVietel['8208']['VMS'][1] + $arrTotalVietel['8208']['VMS'][0]);
		$list .= '		-- Thanh cong: '.$arrTotalVietel['8208']['VMS'][1].'</br>'; 
		$list .= '		-- That bai: '.$arrTotalVietel['8208']['VMS'][0].'</br>';
		// mang khac
		$list .= '- mang khac: </br>'.($arrTotalVietel['8208']['ORTHER'][1] + $arrTotalVietel['8208']['ORTHER'][0]);
		$list .= '		-- Thanh cong: '.$arrTotalVietel['8208']['ORTHER'][1].'</br>'; 
		$list .= '		-- That bai: '.$arrTotalVietel['8208']['ORTHER'][0].'</br>';*/
		$list .= 'Tông số: '.($arrTotal[8208][0] + $arrTotal[8208][1]).'<br>';
		$list .= '		Tông số thanh cong: '.($arrTotal[8208][1]).'<br>';
		$list .= '		Tông số khong thanh cong: '.($arrTotal[8208][0]).'<br>';
		$list .= '<br>---------------------------<br>';
		// dau so 8708
		$list .= 'Đầu số 8708: <br>';
		/*$list .= '- Viettel: </br>'.($arrTotalVietel['8708']['VIETEL'][1] + $arrTotalVietel['8708']['VIETEL'][0]);
		$list .= '		-- Thanh cong: '.$arrTotalVietel['8708']['VIETEL'][1].'</br>'; 
		$list .= '		-- That bai: '.$arrTotalVietel['8708']['VIETEL'][0].'</br>';
		// vms 
		$list .= '- Vms: </br>'.($arrTotalVietel['8708']['VMS'][1] + $arrTotalVietel['8708']['VMS'][0]);
		$list .= '		-- Thanh cong: '.$arrTotalVietel['8708']['VMS'][1].'</br>'; 
		$list .= '		-- That bai: '.$arrTotalVietel['8708']['VMS'][0].'</br>';
		// mang khac
		$list .= '- mang khac: </br>'.($arrTotalVietel['8708']['ORTHER'][1] + $arrTotalVietel['8708']['ORTHER'][0]);
		$list .= '		-- Thanh cong: '.$arrTotalVietel['8708']['ORTHER'][1].'</br>'; 
		$list .= '		-- That bai: '.$arrTotalVietel['8708']['ORTHER'][0].'</br>';*/
		$list .= 'Tông số: '.($arrTotal[8708][1] + $arrTotal[8708][0]).'<br>';
		$list .= '		Tông số thanh cong: '.($arrTotal[8708][1]).'<br>';
		$list .= '		Tông số khong thanh cong: '.($arrTotal[8708][0]).'<br>';
		$list .= '</br>';
		$sql = 'select tele_name,success, count(id) as total, service from log_sms where time_receive >= '.$timeFrom.' and time_receive < '.$timeTo.' and service = "8714" group by success,tele_name';
		comdb() -> query($sql);
		$sms = comdb() -> fetchall();
		$arrTotalVietel = array();//VIETEL,VMS
		$arrTotalVMS = array();
		$arrTotalOrther = array();
		$arrTotal = array();
		if($sms)
		{
			foreach($sms as $row)
			{
				if($row['tele_name'] == 'VIETEL')
					$arrTotalVietel[$row['success']] += $row['total'];
				elseif($row['tele_name'] == 'VMS')
					$arrTotalVMS[$row['success']] += $row['total'];
				else
					$arrTotalOrther[$row['success']] += $row['total'];
				$arrTotal[$row['success']] += $row['total'];
			}
		}
		$list .= '<br>------------------------------------------<br>';
		$list .= 'Đầu số 8714: <br>';
		$list .= '- Viettel: '.($arrTotalVietel[1] + $arrTotalVietel[0]).'<br>';
		$list .= '		-- Thanh cong: '.$arrTotalVietel[1].'<br>'; 
		$list .= '		-- That bai: '.$arrTotalVietel[0].'<br>';
		// vms 
		$list .= '- Vms: '.($arrTotalVMS[1] + $arrTotalVMS[0]).'<br>';
		$list .= '		-- Thanh cong: '.$arrTotalVMS[1].'<br>'; 
		$list .= '		-- That bai: '.$arrTotalVMS[0].'<br>';
		// mang khac
		$list .= '- mang khac:'.($arrTotalOrther[1] + $arrTotalOrther[0]).'<br>';
		$list .= '		-- Thanh cong: '.$arrTotalOrther[1].'<br>'; 
		$list .= '		-- That bai: '.$arrTotalOrther[0].'<br>';
		$list .= 'Tông số: '.($arrTotal[1] + $arrTotal[0]).'<br>';
		$list .= '		Tông số thanh cong: '.($arrTotal[1]).'<br>';
		$list .= '		Tông số khong thanh cong: '.($arrTotal[0]).'<br>';
		$list .= '<br>';
		skn() -> set_var('end', $this ->begin(true));
		skn() -> set_var('list', $list);
		$html = skn()->output('ListSMSForm');
		return $html;
	}
}
