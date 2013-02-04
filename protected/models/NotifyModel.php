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
class NotifyModel extends CActiveRecord {

    /**
     *  rules
     */
    public function rules() {
        return array(
            array('title, content', 'required'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
        );
    }

    /**
     * tables name
     */
    public function tableName() {
        return '{{notify}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}