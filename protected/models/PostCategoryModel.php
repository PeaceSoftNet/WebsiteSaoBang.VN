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
class PostCategoryModel extends CActiveRecord {

    /**
     *  rules
     */
    public function rules() {
        return array(
            array('name, siteId, createUser', 'length'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('name, categoryId, url', 'required')
        );
    }

    /**
     *  tables name
     */
    public function tableName() {
        return '{{post_category}}';
    }

    /**
     *  attributes label
     */
    public function attributeLabels() {
        return array(
            'categoryId' => 'Danh mục tưng ứng trên saobang',
            'name' => 'Tên danh mục đăng tin',
            'url' => 'Đường dẫn tới thu mục đăng tin'
        );
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}