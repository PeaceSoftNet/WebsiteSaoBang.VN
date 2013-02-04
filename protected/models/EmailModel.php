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
class EmailModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('email', 'email'),
            array('email', 'required'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => TRUE),
            array('lastSend', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{email}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}