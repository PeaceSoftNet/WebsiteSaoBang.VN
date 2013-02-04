<?php
/*****
 *    class CDT.RVIP
 *
 * description: Lop CDT.RVIP mua tin VIP
 *
 * @project chodientu
 * @package commerce.sms
 * @author HieuLC
 * @copyright: (C) 2009 Peacesoft Solution System
 * @date 29/04/10
 * @version 2.0
 *****/
defined('IN_CDT') or die('Restricted Access');

require_once ROOT_PATH . DS . 'commerce' . DS . 'user' . DS . 'includes' . DS . 'user.common.php';

require_once ROOT_PATH.DS.'commerce'.DS.'raovat'.DS.'includes'.DS.'raovat.order.object.class.php';
require_once ROOT_PATH.DS.'commerce'.DS.'raovat'.DS.'includes'.DS.'raovat.advertisement.object.class.php';
require_once ROOT_PATH.DS.'commerce'.DS.'raovat'.DS.'includes'.DS.'define.php';

class CDTRVIP
{
    /**
     * @ param $userId  - type data int, so dien thoai do nguoi dung nhan tin den co dinh dang 84946515359
     * @ param $content - Noi dung tin nhan người dùng gửi đến
     * @ param $serviceId - Dau ma dich vu nguoi dung da nhan tin den (8208,8708,8714..)
     * @ return boolean true la gui duoc, false khong gui thanh cong
     *
     **/
    function process($phoneNo=false, $serviceId, $content)
    {
        if ($serviceId!=VIP_SERVICE_ID)
            return      'Dau so ban nhan khong dung. Hay soan tin CDT RVIP Matin va gui den '.VIP_SERVICE_ID;
        // Xử lý các nghiệp vụ dựa trên yêu cầu nêu trong $content;
        $str_error     = "Tin nhan sai cu phap. Vui long gui CDT RVIP MaTin va gui den ".VIP_SERVICE_ID;
        //Co ki tu dac biet -> sai cu phap
        //[\^$.|?*+()
        if (preg_match('/[\[\]\\\^\$\.\|\?\*\+\(\)]+/', $content)) {
            return $str_error;
        }

        //nếu tin nhắn đúng cú pháp
        if (preg_match('/^CDT\s+RVIP\s+([0-9]+)$/i', $content, $matches)) {
            //nhắn tin theo mã tin
            $adId = $matches[1];

            //Process: Kiểm tra tin rao có tồn tại hay không            
            
            $adObj = new Advertisement();
            try {
                $arrAd = $adObj->getOneInfo($adId,'id,category_id, category_parent_id, user_id');
            }
            catch (Exception $e) {
                return 'Tin rao vat ' . $adId . ' khong ton tai tren he thong';
            }
            
            //kiem tra xem trong bang tin VIP co tin dang mua hay ko
            $vipAds = $adObj->getOneVipAd('id, time_end',$adId,'time_end >='.time());
            
            if (sizeof($vipAds)>0)
            {
            	//nếu có thì cộng thêm số ngày, mặc định là 3 ngày
            	$newTimeEnd = $vipAds['time_end'] + 86400*VIP_DAYS_AD_BY_SMS;
				$data = array('time_end' => $newTimeEnd);
				$adObj->updateVipAd($data, $adId);
            }
            else
            {
            	//neu ko co tin trong bang tin VIP, them moi 
            	$dataInsert = array(
									   		'id'=>$adId,					   	
										   	'type'=>NORMAL_VIP, //mặc định tin vip thường.					
											'time_start' => time(),
										   	'time_end'=> time() + 86400*VIP_DAYS_AD_BY_SMS		
									   	);
				if ($arrAd['category_id'] > 0)
					$dataInsert['category_id'] = $arrAd['category_id'];
				else 
					$dataInsert['category_id'] = $arrAd['category_parent_id'];
				if ($arrAd['user_id'] > 0)
					$dataInsert['user_id'] = $arrAd['user_id'];
				$adObj->insertMultiVipAd(array($dataInsert));	
            }
            
            //trả về kết quả
            $str_ret = 'Tin rao ' . $adId . ' da duoc cong them ' . VIP_DAYS_AD_BY_SMS . ' ngay hien thi VIP o dau danh muc';
            
            return $str_ret;
        }        
        else 
        {
            return $str_error;
        }
        // Trả về là nội dung sẽ reply cho người dùng
        return TRUE;
    }
}
?>