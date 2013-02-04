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
class ExtensionClass {

    /**
     * text process
     */
    public static function utf8_to_ascii($str) {
        $str = strip_tags(trim($str));
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/i", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace(array('#(amp;|quot;|;)#', '#[^\d\w- ]#'), '', $str);
        $str = str_replace(array(" ", "----", "---", "--"), "-", trim($str));
        $str = strtolower($str);
        return $str;
    }

    /**
     * processing text before seach 
     */
    public static function textProcessingSeach($str) {
        $str = strip_tags(trim($str));
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/i", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace(array('#(amp;|quot;|;)#', '#[^\d\w- ]#'), ' ', $str);
        $str = strtolower($str);
        $str = trim($str);
        return $str;
    }

    /**
     * get seach parrent category
     */
    public static function listCategoryParent($catId) {
        $item = array();
        $rs = Yii::app()->cache->get('ext_listCategoryParent_' . $catId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `parentId` = 0 ORDER BY  `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_listCategoryParent_' . $catId, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
// build new url category
                if ($catId && $catId == $value['id']) {
                    $item[] = array('label' => $value['name'], 'url' => 'javascript:void(0)', 'itemOptions' => array('class' => 'active'), 'linkOptions' => array('onclick' => 'getParentCategory("' . $value['id'] . '");'));
                } else {
                    $item[] = array('label' => $value['name'], 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'getParentCategory("' . $value['id'] . '");', 'id' => 'cat' . $value['id']));
                }
            }
        }
        return array('items' => $item);
    }

    /**
     * get seach parrent category
     */
    public static function listCategoryChild($catId, $currCat) {
        if (!$catId)
            return $item = array();
        $rs = Yii::app()->cache->get('ext_listCategoryChild_' . $catId . '_' . $currCat);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `parentId` = ' . $catId . ' ORDER BY  `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_listCategoryChild_' . $catId . '_' . $currCat, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
// build new url category
                if ($value['id'] == $currCat) {
                    $item[] = array('label' => $value['name'], 'url' => 'javascript:void(0)', 'itemOptions' => array('class' => 'active'), 'linkOptions' => array('onclick' => 'setChildCat("' . $catId . '", "' . $value['id'] . '");', 'id' => 'childcat' . $value['id']));
                } else {
                    $item[] = array('label' => $value['name'], 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setChildCat(' . $catId . ',"' . $value['id'] . '");', 'id' => 'childcat' . $value['id']));
                }
            }
        }
        return array('items' => $item);
    }

