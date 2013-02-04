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
$keyCache = Yii::app()->cache->get(md5($_SERVER['REMOTE_ADDR']) . ExtensionSearch::utf8_to_ascii($keyword));
if ($keyCache)
    $keyword = $keyCache;

$currentPage = isset($_GET['ASolrDocument_page']) ? $_GET['ASolrDocument_page'] : 1;
$postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;

$locality = ExtensionClass::getListLocality();
$this->renderPartial('search/leftAll', array('site' => $site, 'currUrl' => $currUrl));

$this->pageTitle = $keyword;
$description = $keyword . ' - Thông tin mua bán rao vặt về ' . $keyword . ' được cập nhật trong ngày. Đăng tin miễn phí và tìm kiếm nhanh thông tin tổng hợp toàn quốc tại Saobang.vn trang ' . $currentPage;
Yii::app()->clientScript->registerMetaTag($description, 'description');
Yii::app()->clientScript->registerMetaTag($keyword . ', mua bán, rao vặt', 'keyword');
?>

<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a <?php echo 'class="active"'; ?> href="<?php echo Yii::app()->createUrl('home/search'); ?>">Tìm kiếm</a></li>
        </ul>
    </div>
    <div class="ntc-title clearfix">
        <h3>Đang tìm: <strong><?php echo $keyword; ?></strong></h3>
        <span class="fr"><?php echo ((($currentPage - 1) * $postPerPage) + 1) ?> - <?php echo (($currentPage) * $postPerPage); ?> của <?php echo GlobalComponents::numberFomat($dataProvider->totalItemCount); ?> kết quả</span>
    </div>
    <div class="br-noticebox" id="loadSuggest">

    </div>    
    <div class="Tab-br-NewsRv">
        <ul class="clearfix">
            <li class="active"><a href="javascript:void(0);">Tất cả <span>(<?php echo GlobalComponents::numberFomat($dataProvider->totalItemCount); ?>)</span></a></li>
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
            <a class="slted" href="javascript:void(0);">Kết quả tìm kiếm</a>
        </div>
    </div>

    <ul class="list-Browse-NewsRv">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'search/_view',
            'template' => "{items}",
            'emptyText' => '',
            'viewData' => array('keyword' => $keyword)
                )
        );
        ?>
    </ul>
    <?php
    Yii::app()->clientScript->registerMetaTag('Sản phẩm thuộc Peacesoft Solutions', 'author');


    $did = isset($_GET['did']) ? $_GET['did'] : '';
    if ($did) {
        $demandNameTitle = ExtensionClass::getCurrentDemand($did);
        $this->pageTitle = $this->pageTitle . ' - ' . $demandNameTitle;
    }

    $aid = isset($_GET['aid']) ? $_GET['aid'] : '';
    if ($aid) {
        $extNameTitle = ExtensionClass::getAttributesByAid($aid);
        $this->pageTitle = $this->pageTitle . ' - ' . $extNameTitle;
    }

    $siteId = isset($_GET['site']) ? $_GET['site'] : '';
    if ($siteId) {
        $siteNameTitle = ExtensionClass::getCurrentSite($siteId);
        $this->pageTitle = $this->pageTitle . ' - ' . $siteNameTitle;
    }

    $pager = isset($_GET['ASolrDocument_page']) ? $_GET['ASolrDocument_page'] : '';
    if ($pager) {
        $this->pageTitle = $this->pageTitle . ' - Rao vặt trang ' . $pager;
    }

    $this->renderPartial('email', array('emailNotify' => $emailNotify));

    $this->widget('zii.widgets.CListViewSaoBang', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'search/_view',
        'template' => "{pager}",
        'pager' => array(
            'header' => false,
            'prevPageLabel' => '&laquo; Trước',
            'nextPageLabel' => 'Sau &raquo;',
        ),
        'pagerCssClass' => 'pagination clearfix',
            )
    );
    ?>

</div>	
<script type="text/javascript">
    $('#loadSuggest').load('<?php echo Yii::app()->createUrl('home/loadSuggest'); ?>', {'keyword': '<?php echo $keyword; ?>'});
</script>