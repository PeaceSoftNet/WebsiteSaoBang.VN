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
class AdExtension {
    /**
     * set time to cache
     */

    const _forever = 360000;
    const _btime = 60000;
    const _ntime = 3600;
    const _stime = 5;
    const _SITENAME = 'Rao vặt';
    const _TOANQUOC = 'Toàn quốc';

    /**
     * get category by id
     * param category id
     * return model category
     * cache name: adExtension_category_id_[category Id]
     */
    public static function getCategoryById($categoryId = 0) {
        $cacheId = 'adExtension_category_id_' . $categoryId;
//        $model = Yii::app()->cache->delete($cacheId);
        $model = Yii::app()->cache->get($cacheId);
        if ($model === false) {
            $model = CategoryModel::model()->findByPk($categoryId);
            if (!$model) {
                $model = new CategoryModel;
                $model->name = self::_SITENAME;
                $model->id = 0;
            }
            Yii::app()->cache->set($cacheId, $model, self::_btime);
        }
        return $model;
    }

    /**
     * get list category
     * @param type $parentCategoryId
     * @return type
     */
    public static function getListCategory() {
        $cacheId = 'adExtension_listCategory';
//        $dataProvider = Yii::app()->cache->delete($cacheId);
        $dataProvider = Yii::app()->cache->get($cacheId);
        if ($dataProvider === false) {
            $criteria = new CDbCriteria(array(
                        'order' => '`order` DESC',
                    ));
            $dataProvider = new CActiveDataProvider('CategoryModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));
            //get data
            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($cacheId, $dataProvider, self::_btime);
        }
        return $dataProvider;
    }

    /**
     * get list child category by parent category id
     * param: parentCategoryId
     * return object dataprovider
     * cache name: adExtension_listCategory_pId_[parentCategoryId]
     */
    public static function getListChildCategory($parentCategoryId) {
        $cacheId = 'adExtension_listCategory_parentId_' . $parentCategoryId;
//        $dataProvider = Yii::app()->cache->delete($cacheId);
        $dataProvider = Yii::app()->cache->get($cacheId);
        if ($dataProvider === false) {
            if ($parentCategoryId) {
                $condition = '`parentId` = ' . $parentCategoryId;
            } else {
                $condition = '`parentId` = 0';
            }
            $criteria = new CDbCriteria(array(
                        'condition' => $condition,
                        'order' => '`order` DESC',
                    ));
            $dataProvider = new CActiveDataProvider('CategoryModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));
            //get data
            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($cacheId, $dataProvider, self::_btime);
        }
        return $dataProvider;
    }

    /**
     * get local
     * @param type $localId
     * @return \LocationModel
     */
    public static function getLocalById($localId = 0) {
        $cacheId = 'Adextension_localById_' . $localId;
//        $model = Yii::app()->cache->delete($cacheId);
        $model = Yii::app()->cache->get($cacheId);
        if ($model === false) {
            $model = LocationModel::model()->findByPk($localId);
            if (!$model) {
                $model = new LocationModel;
                $model->name = self::_TOANQUOC;
                $model->id = 0;
            }
            Yii::app()->cache->set($cacheId, $model, self::_forever);
        }
        return $model;
    }

    /**
     * get local all
     */
    public static function getLocalAll() {
        $cacheId = 'adExtension_getLocalAll';
//        $dataProvider = Yii::app()->cache->delete($cacheId);
        $dataProvider = Yii::app()->cache->get($cacheId);
        if ($dataProvider === false) {

            $criteria = new CDbCriteria(array(
                        'order' => '`name` ASC',
                    ));
            $dataProvider = new CActiveDataProvider('LocationModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));
            //get data
            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($cacheId, $dataProvider, self::_forever);
        }
        return $dataProvider;
    }

    /**
     * get key relation by category
     */
    public static function getKeyRelationByCategoryId($categoryId, $childCategoryId = 0) {
        $keycache = 'adExtension_getKeyRelationByCategoryId_' . $categoryId . '_' . $childCategoryId;
        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot")) {
            $dataProvider = Yii::app()->cache->delete($keycache);
        }
        $dataProvider = Yii::app()->cache->get($keycache);
        if ($dataProvider === false) {
            $codition = '`categoryId` = ' . $categoryId;
            if ($childCategoryId) {
                $codition .= ' AND `childCatId` = ' . $childCategoryId;
            }
            $criteria = new CDbCriteria(array(
                        'condition' => $codition,
                        'order' => '`googleActive` ASC',
                    ));
            $criteria->limit = 20;

            $dataProvider = new CActiveDataProvider('SearchKeyModel', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));
            //get data
            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($keycache, $dataProvider, self::_forever);
        }
        return $dataProvider;
    }

    /**
     * check file 
     * @param type $img
     * @return boolean
     */
    public static function isImage($img) {
        if (file_exists($img)) {
            if (!getimagesize($img)) {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    /**
     * get image from data saobang
     */
    public static function getDataImage($url) {
        if (strstr(strtolower($url), "data/images/")) {
            $url = str_replace("data/images/", "http://data.saobang.vn/images/", $url);
        }
        return $url;
    }

    /**
     * get list shop category
     */
    public static function getListShopCategory() {
        $cacheId = 'adExtension_getListShopCategory';
//        $dataProvider = Yii::app()->cache->delete($cacheId);
        $dataProvider = Yii::app()->cache->get($cacheId);
        if ($dataProvider === false) {
            $criteria = new CDbCriteria(array(
                        'order' => '`name` ASC',
                    ));

            $dataProvider = new CActiveDataProvider('ShopCategory', array(
                        'pagination' => false,
                        'criteria' => $criteria,
                    ));
            //get data
            $dataProvider = $dataProvider->getData();
            Yii::app()->cache->set($cacheId, $dataProvider, self::_forever);
        }
        return $dataProvider;
    }

    /**
     * get list shop id by category
     */
    public static function getListShopIdByCategoryId($categoryId) {
        $list = Yii::app()->cache->delete('adEx_getListShopIdByCategoryId_' . $categoryId);
        $list = Yii::app()->cache->get('adEx_getListShopIdByCategoryId_' . $categoryId);
        if ($list === false) {
            $list = '';
            $sql = 'SELECT `shopId` FROM {{shop_category_map}} WHERE `categoryShopId` = ' . $categoryId;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryColumn();
            foreach ($rs as $key => $value) {
                $list .= ', ' . $value;
            }
            //process list
            if (strlen($list) > 1) {
                $list = substr($list, 1);
            } else {
                $list = '';
            }
            Yii::app()->cache->set('adEx_getListShopIdByCategoryId_' . $categoryId, $list, self::_forever);
        }
        return $list;
    }

    /**
     * get categery shop by Id
     */
    public static function getShopCategoryById($categoryId) {
        $model = Yii::app()->cache->get('adEx_getShopCategoryById_' . $categoryId);
        if ($model === false) {
            $model = ShopCategory::model()->findByPk($categoryId);
            Yii::app()->cache->set('adEx_getShopCategoryById_' . $categoryId, $model, self::_forever);
        }
        return $model;
    }

    /**
     * get shop by Id
     */
    public static function getShopById($id) {
        $keycache = 'adEx_getShopById_' . $id;
        $model = Yii::app()->cache->delete($keycache);
        $model = Yii::app()->cache->get($keycache);
        if ($model === false) {
            $model = ShopModel::model()->findByPk($id);
            Yii::app()->cache->set($keycache, $model, self::_forever);
        }
        return $model;
    }

    /**
     * get topic by id
     */
    public static function getTopicById($id) {
        $keyCache1 = 'TopicModel_' . $id;
        $topicModel = Yii::app()->cache->get($keyCache1);
        if ($topicModel === false) {
            $topicModel = TopicModel::model()->findByPk($id);
            Yii::app()->cache->set($keyCache1, $topicModel, AdExtension::_ntime);
        }
        return $topicModel;
    }

    /**
     * get topic detail by id
     */
    public static function getTopicDetailById($id) {
        $keyCache2 = 'TopicDetail_' . $id;
        $topicDetail = Yii::app()->cache->get($keyCache2);
        if ($topicDetail === false) {
            $topicDetail = TopicDetail::model()->findByPk($id);
            Yii::app()->cache->set($keyCache2, $topicDetail, AdExtension::_ntime);
        }
        return $topicDetail;
    }

}