    /**
     * get list category
     */
    public static function getListCategory() {
        $rs = Yii::app()->cache->get('ext_getListCategory');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 ORDER BY  `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getListCategory', $rs, 600);
        }
        $listCategory = array('0' => ' __ Chọn danh mục __ ');
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if ($value['parentId'] == 0) {
                    $listCategory[$value['id']] = '-- ' . $value['name'];
                    foreach ($rs as $key2 => $value2) {
                        if ($value2['parentId'] == $value['id']) {
                            $listCategory[$value2['id']] = '- - - - - ' . $value2['name'];
                        }
                    }
                }
            }
        }
        return $listCategory;
    }

    /**
     * get list filter category
     */
    public static function getListFilterCategory() {
        $rs = Yii::app()->cache->get('ext_getListFilterCategory');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `isPrice` = 1 ORDER BY `order` DESC, `name` ASC';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getListFilterCategory', $rs, 600);
        }
        $listCategory = array('0' => ' __ Chọn danh mục __ ');
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if ($value['parentId'] == 0) {
                    $listCategory[$value['id']] = '_ ' . $value['name'];
                    foreach ($rs as $key2 => $value2) {
                        if ($value2['parentId'] == $value['id']) {
                            $listCategory[$value2['id']] = '- - - - - ' . $value2['name'];
                        }
                    }
                }
            }
        }
        return $listCategory;
    }

    /**
     * get Home category 
     */
    public static function getHomeCategory() {
        $listCategory = array();
        $rs = Yii::app()->cache->get('ext_getHomeCategory');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `displayUrl`, `parentId`, `classCss` FROM `tbl_category` WHERE `isHidden` = 0 ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getHomeCategory', $rs, 600);
        }
        $i = $j = 0;
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if ($value['parentId'] == 0) {
                    $i++;
                    $listCategory[$i]['id'] = $value['id'];
                    $listCategory[$i]['name'] = $value['name'];
                    $listCategory[$i]['displayUrl'] = $value['displayUrl'];
                    $listCategory[$i]['parentId'] = $value['parentId'];
                    $listCategory[$i]['classCss'] = $value['classCss'];
                    $listChirlCategory = array();
                    foreach ($rs as $key2 => $val) {
                        if ($val['parentId'] == $value['id']) {
                            $listChirlCategory[$j]['id'] = $val['id'];
                            $listChirlCategory[$j]['name'] = $val['name'];
                            $listChirlCategory[$j]['displayUrl'] = $val['displayUrl'];
                            $listChirlCategory[$j]['parentId'] = $val['parentId'];
                            $j++;
                        }
                    }
                    $listCategory[$i]['child'] = $listChirlCategory;
                    $j = 0;
                }
            }
        }
        return $listCategory;
    }

    /**
     * get parent category 
     */
    public static function getListParentCategory() {
        $rs = Yii::app()->cache->get('ext_getListParentCategory');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND parentId = 0 ORDER BY  `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getListParentCategory', $rs, 600);
        }
        $listCategory = array('0' => ' __ Chọn danh mục __ ');
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if ($value['parentId'] == 0) {
                    $listCategory[$value['id']] = '-- ' . $value['name'];
                    foreach ($rs as $key2 => $value2) {
                        if ($value2['parentId'] == $value['id']) {
                            $listCategory[$value2['id']] = '- - - ' . $value2['name'];
                        }
                    }
                }
            }
        }
        return $listCategory;
    }

    /**
     * get child category 
     */
    public static function getListChildCategory($categoryId) {
        if ($categoryId) {
            $rs = Yii::app()->cache->get('exc_getListChildCategory' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name`, `order`, `isPrice`, `parentId`,`isHidden` FROM `tbl_category` WHERE `parentId` = ' . $categoryId . ' ORDER BY `order` DESC, `name` ASC ';
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('exc_getListChildCategory' . $categoryId, $rs, 600);
            }
            $dataProvider = new CArrayDataProvider($rs, array(
                        'id' => 'CategoryModel',
                        'sort' => array(
                            'attributes' => array(
                                'orther', 'id',
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 100,
                        ),
                    ));

            return $dataProvider;
        } else {
            return array();
        }
    }

    /**
     * get select child category by category parent 
     */
    public static function getCategoryChildByParentCat($categoryId) {
        if ($categoryId) {
            $list = array();
            $rs = Yii::app()->cache->get('ext_getCategoryChildByParentCat_' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name` FROM `tbl_category` WHERE `parentId` = ' . $categoryId . ' ORDER BY `order` DESC, `name` ASC ';
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('ext_getCategoryChildByParentCat_' . $categoryId, $rs, 600);
            }
            if (is_array($rs)) {
                foreach ($rs as $key => $value) {
                    $list[$value['id']] = $value['name'];
                }
            }
            return $list;
        } else {
            return array();
        }
    }

    /**
     * get child attributes by category 
     */
    public static function getListChildArticlesByCategory($categoryId, $attributeGroup) {
        $rs = Yii::app()->cache->get('ext_getListChildArticlesByCategory_' . $categoryId . '_' . $attributeGroup);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `categoryId`, `order` FROM `tbl_attributes` WHERE `categoryId` = ' . $categoryId . ' AND `group` = ' . $attributeGroup;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getListChildArticlesByCategory_' . $categoryId . '_' . $attributeGroup, $rs, 600);
        }
        $dataProvider = new CArrayDataProvider($rs, array(
                    'id' => 'AttributesModel',
                    'sort' => array(
                        'attributes' => array(
                            'orther', 'id',
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
        return $dataProvider;
    }

    /**
     * get all from locality 
     */
    public static function getAllDataFromLocality() {
        $rs = Yii::app()->cache->get('exc_getAllDataFromLocality');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM `tbl_location` WHERE `parentId` = 0 ORDER BY `order` DESC, `id`, `name` ASC';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('exc_getAllDataFromLocality', $rs, 600);
        }
        return $rs;
    }

    /**
     * get list parent locality 
     */
    public static function getListLocality() {
        $rs = self::getAllDataFromLocality();
        $listLocality = array('0' => ' -- Chọn Tỉnh --');
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                $listLocality[$value['id']] = $value['name'];
            }
        }
        return $listLocality;
    }

    /**
     * get child locality 
     */
    public static function getListChildLocality($LocationId) {
        $rs = Yii::app()->cache->get('ext_getListChildLocality_' . $LocationId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `order` FROM `tbl_location` WHERE `parentId` = ' . $LocationId . ' ORDER BY `order`, `id` DESC, `name` ASC';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getListChildLocality_' . $LocationId, $rs, 600);
        }
        $dataProvider = new CArrayDataProvider($rs, array(
                    'id' => 'LocationModel',
                    'sort' => array(
                        'attributes' => array(
                            'orther', 'id',
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
        return $dataProvider;
    }

    /**
     * get attributes by category 
     */
    public static function getAttributesByCategory($categoryId) {
        $condition = '';
        if ($categoryId)
            $condition = ' AND `categoryId` = ' . $categoryId;
        $rs = Yii::app()->cache->get('ext_getAttributesByCategory_' . $categoryId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM `tbl_attributes` WHERE `group` = 0' . $condition;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getAttributesByCategory_' . $categoryId, $rs, 600);
        }
        $listAttributes = array('0' => ' -- Chọn nhóm thuộc tính --');
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                $listAttributes[$value['id']] = $value['name'];
            }
        }
        return $listAttributes;
    }

    /**
     * get attributes by category 
     */
    public static function getAllAttributesByCategory($categoryId) {
        $condition = '';
        if ($categoryId) {
            $condition = ' `categoryId` = ' . $categoryId;
            $rs = Yii::app()->cache->get('ext_getAllAttributesByCategory_' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name` FROM `tbl_attributes` WHERE ' . $condition;
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('ext_getAllAttributesByCategory_' . $categoryId, $rs, 600);
            }
            $listAttributes = array('0' => ' -- Chọn nhóm thuộc tính --');
            if (is_array($rs)) {
                foreach ($rs as $key => $value) {
                    $listAttributes[$value['id']] = $value['name'];
                }
            }
            return $listAttributes;
        }
    }

    /**
     * get list attributes 
     */
    public static function getListAttributesAjax($categoryId) {
        if ($categoryId) {
            $condition = ' WHERE `categoryId` = ' . $categoryId;
        } else {
            $condition = ' WHERE `categoryId` = 0';
        }
        $rs = Yii::app()->cache->get('ext_getListAttributesAjax_' . $categoryId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `group` FROM tbl_attributes' . $condition;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getListAttributesAjax_' . $categoryId, $rs, 600);
        }
        $list = array();
        if (is_array($rs)) {
            foreach ($rs as $key1 => $value) {
                if ($value['group'] == 0) {
                    $list[$key1]['id'] = $value['id'];
                    $list[$key1]['name'] = $value['name'];
                    $attr = array();
                    foreach ($rs as $key2 => $val) {
                        if ($val['group'] == $value['id']) {
                            $attr[$val['id']] = $val['name'];
                        }
                    }
                    $list[$key1]['attr'] = $attr;
                }
            }
        }
        return $list;
    }

    /**
     * get attribute by category group by group 
     */
    public static function getHomeAttributes($categoryId) {
        if ($categoryId) {
            $rs = Yii::app()->cache->get('exc_getHomeAttributes' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name`, `group` FROM `tbl_attributes` WHERE `categoryId` = ' . $categoryId;
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('exc_getHomeAttributes' . $categoryId, $rs, 600);
            }
            $i = $j = $k = 0;
            $listAttr = array();
            if (is_array($rs)) {
                foreach ($rs as $key => $value) {
                    if ($value['group'] == 0) {
                        $listChirlAttr = array();
                        $listAttr[$k]['name'] = $value['name'];
                        $listAttr[$k]['id'] = $value['id'];
                        foreach ($rs as $key2 => $val) {
                            if ($val['group'] == $value['id']) {
                                $listChirlAttr[$j]['name'] = $val['name'];
                                $listChirlAttr[$j]['id'] = $val['id'];
                                $j++;
                            }
                        }
                        $listAttr[$k]['items'] = $listChirlAttr;
                        $j = 0;
                        $i++;
                        $k++;
                    }
                }
            }


            return $listAttr;
        } else {
            return false;
        }
    }

    /**
     * get home attributes for filer 
     */
    public static function getHomeAttributesFilter($categoryId, $currUrl) {
        $listAtt = array();
        if ($categoryId) {
            $condition = ' WHERE `categoryId` = ' . $categoryId;
        } else {
            $condition = ' WHERE `categoryId` = 0';
        }
        $rs = Yii::app()->cache->get('ext_getHomeAttributesFilter_' . $categoryId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `group` FROM tbl_attributes' . $condition;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getHomeAttributesFilter_' . $categoryId, $rs, 600);
        }
        if (is_array($rs)) {
            $i = 1;
            foreach ($rs as $key => $value) {
                if ($value['group'] == 0) {
                    $listAtt[$i]['name'] = $value['name'];
                    /**
                     * clear old attributes value from urrl
                     */
                    if (isset($currUrl['ext']) && isset($currUrl['aid'])) {
                        unset($currUrl['ext']);
                        unset($currUrl['aid']);
                    }
                    /**
                     * buil list attributes 
                     */
                    foreach ($rs as $key2 => $val2) {
                        if ($val2['group'] == $value['id']) {
                            if (isset($currUrl['extension' . $i])) {
                                $currUrl['extension' . $i] = $val2['id'];
                                $currUrl['extName'] = ExtensionClass::utf8_to_ascii($val2['name']);
                            } else {
                                $currUrl = array_merge($currUrl, array('ext' => $i, 'aid' => $val2['id'], 'extName' => ExtensionClass::utf8_to_ascii($val2['name'])));
                            }
                            $item[] = array('label' => $val2['name'], 'url' => Yii::app()->createUrl('home/category', $currUrl));
                        }
                    }
                    $listAtt[$i]['item'] = $item;
                    $item = array();
                    $i++;
                }
            }
        }
        return $listAtt;
    }

    /**
     * get Demand by category 
     */
    public static function getDemandByCategory($categoryId) {
        if ($categoryId) {
            $rs = Yii::app()->cache->get('ext_getDemandByCategory_' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name` FROM `tbl_category_demand` WHERE `categoryId` = ' . $categoryId . ' ORDER BY `order` DESC, `name` ASC ';
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('ext_getDemandByCategory_' . $categoryId, $rs, 600);
            }
            $listDemand = array();
            if (is_array($rs)) {
                foreach ($rs as $key => $value) {
                    $listDemand[$value['id']] = $value['name'];
                }
            }
            return $listDemand;
        } else {
            return false;
        }
    }

    /**
     * get Demand by category 
     */
    public static function getDemandHomeByCategory($categoryId) {
        if ($categoryId) {
            $rs = Yii::app()->cache->get('ext_getDemandHomeByCategory_' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name` FROM `tbl_category_demand` WHERE `categoryId` = ' . $categoryId . ' ORDER BY `order` DESC, `name` ASC ';
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('ext_getDemandHomeByCategory_' . $categoryId, $rs, 600);
            }
            return $rs;
        } else {
            return false;
        }
    }

    /**
     * getHome demand by categoryId 
     */
    public static function getHomeDemand($categoryId) {
        if ($categoryId) {
            $rs = Yii::app()->cache->get('ext_getHomeDemand_' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name` FROM `tbl_category_demand` WHERE `categoryId` = ' . $categoryId . ' ORDER BY `order` DESC, `name` ASC ';
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('ext_getHomeDemand_' . $categoryId, $rs, 600);
            }
            $listDemand = $listDemandParent = array();
            if (is_array($rs)) {
                foreach ($rs as $key => $value) {
                    $listDemandChild['label'] = $value['name'];
                    $listDemandChild['url'] = array('home/demand', 'id' => $value['id'], 'catId' => $categoryId, 'name' => ExtensionClass::utf8_to_ascii($value['name']));
                    $listDemandParent[] = $listDemandChild;
                }
            }
            $listDemand['items'] = $listDemandParent;
            return $listDemand;
        } else {
            return false;
        }
    }

    /**
     * get category name by category id
     */
    public static function getCategoryNameById($catId) {
        if ($catId) {
            $name = Yii::app()->cache->get('ext_getCategoryNameById_' . $catId);
            if ($name === false) {
                $model = CategoryModel::model()->findByPk($catId);
                if ($model)
                    $name = $model->name;
                else
                    $name = 'Err';
                Yii::app()->cache->set('ext_getCategoryNameById_' . $catId, $name, 6000);
            }
            if ($name)
                return $name;
            else
                return 'Err';
        }else {
            return 'Chưa chọn danh mục';
        }
    }

    /**
     * get category name by category id
     */
    public static function getCategoryUrl($catId) {
        if ($catId) {
            $name = Yii::app()->cache->get('ext_getCategoryUrl_' . $catId);
            if ($name === false) {
                $model = CategoryModel::model()->findByPk($catId);
                if ($model)
                    $name = self::utf8_to_ascii($model->name);
                else
                    $name = '';
                Yii::app()->cache->set('ext_getCategoryUrl_' . $catId, $name, 6000);
            }
            if ($name)
                return $name;
            else
                return '';
        }else {
            return '';
        }
    }

    /**
     * get topic status 
     */
    public static function getTopicByCategoryStatus($categoryId) {
        if ($categoryId) {
            $rs = Yii::app()->cache->get('ext_getTopicByCategoryStatus_' . $categoryId);
            if ($rs === false) {
                $sql = 'SELECT `isPrice`, `isChildLocality` FROM `tbl_category` WHERE `id` = ' . $categoryId . ' ORDER BY `order` DESC, `name` ASC ';
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryRow();
                Yii::app()->cache->set('ext_getTopicByCategoryStatus_' . $categoryId, $rs, 600);
            }
            return $rs;
        } else {
            return array();
        }
    }

    /**
     * Quan/Huyen theo tinh 
     */
    public static function getChildLocality($localityId) {
        $listChildLocality = array();
        if ($localityId) {
            $rs = Yii::app()->cache->get('ext_getChildLocality_' . $localityId);
            if ($rs === false) {
                $sql = 'SELECT `id`, `name` FROM `tbl_location` WHERE `parentId` = ' . $localityId . ' ORDER BY `order`, `id` DESC, `name` ASC';
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryAll();
                Yii::app()->cache->set('ext_getChildLocality_' . $localityId, $rs, 600);
            }
            if (is_array($rs)) {
                foreach ($rs as $key => $value) {
                    $listChildLocality[$value['id']] = $value['name'];
                }
            }
        }
        return $listChildLocality;
    }

    /**
     * get topic child locality by topic 
     */
    public static function getChildLocalityByTopic($topicId) {
        if ($topicId) {
            $rs = Yii::app()->cache->get('ext_getChildLocalityByTopic_' . $topicId);
            if ($rs === false) {
                $sql = 'SELECT `localityId` FROM `tbl_topic_locality` WHERE `topicId` = ' . $topicId;
                $command = Yii::app()->db->createCommand($sql);
                $rs = $command->queryColumn();
                Yii::app()->cache->set('ext_getChildLocalityByTopic_' . $topicId, $rs, 600);
            }
            return $rs;
        } else {
            return array();
        }
    }

    /**
     * get total crawler link 
     */
    public static function getTotalCrawlerLink() {
        $rs = Yii::app()->cache->get('ext_getTotalCrawlerLink');
        if ($rs === false) {
            $sql = 'SELECT SUM(`totalLink`) FROM `tbl_site` WHERE `totalLink` > 0';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryScalar();
            Yii::app()->cache->set('ext_getTotalCrawlerLink', $rs, 600);
        }
        return $rs;
    }

    /**
     * get locality for homepage 
     */
    public static function homepageLocality() {
        $rs = self::getAllDataFromLocality();
        $item[] = array('label' => 'Toàn quốc', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setLocation(0);'));
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                $item[] = array('label' => $value['name'], 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setLocation(' . $value['id'] . ');'));
            }
            $item[] = array('label' => 'Toàn quốc', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setLocation(0);'));
        }
        return array('items' => $item);
    }

    /**
     * topic locality 
     */
    public static function topicLocality() {
        $rs = self::getAllDataFromLocality();
        $item[] = array('label' => 'Toàn quốc', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setTopicLocality(0, \'Toàn quốc\');'));
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                $item[] = array('label' => $value['name'], 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setTopicLocality(' . $value['id'] . ', \'' . $value['name'] . '\');'));
            }
            $item[] = array('label' => 'Toàn quốc', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setTopicLocality(0, \'Toàn quốc\');'));
        }
        return array('items' => $item);
    }

    /**
     * get home category 
     */
    public static function homepageCategory() {
        $rs = Yii::app()->cache->get('ext_homepageCategory');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_homepageCategory', $rs, 600);
        }
        if (is_array($rs)) {
            $item[] = array('label' => 'Tất cả danh mục', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setCategory(\'0\', \'Tất cả danh mục\');'));
            foreach ($rs as $key => $value) {
                if ($value['parentId'] == 0) {
                    $item[] = array('label' => $value['name'], 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setCategory(' . $value['id'] . ', "' . $value['name'] . '")'));
                    foreach ($rs as $key2 => $value2) {
                        if ($value2['parentId'] == $value['id']) {
                            $item[] = array('label' => ' --- ' . $value2['name'], 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setChildCategory(' . $value['id'] . ', "' . $value['name'] . '", ' . $value2['id'] . ', "' . $value2['name'] . '");'));
                        }
                    }
                }
            }
        }
        $item[] = array('label' => 'Tất cả danh mục', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'setCategory(\'0\', \'Tất cả danh mục\');'));
        return array('items' => $item);
    }

    /**
     * get seach parrent category
     */
    public static function searchParentCategory($currUlr) {
        $item = array();
        $key = 'ext_searchParentCategory';
        $rs = Yii::app()->cache->get($key);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `parentId` = 0 ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set($key, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                $currUlr = array('catId' => $value['id']);
                $currUlr = array_merge($currUlr, array('name' => self::utf8_to_ascii($value['name'])));
// build new url category
                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/category', $currUlr));
            }
        }
        return array('items' => $item);
    }

    /**
     * get seach parrent category
     */
    public static function searchAllCategory($currUlr) {
        $item = array();
        $key = 'ext_searchAllCategory';
        $rs = Yii::app()->cache->get($key);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `parentId` = 0 ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set($key, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if (isset($currUlr['catId'])) {
                    $currUlr['catId'] = $value['id'];
                    $currUlr['catName'] = ExtensionClass::utf8_to_ascii($value['name']);
                } else {
                    $currUlr = array_merge($currUlr, array('catId' => $value['id'], 'catName' => ExtensionClass::utf8_to_ascii($value['name'])));
                }
                /**
                 * check and remove childrent category 
                 */
                if (isset($currUlr['childCat'])) {
                    unset($currUlr['childCat']);
                }
// build new url category
                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/search', $currUlr));
            }
        }
        return array('items' => $item);
    }

    /**
     * get seach childrent category
     */
    public static function searchChildrentCategory($currUlr, $parentId) {
        $item = array();
        if (!$parentId)
            return $item;

        $rs = Yii::app()->cache->get('ext_searchChildrentCategory_' . $parentId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `parentId` = ' . $parentId . ' ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_searchChildrentCategory_' . $parentId, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if (isset($currUlr['childCat'])) {
                    $currUlr['childCat'] = $value['id'];
                    $currUlr['childName'] = self::utf8_to_ascii($value['name']);
                } else {
                    $currUlr = array_merge($currUlr, array('childCat' => $value['id'], 'childName' => self::utf8_to_ascii($value['name'])));
                }
                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/category', $currUlr));
            }
        }
        return array('items' => $item);
    }

    /**
     * search Site  
     */
    public static function searchSite($currUlr) {
        $rs = Yii::app()->cache->get('ext_searchSite');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM `tbl_site` WHERE `isHidden`=0 AND `totalLink` >0 ORDER BY `order`';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_searchSite', $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if (isset($currUlr['site'])) {
                    $currUlr['site'] = $value['id'];
                } else {
                    $currUlr = array_merge($currUlr, array('site' => $value['id'], 'siteName' => ExtensionClass::utf8_to_ascii($value['name'])));
                }
                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/category', $currUlr));
            }
        }
        return array('items' => $item);
    }

    /**
     * get demand for category 
     */
    public static function searchDemand($currUlr, $catId) {
        if (isset($currUlr['did']))
            unset($currUlr['did']);
        $item[] = array('label' => 'Tất cả', 'url' => Yii::app()->createUrl('home/category', $currUlr));
        $rs = Yii::app()->cache->get('ext_searchDemand_' . $catId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM `tbl_category_demand` WHERE `categoryId` = ' . $catId . ' ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_searchDemand_' . $catId, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if (isset($currUlr['did'])) {
                    $currUlr['did'] = $value['id'];
                    $currUlr['demandName'] = ExtensionClass::utf8_to_ascii($value['name']);
                } else {
                    $currUlr = array_merge($currUlr, array('did' => $value['id'], 'demandName' => ExtensionClass::utf8_to_ascii($value['name'])));
                }

                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/category', $currUlr));
            }
        }
        return array('items' => $item);
    }

    /**
     * get list site 
     */
    public static function listSite() {
        $rs = Yii::app()->cache->get('ext_listSite');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `totalLink`, `classCss` FROM `tbl_site` WHERE `isHidden`=0 AND `totalLink` > 0 ORDER BY `order`';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_listSite', $rs, 600);
        }
        return $rs;
    }

    /**
     *  get dropdown list site
     */
    public static function dropdownlistsite() {
        $list['0'] = '-- Chọn site --';
        $rs = Yii::app()->cache->get('ext_dropdownlistsite');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM `tbl_site` WHERE `isHidden`=0 AND `totalLink` > 0 ORDER BY `order`';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_dropdownlistsite', $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                $list[$value['id']] = $value['name'];
            }
        }
        return $list;
    }

    /**
     * get current site 
     */
    public static function getCurrentSite($siteId) {
        $name = Yii::app()->cache->get('ext_getCurrentSite_' . $siteId);
        if ($name === false) {
            $model = CrawlerSite::model()->findByPk($siteId);
            if ($model)
                $name = $model->name;
            else
                $name = '-- Chon --';
            Yii::app()->cache->set('ext_getCurrentSite_' . $siteId, $name, 6000);
        }
        if ($name)
            return $name;
        else
            return '-- Chọn --';
    }

    /**
     * get current demand 
     */
    public static function getCurrentDemand($did) {
        $value = Yii::app()->cache->get('ext_getCurrentDemand_' . $did);
        if ($value === false) {
            $model = DemandModel::model()->findByPk($did);
            if ($model)
                $name = $model->name;
            else
                $name = 'Tất cả';
            Yii::app()->cache->set('ext_getCurrentDemand_' . $did, $name, 600);
        }
        return $value;
    }

    /**
     * get current locality 
     */
    public static function getCurrentLocality() {
        $listLocality = ExtensionClass::getListLocality();
        if (Yii::app()->session['location'] && isset($listLocality[Yii::app()->session['location']])) {
            return $listLocality[Yii::app()->session['location']];
        } else {
            return 'Toàn quốc';
        }
    }

    /**
     * get current category 
     */
    public static function getCurrentCategory($id) {
        $catName = '-- Chọn --';
        if ($id)
            $catName = ExtensionClass::getCategoryNameById($id);
        return $catName;
    }

    /**
     * get current attributes 
     */
    public static function getCurrentAttributes($currentAtt) {
        $id = isset($_GET['extension' . $currentAtt]) ? $_GET['extension' . $currentAtt] : '';
        $attrName = '-- Chọn --';
        if ($id) {
            $attrName = Yii::app()->cache->get('ext_getCurrentAttributes_' . $currentAtt);
            if ($attrName === false) {
                $model = AttributesModel::model()->findByPk($id);
                if ($model)
                    $attrName = $model->name;
                Yii::app()->cache->set('ext_getCurrentAttributes_' . $currentAtt, $attrName, 600);
            }
        }
        return $attrName;
    }

    /**
     * get attributes by id
     */
    public static function getAttributesByAid($id) {
        $attrName = '-- Chọn --';
        if ($id) {
            $attrName = Yii::app()->cache->get('ext_getAttributesByAid_' . $id);
            if ($attrName === false) {
                $model = AttributesModel::model()->findByPk($id);
                if ($model)
                    $attrName = $model->name;
                Yii::app()->cache->set('ext_getAttributesByAid_' . $id, $attrName, 600);
            }
        }
        return $attrName;
    }

    /**
     * get all statistic 
     */
    public static function getStatistic($catId = 0) {
        $list = array();
        $list = Yii::app()->cache->get('exc_getStatistic' . $catId);
        if ($list === false) {
            $sql = 'SELECT `key`, `value` FROM `tbl_statistic` WHERE `category` = ' . $catId;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            if (is_array($rs)) {
                foreach ($rs as $key => $value) {
                    $list[$value['key']] = $value['value'];
                }
            }
            Yii::app()->cache->set('exc_getStatistic' . $catId, $list, 600);
        }
        return $list;
    }

    /**
     * get statistic detail 
     */
    public static function statisticDetail($list, $url) {
        if (isset($url['name']))
            unset($url['name']);
        if (isset($url['childName']))
            unset($url['childName']);
        if (isset($url['sort']))
            unset($url['sort']);
        $key = json_encode($url);
//        echo $key; //dgthien da ky

        $isCount = isset($_GET['isCount']) ? $_GET['isCount'] : '';
        if ($isCount) {
            $data = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('statistic/category', $url), FALSE, array(
                'key' => $key
                    ));
            echo $data . '(success)';
        }
        if (isset($list[$key])) {
            return $list[$key];
        }
    }

    /**
     * get statis by site 
     */
    public static function statisticBySite($siteId) {
        $isCount = isset($_GET['isCount']) ? $_GET['isCount'] : '';
        if ($isCount) {
            $data = Yii::app()->CURL->run('http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('statistic/site', array('id' => $siteId)));
            echo $data;
            return (int) $data;
        } else {
            $total = Yii::app()->cache->get('ext_statisticBySite_total_' . $siteId);
            if ($total === false) {
                $model = CrawlerSite::model()->findByPk($siteId);
                $total = isset($model->totalLink) ? $model->totalLink : 0;

                Yii::app()->cache->set('ext_statisticBySite_total_' . $siteId, $total, 30 * 60);
            }
            return $total;
        }
    }

    public static function substrwords($text, $maxchar, $end = '...') {
        if (strlen($text) > $maxchar) {
            $words = explode(" ", $text);
            $output = '';
            $i = 0;
            while (1) {
                $length = (strlen($output) + strlen($words[$i]));
                if ($length > $maxchar) {
                    break;
                } else {
                    $output = $output . " " . $words[$i];
                    ++$i;
                };
            };
        } else {
            $output = $text;
        }
        return $output . $end;
    }

    /**
     * @author  Chienlv
     * @return  Hàn xử lý gửi mail theo định nghĩa có sẵn
     * @param   $to : Địa chỉ email người nhận
     * @param   $subject  tiêu đề email 
     * @param   $content Nội dung email
     */
    public static function mailSend($to, $subject = 'Thông tin tài khoản của bạn tại Saobang.vn', $content = null) {
        $myemail = 'no-reply@saobang.vn';
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "localhost"; // specify main and backup server
        $mail->Port = 25; // set the port to use
        $mail->SMTPAuth = false; // turn on SMTP authentication
        $mail->Username = $myemail; // your SMTP username or your gmail username
        $mail->Password = "abc123456"; // your SMTP password or your gmail password
        $from = $myemail; // Reply to this email
        $name = "Info"; // Recipient's name
        $mail->From = $from;
        $mail->FromName = "Saobang.vn"; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to, $name);
        $mail->AddReplyTo($from, "Info");
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $mail->Body = $content;
        $mail->AltBody = "Email thông báo từ saobang.vn"; //Text Body

        if (!$mail->Send()) {
            echo "<h1>Error: " . $mail->ErrorInfo . ', Vui lòng thử lại sau.</h1>';
            exit();
        }
    }

    /**
     * get locality by id 
     */
    public static function getLocalityById($id) {
        if ($id) {
            $value = Yii::app()->cache->get('ext_getLocalityById_' . $id);
            if ($value === false) {
                $model = LocationModel::model()->findByPk($id);
                if ($model) {
                    $value = $model->name;
                } else {
                    $value = 'Toàn quốc';
                }
                Yii::app()->cache->set('ext_getLocalityById_' . $id, $value, 6000);
            }
            return $value;
        } else {
            return 'Toàn quốc';
        }
    }

    /**
     * @author  Chienlv
     * @return  Hàm trả về toàn bộ cartegories
     */
    public static function allCategories() {
        $rs = Yii::app()->cache->get('all_categories');
        if ($rs === false) {
            $sqlParent = 'SELECT `id`, `name`, `parentId`,`displayUrl` FROM `tbl_category` WHERE `isHidden` = 0 ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sqlParent);
            $rs = $command->queryAll();
            Yii::app()->cache->set('all_categories', $rs, 600);
        }
        $item = array();
        foreach ($rs as $key => $value) {
            if ($value['parentId'] == 0) {
                $item[] = Yii::app()->createUrl('home/category', array('catId' => $value['id'], 'name' => ExtensionClass::utf8_to_ascii($value['name'])));
                foreach ($rs as $key2 => $value2) {
                    if ($value2['parentId'] == $value['id']) {
                        $item[] = Yii::app()->createUrl('home/category', array('catId' => $value['id'], 'name' => ExtensionClass::utf8_to_ascii($value['name']), 'childCat' => $value2['id'], 'childName' => ExtensionClass::utf8_to_ascii($value2['name'])));
                    }
                }
            }
        }

        return $item;
    }

    /**
     * get site name by id 
     */
    public static function getSiteNameById($id) {
        if ($id) {
            $value = Yii::app()->cache->get('ext_getSiteNameById_' . $id);
            if ($value === false) {
                $model = CrawlerSite::model()->findByPk($id);
                if ($model)
                    $value = $model->name;
                else
                    $value = 'Tất cả danh mục';
                Yii::app()->cache->set('ext_getSiteNameById_' . $id, $value, 6000);
            }
            return $value;
        }else
            return 'Tất cả danh mục';
    }

    /**
     * list notify
     * @return type 
     */
    public static function listnotify() {
        $rs = Yii::app()->cache->get('ext_listnotify');
        if ($rs === false) {
            $sql = 'SELECT `id`, `title` FROM {{notify}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_listnotify', $rs, 3600);
        }
        $list = array();
        if ($rs) {
            foreach ($rs as $key => $value) {
                $title = $value['title'];
                $url = Yii::app()->createUrl('home/notify', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['title'])));
                $list[] = array('label' => $title, 'url' => $url);
            }
        }
        $result = array(
            'items' => $list
        );

        return $result;
    }

    /**
     * list help
     */
    public static function getListHelp() {
        $rs = Yii::app()->cache->get('ext_getListHelp');
        if ($rs === false) {
            $sql = 'SELECT `id`, `title` FROM {{help}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getListHelp', $rs, 12 * 60 * 60);
        }
        $list = array();
        if ($rs) {
            foreach ($rs as $key => $value) {
                $title = $value['title'];
                $url = Yii::app()->createUrl('home/help', array('id' => $value['id'], 'title' => ExtensionClass::utf8_to_ascii($value['title'])));
                $list[] = array('label' => $title, 'url' => $url);
            }
        }

        $result = array(
            'items' => $list
        );

        return $result;
    }

    /**
     * get ad banner
     */
    public static function getAdBanner($position) {
        $rs = Yii::app()->cache->get('ext_getAdBanner_' . $position);
        if ($rs === false) {
            $listRand = array('0' => 'id', '1' => 'url', '2' => 'createDate', '3' => 'img');
            $typeRand = array('0' => 'ASC', '1' => 'DESC', '2' => 'ASC');
            $sql = 'SELECT `url`, `img` FROM {{banner}} WHERE `position` = ' . $position . ' AND `endDate` > \'' . date('Y-m-d h:i:s') . '\' ORDER BY `' . $listRand[rand(0, 2)] . '`' . ' ' . $typeRand[rand(0, 2)];
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ext_getAdBanner_' . $position, $rs, 12 * 60 * 60);
        }
        return $rs;
    }

}