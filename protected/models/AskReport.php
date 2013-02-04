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
class AskReport extends CActiveRecord {

    /**
     * rules
     */
    public function rules() {
        return array(
            array('comment, price, link, askId, userId, email', 'length'),
            array('email', 'email'),
            array('comment, email', 'required'),
            array('link', 'url'),
            array('createDate', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false),
            array('hash', 'unique')
        );
    }

    /**
     * table name
     */
    public function tableName() {
        return '{{ask_report}}';
    }

    /**
     * before save
     */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->price = str_replace('.', '', $this->price);
            return true;
        } else {
            return false;
        }
    }

    /**
     * after save
     */
    public function afterSave() {
        //remove cache
        Yii::app()->cache->delete('AskReport_By_askId_' . $this->askId);
        Yii::app()->cache->delete('AskReport_itemcount_By_askId_' . $this->askId);

        $askModel = Yii::app()->cache->get('askModel_byId_' . $this->askId);
        if ($askModel === false) {
            $askModel = AskModel::model()->findByPk($this->askId);
            Yii::app()->cache->set('askModel_byId_' . $this->askId, $askModel, 60 * 60);
        }
        $askModel->lastUpdate = time();
        $itemCount = AskReport::model()->count("askId=:askId AND price > 1000", array("askId" => $this->askId));
        $askModel->report = $itemCount;
        $askModel->update();
        //change cache
        Yii::app()->cache->set('askModel_byId_' . $this->askId, $askModel, 60 * 60);
        //insert into list email
        $title = 'Hỏi mua: ' . $askModel->title;
        $content = '<p>Chào bạn.</p>
        <p>Chủ đề <a href="http://saobang.vn' . Yii::app()->createUrl('ask/detail', array('id' => $askModel->id, 'title' => ExtensionClass::utf8_to_ascii($askModel->title), 'm' => $this->id)) . '">' . $askModel->title . '</a> có trả lời mới từ ' . $askModel->email . ':</p>
        <p style="padding: 5px 30px; border-left: 1px solid #333; color: #333;">' . $this->comment . '</p>
        <p>Xem chi tiết <a href="http://saobang.vn' . Yii::app()->createUrl('ask/detail', array('id' => $askModel->id, 'title' => ExtensionClass::utf8_to_ascii($askModel->title), 'm' => $this->id)) . '">tại đây</a>
            <p><strong><i>Support saobang.vn</></strong></p>
        </p>';

        //send email for asker.
        if ($askModel->email != $this->email)
            self::emailNotify($this->askId, $title, $this->id, $content, $askModel->email);
        /**
         * email comment
         * send email for comment
         */
        $listEmail = self::getListEmail($this->askId);
        foreach ($listEmail as $key => $email) {
            if ($email != $askModel->email && $email != $this->email)
                self::emailNotify($this->askId, $title, $this->id, $content, $email);
        }
        Yii::app()->CURL->run('http://saobang.vn/autorun/emailNotify');
        parent::afterSave();
    }

    /**
     * email notify
     */
    private function emailNotify($askId, $title, $reportId, $reportContent, $email) {
        $modelMail = new AskEmail();
        $modelMail->title = $title;
        $modelMail->content = $reportContent;
        $modelMail->askId = $askId;
        $modelMail->reportId = $reportId;
        $modelMail->email = $email;
        //check email is open
        $modelMail->hash = md5($askId . '_' . $email . '_0');
        if ($modelMail->validate()) {
            $modelMail->save();
        }
    }

    /**
     * get list email from comment
     */
    private function getListEmail($askId) {
        $sql = 'SELECT distinct `email` FROM {{ask_report}} WHERE `askId` = ' . $askId;
        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryColumn();
        return $rs;
    }

    /**
     * model
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}