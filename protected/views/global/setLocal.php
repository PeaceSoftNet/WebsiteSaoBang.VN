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
$listLocal = AdExtension::getLocalAll();
//check local
$localId = Yii::app()->request->cookies->contains('sb_adLocal') ?
        Yii::app()->request->cookies['sb_adLocal']->value : 0;
$listDefault = array('0' => '0', '1' => '1', '2' => '50');
?>
<ul class="tab-slfilter fr">
    <li><a onclick="setLocal(<?php echo $localId; ?>);" href="javascript:void(0);" class="active"><?php echo AdExtension::getLocalById($localId)->name; ?><i>&nbsp;</i></a></li>
    <?php
    foreach ($listDefault as $value) {
        if ($value != $localId)
            echo '<li><a onclick="setLocal(' . $value . ');" href="javascript:void(0);">' . AdExtension::getLocalById($value)->name . '<span>&nbsp;</span></a></li>';
    }
    ?> 
    <li id="setLocalButton">
        <div class="arrang" style="position:relative;top:0">
            <a class="slted" onclick="dropdownMenu('setLocalArea');" href="javascript:void(0);">Tỉnh khác</a>
            <div id="setLocalArea" class="sub-sltbox" style="display: none; width:700px;">
                <div class="inner-sub-sltbox" style="height: 192px;">
                    <ul>
                        <?php
                        foreach ($listLocal as $index => $data) {
                            if (!in_array($data->id, array('1', '50')) && !($data->parentId)) {
                                ?>
                                <li><a onclick="setLocal(<?php echo $data->id; ?>);" href="javascript:void(0);"><?php echo $data->name; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </li>
</ul>