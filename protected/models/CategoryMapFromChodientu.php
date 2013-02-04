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
class CategoryMapFromChodientu extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('id, parent_id, name, sb_id, sb_parent, sb_cat')
        );
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{category_map_chodientu}}';
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}