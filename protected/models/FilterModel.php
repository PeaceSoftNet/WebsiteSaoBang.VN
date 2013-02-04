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
class FilterModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('order, beginPrice, endPrice', 'length'),
            array('name, categoryId', 'required'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{category_filter}}';
    }

    /**
     * attributes label 
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên',
            'categoryId' => 'Danh mục',
            'order' => 'Sắp xếp',
            'beginPrice' => 'Giá bắt đầu',
            'endPrice' => 'Giá kết thúc'
        );
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}