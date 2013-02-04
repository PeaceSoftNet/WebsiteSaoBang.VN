<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
class SMSObject {

    /**
     * insert sms to db
     * Lưu các sms được nhận / gửi đi
     */
    function insertSMS($userId, $serviceId, $message, $requestId = 0, $success = 0) {
        $temp = explode(' ', $message);
        if (!$temp[1])
            $temp[1] = 'NA';
        $model = new SmsModel;
        $model->phone = $userId;
        $model->service = $serviceId;
        $model->requestId = $requestId;
        $model->msg = $message;
        $model->code = $temp[0];
        $model->subCode = $temp[1];
        $model->timeReceive = time();
        $model->success = $success;
        $model->teleName = self::getTeleName($userId);
        if ($model->validate()) {
            $model->save();
        }
        return $userId;
    }

    /**
     * get telephone name
     * @param type $phone
     * @return string 
     */
    function getTeleName($phone) {
        $phone = self::CheckPhone($phone);
        $teleNameArray = array('VIETTEL' => array('098', '097', '0168', '0168', '0165', '0167', '0169'),
            'VMS' => array('090', '0123', '0122'),
            'GPC' => array('091', '094'),
            'SFONE' => array('091', '092'),
            'EVN' => array('062', '052', '061', '046', '050', '022', '057', '040', '019', '049', '055', '028', '025', '057', '063', '048', '019', '021', '016', '051', '058', '024', '047', '042', '045', '027', '043', '018', '054', '030', '031', '044', '059', '060', '023', '056'),
            'HT' => array('091', '092'),
        );
        $phone1 = substr($phone, 0, 3);
        $phone2 = substr($phone, 0, 4);
        foreach ($teleNameArray as $teleName => $value)
            if (isset($value[$phone1]) or isset($value[$phone2]))
                return $teleName; // Tên dịch vụ
                return 'NA'; // Ko xác định
    }

    /**
     * @ desc Xử lý nội dung SMS được gửi đến
     * @ return array ('result'=>true/false,'content'=>'Nội dung sẽ gửi đi nếu là true')
     */
    function processSMS($userId, $serviceId, $content, $requestId = 0, $providerId = 'SB', $isFree = true, $mobileOperator = '') {
        // Ghi log
        //$this->insertSMS($userId,$serviceId,$content,$requestId,0);
        // Parse content để lấy mã dịch vụ
        $content = str_replace(array('   ', '  '), ' ', $content);
        $replyContent = 'Ma so tin nhan cua ban khong hop le. Vui long thu lai.';
        if (!$isFree) {
            $str = explode(' ', $content);
            if (!isset($str[1])) {
                echo 'error';
            } else if ($str[1] == 'VIP' || strtolower($str[1]) == strtolower('VIP')) {
                $topicByCode = TopicModel::model()->find('`code` = ' . $requestId);
                $model = TopicModel::model()->findByPk($topicByCode->id);
                if ($model) {
                    $topicAd = TopicAd::model()->findByPk($topicByCode->id);
                    if ($topicAd) {
                        if ($topicAd->timeValue > time()) {
                            $topicAd->timeValue = $topicAd->timeValue + 3 * 24 * 60 * 60;
                        } else {
                            $topicAd->timeValue = time() + 3 * 24 * 60 * 60;
                        }
                        $topicAd->sms = 1;
                        $topicAd->update();
                        $replyContent = 'Ban da gia han VIP them 3 ngay tin: ' . $topicAd->title;
                    } else {
                        $topicAd = new TopicAd;
                        $topicAd->id = $model->id;
                        $topicAd->title = $model->title;
                        $topicAd->categoryId = $model->categoryId;
                        $topicAd->icon = $model->icon;
                        $topicAd->authorId = $model->authorId;
                        $topicAd->price = $model->price;
                        $topicAd->timeValue = time() + 3 * 24 * 60 * 60;
                        $topicAd->sms = 1;
                        if ($topicAd->validate()) {
                            $topicAd->save();
                            $replyContent = 'Ban da dang VIP 3 ngay tin: ' . $topicAd->title;
                        }
                    }
                }
                //dang tin vip
            } else if ($str[1] == 'UP') {
                //up tin tu dong
            } else {
                //find user in system
            }
            // Gửi nội dung đi
            $ok = SMSCentech::sendSMS($userId, $replyContent, $serviceId, $requestId, $providerId, $isFree, $mobileOperator);
            return $ok;
        }
    }

    /**
     * Kiểm tra số điện thoại có hợp lệ hay ko và convert về số hợp lệ
     */
    protected function CheckPhone($phone) {
        $arr_Mobile = array('090', '091', '092', '093', '094', '095', '096', '097', '098', '099', '0168', '0169', '0123', '0122', '0167', '0166', '0125', '012', '016');
        $array2 = array('08', '04');
        $array3 = array('062', '052', '061', '046', '050', '022', '057', '040', '019', '049', '055', '028', '025', '057', '063', '048', '019', '021', '016', '051', '058', '024', '047', '042', '045', '027', '043', '018', '054', '030', '031', '044', '059', '060', '023', '056');
        $array4 = array('0160', '0161', '0424', '0425', '0329', '0233', '0208', '0209', '0232', '0136', '0328', '0137');
        $check = true;
        if (substr($phone, 0, 2) == '84') {
            $Mobile = substr($phone, 2, strlen($phone));
            $str2 = '0' . substr($Mobile, 0, 1);
            $str3 = '0' . substr($Mobile, 0, 2);
            $str4 = '0' . substr($Mobile, 0, 3);
            if (!in_array($str2, $array2) && !in_array($str3, $array3) && !in_array($str4, $array4) && !in_array($str3, $arr_Mobile) && !in_array($str4, $arr_Mobile))
                $check = false;
        }
        if (substr($phone, 0, 1) == '0') {
            $str2 = substr($phone, 0, 2);
            $str3 = substr($phone, 0, 3);
            $str4 = substr($phone, 0, 4);
            if (!in_array($str2, $array2) && !in_array($str3, $array3) && !in_array($str4, $array4) && !in_array($str3, $arr_Mobile) && !in_array($str4, $arr_Mobile))
                $check = false;
            $phone = '84' . substr($phone, 1, strlen($phone) - 1);
        }
        if ($check)
            return $phone;
        else
            return false;
    }

    /**
     * convert phone
     * @param string $phone
     * @return string 
     */
    protected function convertPhone($phone) {
        $phone = '0' . substr($phone, 2, strlen($phone) - 1);
        return $phone;
    }

}