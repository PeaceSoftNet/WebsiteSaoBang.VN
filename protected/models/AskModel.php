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
class AskModel extends CActiveRecord {

    public $checkBoxRules;

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('title', 'required', 'message' => 'Tiêu đề tin không được phép rỗng'),
            array('content', 'required', 'message' => 'Nội dung hỏi mua không được phép rỗng'),
            array('email', 'required', 'message' => 'Email rỗng hoặc bạn chưa đăng nhập'),
            array('email', 'email'),
            array('tag, visit, report, userId, userInfo, status', 'length'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => true),
            array('mobileNumber', 'length', 'min' => 10, 'max' => 12),
            array('checkBoxRules', 'required', 'requiredValue' => true, 'message' => 'Bạn chưa chấp nhận các Điều khoản và Quy định của SaoBăng.vn'),
            array('isQuote, lastUpdate, isAuth', 'length'),
            array('lastUpdate', 'default', 'value' => time(), 'setOnEmpty' => true),
        );
    }

    /**
     * attributes label
     */
    public function attributeLabels() {
        return array(
            'isQuote' => 'Tôi muốn nhận báo giá từ những người bán khác nữa. '
        );
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            //remove cache by id
            Yii::app()->cache->delete('askModel_byId_' . $this->id);

            return true;
        } else {
            return false;
        }
    }

    /**
     * after save
     */
    public function afterSave() {
        //check auth
        if ($this->isAuth == 0) {
            //check xac thuc
            $key_isAuth = $this->email . $this->title . $this->createDate;
            $key_isAuth = md5($key_isAuth);
            $value = Yii::app()->cache->get($key_isAuth);
            if ($value === false) {
                $title = 'Kích hoạt nội dung đăng hỏi mua tại saobang.vn ' . date('d/m/Y');
                $content = self::mailContent($this->title, $this->id, $this->content);
                ExtensionClass::mailSend($this->email, $title, $content); // regenerate $value because it is not found in cache
                // and save it in cache for later use:
                Yii::app()->cache->set($key_isAuth, $title, 60 * 60);
            }
        }
        parent::afterSave();
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{ask}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * after delete
     */
    public function afterDelete() {
        Yii::app()->cache->flush();                
        parent::afterDelete();
    }

    /**
     * email content
     */
    private function mailContent($title, $id, $content) {
        $content = '<p>Chào bạn.</p>
                <p>Bạn đã đăng một chủ đề hỏi mua tại <a href="http://saobang.vn' . Yii::app()->createUrl('ask/detail', array('id' => $id, 'title' => ExtensionClass::utf8_to_ascii($title))) . '">' . $title . '</a></p>
                <p style="padding: 5px 30px; border-left: 1px solid #333; color: #333;">' . $content . '</p>
                <p style="padding: 10px;"><strong>Click <a target="_blank" href="http://saobang.vn' . Yii::app()->createUrl('ask/isAuth', array('askId' => $id, 'hash' => md5($id . 'saobang.vnauth'))) . '">tại đây</a> để xác nhận nội dung bạn đã đăng trên Saobang.vn</strong></p>
                <p>Nếu trình duyệt không chuyển trang, vui lòng copy link: http://saobang.vn' . Yii::app()->createUrl('ask/isAuth', array('askId' => $id, 'hash' => md5($id . 'saobang.vnauth'))) . ' và chạy bằng trình duyệt</p>
                <p><strong><i>Support saobang.vn</></strong></p>
                </p>';
        return $content;
    }

}