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
class CrawlerDetail extends CActiveRecord {

    /**
     * rules  
     */
    public function rules() {
        return array(
            array('id, content', 'length'),
            array('content', 'required'),
        );
    }

    /**
     * tables 
     */
    public function tableName() {
        return '{{crawler_detail}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}