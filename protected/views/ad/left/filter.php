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
//$fcurrent = Yii::app()->cache->get(self::_key_filter);
?>
<div class="block fil-browse">
    <div class="Sbox-title">
        <a href="javascript:void(0);">Lọc chi tiết:</a>
    </div>
    <div class="fil-detail no-bdt">
        <div class="block-content">
            <ul class="fil-br-slt">
                <?php
                $i = 1;
                foreach ($dataProvider as $index => $data) {
                    if (!$data->group) {
                        ?>
                        <li>
                            <span class="fl"><?php echo $data->name; ?></span>
                            <?php
                            if (isset($fcurrent[$i])) {
                                echo '<a href="javascript:void(0);" onclick="removeFilter(' . $i . ');" class="un-select-fil" style="width:56px"><i class="icon-fil">&nbsp;</i>Bỏ lọc </a>';
                            }
                            ?>                            
                            <div class="clear"></div>
                            <div class="fil-br-categ">
                                <ul>
                                    <?php
                                    foreach ($dataProvider as $key => $value) {
                                        $checked = '';
                                        if (isset($fcurrent[$i])) {
                                            if ($value->id == $fcurrent[$i])
                                                $checked = 'checked="checked"';
                                        }
                                        if ($value->group == $data->id)
                                            echo '<li><input ' . $checked . ' type="radio" onchange="setFilter(' . $i . ', ' . $value->id . ');" onselect="setFilter(' . $i . ', ' . $value->id . ');" name="filter_' . $i . '" id="rd' . $key . '"/> <label for="rd' . $key . '">' . $value->name . '</label></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                        <?php
                        $i++;
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>