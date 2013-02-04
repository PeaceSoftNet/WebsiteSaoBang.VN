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
$listParentCategory = ExtensionClass::getListParentCategory();
?>
<tr id="topic-edit-<?php echo $data->id; ?>">
    <td>#<?php echo $index + 1; ?></td>
    <td>
        <?php
        echo CHtml::textField('title', $data->title, array('id' => 'topicTitle', 'class' => 'w400', 'onchange' => 'updateTopic(this.value, "title", "' . $data->id . '");'));

        echo CHtml::textArea('description', $data->description, array('class' => 'w400 no-resize h40', 'onchange' => 'updateTopic(this.value, "description", "' . $data->id . '");'));

        /**
         * list demand
         */
        echo '<div class="content-edit-style">';
        $demandvalue = ExtensionClass::getDemandByCategory($data->categoryId);
        if ($demandvalue) {
            echo '<div class="demand"><strong>Nhu cầu</strong>' . CHtml::radioButtonList('demand' . $data->id, $data->demand, $demandvalue, array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;', 'onchange' => 'updateTopic(this.value, "demand", "' . $data->id . '");')) . '</div>';
        }
        echo '</div><div class="pd10"></div>';
        echo '<div class="content-edit-style">';
        /**
         * list extension by category parent
         */
        $attrArr = ExtensionClass::getListAttributesAjax($data->categoryId);
        $condition = '';
        $num = 0;
        if (is_array($attrArr)) {
            foreach ($attrArr as $key => $value) {
                $num++;
                $extension = 'extension' . $num;
                $condition .= '<div class="' . $extension . '"><strong>' . $value['name'] . '</strong>' . CHtml::radioButtonList($extension . $data->id, $data->$extension, $value['attr'], array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;', 'onchange' => 'updateTopic(this.value, "' . $extension . '", "' . $data->id . '");')) . '</div>';
            }
            echo $condition;
        }

        /**
         * list extension by category child
         */
        $attrArrChild = ExtensionClass::getListAttributesAjax($data->childCatId);
        $conditionChild = '';
        if (is_array($attrArrChild)) {
            foreach ($attrArrChild as $keyChild => $valueChild) {
                $num++;
                $extension = 'extension' . $num;
                $conditionChild .= '<div class="' . $extension . '"><strong>' . $valueChild['name'] . '</strong>' . CHtml::radioButtonList($extension . $data->id, $data->$extension, $valueChild['attr'], array('separator' => '', 'template' => '{input}&nbsp;{label} &nbsp;&nbsp;', 'onchange' => 'updateTopic(this.value, "' . $extension . '", "' . $data->id . '");')) . '</div>';
            }
            echo $conditionChild;
        }
        echo '</div><div class="clear"></div>';
        echo CHtml::textArea('contentDetail', TopicDetail::model()->findByPk($data->id)->content, $htmlOptions = array('class' => 'text600', 'onchange' => 'updateTopic(this.value, "content", "' . $data->id . '");'));
        ?>
    </td>
    <td>
        <?php
        $categoryParentId = isset($_POST['parentCatId']) ? $_POST['parentCatId'] : $data->categoryId;
        $listCategory = ExtensionClass::getCategoryChildByParentCat($categoryParentId);
        echo '<br />' . CHtml::dropDownList('categoryId', $data->categoryId, $listParentCategory, array('class' => 'multiOption w200', 'onclick' => 'getParentCategory(this.value, "childCategory' . $data->id . '");'));
        echo '<br /><br /><div id="childCategory' . $data->id . '">' . CHtml::dropDownList('childCatId', $data->childCatId, $listCategory, array('class' => 'multiOption w200', 'onchange' => 'changeCategory("' . $categoryParentId . '" ,this.value, "' . $data->id . '");')) . '</div>';
        ?>
    </td>
    <td>
        <div class="over-h300">
            <?php
            $imagesTopic = json_decode(TopicDetail::model()->findByPk($data->id)->images);
            if (is_array($imagesTopic)) {
                foreach ($imagesTopic as $key => $value) {
                    echo '<img src="' . $value . '" width="180px" />';
                }
            }
            ?>
        </div>
    </td>
</tr>
<tr id="topic-buttom-<?php echo $data->id; ?>" class="content-edit-button" style="border-bottom: 2px solid #ccc;">
    <td colspan="3" width="100%">
        <div class="m20 right">
            <a class="addNew" onclick="complateTopic('<?php echo $data->id; ?>');" href="javascript:void(0);">
                <span>Xong</span>
            </a>      
            <a class="addNew" onclick="deleteTopic('<?php echo $data->id; ?>');" href="javascript:void(0);">
                <span>Xóa</span>
            </a>    
        </div>
        <div class="color-red left">Tạo lúc <?php echo $data->createDate; ?></div>
</tr>