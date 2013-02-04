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
class ReportModel extends CActiveRecord {

    public function rules() {
        return array(
            array('topicId, title, content', 'length'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{topic_report}}';
    }

    /**
     * attributes labael 
     */
    public function attributeLabels() {
        return array(
            'content' => 'Nội dung'
        );
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}