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
if ($index % 2) {
    echo '<tr class="odd">';
} else {
    echo '<tr>';
}
?>
<td><strong>#<?php echo $index + 1; ?></strong></td>
<td style="text-align: left;">
    <div class="title">
        <?php
        echo $data->id;
        ?>
    </div>
</td>    
<td style="text-align: left;">
    <?php
    echo '<strong>' . $data->title . '</strong>';
    ?>
</td>
</tr>
