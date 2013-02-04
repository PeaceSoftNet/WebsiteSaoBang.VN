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
class MarketingTypeModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('demandTypeA, demandTypeB', 'length', 'min' => 5),
            array('demandTypeA, demandTypeB', 'required'),
            array('topicA, topicB', 'length'),
        );
    }

    /**
     * label 
     */
    public function attributeLabels() {
        return array(
            'demandTypeA' => 'Bên A',
            'demandTypeB' => 'Bên B'
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{marketing_type}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}