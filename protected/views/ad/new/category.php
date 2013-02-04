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
<div class="sm-forminfo clearfix">
    <div class="cont">
        <div class="fl">
            <div class="title">
                Danh mục đăng tin:
            </div>
            <input type="text" class="inp-sminfo bgGray" value="<?php echo $categoryModel->name; ?>   *   <?php echo $childCateogryModel->name; ?>" style="width:310px">
        </div>
        <a style="margin:40px 18px 0;display:block;float:left;text-decoration:underline" onclick="history.go(-1)" href="javascript:void(0);">Quay lại bước 1</a>
        <div class="fr error" style="width:250px">
            <div class="title">
                Chọn tỉnh/thành:
            </div>
            <style type="text/css">
                .sm-forminfo .sltbox .sub-sltbox1{right: 0; top: 70px; width: 650px;}
                div.sub-sltbox1 {background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #9B9B9B;border-radius: 2px 2px 2px 2px;box-shadow: 0 6px 6px rgba(0, 0, 0, 0.3);padding: 10px 0;position: absolute;z-index: 999;}
                .sub-sltbox1 li a {color: #333333;display: inline-block;padding: 2px 6px;}
                .sub-sltbox1 li a:hover {color: #0072BC;}
                .sub-sltbox1 li{float: left; padding: 2px 5px;}
            </style>
            <div class="sltbox">
                <a href="javascript:void(0);" id="localLabel" onclick="dropdownMenu('setLocalArea');" class="slted">Toàn quốc</a>
                <div class="sub-sltbox1" id="setLocalArea" style="display: none;">
                    <div class="inner-sub-sltbox" style="height: auto;">
                        <ul>
                            <?php
                            foreach ($localAll as $index => $data) {
                                if ($data->parentId == 0) {
                                    ?>
                                    <li><a onclick="step2Local('<?php $data->id; ?>', '<?php echo $data->name; ?>');" href="javascript:void(0);"><?php echo $data->name; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>                            
        </div>
    </div>
</div>