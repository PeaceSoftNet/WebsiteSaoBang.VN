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
class SmsController extends Controller {

    protected $__USERNAME = 'saobang';
    protected $__PASSWORD = 'saobang2012$$08';

    public function init() {
        return parent::init();
    }

    /**
     *  return response code for centech sms center 
     */
    public function filters() {
        header("HTTP/1.1 202 ACCEPTED"); //trả về response code cho CENTECH SMS CENTER
    }

    /**
     * get sms 
     * @param username
     * @param password
     * @param src
     * @param description
     * @param cmdcode
     * @param moseq
     * @param msgbody
     * ?username=peacesoft&password=ps8x08&src=0946020002&dest=8708&cmdcode=SB&moseq=1234&msgbody=SB VIP 1234
     */
    public function actionProcess() {
        $username = isset($_GET['username']) ? $_GET['username'] : '';
        $password = isset($_GET['password']) ? $_GET['password'] : '';
        $src = isset($_GET['src']) ? $_GET['src'] : '';
        $dest = isset($_GET['dest']) ? $_GET['dest'] : '';
        $cmdcode = isset($_GET['cmdcode']) ? $_GET['cmdcode'] : '';
        $moseq = isset($_GET['moseq']) ? $_GET['moseq'] : '';
        $msgbody = isset($_GET['msgbody']) ? $_GET['msgbody'] : '';

        //write file log by date
        $log_file = 'log-' . date('Y') . '-' . date('m') . '-' . date('d') . '.html';
        $filePath = 'data/sms/' . $log_file;
        $contentLog = date('Y-m-d h:i:s') . '-<b style="color: blue">' . $src . '</b>-' . $dest . '-<i style="color: green">' . $msgbody . '</i>-' . $moseq . ' <br />';
        $fp = fopen($filePath, 'a+');
        fwrite($fp, $contentLog);
        fclose($fp);

        $temp = explode(' ', $msgbody);
        if ($moseq != $temp[2])
            $moseq = $temp[2];

        $smsObject = new SMSObject();

        $smsObject->insertSMS($src, $dest, $msgbody, $moseq);

        $msgbody = str_replace(array('   ', '  '), ' ', trim($msgbody));

        if ($username != $this->__USERNAME || $password != $this->__PASSWORD) {
            $result = 'E02'; //sai username và password
        } else if (strtolower($cmdcode) != strtolower('SB')) {
            $result = 'E03'; //sai keyword của dịch vụ (lỗi này do Centech trỏ sai đường dẫn)
        } else {
            $result = $smsObject->processSMS($src, $dest, $msgbody, $moseq, 'SB', false);
        }
        var_dump($result);
    }

}