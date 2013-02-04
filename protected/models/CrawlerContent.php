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
class CrawlerContent extends CActiveRecord {

    /**
     *  rules
     */
    public function rules() {
        return array(
            array('id, title, mobile, address, categoryId, categoryChildId, Location, createDate, domain, url, is_insert', 'length'),
            array('id', 'unique'),
//            array('url', 'unique'),
            array('title, categoryChildId', 'required'),
        );
    }

    /**
     * before save 
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{crawler_content}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}