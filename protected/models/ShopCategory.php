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
class ShopCategory extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('name', 'required'),
        );
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{shop_category}}';
    }

    /**
     * after save remove cache
     */
    public function afterSave() {
        $dataProvider = Yii::app()->cache->delete('adExtension_getListShopCategory');
        parent::afterSave();
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}