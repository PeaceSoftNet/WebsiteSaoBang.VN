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
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('home/pendingApprovalTopic'); ?>" class="active">Tin đã đăng</a></li>
        </ul>
    </div>

    <div class="Tab-br-NewsRv">
        <ul class="clearfix">
            <li class="active"><a href="">Tất cả <span>(<?php echo $dataProvider->getTotalItemCount(); ?>)</span></a></li>
        </ul>
    </div>
    <div class="btbar-Tab-br-NewsRv"></div>
    <div class="Opt-Tab-br-NewsRv clearfix">
        <div class="fl">
            <span>Hiển thị:</span>
            <ul class="clearfix">
                <?php if ($postPerPage == 15) { ?>
                    <li class="active"><a onclick="setPostPerPage(15);" href="javascript:void(0);">15</a></li>
                    <li><a onclick="setPostPerPage(30);" href="javascript:void(0);">30</a></li>
                <?php } else { ?>
                    <li><a onclick="setPostPerPage(15);" href="javascript:void(0);">15</a></li>
                    <li class="active"><a onclick="setPostPerPage(30);" href="javascript:void(0);">30</a></li>
                <?php } ?>

            </ul>
        </div>
        <div class="fr">
            <span>Sắp xếp theo:</span>
            <a class="slted" id="statusSort" onclick="showDropDown('sortcatpage', '_sortcatpage');" href="javascript:void(0);"><?php echo TopicModel::model()->getAttributeLabel($sort); ?></a>
            <input type="hidden" name="dropdownfucntion" value="1" id="sortcatpage" />
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => 'published/_pendingapprovaltopic',
                'template' => "{sorter}",
                'sortableAttributes' => array(
                    'createDate',
                    'title',
                    'price',
                    'locality',
                ),
                'id' => '_sortcatpage',
                'htmlOptions' => array(
                    'class' => 'sub-sltbox none',
                ),
                'sorterHeader' => false,
                'sorterCssClass' => 'inner-sub-sltbox',
                    )
            );
            ?>
        </div>
    </div>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'published/_pendingapprovaltopic',
        'template' => "{items}",
        'emptyText' => '',
        'itemsTagName' => 'ul',
        'htmlOptions' => array(
            'class' => false,
        ),
        'viewData' => array(),
        'itemsCssClass' => 'list-Browse-NewsRv',
            )
    );

    $this->renderPartial('email', array('emailNotify' => $emailNotify));
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