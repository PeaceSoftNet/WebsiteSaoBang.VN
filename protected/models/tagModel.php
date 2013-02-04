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
class tagModel extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('name', 'unique'),
            array('name', 'required'),
        );
    }

    /**
     * attributes name
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên tag'
        );
    }

    /**
     * attributes
     */
    public function tableName() {
        return '{{tag}}';
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->name = strtolower($this->name);
            $this->id = ExtensionClass::utf8_to_ascii($this->name);
            return true;
        }
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}