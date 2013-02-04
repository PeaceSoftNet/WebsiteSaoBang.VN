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
class ShopEmail extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('email', 'email'),
            array('content, title, shopId, email', 'required'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
        );
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            ExtensionClass::mailSend($this->email, $this->title, $this->content);
            return true;
        } else {
            return false;
        }
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{shop_email}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}