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
class UserVipModel extends CActiveRecord {

    /**
     * rules
     * @return type
     */
    public function rules() {
        return array(
            array('userId, status', 'length'),
            array('userId', 'unique'),
            array('beginDate', 'default', 'value' => time(), 'setOnEmpty' => false),
            array('endDate', 'default', 'value' => time() + 30 * 24 * 60 * 60, 'setOnEmpty' => false),
        );
    }

    /**
     * tables name
     * @return string
     */
    public function tableName() {
        return '{{user_vip}}';
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $clear = UserVipModel::model()->find('`userId` = ' . $this->userId);
            if ($clear)
                $clear->delete();
            return true;
        }else {
            return fasle;
        }
    }

    /**
     * after save, write cache time
     */
    public function afterSave() {
        $timeLimited = time() + 28 * 24 * 60 * 60;
        $string = date('Ym', $timeLimited);
        $key = $string . '_' . $this->userId;
        Yii::app()->cache->set($key, true, 30 * 24 * 60 * 60);
        parent::afterSave();
    }

    /**
     * model
     * @param type $className
     * @return type
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}