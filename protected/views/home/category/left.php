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
$noneUrl = $currUrl;
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
                    <div class="sltbox fr" id="leftdropLocal">
                        <a class="slted" href="javascript:void(0);">
                            <?php
                            echo ExtensionClass::getCurrentLocality();
                            ?>
                        </a>
                        <div class="sub-sltbox none" id="_leftLocal">
                            <div class="overflow inner-sub-sltbox">
                                <?php $this->widget('zii.widgets.CMenu', ExtensionClass::homepageLocality()); ?>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="fl">Danh mục</span>
                    <div class="sltbox fr" id="leftDropCategory">
                        <a class="slted" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentCategory($catId); ?></a>
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
                        <div class="sltbox fr" id="leftCCat">
                            <a class="slted" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentCategory($childCat); ?></a>
                            <div class="none w160 sub-sltbox" id="_leftCCat">
                                <div class="overflow inner-sub-sltbox">
                                    <?php $this->widget('zii.widgets.CMenu', ExtensionClass::searchChildrentCategory($currUrl, $catId)); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <span class="fl">Nhu cầu</span>
                        <div class="sltbox fr" id="leftDemand">
                            <a class="slted" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentDemand($did); ?></a>
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
                            if ($attrKey < 5) {
                                echo '<li><span class="fl">' . $attrValue['name'] . '</span><div class="sltbox fr" id="leftA' . ($attrKey + 1) . '"><a class="slted" href="javascript:void(0);">' . ExtensionClass::getCurrentAttributes($attrKey) . '</a><div class="none sub-sltbox" id="_leftA' . ($attrKey + 1) . '"><div class="overflow inner-sub-sltbox">';
                                $this->widget('zii.widgets.CMenu', array('items' => $attrValue['item']));
                                echo '</div></div></div></li>';
                            }
                        }
                    }
                }
                ?>

                <li>
                    <span class="fl">Nguồn tin</span>
                    <div class="sltbox fr" id="leftSite">
                        <a class="slted" href="javascript:void(0);"><?php echo ExtensionClass::getCurrentSite($site); ?></a>
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
            <p><a class="gray-clr" href="<?php echo Yii::app()->createUrl('home/all'); ?>">Tất cả danh mục</a></p>
            <div class="fil-br-categ">
                <?php
                $currUrlParent = $currUrl;
                if (isset($currUrlParent['childCat'])) {
                    unset($currUrlParent['childCat']);
                    unset($currUrlParent['childName']);
                }
                ?>
                <h3><a class="gray-clr" href="<?php echo Yii::app()->createUrl('home/category', $currUrlParent); ?>"><?php echo $catName; ?></a></h3>
                <ul>
                    <?php
                    if (is_array($listCategory)) {
                        foreach ($listCategory as $key => $value) {
                            $childName = ExtensionClass::utf8_to_ascii($value);
                            if ($key == $childCat)
                                $value = '<strong>' . $value . '</strong>';
                            $currUrlNew = $currUrl;
                            if (isset($currUrlNew['childCat'])) {
                                $currUrlNew['childCat'] = (string) $key;
                                $currUrlNew['childName'] = $childName;
                            } else {
                                $currUrlNew = array_merge($currUrlNew, array('childCat' => (string) $key));
                                $currUrlNew = array_merge($currUrlNew, array('childName' => $childName));
                            }
                            //statistic
                            $countVal = ExtensionClass::statisticDetail($statistic, $currUrlNew);
                            $countVal = GlobalComponents::numberFomat($countVal);
                            echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrlNew) . '">' . $value . '</a>&nbsp;<span>(' . $countVal . ')</span></li>';
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
                foreach ($listAttr as $keyAid => $AttrVal) {
                    if ($keyAid < 5) {
                        echo '<strong>' . $AttrVal['name'] . '</strong>';
                        ?>
                        <div class="fil-br-categ">
                            <ul>
                                <?php
                                /**
                                 * attributes value by category 
                                 */
                                if (is_array($AttrVal['items'])) {
                                    foreach ($AttrVal['items'] as $key1 => $childItem) {
                                        $currUrl = array_merge($currUrl, array('ext' => (string) ($keyAid + 1), 'aid' => $childItem['id'], 'extName' => ExtensionClass::utf8_to_ascii($childItem['name'])));
                                        $attributeName = $childItem['name'];
                                        if ($childItem['id'] == $aid) {
                                            $attributeName = '<strong>' . $attributeName . '</strong>';
                                        }
                                        echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributeName . '</a></li>';
                                    }
                                }
                                ?>                            
                            </ul>
                        </div>
                        <?php
                    }
                }if ($childCat) {
                    /**
                     * attributes value by child category 
                     */
                    $keyAid++;
                    $listChildAttr = ExtensionClass::getHomeAttributes($childCat);
                    foreach ($listChildAttr as $keyChildAid => $AttrVal2) {
                        $currentKeyAid = $keyAid + $keyChildAid;
                        if ($currentKeyAid <= 4) {

                            echo '<strong>' . $AttrVal2['name'] . '</strong>';
                            ?>
                            <div class="fil-br-categ">
                                <ul>
                                    <?php
                                    if (is_array($AttrVal2['items'])) {
                                        foreach ($AttrVal2['items'] as $key2 => $childItem2) {
                                            $currUrl = array_merge($currUrl, array('ext' => ($currentKeyAid + 1), 'aid' => $childItem2['id']));
                                            $attributeName2 = $childItem2['name'];
                                            if ($childItem2['id'] == $aid)
                                                $attributeName2 = '<strong>' . $attributeName2 . '</strong>';
                                            //statistic
                                            $countVal = ExtensionClass::statisticDetail($statistic, $currUrl);
                                            echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $attributeName2 . '</a></li>';
                                        }
                                    }
                                    ?>                            
                                </ul>
                            </div>
                            <?php
                        }
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
                            $noneUrl = array_merge($noneUrl, array('site' => $value['id'], 'siteName' => ExtensionClass::utf8_to_ascii($value['name'])));
                            $siteName = $value['name'];
                            $siteId = isset($_GET['site']) ? $_GET['site'] : '';
                            if ($siteId && ($siteId == $value['id']))
                                $siteName = '<strong>' . $siteName . '</strong>';
                            echo '<li><i class="' . $value['classCss'] . '"></i><a href="' . Yii::app()->createUrl('home/category', $noneUrl) . '">' . $siteName . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div> 
    <div id="postionAd"></div>
    <div class="boxModule" style="position: relative; display: block; height: 365px">
        <div id="advertising" style="margin-top:0px;">
            <?php
            $this->renderPartial('advertising/facebook');
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    var positionAd = $("#postionAd").position();
    var topAd =positionAd.top;
    $("#advertising").css("top", topAd+'px');
    $(window).scroll(function(){
        $("#advertising").css("top",Math.max(0,topAd-$(this).scrollTop()));
    });
</script>