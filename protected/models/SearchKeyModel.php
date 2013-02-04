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
class SearchKeyModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('name, categoryId, childCatId, googleActive, order', 'length'),
            array('name, childCatId, categoryId', 'required'),
            array('name', 'length', 'min' => 2),
        );
    }

    public function afterFind() {
        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot")) {
            if (!$this->googleActive)
                $this->googleActive = 1;
            $this->update();
        }
        parent::afterFind();
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{search_key}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}