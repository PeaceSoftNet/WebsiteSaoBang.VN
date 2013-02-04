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
<td>#<?php echo $index + 1; ?></td>
<td style="text-align: left;">
    <div class="title">
        <?php echo $data->title; ?>            
    </div>     
    <div>
        <?php echo $data->email; ?>
        <p><?php echo $mailTitle; ?></p>
    </div>
</td>
<td style="text-align: left;">
    <div class="title">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProviderB,
            'itemView' => '_productEmail',
            'template' => "{items}\n",
            'emptyText' => '',
        ));
        ?>
    </div>        
</td>
</tr>