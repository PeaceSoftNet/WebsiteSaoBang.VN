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
class BannerModel extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('url, img, position', 'required'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => TRUE),
            array('endDate', 'length'),
        );
    }

    /**
     * attributes
     */
    public function attributeLabels() {
        return array(
            'img' => 'Hình ảnh',
            'url' => 'Đường dẫn',
            'position' => 'Vị trí',
            'endDate' => 'Ngày hết hạn',
        );
    }

    /**
     * tables name
     */
    public function tableName() {
        return '{{banner}}';
    }

    /**
     * after save
     */
    public function afterSave() {
        Yii::app()->cache->delete('ext_getAdBanner');
        parent::afterSave();
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}