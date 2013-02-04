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
<style type="text/css">
    .sm-textimage .col-left{padding: 5px;}
</style>
<div class="grid_3">

    <div class="block cls-bl">
        <div class="bl-title">
            <h4>Chọn ảnh để đăng</h4>
        </div>
        <div class="block-content">
            <div class="sm-sltfile">
                <input id="number_countimg" value="0" type="hidden" />
                <p><span class="hint">Định dạng:</span>gif, png, jpg, jpeg</p>
                <p><span class="hint">Kích thước:</span>dưới 1Mb / ảnh</p>
                <p><span class="hint">Số lượng:</span>tối đa 10 ảnh / tin</p>
                <div class="bt">
                    <a id="file_upload_1" class="btn-sltfile" href="javascript:void(0);">
                        Chọn file
                    </a>
                </div>
            </div>
            <div class="sm-textimage clearfix" id="image_uploaded">
                <?php
                $key = 0;
                if ($imgUpload) {
                    foreach ($imgUpload as $key => $value) {
                        ?>
                        <div class="col-left fl" id="imgArea<?php echo $key; ?>">
                            <div class="bl-image">
                                <a href=""><img width="90px" height="90px" src="<?php echo $value; ?>"></a>
                                <span class="bdt-t"></span>
                                <span class="bdt-l"></span>
                                <span class="bdt-b"></span>
                                <span class="bdt-r"></span>
                            </div>
                            <p><a href="javascript:void(0)" onclick="removeImg('<?php echo $key; ?>');">Xóa </a> | <a href="javascript:void(0);" onclick="insertImg('<?php echo $value; ?>', 'are<?php echo $key; ?>');">Chèn ảnh</a></p>
                        </div>
                        <input type="hidden" name="imgUpload[]" value="<?php echo $value; ?>">
                        <?php
                    }
                }
                ?>
                <script type="text/javascript">
                    $('#number_countimg').val(<?php echo $key; ?>);
                </script>
            </div>
        </div>
    </div>
</div>