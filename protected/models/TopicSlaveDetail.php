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
class TopicSlaveDetail extends SlaveActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('id, images, status', 'length'),
            array('content', 'required'),
            array('content', 'length', 'min' => 100),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{topic_detail}}';
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
            'content' => 'Nội dung',
            'images' => 'Hình ảnh'
        );
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}