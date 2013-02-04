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
$keyCache = Yii::app()->cache->get(md5($_SERVER['REMOTE_ADDR']) . ExtensionSearch::utf8_to_ascii($keyword));
if ($keyCache) {
    $keyword = $keyCache;
}

$currentPage = isset($_GET['ASolrDocument_page']) ? $_GET['ASolrDocument_page'] : 1;
$postPerPage = isset(Yii::app()->session['postPerPage']) ? Yii::app()->session['postPerPage'] : 15;

$locality = ExtensionClass::getListLocality();
$attributes = ExtensionClass::getAllAttributesByCategory($catId);
$demand = ExtensionClass::getDemandByCategory($catId);
$homeDemand = ExtensionClass::getDemandHomeByCategory($catId);
if ($catId)
    $model = CategoryModel::model()->findByPk($catId);
$this->renderPartial('search/leftSearch', array('catId' => $catId, 'catName' => $model->name, 'childCat' => $childCat, 'sort' => $sort, 'listAttr' => $listAttr, 'currUrl' => $currUrl, 'aid' => $aid, 'site' => $site, 'did' => $dId, 'statistic' => $statistic));
$this->pageTitle = $keyword;
if (!$model->description)
    $model->description = $keyword . ' - Thông tin mua bán rao vặt về ' . $model->name . ' được cập nhật trong ngày. Đăng tin miễn phí và tìm kiếm nhanh thông tin tổng hợp toàn quốc tại Saobang.vn trang ' . $currentPage;
?>
<div class="grid_9">    
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('home/search', array('keyword' => $keyword)); ?>">Tìm kiếm</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name))); ?>"><?php echo $model->name; ?></a></li>
            <?php
            if ($childCat) {
                $childModel = CategoryModel::model()->findByPk($childCat);
                $this->pageTitle = $keyword;
                if (!$childModel->description)
                    $childModel->description = 'Mạng xã hội mua sắm, rao vặt, tích hợp thanh toán trực tuyến Việt Nam';
                echo '<li><a class="active" href="' . Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name), 'childCat' => $childCat, 'childName' => ExtensionClass::utf8_to_ascii($childModel->name))) . '">' . $childModel->name . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <?php
    $breadcrumb = array(
        '0' => array(
            'url' => Yii::app()->createUrl('home/search', array('keyword' => $keyword)),
            'name' => 'Rao vặt',
        ),
        '1' => array(
            'url' => Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name))),
            'name' => $model->name,
        ),
        '2' => array(
            'url' => $currUrl,
            'name' => $keyword,
        ),
    );
    echo GlobalComponents::createSnippetsSearchPage($keyword, $model->description, $currUrl, $breadcrumb);
    ?>
    <div class="br-noticebox">
        <div class="ntc-title clearfix">
            <h3>Đang tìm: <strong><?php echo $keyword; ?></strong></h3>
            <span class="fr"><?php echo ((($currentPage - 1) * $postPerPage) + 1) ?> - <?php echo (($currentPage) * $postPerPage); ?> của <?php echo GlobalComponents::numberFomat($dataProvider->totalItemCount); ?> kết quả</span>
        </div>
    </div>
    <div class="br-noticebox">
        <div class="Tab-br-NewsRv">
            <ul class="clearfix">
                <?php
//remove demand value
                $demanUrl = $currUrl;
                unset($demanUrl['did']);
                unset($demanUrl['demandName']);
//statistic
                $countVal = ExtensionClass::statisticDetail($statistic, $demanUrl);
                $countVal = GlobalComponents::numberFomat($countVal);
                if (!$dId) {
                    echo '<li class="active"><a href="' . Yii::app()->createUrl('home/search', $demanUrl) . '">Tất cả&nbsp;</a></li>';
                } else {
                    echo '<li><a href="' . Yii::app()->createUrl('home/search', $demanUrl) . '">Tất cả&nbsp;</a></li>';
                }
                if (is_array($homeDemand)) {
                    foreach ($homeDemand as $key => $value) {
                        $currUrl = array_merge($currUrl, array('did' => $value['id'], 'demandName' => ExtensionClass::utf8_to_ascii($value['name'])));
                        $countVal = ExtensionClass::statisticDetail($statistic, $currUrl);
                        $countVal = GlobalComponents::numberFomat($countVal);
                        if ($dId == $value['id']) {
                            echo '<li class="active"><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $value['name'] . '&nbsp;</a></li>';
                        } else {
                            echo '<li><a href="' . Yii::app()->createUrl('home/search', $currUrl) . '">' . $value['name'] . '&nbsp;</a></li>';
                        }
                    }
                }
                ?>
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
        <?php
        /**
         * list topic 
         */
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'search/_byCategory',
            'template' => "{items}",
            'emptyText' => '',
            'itemsTagName' => 'ul',
            'htmlOptions' => array(
                'class' => false,
            ),
            'viewData' => array(
                'locality' => $locality,
                'attributes' => $attributes,
                'demand' => $demand,
                'currUrl' => $currUrl,
                'keyword' => $keyword
            ),
            'itemsCssClass' => 'list-Browse-NewsRv',
                )
        );

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

        Yii::app()->clientScript->registerMetaTag($model->description, 'description');
        Yii::app()->clientScript->registerMetaTag($keyword . ', ' . $model->name . ', mua bán, rao vặt', 'keyword');
        Yii::app()->clientScript->registerMetaTag('Sản phẩm thuộc Peacesoft Solutions', 'author');

        /**
         * send email 
         */
        $this->renderPartial('email', array('emailNotify' => $emailNotify));

        /**
         * paging 
         */
        $this->widget('zii.widgets.CListViewSaoBang', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'search/_byCategory',
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