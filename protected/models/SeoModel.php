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
class SeoModel extends CActiveRecord {

    /**
     *  rules
     */
    public function rules() {
        return array(
            array('name, isIndex', 'length'),
            array('name', 'unique'),
            array('name', 'required'),
            array('name', 'length', 'min' => 2),
        );
    }

    /**
     *  attributes label
     */
    public function attributeLabels() {
        return array(
            'name' => 'Từ khóa'
        );
    }

    /**
     *  table name
     */
    public function tableName() {
        return '{{seo}}';
    }

    /**
     *  model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}