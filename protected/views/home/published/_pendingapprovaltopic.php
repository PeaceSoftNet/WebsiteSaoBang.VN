<li>
    <?php
    $categoryModel = AdExtension::getCategoryById($data->categoryId);
    ?>
    <h3 class="title-Br-NewsRv">
        <a class="fl" target="_black" href="<?php echo Yii::app()->createUrl('ad/detail', array('categoryName' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))); ?>"><?php echo $data->title; ?></a>
        <?php if ($data->price) echo '<span class="Br-price fr">' . GlobalComponents::numberFomat($data->price) . ' VNĐ</span>'; ?>
    </h3>
    <div class="Navi-Br-NewsRv clearfix">
        <div style="margin: 10px; clear: both;">
            &nbsp;&nbsp;<a class="detail-NewsRv" href="<?php echo Yii::app()->createUrl('ad/step2', array('id' => $data->id, 'categoryId' => $data->categoryId, 'childCategoryId' => $data->childCatId)); ?>"><i class="gr-icon-expand"></i> <span>Sửa tin....</span></a>&nbsp;&nbsp;
            <a onclick="$.removeTopic(<?php echo $data->id; ?>);" class="detail-NewsRv" href="javascript:void(0);" ><i class="gr-icon-delete"></i> <span>Xóa tin</span></a>&nbsp;&nbsp;
        </div>        
    </div>
    <style type="text/css">
        .falseDetail{display: none;}
        .trueDetail{display:block;}
    </style>
    <div class="clear"></div>
</li>