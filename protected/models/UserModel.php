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
class UserModel extends CActiveRecord {

    public $password2;
    public $oldPass;
    private $maxLength = 255;
    private $minLength = 6;
    public $remember_me;
    public $curent_pass;

    /**
     * rules 
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('email, password,password2,remember_me', 'required'),
            array('email, password,password2,remember_me', 'required', 'on' => 'login, register'),
            array('email, password, remember_me', 'safe', 'on' => 'login'),
            array('remember_me', 'required', 'on' => 'register'),
            array('email', 'required', 'on' => 'login, forgotPassword, register'),
            array('blog', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'Tên blog chỉ bao gồm các ký tự a-z, 0-9'),
            array('password2', 'required', 'on' => 'register, change'),
            array('oldPass', 'required', 'on' => 'change', 'message' => 'Bạn chưa nhập mật khẩu cũ'),
            array('password,password2', 'checkPass', 'on' => 'change,register'),
            # Check điều khoản
            array('remember_me', 'checkRememberMme', 'on' => 'register'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('isActive', 'default', 'value' => 1, 'setOnEmpty' => true),
            array('email', 'email', 'on' => 'login, forgotPassword, register'),
            array('email', 'unique', 'on' => 'register'),
            array('password2', 'compare', 'compareAttribute' => 'password', 'on' => 'register, change'),
            array('email', 'checkExistsEmail', 'on' => 'forgotPassword'),
            array('oldPass', 'checkOldPass', 'on' => 'change'),
            array('isActive', 'numerical', 'integerOnly' => true),
            array('email, password', 'length', 'max' => 255),
            array('id, email, password,createDate,remember_me,blog,mobile, im, address, avata, info, lastLoginDate, isActive', 'safe', 'on' => 'search'),
        );
    }

    public function checkOldPass() {
        if (md5($this->oldPass) != $this->curent_pass)
            $this->addError('oldPass', 'Bạn nhập sai mật khẩu cũ .');
    }

    public function checkRememberMme() {
        if ($this->remember_me == 0)
            $this->addError('remember_me', 'Bạn chưa đồng ý với các điều khoản .');
    }

    public function checkExistsEmail() {
        $record = UserModel::model()->findByAttributes(array('email' => $this->email), array('select' => 'id'));
        if ($record === null)
            $this->addError('email', 'Incorrect email or email was not exists.');
    }

    public function checkPass() {
        if (strlen($this->password) < $this->minLength || strlen($this->password) > $this->maxLength)
            $this->addError('password', Yii::t('BackEnd', 'Mật khẩu quá ngắn.'));
        else if ($this->password != $this->password2)
            $this->addError('password2', Yii::t('BackEnd', 'Mật khẩu bạn nhập không khớp'));
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * attributes 
     */
    public function attributeLabels() {
        return array(
            'address' => 'Địa chỉ',
            'avata' => 'Ảnh đại diện',
            'info' => 'Thông tin',
            'mobile' => 'Số điện thoại di động',
            'password' => 'Mật khẩu',
            'password2' => 'Nhập lại mật khẩu'
        );
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * before save 
     */
    public function beforeSave() {
        if (parent::beforeSave()) {

            return true;
        } else {
            return false;
        }
    }

    /**
     *  after save
     */
    public function afterSave() {
        if (Yii::app()->controller->action->id == 'register') {
            $actionModel = new UserActionModel;
            $actionModel->userId = $this->id;
            $actionModel->email = $this->email;
            $actionModel->action = 'DANG_KY_THANH_VIEN';
            $actionModel->save();
        } elseif (Yii::app()->controller->action->id == 'login') {
            $actionModel = new UserActionModel;
            $actionModel->userId = $this->id;
            $actionModel->email = $this->email;
            $actionModel->action = 'DANG_NHAP';
            $actionModel->save();
        } elseif (Yii::app()->controller->action->id == 'changerPassword') {
            $actionModel = new UserActionModel;
            $actionModel->userId = $this->id;
            $actionModel->email = $this->email;
            $actionModel->action = 'DOI_MAT_KHAU';
            $actionModel->save();
        }
        parent::afterSave();
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return $this->hashPassword($password) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public static function hashPassword($password) {
        return md5($password);
    }

}