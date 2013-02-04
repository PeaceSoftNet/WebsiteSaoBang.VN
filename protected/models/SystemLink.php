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
class SystemLink extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('id, link', 'length'),
            array('link', 'unique'),
        );
    }

    /**
     *  table name
     */
    public function tableName() {
        return '{{system_link}}';
    }

    /**
     * topic model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}