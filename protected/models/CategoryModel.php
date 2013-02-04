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
class CategoryModel extends CActiveRecord {

    /**
     * Values rules 
     */
    public function rules() {
        return array(
            array('name, parentId', 'required'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('description', 'length', 'max' => 128),
            array('displayUrl, icon, order', 'length'),
            array('isPrice, isHidden, isChildLocality, isDelete, totalItem, classCss', 'length'),
        );
    }

    /**
     * relation 
     */
    public function relations() {
        return array(
            'child' => array(self::BELONGS_TO, 'CategoryModel', 'parentId'),
        );
    }

    /**
     * table name define
     */
    public function tableName() {
        return '{{category}}';
    }

    /**
     * Attributes label 
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên chuyên mục',
            'description' => 'Miêu tả',
            'displayUrl' => 'Đường dẫn',
            'parentId' => 'Chuyên mục cha',
            'isPrice' => 'Yêu cầu giá sản phẩm',
            'isHidden' => 'Chuyên mục ẩn',
            'order' => 'Sắp xếp',
            'icon' => 'Ảnh đại diện',
            'isChildLocality' => 'Hiển thị quận / huyện',
            'classCss' => 'Cấu hình Css'
        );
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            if (!$this->displayUrl) {
                $this->displayUrl = ExtensionClass::utf8_to_ascii($this->name);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function hiddenName() {
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

    public static function hiddenChild($data) {
        $title = 'Click để ẩn';
        $imageFile = 'display.png';
        if ($data['isHidden'] == '1') {
            $imageFile = 'hindden.png';
            $title = 'Click để hiển thị';
        }
        return '<a href="javascript:void(0);" onclick="changerisHidden(this);" rel="' . $data['id'] . '" title="' . $title . '" >
                <img id="Chienlv-' . $data['id'] . '" style="width:16px; height:16px;" src="' . Yii::app()->request->baseUrl . '/themes/backend/images/' . $imageFile . '">
            </a>';
    }

}