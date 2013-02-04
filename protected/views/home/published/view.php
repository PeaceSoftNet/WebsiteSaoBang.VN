<div class="grid_3">

    <div class="Mysb-Categ">
        <h4>Cá nhân</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::accountPublisherMenu()); ?>
    </div>

    <div class="Mysb-Categ">
        <h4>Tin rao vặt</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::publisherMenu()); ?>
    </div>

</div>

<div class="grid_9">

    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('home/approvedTopic'); ?>" class="active">Tin đã đăng</a></li>
        </ul>
    </div>

    <?php
    $locality = ExtensionClass::getListLocality();
//    $attributes = ExtensionClass::getAllAttributesByCategory($catId);

    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'published/_pendingapprovaltopic',
        'template' => "{items}",
        'emptyText' => '',
        'itemsTagName' => 'ul',
        'htmlOptions' => array(
            'class' => false,
        ),
        'viewData' => array(
            'locality' => $locality,
//            'attributes'=>$attributes,
//            'demand'=>$demand,
//            'currUrl'=>$currUrl
        ),
        'itemsCssClass' => 'list-Browse-NewsRv',
            )
    );
    ?>
    <div class="pagination clearfix">
        <?php
        $this->widget('zii.widgets.CListViewSaoBang', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'published/_pendingapprovaltopic',
            'template' => "{pager}",
            'pager' => array(
                'header' => false,
                'prevPageLabel' => '&laquo; Trước',
                'nextPageLabel' => 'Sau &raquo;',
            ),
            'pagerCssClass' => 'list-Browse-NewsRv',
                )
        );
        ?>
    </div>

</div>