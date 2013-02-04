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
class PostUserModel extends CActiveRecord {

    /**
     *  rules
     */
    public function rules() {
        return array(
            array('name, password, site, createUser, createDate, status', 'length'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => true),
        );
    }

    /**
     *  table name
     */
    public function tableName() {
        return '{{post_user}}';
    }

    /**
     *  attributes label
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tài khoản',
            'password' => 'Mật khẩu',
        );
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}