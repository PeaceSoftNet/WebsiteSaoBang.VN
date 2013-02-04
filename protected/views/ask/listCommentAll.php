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
foreach ($dataProvider as $index => $data) {
    ?>
    <li>
        <div class="reply">
            <p><?php echo $data['comment']; ?></p>
            <div class="price"><?php if ($data['price']) { ?>Giá: <span class="org-clr"><?php echo GlobalComponents::numberFomat($data['price']); ?> VNĐ</span><?php } ?>&nbsp;&nbsp;
                <?php if ($data['link']) { ?>•&nbsp;&nbsp;<a target="_black" rel="nofollow" href="<?php echo $data['link']; ?>"><?php echo $data['link']; ?></a><?php } ?></div>
        </div>
        <div class="infoUser">
            <p><?php echo GlobalComponents::convertTimeValue($data['createDate']); ?> </p>
            <p><?php echo GlobalComponents::hiddenEmail($data['email']); ?></p>
            <p>Uy tín: 50</p>
        </div>
    </li>
    <?php
}
?>    