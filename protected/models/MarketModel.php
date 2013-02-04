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
class MarketModel extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('id, time_start, time_end, type, status, category_id, user_id')
        );
    }

    /**
     * tables name
     */
    public function tableName() {
        return '{{market_vip}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}