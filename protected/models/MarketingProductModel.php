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
class MarketingProductModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('email, phone, title, description', 'length'),
            array('email', 'email'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => true),
            array('code', 'unique'),
        );
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{marketing_product}}';
    }

    /**
     * before save 
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->code = md5($this->email . $this->title);
            return true;
        } else {
            return false;
        }
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}