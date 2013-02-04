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
class StatisticModel extends CActiveRecord {

    /**
     * rules
     * 
     */
    public function rules() {
        return array(
            array('controller, action, category, key, value, url, locality', 'length'),
            array('lastUpdate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
        );
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{statistic}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}