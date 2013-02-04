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
class DemandModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('order', 'length'),
            array('name, categoryId', 'required'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{category_demand}}';
    }

    /**
     * attributes label 
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên',
            'categoryId' => 'Danh mục',
            'order' => 'Sắp xếp'
        );
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}