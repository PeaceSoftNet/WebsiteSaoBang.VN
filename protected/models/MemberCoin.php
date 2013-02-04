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
class MemberCoin extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('userShareId, coin', 'length')
        );
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{member_coin}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}