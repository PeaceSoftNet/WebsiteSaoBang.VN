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
$i = 1;
?>
<ul class="categRv">                        
    <?php
    foreach ($dataProvider as $index => $data) {
        if ($data->parentId == 0) {
            $parentLink = Yii::app()->createUrl('ad/category', array('categoryId' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->name)));
            if ($i == 1) {
                echo '<li class="no-bdt">';
            } elseif (in_array($i, array(4, 7, 10, 13, 16, 19, 22))) {
                echo '<li>';
            }
            ?>
            <div class="bl-col holder">
                <div class="Categ-title"><span class="<?php echo $data->classCss; ?>"></span><a href="<?php echo $parentLink; ?>"><h1><?php echo $data->name; ?></h1></a></div>
                <div class="Categ-cont">                        
                    <div class="scroll-pane">
                        <ul>
                            <?php
                            $j = 0;
                            foreach ($dataProvider as $key => $value) {
                                if ($value->parentId == $data->id && $j < 6) {
                                    $childLink = Yii::app()->createUrl('ad/category', array('categoryId' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->name), 'childCategoryId' => $value->id, 'childTitle' => ExtensionClass::utf8_to_ascii($value->name)));
                                    ?>
                                    <li><a href="<?php echo $childLink; ?>"><?php echo $value->name; ?></a></li>
                                    <?php
                                    $j++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            if (in_array($i, array(3, 6, 9, 12, 15, 18, 21))) {
                echo '</li>';
            }
            $i++;
        }
    }
    ?>
</ul>