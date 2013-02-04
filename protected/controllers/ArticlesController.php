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
class ArticlesController extends Controller {

    /**
     * set layout default
     * @var type 
     */
    public $layout = 'Administrator';

    /**
     * set keyword default for search
     * @var type 
     */
    public $keyword = '';

    /**
     * add and edit articles
     */
    public function actionAdd() {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $model = ArticlesModel::model()->findByPk($id);
        } else {
            $model = new ArticlesModel;
        }
        if (isset($_POST['ArticlesModel'])) {
            $model->attributes = $_POST['ArticlesModel'];

            if ($model->validate()) {
                $model->save();
                if ($id) {
                    $this->redirect(array('articles/add'));
                } else {
                    $this->refresh();
                }
            }
        }

        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('ArticlesModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('admin/add', array('model' => $model, 'dataProvider' => $dataProvider));
    }

    /**
     * view list
     */
    public function actionView() {
        $this->layout = 'HomePage';

        $criteria = new CDbCriteria(array(
                    'condition' => '',
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('ArticlesModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $dataProvider = $dataProvider->getData();

        $this->render('view', array('dataProvider' => $dataProvider));
    }

    /**
     * detail
     */
    public function actionDetail() {
        $this->layout = 'HomeArticles';

        $privateValue = ExtensionClass::utf8_to_ascii($_SERVER["REMOTE_ADDR"]);

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $shareId = isset($_GET['share']) ? $_GET['share'] : '';

        //Neu la lan dau tien load trang, cap phat bo nho xac nhan
        $value = Yii::app()->cache->get('isFistLoad_' . $privateValue . '_' . $id);
        if ($value === false) {
            //Day la lan load dau tien cua ban doi voi tin bai nay
            $value = 'true';

            Yii::app()->cache->set('isFistLoad_' . $privateValue . '_' . $id, $value, 60 * 5);
            //cap 1 chung thuc trong 58 giay ban onsite
            Yii::app()->cache->set('isFinishtLoad_' . $privateValue . '_' . $id, $value, 55);
        } else {
            //xoa xac nhan lan dau tien vao trang
            Yii::app()->cache->delete('isFistLoad_' . $privateValue . '_' . $id);
            //phan nay xu ly viec refresh lai trang
            $valueCheck = Yii::app()->cache->get('isFinishtLoad_' . $privateValue . '_' . $id);
            //check ip isBan
            $checkIp = Yii::app()->cache->get('isBanIp_' . $privateValue . '_' . $id);
            if ($valueCheck === false && $checkIp === false) {
                //xu ly theo cam ket
                self::addCoin($shareId, $id);    //cong diem cho thanh vien
            }
        }

        $articles = ArticlesModel::model()->findByPk($id);

        $condition = 'id != ' . $id;
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => 'id DESC',
                ));
        $dataProvider = new CActiveDataProvider('ArticlesModel', array(
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                    'criteria' => $criteria,
                ));

        $dataProvider = $dataProvider->getData();

        $this->render('detail', array('articles' => $articles, 'dataProvider' => $dataProvider));
    }

    /**
     * add coin
     */
    public function addCoin($shareId, $articlesId) {
        $model = MemberCoin::model()->findByPk($shareId);
        if ($model) {
            $model->coin = $model->coin + 1;
            $model->update();
        } else {
            $model = new MemberCoin;
            $model->userShareId = $shareId;
            $model->coin = 1;
            $model->save();
        }
        $value = "lock";
        $privateValue = ExtensionClass::utf8_to_ascii($_SERVER["REMOTE_ADDR"]);
        //set memcache lock ip user 8h
        Yii::app()->cache->set('isBanIp_' . $privateValue . '_' . $articlesId, $value, 8 * 60 * 60);
    }

    /**
     * about event
     */
    public function actionAbout() {
        $this->layout = 'HomeArticles';

        $this->render('about');
    }

}