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
class CrawlerSite extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('totalLink, classCss, url, order,isHidden', 'length'),
            array('lastUpdate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => true),
            array('isHidden', 'default', 'value' => 0),
            array('name', 'required'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{site}}';
    }

    /**
     * attributes label 
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên',
            'classCss' => 'Css',
            'url' => 'Địa chỉ url',
            'order' => 'Sắp xếp',
            'isHidden' => 'Trạng thái'
        );
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function hidenAction() {
        $title = 'Click để ẩn';
        $imageFile = 'display.png';
        if ($this->isHidden == 1) {
            $imageFile = 'hindden.png';
            $title = 'Click để hiển thị';
        }
        return '<a href="javascript:void(0);" onclick="changerisHidden(this);" rel="' . $this->id . '" title="' . $title . '" >
                <img id="Chienlv-' . $this->id . '" style="width:16px; height:16px;" src="' . Yii::app()->request->baseUrl . '/themes/backend/images/' . $imageFile . '">
            </a>';
    }

}