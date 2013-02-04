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
class ExtensionSearch {

    /**
     * hightlight 
     */
    public static function setHightLight($content, $keyword) {
        $listKey = explode(" ", $keyword);
        foreach ($listKey as $key => $text) {
            $content = str_replace(' ' . strtolower($text), ' <em>' . strtolower($text) . '</em>', $content);
            $content = str_replace(' ' . strtoupper($text), ' <em>' . strtoupper($text) . '</em>', $content);
            $content = str_replace(' ' . ucwords($text), ' <em>' . ucwords($text) . '</em>', $content);
            $content = str_replace(strtolower($text) . ' ', ' <em>' . strtolower($text) . '</em> ', $content);
            $content = str_replace(strtoupper($text) . ' ', ' <em>' . strtoupper($text) . '</em> ', $content);
            $content = str_replace(ucwords($text) . ' ', ' <em>' . ucwords($text) . '</em> ', $content);
        }
        return $content;
    }

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
     * get seach parrent category
     */
    public static function searchParentCategory($currUlr) {
        $item = array();
        $rs = Yii::app()->cache->get('es_searchParentCategory');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `parentId` = 0 ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('es_searchParentCategory', $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                $currUlr = array('catId' => $value['id']);
                $currUlr = array_merge($currUlr, array('name' => self::utf8_to_ascii($value['name'])));
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
        unset($currUlr['childCat']);
        unset($currUlr['childName']);
        $item = array();
        if (!$parentId)
            return $item;
        $rs = Yii::app()->cache->get('se_searchChildrentCategory_' . $parentId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `parentId` FROM `tbl_category` WHERE `isHidden` = 0 AND `parentId` = ' . $parentId . ' ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('se_searchChildrentCategory_' . $parentId, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if (isset($currUlr['childCat'])) {
                    $currUlr['childCat'] = $value['id'];
                    $currUlr['childName'] = self::utf8_to_ascii($value['name']);
                } else {
                    $currUlr = array_merge($currUlr, array('childCat' => $value['id'], 'childName' => self::utf8_to_ascii($value['name'])));
                }
                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/search', $currUlr));
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
        $rs = Yii::app()->cache->get('se_searchDemand_' . $catId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM `tbl_category_demand` WHERE `categoryId` = ' . $catId . ' ORDER BY `order` DESC, `name` ASC ';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('se_searchDemand_' . $catId, $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if (isset($currUlr['did'])) {
                    $currUlr['did'] = $value['id'];
                    $currUlr['demandName'] = ExtensionClass::utf8_to_ascii($value['name']);
                } else {
                    $currUlr = array_merge($currUlr, array('did' => $value['id'], 'demandName' => ExtensionClass::utf8_to_ascii($value['name'])));
                }

                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/search', $currUlr));
            }
        }
        return array('items' => $item);
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
        $rs = Yii::app()->cache->get('se_getHomeAttributesFilter_' . $categoryId);
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `group` FROM `tbl_attributes` ' . $condition;
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('se_getHomeAttributesFilter_' . $categoryId, $rs, 600);
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
                                $currUrl['ext'] = $i;
                                $currUrl['aid'] = $val2['id'];
                                $currUrl['extName'] = ExtensionClass::utf8_to_ascii($val2['name']);
                            } else {
                                $currUrl = array_merge($currUrl, array('ext' => $i, 'aid' => $val2['id'], 'extName' => ExtensionClass::utf8_to_ascii($val2['name'])));
                            }
                            $item[] = array('label' => $val2['name'], 'url' => Yii::app()->createUrl('home/search', $currUrl));
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
     * search Site  
     */
    public static function searchSite($currUlr) {
        $rs = Yii::app()->cache->get('se_searchSite');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM `tbl_site` WHERE 1 ORDER BY `order`';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('se_searchSite', $rs, 600);
        }
        if (is_array($rs)) {
            foreach ($rs as $key => $value) {
                if (isset($currUlr['site'])) {
                    $currUlr['site'] = $value['id'];
                } else {
                    $currUlr = array_merge($currUlr, array('site' => $value['id']));
                }
                $item[] = array('label' => $value['name'], 'url' => Yii::app()->createUrl('home/search', $currUlr));
            }
        }
        return array('items' => $item);
    }

    /**
     * get tag
     */
    public static function getListTag() {
        $rs = Yii::app()->cache->get('ExtensionSearch_all_table_tag');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM {{tag}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ExtensionSearch_all_table_tag', $rs, 60 * 60);
        }
        $list = array();
        foreach ($rs as $key => $value) {
            $list[$value['id']] = $value['name'];
        }
        return $list;
    }

    /**
     * list shop vip
     */
    public static function listShopVip() {
        $rs = Yii::app()->cache->get('ExtensionSearch_listShopVip');
        if ($rs === false) {
            $sql = 'SELECT `id` FROM {{shop_vip}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryColumn();
            Yii::app()->cache->set('ExtensionSearch_listShopVip', $rs, 60 * 60);
        }
        return $rs;
    }

