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
?>
<div style="height: 60px; border-bottom: 1px solid #ccc;">
    <div>
        <span>#<?php echo $data->id; ?></span>
        <span>#<?php echo base64_decode($data->title); ?></span>
    </div>
    <div>
        <strong>  
            <span style="color: blue;">#<?php echo $data->domain; ?></span>        
            <span>#<?php echo base64_decode($data->categoryId); ?></span>
            <span>#<?php echo base64_decode($data->categoryChildId); ?></span>
        </strong>
        <?php
        $catId = isset($_GET['catId']) ? $_GET['catId'] : 0;
        echo CHtml::dropDownList('categoryId', $catId, ExtensionClass::getListParentCategory(), array('onchange' => 'selectCat(this.value, "' . $data->id . '")'));
        ?>
        <span id="childCate<?php echo $data->id; ?>">
            <?php
            if ($catId) {
                $childCatList = ExtensionClass::getCategoryChildByParentCat($catId);
                $childCatList[0] = ' -- Chọn danh mục con -- ';
                echo CHtml::dropDownList('categoryChildId', 0, $childCatList, array('onchange' => 'selectByCat("' . urlencode(trim($data->categoryId)) . '", "' . urlencode(trim($data->categoryChildId)) . '", "' . $catId . '", this.value, "' . urlencode($data->domain) . '")'));
            }
            ?>
        </span>

    </div>
</div>
<script type="text/javascript">
    function selectCat(catId, topicId){
        window.location.href = '/crawler/Tranf?catId='+catId +'';
    }
    function selectByCat(beginCat, beginChildCat, endCat, endChildCat, domainName){
        window.location.href = '/crawler/TranfCat?beginCat='+beginCat+'&beginChildCat='+beginChildCat+'&endCat='+endCat+'&endChildCat='+endChildCat+'&domain='+domainName;
    }
</script>