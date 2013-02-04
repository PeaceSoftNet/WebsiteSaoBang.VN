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
$listSite = ExtensionClass::listSite();
$currUrl = array();
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
                        <a class="slted" href="javascript:void(0);">Chọn danh mục</a>
                        <div class="none w160 sub-sltbox" id="_leftCat">
                            <div class="overflow inner-sub-sltbox">
                                <?php $this->widget('zii.widgets.CMenu', ExtensionClass::searchParentCategory($currUrl)); ?>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="block fil-browse">
        <div class="Sbox-title">
            <a class="icon-compact" href="javascript:void(0)"></a>
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
                            $currUrl = array_merge($currUrl, array('name' => ExtensionClass::utf8_to_ascii($siteName)));
                            $countVal = ExtensionClass::statisticBySite($value['id']);
                            echo '<li><i class="' . $value['classCss'] . '"></i><a href="' . Yii::app()->createUrl('home/all', $currUrl) . '">' . $siteName . '</a>&nbsp;<span>(' . GlobalComponents::numberFomat($countVal) . ')</span></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>    
    <div class="boxModule" style="margin-bottom: 0px;">
        <?php
        $this->renderPartial('advertising/facebook');
        ?>
    </div>
</div>
