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
class AutorunModel extends CActiveRecord {

    /**
     *  rules
     */
    public function rules() {
        return array(
            array('catId, childCat, keyword, key, value', 'length')
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{autorun}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}