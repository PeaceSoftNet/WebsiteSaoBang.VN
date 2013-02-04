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
class UserActionModel extends CActiveRecord {

    /**
     *  rules
     */
    public function rules() {
        return array(
            array('userId, email, action, ipAddress', 'length'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
        );
    }

    /**
     *  before save
     */
    public function beforeSave() {
        $this->ipAddress = Yii::app()->request->userHostAddress;
        if (parent::beforeSave()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *  table name
     */
    public function tableName() {
        return '{{user_action}}';
    }

    /**
     *  model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}