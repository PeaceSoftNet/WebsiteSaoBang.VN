<?php

/**
 * @author  Chienlv
 * @return  Class xử lý gửi và cấu hình email
 */
class Mailer {

    /**
     * @author  Chienlv
     * @return  Hàm gửi mail
     */
    public static function send($to, $subject, $body) {
        try {
            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
            $mailer->IsSMTP();
            $mailer->Host = 'localhost';
            $mailer->SMTPAuth = 0;
            $mailer->Username = 'noreply';
            $mailer->Password = '';
            $mailer->CharSet = 'UTF-8';
            $mailer->IsHTML(true);

            $mailer->SetFrom('notification@saobang.vn', 'saobang.vn');

            $mailer->AddAddress($to);

            $mailer->Subject = $subject;
            $mailer->Body = $body;
            return $mailer->Send();
        } catch (phpmailerException $e) {
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

}