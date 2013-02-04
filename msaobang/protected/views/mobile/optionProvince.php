<?php

/**
 * 
 * @author              Linhnt
 * @package         System SaoBang.vn
 * @version         1.0
 * @since         
 * @copyright         PeaceSoft (c) 2012
 *
 */
//var_dump($content); die;
//<li><a href="">abc abc abc</a></li>
?>
<ul>
    <?php
        foreach ($content as $value){
            echo '<li>';
            echo '<a href="">'.$value['name'].'</a>';
            echo '</li>';
        }
    ?>
</ul>