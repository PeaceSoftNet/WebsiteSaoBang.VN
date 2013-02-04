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
<div class="block-shop">
    <div class="title clear">
        <h3><i class="icon-shopPro">&nbsp;</i>Người bán tiêu biểu</h3>
        <a href="<?php echo Yii::app()->createUrl('ask/shopRegister'); ?>" class="fr">Đăng ký người bán</a>
    </div>
    <div class="cont clearfix">
        <ul class="list-shop clearfix">
            <?php
            foreach ($dataProvider as $index => $data) {
                $link = Yii::app()->createUrl('ask/shop', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->name)));
                ?>
                <li>                    	
                    <a style="border: 0px;" href="<?php echo $link; ?>" target="_blank" class="disp-lg"><div style="background-size:cover !important; height: 40px; width: 40px; display: block; background-size: 30px 30px; background: url('<?php echo $data->logo; ?>') top no-repeat;"></div></a>
                    <p><a style="padding-left: 5px;" href="<?php echo $link; ?>"  target="_blank"><?php echo $data->name; ?></a></p>
                    <p style="padding-left: 5px;"><span class="starRate"><span style="<?php echo 'width:' . (10 * $data->rank) . '%'; ?>" class="starVote">&nbsp;</span></span></p>                                
                </li>
                <?php
            }
            ?>
            <li>                    	
                <p><a style="padding-left: 5px;" href="<?php echo Yii::app()->createUrl('ask/listShop'); ?>">Xem thêm..</a></p>                        
            </li>
        </ul>
    </div>
</div>