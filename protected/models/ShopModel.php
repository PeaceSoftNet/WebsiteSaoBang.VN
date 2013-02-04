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
class ShopModel extends CActiveRecord {

    public $tag, $product, $checkBoxRules, $category;

    /**
     * rules
     */
    public function rules() {
        return array(
            array('name, email', 'required'),
            array('name', 'unique'),
            array('checkBoxRules', 'required', 'requiredValue' => true, 'message' => 'Bạn chưa chấp nhận các Điều khoản và Quy định của SaoBăng.vn'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('logo, category, description, tag, address', 'length'),
            array('url, phone, zone, rank', 'length'),
            array('isSMS', 'length')
        );
    }

    /**
     * attributes label
     */
    public function attributeLabels() {
        return array(
            'name' => 'Tên người bán',
            'description' => 'Miêu tả',
            'email' => 'Các email nhận yêu cầu',
            'logo' => 'Ảnh đại diện',
            'url' => 'Website của Shop',
            'address' => 'Địa chỉ Shop',
            'phone' => 'Điện thoại',
            'zone' => 'Chọn tỉnh/thành phố',
            'rank' => 'Đánh giá'
        );
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->description = GlobalComponents::processContent($this->description);
            return true;
        } else {
            return false;
        }
    }

    /**
     * after save
     */
    public function afterSave() {
        $listTag = json_decode($this->tag);
        $cond = '';
        if (is_array($listTag)) {
            foreach ($listTag as $key => $tagId) {
                $cond .= ', (' . $this->id . ', ' . $tagId . ')';
            }
            if (strlen($cond) > 3) {
                $cond = substr($cond, 1);
                //remove old shop's tag
                $sqlDel = 'DELETE FROM {{shop_tag}} WHERE `shopId` = ' . $this->id;
                $commadDel = Yii::app()->db->createCommand($sqlDel);
                $commadDel->execute();
                //insert new tag
                $sql = 'INSERT INTO {{shop_tag}}(`shopId`, `tagId`) VALUES ' . $cond;
                $commad = Yii::app()->db->createCommand($sql);
                $commad->execute();
            }
        }
        parent::afterSave();
    }

    /**
     * tables name
     */
    public function tableName() {
        return '{{shop}}';
    }

    /**
     * static model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}