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
class PostSiteModel extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('name, url, createUser, status, urlLogin, type', 'length'),
            array('name, url, urlLogin, type', 'required'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('url', 'unique'),
            array('name', 'unique'),
        );
    }

    /**
     * tables name
     */
    public function tableName() {
        return '{{post_site}}';
    }

    /**
     *  attributes lable
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên',
            'url' => 'Địa chỉ url',
            'urlLogin' => 'URL đăng nhập'
        );
    }

    /**
     *  model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}