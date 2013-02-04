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
class UserController extends Controller {

    public $layout = 'adHome';
    public $keyword = '';

    /**
     * @method  str email 
     */
    public $email;

    /**
     * @method  str address : địa chỉ của thành viên
     */
    public $address = '';

    /**
     * @method  str info : thông tin thêm của thành viên
     */
    public $info = '';

    /**
     * @method  arr $openData : mảng của opend id trả về
     */
    public $openData = array();

    /**
     * @method  arr $userInfo mảng khai báo tạm của user
     */
    public $userInfo = array();

    /**
     * @method  arr msg mảng thông báo tạm
     */
    public $msg = array();

    /**
     * @method  (true or false) $flag : cờ trạng thái khai báo tạm của hàm
     */
    public $flag = false;

    /**
     * @method  str call_back_url : đường dẫn trở lại trang trước đó
     */
    public $call_back_url = null;

    /**
     * register by openID 
     */
    public function actionRegister() {

        //Check Logged-in
        $userId = Yii::app()->session['userId'];
        if ($userId)
            $this->redirect(array('user/profile'));

        $model = new UserModel();
        $model->setScenario('register');
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $openSite = isset($_GET['openSite']) ? $_GET['openSite'] : '';
        if ($openSite) {
            $openid = new LightOpenID($_SERVER['HTTP_HOST']);
            if (!$openid->mode) {
                if ($openSite == 'google') {        //register use gooogle account
                    $openid->identity = 'https://www.google.com/accounts/o8/id';
                    $openid->required = array('contact/email', 'contact/country/home ');
                    $this->redirect($openid->authUrl());
                } else if ($openSite == 'yahoo') {  //register use yahoo account
                    $openid->identity = 'https://me.yahoo.com';
                    $openid->required = array('contact/email', 'contact/country/home');
                    $this->redirect($openid->authUrl());
                } else if ($openSite == 'facebook') {   //register use facebook account
                    $userid = Yii::app()->facebook->getUser();
                    if ($userid == 0) {
                        $loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => 'email'));
                        $this->redirect($loginUrl);
                    } else {
                        $this->userInfo = Yii::app()->facebook->getInfo();
                        if (!empty($this->userInfo)) {
                            $this->email = isset($this->userInfo['email']) ? $this->userInfo['email'] : '';
                            $this->address = isset($this->userInfo['location']['name']) ? $this->userInfo['location']['name'] : '';
                            $this->info = isset($this->userInfo['bio']) ? $this->userInfo['bio'] : '';
                        }
                    }
                }
            } else {
                $this->openData = $openid->getAttributes();
                if (!empty($this->openData)) {
                    $this->email = isset($this->openData['contact/email']) ? $this->openData['contact/email'] : '';
                    $this->address = isset($this->openData['contact/country/home']) ? $this->openData['contact/country/home'] : '';
                }
            }
            if ($this->email) {
                $model->email = $this->email;
                $model->password = time();
                $model->password2 = time();
                $model->remember_me = true;
                $model->address = $this->address;
                $model->info = $this->info;
                if ($model->validate()) {
                    if ($model->insert()) {
                        Yii::app()->session['email'] = $model->email;
                        Yii::app()->session['userId'] = $model->id;

                        Yii::app()->user->setFlash('profile', '<p class="success">Đăng ký tài khoản tại Saobang.vn thành công ! </p>');

                        $this->redirect(array('user/profile'));
                    }
                }
            }
        }
        // register need active
        if (isset($_POST['UserModel'])) {
            $model->attributes = $_POST['UserModel'];
            $model->isActive = 0;
            $model->password = UserModel::hashPassword($model->password);
            $model->password2 = UserModel::hashPassword($model->password2);
            if ($model->validate()) {
                $model->save();
                $this->msg = 'Đăng ký thành công. Vui lòng kiểm tra lại email và kích hoạt tài khoản người dùng!';
                $content = '
                        <html>
                        <head>
                        <title>Kích hoạt tài khoản của bạn tại SaoBang.vn</title>
                        </head>
                        <body>
                        <p>Chào bạn!</p>
                        <i>Bạn đã đăng ký tài khoản tại cổng thông tin mua bán, rao vặt, việc làm <a target="_blank" href="http://saobang.vn">Saobang.vn</a></i>
                        <p>Click <a target="_blank" href="http://saobang.vn' . Yii::app()->createUrl('user/activeAccount', array('id' => $model->id, 'code' => md5($model->id . 'saobang'))) . '">tại đây</a> để kích hoạt tài khoản của bạn trên Saobang.vn</p>
                        <p>Trân trọng!</p>
                        </body>
                        </html>
                        ';
                ExtensionClass::mailSend($model->email, 'Kích hoạt tài khoản của bạn tại SaoBang.vn', $content);
            }
        }
        $this->render('register', array('model' => $model, 'msg' => $this->msg));
    }

    /**
     *  active account
     */
    public function actionActiveAccount() {
        $uId = isset($_GET['id']) ? $_GET['id'] : '';
        $ucode = isset($_GET['code']) ? $_GET['code'] : '';
        if ($uId && $ucode) {
            //check code
            if ($ucode == md5($uId . 'saobang')) {
                $model = UserModel::model()->findByPk($uId);
                $model->isActive = 1;
                $model->update();
                $this->render('activeAccount', array('code' => 'Success'));
                exit();
            } else {
                $this->render('activeAccount', array('code' => 'Error'));
            }
        } else {
            return false;
        }
    }

    /**
     * user login 
     */
    public function actionLogin() {
        //Check Logged-in
        $userId = Yii::app()->session['userId'];
        if ($userId)
            $this->redirect(array('user/profile'));

        $model = new UserLogin();
        $model->setScenario('login');

        $openSite = isset($_GET['openSite']) ? $_GET['openSite'] : '';

        $this->flag = Yii::app()->request->getUrlReferrer();

        if (!$openSite) {
            Yii::app()->request->cookies['call_back'] = new CHttpCookie('call_back', Yii::app()->request->getUrlReferrer());
        }

        if ($openSite) {
            $openid = new LightOpenID($_SERVER['HTTP_HOST']);
            if (!$openid->mode) {
                if ($openSite == 'google') {
                    $openid->identity = 'https://www.google.com/accounts/o8/id';
                    $openid->required = array('contact/email');
                    $this->redirect($openid->authUrl());
                } else if ($openSite == 'yahoo') {
                    $openid->identity = 'https://me.yahoo.com';
                    $openid->required = array('contact/email');
                    $this->redirect($openid->authUrl());
                } else if ($openSite == 'facebook') {
                    $userid = Yii::app()->facebook->getUser();
                    if ($userid == 0) {
                        $loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => 'email'));
                        $this->redirect($loginUrl);
                    } else {
                        $this->userInfo = Yii::app()->facebook->getInfo();
                        if (!empty($this->userInfo))
                            $this->email = isset($this->userInfo['email']) ? $this->userInfo['email'] : '';
                    }
                }
            }else {
                $this->openData = $openid->getAttributes();
                if (!empty($this->openData))
                    $this->email = isset($this->openData['contact/email']) ? $this->openData['contact/email'] : '';
            }
        }
        #Nếu xác thực thành công .
        if ($this->email) {
            $selects = array('select' => 'email,id,isActive');
            $this->userInfo = UserModel::model()->findByAttributes(array('email' => $this->email), $selects);
            if ($this->userInfo) {
                if ($this->userInfo->isActive == 1) {
                    Yii::app()->session['email'] = $this->userInfo->email;
                    Yii::app()->session['userId'] = $this->userInfo->id;

                    Yii::app()->user->setFlash('profile', '<p class="success">Đăng nhập tài khoản tại Saobang.vn thành công !</p>');
                    $curentUrl = isset(Yii::app()->request->cookies['call_back']) ? Yii::app()->request->cookies['call_back']->value : 'ad/index';

                    unset(Yii::app()->request->cookies['call_back']);

                    $this->redirect($curentUrl);
                } else {
                    $this->render('activeAccount', array('code' => 'login'));
                    exit();
                }
            } else {
                Yii::app()->user->setFlash('register', '<p class="msg-error">Tài khoản email : ' . $this->email . ' không tồn tại trong hệ thống. Xin vui lòng đăng ký</p>');
                $this->redirect(Yii::app()->createUrl('user/register'));
            }
        } else {
            if (isset($_POST['UserLogin'])) {
                $model->attributes = $_POST['UserLogin'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate()) {
                    # Check login on submit
                    $attributes = array('email' => $model->email);
                    $selects = array('select' => 'email,id,isActive,password');
                    $this->userInfo = UserModel::model()->findByAttributes($attributes, $selects);
                    if (!empty($this->userInfo)) {
                        # Check trạng thái user
                        if ($this->userInfo->isActive != 1) {
                            $this->render('activeAccount', array('code' => 'login'));
                            exit();
                        }
                        $curentPassword = md5($model->password);
                        if ($this->userInfo->isActive == 1 && $this->userInfo->validatePassword($model->password)) {
                            Yii::app()->session['email'] = $this->userInfo->email;
                            Yii::app()->session['userId'] = $this->userInfo->id;
                            $lastUrl = $_POST['lastUrl'];

                            $curentUrl = isset(Yii::app()->request->cookies['call_back']) ? Yii::app()->request->cookies['call_back']->value : 'ad/index';

                            unset(Yii::app()->request->cookies['call_back']);

                            if ($lastUrl == $curentUrl) {
                                $link = array('ad/index');
                            } else if (strlen($_POST['lastUrl']) > 5)
                                $link = $lastUrl;
                            else
                                $link = array('ad/index');

                            $this->redirect($link);
                        }
                    }
                }
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * user logout 
     */
    public function actionLogout() {
        unset(Yii::app()->session['email']);
        unset(Yii::app()->session['userId']);
        $this->redirect(Yii::app()->createUrl('ad/index'));
    }

    /**
     * profile 
     */
    public function actionProfile() {
        $this->pageTitle = 'Tài khoản';
        $userId = Yii::app()->session['userId'];
        if (!$userId) {
            $this->redirect(array('user/login'));
        } else {
            $model = UserModel::model()->findByPk($userId);
            if (isset($_POST['UserModel'])) {
                $model->attributes = $_POST['UserModel'];
                $model->mobile = $_POST['UserModel']['mobile'];
                $model->address = $_POST['UserModel']['address'];
                $model->info = $_POST['UserModel']['info'];
                if ($model->validate()) {
                    if ($model->update()) {
                        Yii::app()->user->setFlash('profile', '<p class="success">Cập nhật thông tin tài khoản thành công.</p>');
                    }
                }
            }
            $this->render('profile', array('model' => $model));
        }
    }

    /**
     * email notify 
     */
    public function actionEmailNotify() {
        $this->render('emailNotify');
    }

    /**
     * @author  Chienlv
     * @return  Action xử lý đăng ký nhận email
     */
    public function actionNewsletter() {
        $this->pageTitle = 'Email đăng ký';
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $user = UserModel::model()->findByPk($userId, array('select' => 'email'));

        $postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;
        $sort = isset($_GET['EmailModel_sort']) ? str_replace('.desc', '', $_GET['EmailModel_sort']) : 'id';

        $criteria = new CDbCriteria(array(
                    'condition' => '`email`="' . $user->email . '"',
                    'order' => '`id` DESC',
                ));
        $dependecy = new CDbCacheDependency('SELECT MAX(`id`) FROM {{email}}');
        $dataProvider = new CActiveDataProvider(EmailModel::model()->cache(6, $dependecy, 2), array(
                    'pagination' => array(
                        'pageSize' => $postPerPage,
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('newsletter', array(
            'dataProvider' => $dataProvider,
            'postPerPage' => $postPerPage,
            'sort' => $sort
        ));
    }

    /**
     * @author  Chienlv
     * @param   Action xử lý đổi mật khẩu
     */
    public function actionChangerPassword() {
        $this->pageTitle = 'Đổi mật khẩu';
        $userId = Yii::app()->session['userId'];
        if (!$userId)
            $this->redirect(array('user/login'));

        $model = UserModel::model()->findByPk($userId);
        $model->curent_pass = $model->password;
        $model->password = '';
        $model->setScenario('change');
        if ($model) {
            if (isset($_POST['UserModel'])) {
                $model->attributes = $_POST['UserModel'];
                $model->oldPass = $_POST['UserModel']['oldPass'];
                $model->password = $_POST['UserModel']['password'];
                $model->password2 = $_POST['UserModel']['password2'];

                if ($model->validate()) {
                    if ($model->update()) {
                        Yii::app()->user->setFlash('login', '<p class="success">Đổi mật khẩu thành công ! Xin vui lòng đăng nhập lại.</p>');
                        unset(Yii::app()->session['email']);
                        unset(Yii::app()->session['userId']);
                        $this->redirect(Yii::app()->createUrl('user/login'));
                    }
                }
            }
            $this->render('changerPassword', array('model' => $model));
        }else
            $this->redirect(array('user/login'));
    }

    /**
     * @author  Chienlv
     * @param   Action xử lý lấy lại mật khẩu bị mất của thành viên
     */
    public function actionForGotPassword() {
        $this->pageTitle = 'Quên mật khẩu';

        $userId = Yii::app()->session['userId'];
        if ($userId)
            $this->redirect(array('user/profile'));
        $model = new UserModel();

        #for submit
        $model->setScenario('forgotPassword');
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'forgot-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['UserModel'])) {
            $model->attributes = $_POST['UserModel'];
            if ($model->validate()) {
                $this->userInfo = UserModel::model()->findByAttributes(array('email' => $model->email));
                if ($this->userInfo) {
//                    $newPasswd = rand(100000, 999999);
//                    $this->userInfo->password = UserModel::hashPassword($newPasswd);
//                    $this->userInfo->update();
                    $content = '
                        <html>
                        <head>
                        <title>Thông tin tài khoản của bạn tại SaoBang.vn</title>
                        </head>
                        <body>
                        <p>Chào bạn!</p>
                        <i>Thông tin tài khoản của bạn tại cổng thông tin mua bán, rao vặt, việc làm <a target="_blank" href="http://saobang.vn">Saobang.vn</a> là</i>
                        <p style="padding-left: 10px; margin:5px;">Email: ' . $model->email . '</p>
                        <p style="padding-left: 10px; margin:5px;">Mật khẩu: <a href="http://saobang.vn' . Yii::app()->createUrl('user/changerPasswdThroughEmail', array('email' => urlencode($model->email), 'hash' => md5($model->email . 'saobangVN2012'))) . '">Kích vào đây để đổi mật khẩu</a></p>
                            <p>Click <a target="_blank" href="http://saobang.vn/dang-nhap.html">tại đây</a> để đăng nhập tài khoản của bạn trên Saobang.vn</p>
                        <p>Trân trọng!</p>
                        </body>
                        </html>
                        ';
                    ExtensionClass::mailSend($this->userInfo->email, 'Thông tin tài khoản của bạn tại SaoBang.vn', $content);
                    Yii::app()->user->setFlash('login', '<p class="success">Saobang.vn đã gửi mật khẩu mới tới email : ' . $this->userInfo->email . ' của bạn .<br/>
                    Xin vui lòng kiểm tra lại email để đăng nhập bằng mật khẩu mới
                    </p>');
                    $this->redirect(Yii::app()->createUrl('user/login'));
                }
            } else {
                $model->addError('email', 'Email của bạn không tồn tại trong hệ thống ! Xin vui lòng đăng ký.');
            }
        } else {
            $openSite = isset($_GET['openSite']) ? $_GET['openSite'] : '';
            if ($openSite) {
                $openid = new LightOpenID($_SERVER['HTTP_HOST']);
                if (!$openid->mode) {
                    if ($openSite == 'google') {
                        $openid->identity = 'https://www.google.com/accounts/o8/id';
                        $openid->required = array('contact/email');
                        $this->redirect($openid->authUrl());
                    } else if ($openSite == 'yahoo') {
                        $openid->identity = 'https://me.yahoo.com';
                        $openid->required = array('contact/email');
                        $this->redirect($openid->authUrl());
                    } else if ($openSite == 'facebook') {
                        $userid = Yii::app()->facebook->getUser();
                        if ($userid == 0) {
                            $loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => 'email'));
                            $this->redirect($loginUrl);
                        } else {
                            $this->userInfo = Yii::app()->facebook->getInfo();
                            if (!empty($userinfo))
                                $this->email = isset($userinfo['email']) ? $userinfo['email'] : '';
                        }
                    }
                }else {
                    $this->openData = $openid->getAttributes();
                    if (!empty($this->openData))
                        $this->email = isset($this->openData['contact/email']) ? $this->openData['contact/email'] : '';
                }
            }

            if ($this->email) {
                $selects = array('select' => 'email,id,isActive');
                $this->userInfo = UserModel::model()->findByAttributes(array('email' => $this->email), $selects);
                if (!empty($this->userInfo)) {
//                    $newPasswd = rand(100000, 999999);
//                    $this->userInfo->password = UserModel::hashPassword($newPasswd);
//                    $this->userInfo->update();

                    $content = '
                        <html>
                        <head>
                        <title>Thông tin tài khoản của bạn tại SaoBang.vn</title>
                        </head>
                        <body>
                        <p>Chào bạn!</p>
                        <i>Thông tin tài khoản của bạn tại cổng thông tin mua bán, rao vặt, việc làm <a target="_blank" href="http://saobang.vn">Saobang.vn</a> là</i>
                        <p style="padding-left: 10px; margin:5px;">Email: ' . $model->email . '</p>
                        <p style="padding-left: 10px; margin:5px;">Mật khẩu: <a href="http://saobang.vn' . Yii::app()->createUrl('user/changerPasswdThroughEmail', array('email' => urlencode($model->email), 'hash' => md5($model->email . 'saobangVN2012'))) . '">Kích vào đây để đổi mật khẩu</a></p>
                            <p>Click <a target="_blank" href="http://saobang.vn/dang-nhap.html">tại đây</a> để đăng nhập tài khoản của bạn trên Saobang.vn</p>
                        <p>Trân trọng!</p>
                        </body>
                        </html>
                        ';
                    ExtensionClass::mailSend($this->email, 'Thông tin tài khoản của bạn tại SaoBang.vn', $content);

                    /**
                     * Khi xác thực tài khoản xong chuyển về trang  user/profile nếu isActive user bằng 1
                     * nếu isActive khác 1 thì chuyển về trang chủ
                     */
                    if ($this->userInfo->isActive == 1) {
                        Yii::app()->session['email'] = $this->userInfo->email;
                        Yii::app()->session['userId'] = $this->userInfo->id;

                        Yii::app()->user->setFlash('profile', '<p class="success">Saobang.vn đã gửi mật khẩu mới tới email : ' . $this->email . ' của bạn .<br/>
                        Xin vui lòng kiểm tra lại email để đăng nhập và đổi mật khẩu mới
                        </p>');

                        $this->redirect(Yii::app()->createUrl('user/profile'));
                    }else
                        $this->redirect(Yii::app()->createUrl('user/login'));
                }
            }
        }
        $model->email = $this->email;
        $this->render('forgotpassword', array('model' => $model));
    }

    /**
     * @author  Chienlv
     * @param   Action xử lý đổi mật khẩu
     */
    public function actionChangerPasswdThroughEmail() {
        $this->pageTitle = 'Đổi mật khẩu';
        $this->msg = '';
        if (isset($_SERVER['HTTP_REFERER'])) {
            //if user changed passwd, redirect to user profile
            if (strpos($_SERVER['HTTP_REFERER'], 'saobang.vn/dang-nhap.html') > 0) {
                $this->redirect(array('user/profile'));
            }
        }
        unset(Yii::app()->session['email']);
        unset(Yii::app()->session['userId']);
        $email = isset($_GET['email']) ? $_GET['email'] : 'nothing';
        $email = urldecode($email);
        $hash = isset($_GET['hash']) ? $_GET['hash'] : '';
        if ($hash != md5($email . 'saobangVN2012')) {
            $this->msg = 'saobang';
            $this->render('changerPasswdThroughEmail', array('model' => new UserModel));
            exit();
        } else {
            $model = UserModel::model()->find('LOWER(email)=?', array(strtolower($email)));
            $model->setScenario('change');
            if ($model) {
                if (isset($_POST['UserModel'])) {
                    $model->attributes = $_POST['UserModel'];
                    $passswd = $model->password;
                    if ($model->password != $model->password2) {
                        $this->msg = '<p class="success" style="color:red;">Nhập lại khẩu chưa chính xác, vui lòng thử lại</p>';
                    } else {
                        $model->password = UserModel::hashPassword($passswd);
                        $model->update();
                        $this->msg = 'Success';
                        Yii::app()->user->setFlash('login', '<p class="success">Đổi mật khẩu thành công ! Xin vui lòng đăng nhập lại.</p>');
                        $this->redirect(array('user/login'));
                    }
                }
                $this->render('changerPasswdThroughEmail', array('model' => $model));
            }
        }
    }

    /**
     * re active account
     */
    public function actionReActive() {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        if ($email) {
            $model = UserModel::model()->find('LOWER(email)=?', array(strtolower($email)));
            if ($model) {
                $content = '<html>
            <head>
            <title>Kích hoạt tài khoản của bạn tại SaoBang.vn</title>
            </head>
            <body>
            <p>Chào bạn!</p>
            <i>Bạn đã đăng ký tài khoản tại cổng thông tin mua bán, rao vặt, việc làm <a target="_blank" href="http://saobang.vn">Saobang.vn</a></i>
            <p>Click <a target="_blank" href="http://saobang.vn' . Yii::app()->createUrl('user/activeAccount', array('id' => $model->id, 'code' => md5($model->id . 'saobang'))) . '">tại đây</a> để kích hoạt tài khoản của bạn trên Saobang.vn</p>
            <p>Trân trọng!</p>
            </body>
            </html>';
                ExtensionClass::mailSend($model->email, 'Kích hoạt tài khoản của bạn tại SaoBang.vn', $content);
                Yii::app()->user->setFlash('login', '<p class="success">Gửi yêu cầu thành công, vui lòng kiểm tra lại email</p>');
                unset(Yii::app()->session['email']);
                unset(Yii::app()->session['userId']);
                $this->redirect(Yii::app()->createUrl('user/login'));
            }
        }
        $this->render('reActive');
    }

    /**
     * topPage
     */
    public function topPage() {
        list($lobalController) = Yii::app()->createController('global/topPage');
        return $lobalController->topPage();
    }

    /**
     * fotter page
     * @return type
     */
    public function footerPage() {
        list($lobalController) = Yii::app()->createController('global/footerPage');
        return $lobalController->footerPage();
    }

    /**
     * banner ad
     */
    public function bannerAd() {
        list($lobalController) = Yii::app()->createController('global/bannerAd');
        return $lobalController->bannerAd();
    }

    /**
     * gooogle ad
     */
    public function googleAd() {
        list($lobalController) = Yii::app()->createController('global/googleAd');
        return $lobalController->googleAd();
    }

    /**
     * set local
     */
    public function setLocal() {
        list($lobalController) = Yii::app()->createController('global/setLocal');
        return $lobalController->setLocal();
    }

}