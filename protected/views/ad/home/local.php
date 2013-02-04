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
$currentLocal = Yii::app()->request->cookies->contains('sb_adLocal') ? Yii::app()->request->cookies['sb_adLocal']->value : 0;
?>
<div class="block slt-location">
    <div class="bl-title"><h4>Chọn Tỉnh/Thành phố</h4></div>
    <div class="block-content">
        <input class="enter-lct" id="homelocality" type="text" value="Nhập tên thành phố" />
        <div id="localityAjx">
            <div class="holder">
                <div class="list-lct scroll-pane">
                    <ul class="clearfix">
                        <?php
                        if (!isset($_POST['localKey']))
                            echo '<li><a onclick="setLocal(0);" href="javascript:void(0);">Toàn quốc</a></li>';

                        foreach ($dataProviderLocality as $index => $data) {
                            if ($currentLocal == $data->id) {
                                $style = 'style="font-weight: bold;"';
                            } else {
                                $style = '';
                            }
                            echo '<li><a ' . $style . ' onclick="setLocal(' . $data->id . ');" href="javascript:void(0);">' . $data->name . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>