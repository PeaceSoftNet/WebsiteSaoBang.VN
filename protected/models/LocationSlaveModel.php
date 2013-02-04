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
class LocationSlaveModel extends SlaveActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('name, parentId, order, alias', 'length'),
            array('name', 'required')
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{location}}';
    }

    /**
     * before save 
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            if (!$this->alias)
                $this->alias = ExtensionClass::utf8_to_ascii($this->name);
            return true;
        }else {
            return false;
        }
    }

    /**
     * attributes label 
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên',
            'parentId' => 'Chọn tỉnh',
            'order' => 'Sắp xếp',
            'alias' => 'Đường dẫn'
        );
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}