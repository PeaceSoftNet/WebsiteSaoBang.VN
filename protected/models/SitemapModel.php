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
class SitemapModel extends CActiveRecord {

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('url, lastCode', 'length')
        );
    }

    /**
     * table namd 
     */
    public function tableName() {
        return '{{sitemap}}';
    }

    /**
     * model 
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}