    /**
     * endTime
     */
    public static function ShopVipendTime() {
        $rs = Yii::app()->cache->get('ExtensionSearch_ShopVipendTime');
        if ($rs === false) {
            $sql = 'SELECT `id`, `endTime` FROM {{shop_vip}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ExtensionSearch_ShopVipendTime', $rs, 60 * 60);
        }
        $list = array();
        foreach ($rs as $key => $value) {
            $list[$value['id']] = $value['endTime'];
        }
        return $list;
    }

    /**
     * list soft vip
     */
    public static function listShopUyTin() {
        $rs = Yii::app()->cache->get('ExtensionSearch_listShopUyTin');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name`, `logo` FROM {{shop_vip}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ExtensionSearch_listShopUyTin', $rs, 60 * 60);
        }
        $i = rand(0, 3);
        switch ($i) {
            case 0:
                arsort($rs);
                break;
            case 1:
                krsort($rs);
                break;
            case 2:
                ksort($rs);
                break;
            case 3:
                asort($rs);
                break;
            default:
                asort($rs);
        }

        return $rs;
    }

    /**
     * list tag
     */
    public static function getAllTag() {
        $list = array();
        $rs = Yii::app()->cache->get('ExtensionSearch_all_table_tag');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM {{tag}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ExtensionSearch_all_table_tag', $rs, 60 * 60);
        }
        foreach ($rs as $key => $value) {
            $list[$value['id']] = $value['name'];
        }
        return $list;
    }

    /**
     * list tag
     */
    public static function getSearchTag() {
        $list = array();
        $rs = Yii::app()->cache->get('ExtensionSearch_all_table_tag');
        if ($rs === false) {
            $sql = 'SELECT `id`, `name` FROM {{tag}}';
            $command = Yii::app()->db->createCommand($sql);
            $rs = $command->queryAll();
            Yii::app()->cache->set('ExtensionSearch_all_table_tag', $rs, 60 * 60);
        }
        foreach ($rs as $key => $value) {
            $list[$value['id']] = ExtensionClass::textProcessingSeach($value['name']);
        }
        return $list;
    }

    /**
     * insert into table tbl_shop_tag
     */
    public static function insertToRepliTag($askId, $listTag) {
        $list = '';
        foreach ($listTag as $key) {
            $list .= ",('" . $askId . "', '" . $key . "')";
        }

        if (strlen($list) > 2) {
            $list = substr($list, 1);

            //remove old tag
            $sqlRemove = 'DELETE FROM `tbl_ask_tag` WHERE `askId` = ' . $askId;
            $commandRemove = Yii::app()->db->createCommand($sqlRemove);
            $commandRemove->execute();
            //insert to new tag
            $sql = "INSERT INTO `tbl_ask_tag`(`askId`, `tagId`) VALUES " . $list;

            $command = Yii::app()->db->createCommand($sql);
            $command->execute();
            return true;
        }
    }

    /**
     * get shop by shop id
     */
    public static function getShopByShopId($id) {
        $model = Yii::app()->cache->get('extensionSearch_getShopByShopId_' . $id);
        if ($model === false) {
            $model = ShopModel::model()->findByPk($id);
            Yii::app()->cache->set('extensionSearch_getShopByShopId_' . $id, $model, 60 * 60);
        }
        return $model;
    }

    /**
     * get tag name by tag id
     */
    public static function getTagNameByTagId($tagId) {

        $model = Yii::app()->cache->get('extensionSearch_getTagNameByTagId_' . $tagId);
        if ($model === false) {
            $model = tagModel::model()->findByPk($tagId);
            Yii::app()->cache->set('extensionSearch_getTagNameByTagId_' . $tagId, $model, 60 * 60);
        }
        if ($model) {
            return $model->name;
        }
    }

    /**
     * get ask title from ask id
     */
    public static function getAskTitleByAskId($askId) {
        $model = Yii::app()->cache->get('askModel_byId_' . $askId);
        if ($model === false) {
            $model = AskModel::model()->findByPk($askId);
            Yii::app()->cache->set('askModel_byId_' . $askId, $model, 60 * 60);
        }
        if ($model)
            return $model->title;
    }

    /**
     * shop for ask
     * sql action
     * no cache
     */
    public static function insertToRepliShop($askId, $listShop, $auth) {
        $cond = '';
        foreach ($listShop as $key => $shop) {
            $cond .= ", (NULL, '" . $shop . "', '" . $askId . "', '" . $auth . "')";
        }
        //remove all shop
        $sqlRemove = 'DELETE FROM `{{ask_shop}}` WHERE `askId` = ' . $askId;
        $commandRemove = Yii::app()->db->createCommand($sqlRemove);
        $commandRemove->execute();
        //insert new shop
        $cond = substr($cond, 1);
        $sql = "INSERT INTO `{{ask_shop}}` (`id`, `shopId`, `askId`, `type`) VALUES " . $cond;
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
        return true;
    }

    /**
     * insert category shop replicate
     */
    public static function insertCategoryShop($shopId, $listCateogry) {
        if ($listCateogry) {
            $condition = '';
            foreach ($listCateogry as $value) {
                $condition .= ', (' . $shopId . ', ' . $value . ')';
            }
            $condition = substr($condition, 1);

            if ($condition) {
                $sqlRemove = 'DELETE FROM {{shop_category_map}} WHERE `shopId` = ' . $shopId;
                $commandRemove = Yii::app()->db->createCommand($sqlRemove);
                $commandRemove->execute();
                //insert new data
                $sqlInsert = 'INSERT INTO {{shop_category_map}} (`shopId`, `categoryShopId`) VALUES ' . $condition;
                $commandInsert = Yii::app()->db->createCommand($sqlInsert);
                $commandInsert->execute();
            }
        }
        return true;
    }

}