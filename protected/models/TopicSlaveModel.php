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
class TopicSlaveModel extends SlaveActiveRecord {

    public $checkBoxRules;
    public $verifyCode;

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('id, authorId, price, demand, locality, description, icon, endDate, status, type, order, isPublished, isSms, isDelete', 'length'),
            array('extension1, extension2, extension3, extension4, extension5', 'length'),
            array('site, domain', 'length'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => true),
            array('title, categoryId, childCatId, email', 'required'),
            array('checkBoxRules', 'required', 'requiredValue' => true, 'message' => 'Bạn chưa chấp nhận các Điều khoản và Quy định của SaoBăng.vn'),
            array('email', 'email'),
            array('title', 'length', 'max' => 140),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{topic}}';
    }

    /**
     * before save 
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->order = (int) time();
            $this->description = self::textProcess($this->description);
            $this->endDate = time() + (60 * 60 * 24 * 30);
            if (!$this->authorId && Yii::app()->session['userId'])
                $this->authorId = Yii::app()->session['userId'];
            return true;
        } else {
            return false;
        }
    }

    /**
     * after save 
     */
    public function afterSave() {
        //update to solr
        $listFillter = array(
            'id' => $this->id,
            'title' => $this->title,
            'categoryId' => $this->categoryId,
            'childCatId' => $this->childCatId,
            'demand' => $this->demand,
            'extension1' => $this->extension1,
            'extension2' => $this->extension2,
            'extension3' => $this->extension3,
            'extension4' => $this->extension4,
            'extension5' => $this->extension5,
            'site' => $this->site,
            'domain' => $this->domain,
            'locality' => $this->locality,
            'description' => $this->description,
        );
        if ($this->isSms) {
            $listFillter = array_merge($listFillter, array('isVip' => '1'));
        }

        $data = Yii::app()->CURL->run('http://saobang.vn/topic/AppendSolr', FALSE, $listFillter);

        $actionModel = new UserActionModel;
        $actionModel->userId = $this->authorId;
        $actionModel->email = $this->email;
        $actionModel->action = 'RAO_VAT_' . $this->id . '_' . $this->title;
        $actionModel->save();

        parent::afterSave();
    }

    /**
     * attributes label 
     */
    public function attributeLabels() {
        return array(
            'title' => 'Tiêu đề',
            'email' => 'Email',
            'price' => 'Giá',
            'locality' => 'Tỉnh',
            'order' => 'Sắp xếp',
            'categoryId' => 'Danh mục',
            'childCatId' => 'Danh mục con',
            'domain' => 'Domain',
            'demand' => 'Nhu cầu',
            'createDate' => 'Thời gian tạo',
            'mobileNumber' => 'Số điện thoại',
            'verifyCode' => 'Mã xác thực'
        );
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * string text process 
     */
    public function textProcess($text) {
        $numval = 250;
        $text = strip_tags($text);
        if (strlen($text) > $numval) {
            $text = substr($text, 0, $numval);
            $number = strlen(strrchr($text, ' '));
            $text = substr($text, 0, $numval - $number);
            return $text . '...';
        } else {
            return $text;
        }
    }

    /**
     * after delete 
     */
    public function afterDelete() {
        parent::afterDelete();
        $data = Yii::app()->CURL->run('http://saobang.vn/topic/deleteSolr', FALSE, array(
            'id' => $this->id,
                )
        );
    }

}