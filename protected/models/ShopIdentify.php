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
class ShopIdentify extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('content, tag', 'length'),
            array('content', 'required')
        );
    }

    /**
     * attributes label
     */
    public function attributeLabels() {
        return array(
            'content' => 'Sản phẩm cung cấp chính'
        );
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
//        update to solr
        Yii::app()->shopSearch->updateOne(array('id' => $this->id,
            'content' => $this->content,
            'text' => $this->tag)
        );
        parent::afterSave();
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{shop_identify}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
