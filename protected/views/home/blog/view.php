<div class="grid_3">

    <div class="Mysb-Categ">
        <h4>Thông tin người đăng</h4>
        <ul>
            <li><?php echo $userInfo->email; ?></li>
            <li><?php echo $userInfo->mobile; ?></li>
            <li><?php echo $userInfo->address; ?></li>
        </ul>
    </div>
    <div id="postionAd"></div>
    <div class="Mysb-Categ" style="position: relative; display: block; height: 350px">
        <div id="advertising" style="margin-top:0px;">
            <?php
            $this->renderPartial('advertising/facebook');
            ?>
        </div>
    </div>
</div>

<div class="grid_9">

    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('home/approvedTopic'); ?>" class="active">Tin đã đăng</a></li>
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
                'itemView' => 'blog/_view',
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
    $locality = ExtensionClass::getListLocality();

    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'blog/_view',
        'template' => "{items}",
        'emptyText' => '',
        'itemsTagName' => 'ul',
        'htmlOptions' => array(
            'class' => false,
        ),
        'viewData' => array(
            'locality' => $locality,
        ),
        'itemsCssClass' => 'list-Browse-NewsRv',
            )
    );
    ?>
    <div class="pagination clearfix">
        <?php
        $this->widget('zii.widgets.CListViewSaoBang', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'blog/_view',
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
<script type="text/javascript">
    var positionAd = $("#postionAd").position();
    var topAd =positionAd.top;
    $("#advertising").css("top", topAd+'px');
    $(window).scroll(function(){
        $("#advertising").css("top",Math.max(0,topAd-$(this).scrollTop()));
    });
    function topicIsVipFree(topicId){
        $.post('<?php echo Yii::app()->createUrl('topic/ad'); ?>', {
            'topicId': topicId
        }, function(){
            alert("<?php
        $key = 'ad_' . date('Ymd') . '_' . Yii::app()->session['userId'];
        $value = Yii::app()->cache->get($key);
        if ($value <= 5) {
            echo 'Bạn đã đăng tin VIP thành công!!';
        } else {
            echo 'Tin VIP miễn phí hôm nay của bạn đã dùng hết, hãy thử lại vào ngày hôm sau!';
        }
        ?>");
                });
            }
</script>