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
class HelpModel extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('title, content', 'required'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => TRUE),
        );
    }

    /**
     * attributes
     */
    public function attributeLabels() {
        return array(
            'title' => 'Tiêu đề',
            'content' => 'Nội dung'
        );
    }

    /**
     *  table name
     */
    public function tableName() {
        return '{{help}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}