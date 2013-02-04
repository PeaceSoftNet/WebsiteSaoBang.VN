<?php
/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$listCategory = ExtensionClass::getCategoryChildByParentCat($catId);
$listSite = ExtensionClass::listSite();
?>
<div class="grid_3">
    <div class="block fil-browse">
        <div class="Sbox-title">
            <a class="icon-compact" href=""></a>
            Lọc tin theo:
        </div>
        <div class="block-content">
            <ul class="fil-br-slt">
                <li>
                    <span class="fl">Thành phố</span>
                    <div class="sltbox fr">
                        <a class="slted" onclick="showDropDown('leftLocal', '_leftLocal');" href="javascript:void(0);">
                            <?php
                            echo ExtensionClass::getCurrentLocality();
                            ?>
                        </a>
                        <input type="hidden" name="dropdownfucntion" value="1" id="leftLocal" />
                        <div class="sub-sltbox none" id="_leftLocal">
                            <div class="overflow inner-sub-sltbox">
                                <?php $this->widget('zii.widgets.CMenu', ExtensionClass::homepageLocality()); ?>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="fl">Danh mục</span>
                    <div class="sltbox fr">
                        <a class="slted" onclick="showDropDown('leftCat', '_leftCat');" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentCategory($catId); ?></a>
                        <input type="hidden" name="dropdownfucntion" value="1" id="leftCat" />
                        <div class="none w160 sub-sltbox" id="_leftCat">
                            <div class="overflow inner-sub-sltbox">
                                <?php $this->widget('zii.widgets.CMenu', ExtensionClass::searchParentCategory($currUrl)); ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php if ($catId) { ?>
                    <li>
                        <span class="fl">Danh mục con</span>
                        <div class="sltbox fr">
                            <a class="slted" onclick="showDropDown('leftCCat', '_leftCCat');" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentCategory($childCat); ?></a>
                            <input type="hidden" name="dropdownfucntion" value="1" id="leftCCat" />
                            <div class="none w160 sub-sltbox" id="_leftCCat">
                                <div class="overflow inner-sub-sltbox">
                                    <?php $this->widget('zii.widgets.CMenu', ExtensionClass::searchChildrentCategory($currUrl, $catId)); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <span class="fl">Nhu cầu</span>
                        <div class="sltbox fr">
                            <a class="slted" onclick="showDropDown('leftDemand', '_leftDemand');" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentDemand($did); ?></a>
                            <input type="hidden" name="dropdownfucntion" value="1" id="leftDemand" />
                            <div class="none sub-sltbox" id="_leftDemand">
                                <div class="overflow inner-sub-sltbox">
                                    <?php $this->widget('zii.widgets.CMenu', ExtensionClass::searchDemand($currUrl, $catId)); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                    $attributesList = ExtensionClass::getHomeAttributesFilter($catId, $currUrl);
                    if (is_array($attributesList)) {
                        foreach ($attributesList as $attrKey => $attrValue) {
                            echo '<li><span class="fl">' . $attrValue['name'] . '</span><div class="sltbox fr">
            <a class="slted" onclick="showDropDown(\'leftA' . ($attrKey + 1) . '\', \'_leftA' . ($attrKey + 1) . '\');" href="javascript:void(0);">' . ExtensionClass::getCurrentAttributes($attrKey) . '</a>
            <input type="hidden" name="dropdownfucntion" value="1" id="leftA' . ($attrKey + 1) . '" />
            <div class="none sub-sltbox" id="_leftA' . ($attrKey + 1) . '"><div class="overflow inner-sub-sltbox">';
                            $this->widget('zii.widgets.CMenu', array('items' => $attrValue['item']));
                            echo '</div></div></div></li>';
                        }
                    }
                }
                ?>

                <li>
                    <span class="fl">Nguồn tin</span>
                    <div class="sltbox fr">
                        <a class="slted" onclick="showDropDown('leftSite', '_leftSite');" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentSite($site); ?></a>
                        <input type="hidden" name="dropdownfucntion" value="1" id="leftSite" />
                        <div class="none sub-sltbox w160" id="_leftSite">
                            <div class="overflow inner-sub-sltbox">
                                <?php $this->widget('zii.widgets.CMenu', ExtensionClass::searchSite($currUrl)); ?>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="block fil-browse">
        <div class="Sbox-title">
            <a class="icon-compact" href="javascript:void(0);"></a>
            Danh mục con
        </div>
        <div class="block-content">
            <p>Tất cả danh mục</p>
            <div class="fil-br-categ">
                <h3><?php echo $catName; ?></h3>
                <ul>
                    <?php
                    if (is_array($listCategory)) {
                        foreach ($listCategory as $key => $value) {
                            $childName = ExtensionClass::utf8_to_ascii($value);
                            if ($key == $childCat)
                                $value = '<strong>' . $value . '</strong>';
                            $currUrlNew = $currUrl;
                            if (isset($currUrlNew['childCat'])) {
                                $currUrlNew['childCat'] = $key;
                                $currUrlNew['childName'] = $childName;
                            } else {
                                $currUrlNew = array_merge($currUrlNew, array('childCat' => $key));
                                $currUrlNew = array_merge($currUrlNew, array('childName' => $childName));
                            }
                            //statistic
                            $countVal = ExtensionClass::statisticDetail($statistic, $currUrlNew);
                            $countVal = GlobalComponents::numberFomat($countVal);
                            echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrlNew) . '">' . $value . '</a>&nbsp;<span>(' . $countVal . ')</span><a href="' . Yii::app()->createUrl('statistic/category', $currUrlNew) . '">(....)</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
    if ($listAttr) {
        ?>  
        <div class="block fil-browse">
            <div class="Sbox-title">
                <a class="icon-compact" href="javascript:void(0);"></a>
                Hiển thị theo:
            </div>
            <div class="block-content"> 
                <?php
                foreach ($listAttr as $key => $AttrVal) {
                    echo '<strong>' . $AttrVal['name'] . '</strong>';
                    ?>
                    <div class="fil-br-list-Wfind">
                        <ul>
                            <?php
                            /**
                             * attributes value by category 
                             */
                            if (is_array($AttrVal['items'])) {
                                foreach ($AttrVal['items'] as $key1 => $childItem) {
                                    $currUrl = array_merge($currUrl, array('ext' => ($key1 + 1), 'aid' => $childItem['id']));
                                    $attributeName = $childItem['name'];
                                    if ($childItem['id'] == $aid)
                                        $attributeName = '<strong>' . $attributeName . '</strong>';
                                    //statistic
                                    $countVal = ExtensionClass::statisticDetail($statistic, $currUrl);
                                    $countVal = GlobalComponents::numberFomat($countVal);
                                    echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributeName . '</a>&nbsp;<span>(' . $countVal . ')</span><a href="' . Yii::app()->createUrl('statistic/category', $currUrl) . '">(...)</a></li>';
                                }
                            }
                            ?>                            
                        </ul>
                    </div>
                    <?php
                }if ($childCat) {
                    /**
                     * attributes value by child category 
                     */
                    $listChildAttr = ExtensionClass::getHomeAttributes($childCat);
                    foreach ($listChildAttr as $key => $AttrVal2) {
                        echo '<strong>' . $AttrVal['name'] . '</strong>';
                        ?>
                        <div class="fil-br-list-Wfind">
                            <ul>
                                <?php
                                if (is_array($AttrVal2['items'])) {
                                    foreach ($AttrVal2['items'] as $key2 => $childItem2) {
                                        $currUrl = array_merge($currUrl, array('ext' => ($key1 + $key2 + 1), 'aid' => $childItem2['id']));
                                        $attributeName2 = $childItem2['name'];
                                        if ($childItem2['id'] == $aid)
                                            $attributeName2 = '<strong>' . $attributeName2 . '</strong>';
                                        //statistic
                                        $countVal = ExtensionClass::statisticDetail($statistic, $currUrl);
                                        $countVal = GlobalComponents::numberFomat($countVal);
                                        echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributeName2 . '</a>&nbsp;<span>(' . $countVal . ')</span><a href="' . Yii::app()->createUrl('statistic/category', $currUrl) . '">(...)</a></li>';
                                    }
                                }
                                ?>                            
                            </ul>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="block fil-browse">
        <div class="Sbox-title">
            <a class="icon-compact" href=""></a>
            Kết quả từ
        </div>
        <div class="block-content">
            <p>Xem kết quả từ các trang:</p>
            <div class="fil-br-list-Wfind">
                <ul>
                    <?php
                    if (is_array($listSite)) {
                        foreach ($listSite as $key => $value) {
                            $currUrl = array_merge($currUrl, array('site' => $value['id']));
                            $siteName = $value['name'];
                            $siteId = isset($_GET['site']) ? $_GET['site'] : '';
                            if ($siteId && ($siteId == $value['id']))
                                $siteName = '<strong>' . $siteName . '</strong>';
                            //statistic
                            $countVal = ExtensionClass::statisticDetail($statistic, $currUrl);
                            $countVal = GlobalComponents::numberFomat($countVal);
                            echo '<li><i class="' . $value['classCss'] . '"></i><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $siteName . '</a>&nbsp;<span>(' . $countVal . ')</span><a href="' . Yii::app()->createUrl('statistic/category', $currUrl) . '">(...)</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>    
    <!--<div class="block fil-browse">
        <div class="Sbox-title no-bdb">
            <a class="icon-expand" href=""></a>
            Tìm kiếm đã lưu
            <span class="hint">(10)</span>
        </div>
    </div>    -->
</div>