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
class TopicLink extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('id, link', 'length')
        );
    }

    /**
     *  table name
     */
    public function tableName() {
        return '{{topic_link}}';
    }

    /**
     * topic model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}