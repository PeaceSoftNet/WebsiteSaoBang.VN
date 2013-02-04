<?php

class TopicSaves extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('userId, topicIds', 'length'),
        );
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{topic_saves}}';
    }

    /**
     *  model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}