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
class AskEmail extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('email', 'email'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('title, content, email', 'required'),
            array('askId, reportId, isSend, isOpen', 'length'),
            array('hash', 'unique'),
        );
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{ask_email}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}