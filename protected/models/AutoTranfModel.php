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
class AutoTranfModel extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('id, time', 'length')
        );
    }

    /**
     * tables name
     */
    public function tableName() {
        return '{{autotranf}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}