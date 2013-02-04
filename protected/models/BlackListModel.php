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
class BlackListModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('keyword', 'length'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{blacklist}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}