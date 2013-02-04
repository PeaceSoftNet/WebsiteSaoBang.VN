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
class AttributesModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('group, order', 'length'),
            array('name, categoryId', 'required'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{attributes}}';
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
     * attributes label 
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên thuộc tính',
            'categoryId' => 'Danh mục',
            'group' => 'Nhóm thuộc tính',
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