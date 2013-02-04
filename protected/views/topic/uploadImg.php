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

<div class="grid_3">

    <div class="block cls-bl">
        <div class="bl-title">
            <h4>Chọn ảnh để đăng</h4>
        </div>
        <div class="block-content">
            <div class="sm-sltfile">
                <p><span class="hint">Định dạng:</span>gif, png, jpg, jpeg</p>
                <p><span class="hint">Kích thước:</span>dưới 1Mb / ảnh</p>
                <p><span class="hint">Số lượng:</span>tối đa 10 ảnh / tin</p>
                <div class="bt">
                    <a id="file_upload_1" class="btn-sltfile" href="javascript:void(0);">
                        Chọn file
                    </a>
                    <span class="notes none">Giới hạn tải file ...</span>
                </div>
            </div>
            <div id="image_uploaded">
                <?php
                if (isset($_POST['imgUpload'])) {
                    foreach ($_POST['imgUpload'] as $key => $val) {
                        if (isset($val['src']) && isset($val['comment'])) {
                            ?>
                            <div class="sm-textimage clearfix">
                                <div class="col-left">
                                    <div class="bl-image">
                                        <a href=""><img width="60px" height="60px" src="<?php echo $val['src']; ?>"></a>
                                        <span class="bdt-t"></span>
                                        <span class="bdt-l"></span>
                                        <span class="bdt-b"></span>
                                        <span class="bdt-r"></span>
                                        <input type="hidden" value="<?php echo $val['src']; ?>" name="imgUpload[<?php echo $key; ?>][src]" />
                                    </div>
                                    <span class="hint"><?php echo 'Ảnh ' . $key . '/10'; ?></span>
                                </div>
                                <div class="col-right">
                                    <textarea maxlength="200" id="are<?php echo $key; ?>" name="imgUpload[<?php echo $key; ?>][comment]" onclick="this.value=''" /><?php echo $val['comment']; ?></textarea>
                                    <div class="Opt-btn">
                                        <a class="btn-left" href="javascript:void(0);"><i class="icon-delete"></i>&nbsp;Xóa</a>
                                        <a class="btn-right" onclick="insertImg('<?php echo $val['src']; ?>', 'are<?php echo $key; ?>');" href="javascript:void(0);">Chèn ảnh</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    echo '<input type="hidden" id="number_countimg" value="' . $key . '">';
                } else {
                    echo '<input type="hidden" id="number_countimg" value="0">';
                }
                ?>
            </div>            
        </div>
    </div>

</div>