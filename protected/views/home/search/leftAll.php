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
                                <?php $this->widget('zii.widgets.CMenu', ExtensionClass::searchAllCategory($currUrl)); ?>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="boxModule" style="margin-bottom: 0px;">
        <?php
        $this->renderPartial('advertising/facebook');
        ?>
    </div>
</div>
