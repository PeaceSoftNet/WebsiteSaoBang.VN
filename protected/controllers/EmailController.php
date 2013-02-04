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
class EmailController extends Controller {

    public $keyword = '';

    /**
     * action ad email to 123mail.vn 
     */
    public function actionAll() {
        $zone = isset($_GET['zone']) ? $_GET['zone'] : '1';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '`email`';
        $type = isset($_GET['type']) ? $_GET['type'] : 'ASC';
        $page = isset($_GET['TopicSlaveModel_page']) ? $_GET['TopicSlaveModel_page'] : 1;
        $page++;
        //view
        $criteria = new CDbCriteria();
        $criteria->select = '`id` , `locality`, `email` ,  `mobileNumber` , `createDate`';
        if ($zone == 1) {
            $criteria->condition = ' `id` < 2012080000000000';
        } elseif ($zone == 1) {
            $criteria->condition = ' `id` > 2012080000000000 AND `id` < 2012120000000000';
        } elseif ($zone == 2) {
            $criteria->condition = ' `id` > 2012120000000000 AND `id` < 2012080000000000000';
        } elseif ($zone == 3) {
            $criteria->condition = ' `id` > 2012080000000000000 AND `id` < 2012090000000000000';
        } elseif ($zone == 4) {
            $criteria->condition = ' `id` > 2012090000000000000 AND `id` < 2012100000000000000';
        } elseif ($zone == 5) {
            $criteria->condition = ' `id` > 2012100000000000000 AND `id` < 2012110000000000000';
        } else {
            $criteria->condition = ' `id` > 2012110000000000000';
        }
        $criteria->condition .= ' AND `email` != \'noreply@saobang.vn\'';
        $criteria->group = '`email`';
        $criteria->order = $sort . ' ' . $type;
        $dataProvider = new CActiveDataProvider('TopicSlaveModel', array(
                    'pagination' => array(
                        'pageSize' => 1000,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('all', array('dataProvider' => $dataProvider, 'page' => $page, 'zone' => $zone));
    }

    /**
     * mail to chodientu.vn account
     */
    public function actionChodientu() {
        $i = 0;
        do {
            $model = TopicModel::model()->find('`authorId` = 0 AND `site` = 25 AND `email` !=\'noreply@saobang.vn\'');
            if (!$model) {
                echo 'not found';
                return true;
            }
            $email = $model->email;
            $user = UserModel::model()->find('`email` = \'' . $email . '\'');
            $passwd = rand('111111', 999999);
            $title = '<a href="http://saobang.vn' . Yii::app()->createUrl('home/TopicDetail', array('id' => $model->id, 'name' => ExtensionClass::utf8_to_ascii($model->title))) . '">' . $model->title . '</a>';
            $content = self::content($title, $email, $passwd = '');
            $name = 'sendEmailTrans.html';
            $text = ' Time: <i style="color:blue">' . date('h:i:s d/m/Y') . '</i>';
            $text .= ' email: <strong style="color:red">' . $email . '</strong> ' . $title;
            $text .= '<br />';
            //write log
            $fp = fopen('data/auto/' . $name, 'a+');
            fwrite($fp, $text);
            fclose($fp);
            if ($user) {
                //check user, if user is ready, exit program
                echo 'user ready<br />';
                $model->authorId = $user->id;
                $model->update();
                echo 'send email success <br />' . $title;
                $to = $user->email;
                ExtensionClass::mailSend($to, $subject = 'Thông tin chuyển đổi dữ liệu từ Rao vặt Chợ Điện Tử sang Saobang.vn', $content);
            } else {
                //create new user
                $user = new UserModel;
                $user->email = $email;
                $user->password = UserModel::hashPassword($passwd);
                $user->isActive = 1;

                if ($user->validate()) {
                    $user->save();
                    $model->authorId = $user->id;
                    $model->update();
                    $to = $user->email;
                    ExtensionClass::mailSend($to, $subject = 'Thông báo về việc chuyển đổi dữ liệu từ Rao vặt Chợ Điện Tử sang Saobang.vn', $content);
                    echo 'Success ';
                    echo '<pre>';
                    var_dump($title);
                    var_dump($user);
                    echo '</pre>';
                }
            }
            $i++;
            echo $i;
        } while ($i < 3);
    }

    /**
     * send email function
     * @param type $to
     * @param type $subject
     * @param type $content
     */
    public static function mailSend($to, $subject = 'Thông báo về việc chuyển đổi dữ liệu từ Rao vặt Chợ Điện Tử sang Saobang.vn', $content = null) {

        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "smtp.gmail.com"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'ssl';
        $mail->Username = "info@saobang.vn"; // your SMTP username or your gmail username
        $mail->Password = "abc@123."; // your SMTP password or your gmail password
        $from = "info@saobang.vn"; // Reply to this email
        $name = "Info"; // Recipient's name
        $mail->From = $from;
        $mail->FromName = "Saobang.vn"; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to, $name);
        $mail->AddReplyTo($from, "Info");
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $mail->Body = $content;
        $mail->AltBody = "Email thông báo từ saobang.vn"; //Text Body

        if (!$mail->Send()) {
            echo "<h1>Error: " . $mail->ErrorInfo . '</h1>';
        } else {
            echo "<h1>Gửi email thành công</h1>";
        }
    }

    public function content($title, $email, $passwd = '') {
        return '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Thông báo về việc chuyển dữ liệu rao vặt từ Chodientu.vn sang Saobang.vn</title>
    </head>
    <body>  
        <p>Chào bạn</p>
        <p>Từ ngày 1/11/2012, các nội dung rao vặt tại website http://chodientu.vn sẽ tạm dừng hoạt động và chuyển sang website saobang.vn (xem lại thông báo <a href="http://chodientu.vn/tin-ban-quan-tri-106/2287/Thong-bao-chuyen-du-lieu-trang-Rao-Vat-ChoDienTuvn-sang-Saobangvn.html">tại đây</a>).</p>
        <p>Theo quy định, các tin rao vặt tại chodientu.vn trong 3 tháng gần đây sẽ được tự động chuyển sang Saobang.vn, bạn có thể sử dụng tài khoản của mình tại Chodientu.vn trên website Saobang.vn.</p>
        <p>Do đó chúng tôi gửi email này thông báo cho bạn các nội dung sau:
            <div style="padding: 0px 20px;">
                <p>     -	Rao vặt <strong><em>' . $title . '</em></strong> của bạn đã được chuyển sang saobang.vn</p>
                <p>     -	Tài khoản của bạn trên saobang.vn là:
                    <p style="padding: 0px 30px; font-style: italic">         o	User: ' . $email . '</p>
                    <p style="padding: 0px 30px; font-style: italic">         o	Passwd: <a href="http://saobang.vn' . Yii::app()->createUrl('user/changerPasswdThroughEmail', array('email' => urlencode($email), 'hash' => md5($email . 'saobangVN2012'))) . '">Click vào đây để tạo mật khẩu mới của bạn</a>  </p>
                </p>
            </div>
        </p>
        <p>
            Saobang.vn là website tổng hợp rao vặt trên toàn quốc lớn nhất tại Việt Nam, cho phép người dùng nhanh chóng và dễ dàng tìm kiếm thông tin về Mua bán, rao vặt và việc làm mà không phải vào từng website. Chúng tôi hy vọng sẽ giúp bạn quảng bá thông tin và hình ảnh của mình nhanh nhất và hiệu quả nhất. Tìm hiểu thêm về saobang.vn <a href="http://saobang.vn">tại đây</a>.
        </p>
        <p>   Thông tin chi tiết xin liên hệ:</p>
        <p>             Trung tâm CSKH của Saobang.vn</p>
        <p>
            <ul><li>             Hotline: (04)36 321 125 - 093 696 6263</li>
                <li>             Yahoo: saobangvn_cskh</li>
                <li>             Skype: saobangvn_cskh</li>
            </ul>

        </p>
        <div style="margin: 10px 0px">
            <p><strong>Trân trọng cám ơn</strong><p>

            <p>Saobang.vn support</p>
        </div>
        </body></html>';
    }

    /**
     * 
     * send email use smtp
     */
    public function actionSendEmailSmtp($from, $namefrom, $to, $nameto, $subject, $message) {
        
    }

    /**
     * create user
     * @return boolean
     */
    public function actionCreateUser() {

        $this->layout = 'Administrator';

        if (isset($_POST['UserModel'])) {
            $email = isset($_POST['UserModel']['email']) ? $_POST['UserModel']['email'] : '';

            $model = TopicModel::model()->find('`authorId` = 0 AND `site` = 25 AND `email` =\'' . $email . '\'');
            if (!$model) {
                echo 'not found';
                return true;
            }
            $email = $model->email;
            $user = UserModel::model()->find('`email` = \'' . $email . '\'');
            $passwd = rand('111111', 999999);
            $title = '<a href="http://saobang.vn' . Yii::app()->createUrl('home/TopicDetail', array('id' => $model->id, 'name' => ExtensionClass::utf8_to_ascii($model->title))) . '">' . $model->title . '</a>';
            $content = self::content($title, $email, $passwd = '');
            $name = 'sendEmailTrans.html';
            $text = ' Time: <i style="color:blue">' . date('h:i:s d/m/Y') . '</i>';
            $text .= ' email: <strong style="color:red">' . $email . '</strong> ' . $title;
            $text .= '<br />';
            //write log
            $fp = fopen('data/auto/' . $name, 'a+');
            fwrite($fp, $text);
            fclose($fp);
            if ($user) {
                //check user, if user is ready, exit program
                echo 'user ready<br />';
                $model->authorId = $user->id;
                $sql = 'UPDATE `tbl_topic` SET `authorId` = ' . $model->authorId . ' WHERE `email` =\'' . $email . '\'';
                $command = Yii::app()->db->createCommand($sql);
                $command->execute();
                echo 'send email success <br />' . $title;
                $to = $user->email;
                ExtensionClass::mailSend($to, $subject = 'Thông tin chuyển đổi dữ liệu từ Rao vặt Chợ Điện Tử sang Saobang.vn', $content);
                $this->render('createEmailSuccess');
                exit();
            } else {
                //create new user
                $user = new UserModel;
                $user->email = $email;
                $user->password = UserModel::hashPassword($passwd);
                $user->isActive = 1;
                if ($user->validate()) {
                    $user->save();
                    $model->authorId = $user->id;
                    $sql = 'UPDATE `tbl_topic` SET `authorId` = ' . $model->authorId . ' WHERE `email` =\'' . $email . '\'';
                    $command = Yii::app()->db->createCommand($sql);
                    $command->execute();
                    $to = $user->email;
                    ExtensionClass::mailSend($to, $subject = 'Thông báo về việc chuyển đổi dữ liệu từ Rao vặt Chợ Điện Tử sang Saobang.vn', $content);
                    echo 'Success ';
                    $this->render('createEmailSuccess');
                    exit();
                }
            }
        }
        $this->render('createEmail');
    }

    /**
     * find customer
     */
    public function actionAutoFind() {
        $this->layout = 'HomeTopic';

        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : 'Nhập từ khóa tìm kiếm';

        $tpId = isset($_GET['tpid']) ? $_GET['tpid'] : '';

        if (!$tpId) {
            $this->redirect(array('home/vip'));
        }

        if ($keyword && $keyword != 'Nhập từ khóa tìm kiếm') {

            $condition = 'title:(' . $keyword . ') OR description:(' . $keyword . ')';

            $dataProvider = new ASolrDataProvider("ASolrDocument");
            $criteria = $dataProvider->getCriteria()->query = $condition;

            $dataProvider->pagination = array(
                'pageSize' => 100,
            );

            $listId = '0';
            foreach ($dataProvider->getData() as $index => $data) {
                $listId .= ', ' . $data["id"];
            }

            $cond = '`id` IN ( ' . $listId . ') AND `email` != \'noreply@saobang.vn\'';
            $criteriaTopic = new CDbCriteria(array(
                        'condition' => $cond,
                        'order' => 'id DESC',
                    ));
            $criteriaTopic->select = '`email`';
            $criteriaTopic->distinct = true;
            $dataProviderTopic = new CActiveDataProvider('TopicSlaveModel', array(
                        'pagination' => array(
                            'pageSize' => 40,
                        ),
                        'criteria' => $criteriaTopic,
                    ));

            $this->render('automail', array('dataProvider' => $dataProviderTopic, 'topicId' => $tpId, 'keyword' => $keyword));
        } else {
            $this->render('autosearch');
        }
    }

    /**
     * {'mailto': emailTo, 'mailfrom': email, 'passwd': passwd, 'topicId':'<?php echo $topicId; ?>'}
     * customerSend
     */
    public function actionCustomerSend() {
        $mailto = isset($_POST['mailto']) ? $_POST['mailto'] : '';
        $mailfrom = isset($_POST['mailfrom']) ? $_POST['mailfrom'] : '';
        $passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';
        $topicId = isset($_POST['topicId']) ? $_POST['topicId'] : '';
        $duration = 6;
        // check topic and topic is vip
        $topicModel = Yii::app()->cache->get('home_index_topicDetail_model' . $topicId);
        if ($topicModel === false) {
            $topicModel = TopicSlaveModel::model()->cache($duration, NULL)->findByPk($topicId);
            Yii::app()->cache->set('home_index_topicDetail_model' . $topicId, $topicModel, 10);
        }

        //test send email
//        $mailto = 'thiendd@peacesoft.net';
        if ($topicModel && $topicModel->isSms) {
            $topicDetail = Yii::app()->cache->get('home_detail_modelDetail_' . $topicId);
            if ($topicDetail === false) {
                $topicDetail = TopicSlaveDetail::model()->cache($duration, NULL)->findByPk($topicId);
                Yii::app()->cache->set('home_detail_modelDetail_' . $topicId, $topicDetail, 10);
            }

            $content = $topicDetail->content;
            $content .= 'Xem chi tiết <a href="http://saobang.vn' . Yii::app()->createUrl('home/TopicDetail', array('id' => $topicModel->id, 'name' => ExtensionClass::utf8_to_ascii($topicModel->title))) . '">' . $topicModel->title . '</a>';

            if ($mailfrom != 'undefined' && $passwd != 'undefined') {
                self::sendTo($mailto, $topicModel->title, $content, $mailfrom, $passwd);
            } else {
                self::mailPHP($mailto, $topicModel->title, $content);
            }
        }
    }

    public function sendTo($to, $subject, $content, $from, $passswd) {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "smtp.gmail.com"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = $from; // your SMTP username or your gmail username
        $mail->Password = $passswd; // your SMTP password or your gmail password

        $name = "Me"; // Recipient's name
        $mail->From = $from;
        $mail->FromName = "Me"; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to, $name);
        $mail->AddReplyTo($from, "Me");
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $mail->Body = $content;
        $mail->AltBody = "Email thông qua saobang.vn"; //Text Body

        if (!$mail->Send()) {
            echo "Error: " . $mail->ErrorInfo . '';
        } else {
            echo 'Đã gửi';
        }
    }

    /**
     * mail php
     */
    public function mailPHP($to, $subject, $content) {
        $headers = 'From: noreply@saobang.vn' . "\r\n" .
                'Reply-To: noreply@saobang.vn' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
        $headers .= "X-Priority: 1 (Higuest)\n";
        $headers .= "X-MSMail-Priority: High\n";
        $headers .= "Importance: High\n";
        mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $content, $headers);
        echo 'Đã gửi';
    }

}