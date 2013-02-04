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
class AskShop extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('shopId, askId', 'required'),
            array('type', 'length')
        );
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{ask_shop}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}