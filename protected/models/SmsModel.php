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
class SmsModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('phone, service, requestId, msg, code, subCode, timeReceive, success, teleName', 'length'),
        );
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{sms}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}