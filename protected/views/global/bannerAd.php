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
<div class="boxModule">
    <?php
    if (isset($listAdvertising) && isset($random)) {
        echo $listAdvertising[$random];
    }
    ?>
</div>