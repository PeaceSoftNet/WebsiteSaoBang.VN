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
class AttributesCrontab extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('url', 'unique'),
        );
    }

    /**
     * tablename 
     */
    public function tableName() {
        return '{{attributes_crontab}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}