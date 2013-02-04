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
?>
<div class="block cls-bl ">
    <div class="bl-title">
        <h4>Rao vặt nổi bật</h4>
    </div>
    <div class="block-content pr">
        <style type="text/css">
            .imgVip{background-size:cover !important; height: 90px; width: 90px; display: block; background-size: 90px 90px; float: left; margin-right: 5px; margin-right: 7px; border: 1px solid #ccc;}
        </style>
        <ul class="listRv-hot">
            <?php
            foreach ($dataProviderAd as $index => $data) {
                $categoryModel = AdExtension::getCategoryById($data->categoryId);
                $linkDetail = Yii::app()->createUrl('ad/detail', array('categoryName' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title)));
                ?>
                <li>
                    <?php
                    if ($data->icon) {
                        $data->icon = AdExtension::getDataImage($data->icon);
                        if (AdExtension::isImage($data->icon))
                            echo '<div class="imgVip" style="background: url(\'' . $data->icon . '\') top no-repeat;">&nbsp;</div>';
                    }
                    ?>
                    <p><a href="<?php echo $linkDetail; ?>"><?php echo $data->title; ?></a></p>
                </li>
                <?php
            }
            ?>
        </ul>
        <div class="regisRV-Hot-sms">
            Soạn tin <b>SBV [Mã rao vặt]</b> gửi <b> 8708</b><br />
            để hiển thị tin tại đây (Phí: 15.000đ/sms)
        </div>
    </div>
</div>