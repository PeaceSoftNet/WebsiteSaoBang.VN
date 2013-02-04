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
class PostController extends Controller {

    public $layout = 'Administrator';

    /**
     *  site manager
     */
    public function actionSite() {
        $model = new PostSiteModel;
        if (isset($_POST['PostSiteModel'])) {
            $model->attributes = $_POST['PostSiteModel'];
            if ($model->validate()) {
                $model->save();
                $this->refresh();
            }
        }

        //view
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));

        $dataProvider = new CActiveDataProvider('PostSiteModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('site', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * user manager
     */
    public function actionUser() {
        $siteid = isset($_GET['siteid']) ? $_GET['siteid'] : '';
        if (!$siteid) {
            $this->redirect(array('post/site'));
        }
        $model = new PostUserModel;

        if (isset($_POST['PostUserModel'])) {
            $model->attributes = $_POST['PostUserModel'];
            $model->site = $siteid;
            if ($model->validate()) {
                $model->save();
                $this->refresh();
            }
        }
        $codition = '`site` = ' . $siteid;
        //view
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $criteria->condition = $codition;

        $dataProvider = new CActiveDataProvider('PostUserModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('user', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     *  category
     */
    public function actionCategory() {
        $siteId = isset($_GET['siteid']) ? $_GET['siteid'] : '';

        if (!$siteId) {
            echo 'Access denid';
            exit();
        }

        $model = new PostCategoryModel;

        if (isset($_POST['PostCategoryModel'])) {
            $model->attributes = $_POST['PostCategoryModel'];
            $model->siteId = $siteId;
            if ($model->validate()) {
                $model->save();
                $this->refresh();
            }
        }

        $codition = '`siteId` = ' . $siteId;
        //view
        $criteria = new CDbCriteria(array(
                    'order' => 'id DESC',
                ));
        $criteria->condition = $codition;

        $dataProvider = new CActiveDataProvider('PostCategoryModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('category', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * get url content by curl
     * @param type $url
     * @param type $method
     * @param type $vars
     * @return type 
     */
    public function getUrl($url, $method = '', $vars = '') {
        $ch = curl_init();
        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, YII_ROOT_FOLDER . '/data/cookies/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, YII_ROOT_FOLDER . '/data/cookies/cookie.txt');
        $buffer = curl_exec($ch);
        curl_close($ch);
        return $buffer;
    }

    /**
     * login site by curl
     * @param string $loginUrl 'http://vizum.vn/login.php?do=login';
     * @param type $user
     * @param type $passwd
     * @return boolean
     */
    public function LgVbb($loginUrl, $username, $passwd) {
//        $loginUrl = 'http://vizum.vn/login.php?do=login'; //action from the login form
        $loginFields = array(
            'vb_login_username' => $username,
            'vb_login_password' => $passwd,
            's' => '',
            'securitytoken' => 'guest',
            'do' => 'login',
            'vb_login_md5password' => md5($passwd),
            'vb_login_md5password_utf' => md5($passwd),
        ); //login form field names and values

        $login = self::getUrl($loginUrl, 'post', $loginFields); //login to the site
        return 'Login success';
    }

    public function PostVbb($url, $subject, $message) {
        $result = self::getUrl($url);

        preg_match_all('#name="posthash" value="(.*?)"#s', $result, $a);
        preg_match_all('#name="poststarttime" value="(.*?)"#s', $result, $b);
        preg_match_all('#name="loggedinuser" value="(.*?)"#s', $result, $c);
        preg_match_all('#name="securitytoken" value="(.*?)"#s', $result, $d);
        preg_match_all('#name="f" value="(.*?)"#s', $result, $f);
        $newThreadFields = array(
            'subject' => $subject,
            'message' => $message,
            's' => '',
            'f' => $f[1][0],
            'do' => 'postthread',
            'posthash' => $a[1][0],
            'poststarttime' => $b[1][0],
            'loggedinuser' => $c[1][0],
            'securitytoken' => $d[1][0]
        );

        $postContent = self::getUrl($url, 'post', $newThreadFields);

        return '** Post success **';
    }

    /**
     *  post by other
     */
    public function actionOtherRun() {
        $this->layout = 'HomeLayout';
        $tid = isset($_GET['tid']) ? $_GET['tid'] : '';
        if ($tid) {
            $topic = TopicModel::model()->findByPk($tid);
            $criteria = new CDbCriteria(array(
                        'order' => 'id DESC',
                    ));

            $dataProvider = new CActiveDataProvider('PostSiteModel', array(
                        'pagination' => array(
                            'pageSize' => 40,
                        ),
                        'criteria' => $criteria,
                    ));

            $this->render('run', array('topic' => $topic, 'dataProvider' => $dataProvider));
        }
    }

    public function actionProcess() {
        $sid = isset($_POST['sid']) ? $_POST['sid'] : '';
        $tid = isset($_POST['tid']) ? $_POST['tid'] : '';
        $subject = isset($_POST['tTitle']) ? $_POST['tTitle'] : '';
        if ($sid) {
            $site = PostSiteModel::model()->findByPk($sid);
            $user = PostUserModel::model()->find('`site` = ' . $sid);
            $loginUrl = $site->urlLogin; //echo $loginUrl;
            $username = $user->name; //echo $username;
            $passwd = $user->password; //echo $passwd;
            echo $this->LgVbb($loginUrl, $username, $passwd);
            $topicDetail = TopicDetail::model()->findByPk($tid);
            $message = $topicDetail->content;
            $category = PostCategoryModel::model()->find('`siteId` = ' . $sid . ' AND `categoryId` = 0'); // category id = 0 cho tat ca danh muc hoac category id = category cua bai chi tiet
            $postUrl = $category->url;
            echo $this->PostVbb($postUrl, $subject, $message);
        }
    }

    public function actionViewSite() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $site = PostSiteModel::model()->findByPk($id);
        $url = $site->url;
        echo self::getUrl($url);
    }

    /**
     * get list account through site
     */
    public function listAccount($siteId) {
        $sql = 'select `id`, `name` from {{post_user}} where `site` = ' . $siteId;
        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryAll();
        return $rs;
    }

}