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
class TopicCommentModel extends CActiveRecord {

    public function rules() {
        return array(
            array('topicId, email, isNotify, isHidden, isDelete', 'length'),
            array('email', 'email'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('content, topicId, email', 'required')
        );
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{topic_comment}}';
    }

    /**
     * attributelabel
     */
    public function attributeLabels() {
        return array(
            'isNotify' => 'Theo dõi chủ đề này',
            'content' => 'Bình luận'
        );
    }

    /**
     * after save
     */
    public function afterSave() {
        $keyCache = 'ad_comment_' . $this->topicId;
        Yii::app()->cache->delete($keyCache);
        $countCacheKey = 'count_comment_cache_' . $this->topicId;
        Yii::app()->cache->delete($countCacheKey);
        parent::afterSave();
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}