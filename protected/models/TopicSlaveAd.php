<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
class TopicSlaveAd extends SlaveActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('title, categoryId, authorId, timeValue, price, icon', 'length'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
        );
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{topic_ad}}';
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
     * after save
     */
    public function afterSave() {
        $topic = TopicModel::model()->findByPk($this->id);
        $topic->isSms = 1;
        $topic->update();
        $timeCheck = time() + 6 * 3 * 24 * 60 * 60;
        if ($this->timeValue > $timeCheck) {
            $userVip = new UserVipModel;
            $userVip->userId = $this->authorId;
            $userVip->save();
        }
        parent::afterSave();
    }

    /**
     *  model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}