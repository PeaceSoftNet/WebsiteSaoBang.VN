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
class StatisticUrl extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('type', 'length'),
            array('name', 'unique'),
            array('name', 'required'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{statistic_url}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}