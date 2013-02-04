<?php

class TblBlacklist extends CActiveRecord {

    static $str,
            $arrData = array();

    /**
     * rules 
     */
    public function rules() {
        return array(
            array('keyword', 'required'),
            array('keyword', 'length', 'max' => 200),
            array('id, keyword', 'safe', 'on' => 'search'),
        );
    }

    /**
     * tables name 
     */
    public function tableName() {
        return '{{blacklist}}';
    }

    /**
     * attributes label 
     */
    public function attributeLabels() {
        return array(
            'keyword' => 'Từ khóa cảnh báo',
        );
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function strallkeyword() {
        $sql = 'SELECT `keyword` FROM `' . self::tableName() . '` ORDER BY `id` ASC, `keyword` ASC ';
        $command = Yii::app()->db->createCommand($sql);
        $keywords = $command->queryAll();
        if ($keywords) {
            foreach ($keywords as $k => $keyword)
                self::$arrData[$k] = $keyword['keyword'];

            self::$str = implode(',', self::$arrData);
            self::$arrData = null;
        }
        unset($keywords, $sql, $command);
        return self::$str;
    }

}