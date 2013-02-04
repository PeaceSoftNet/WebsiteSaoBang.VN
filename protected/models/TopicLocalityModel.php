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
class TopicLocalityModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('topicId, localityId', 'length'),
        );
    }

    /**
     * table name 
     */
    public function tableName() {
        return '{{topic_locality}}';
    }

    /**
     * before save 
     */
    public function SaveToDB($condition, $topicId) {
        self::model()->deleteAll('`topicId` = ' . $topicId);
        if ($condition) {
            $sql = 'INSERT INTO `tbl_topic_locality` (`id`, `topicId`, `localityId`) VALUES ' . $condition;
            $command = Yii::app()->db->createCommand($sql);
            $command->execute();
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