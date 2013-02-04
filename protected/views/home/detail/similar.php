<?php
/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		system
 * @version 		
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$locality = ExtensionClass::getListLocality();
$attributes = ExtensionClass::getAllAttributesByCategory($catId);
$demand = ExtensionClass::getDemandByCategory($catId);
?>
<div class="block" >
    <div class="bl-title"><h4>Tin tương tự</h4></div>
    <div class="block-content">
        <ul class="list-Browse-NewsRv no-mg">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => 'detail/_similar',
                'template' => "{items}",
                'emptyText' => '',
                'viewData' => array('locality' => $locality, 'attributes' => $attributes, 'demand' => $demand, 'catId' => $catId),
                    )
            );
            ?> 
        </ul>
    </div>
</div>