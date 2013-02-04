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
class ArticlesModel extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('description, budget, beginTime, endTime', 'length'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('title, content, avata', 'required'),
        );
    }

    /**
     * attributes label
     */
    public function attributeLabels() {
        return array(
            'title' => 'Tiêu đề',
            'description' => 'Miêu tả',
            'content' => 'Nội dung',
            'budget' => 'Dự trù ngân sách',
            'beginTime' => 'Thời gian bắt đầu sự kiện',
            'endTime' => 'Thời gian kết thúc sự kiện',
            'avata' => 'Hình ảnh minh họa'
        );
    }

    /**
     * tables name
     */
    public function tableName() {
        return '{{articles}}';
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->beginTime = strtotime($this->beginTime);
            $this->endTime = strtotime($this->endTime);
            return true;
        }
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * ad coin
     */
    public function addCoin($shareId) {
        $sql = '';
    }

}