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
if ($keyCache)
    $keyword = $keyCache;

$currentPage = isset($_GET['ASolrDocument_page']) ? $_GET['ASolrDocument_page'] : 1;
$locality = ExtensionClass::getListLocality();
$this->renderPartial('category/leftAll', array('site' => $site));
$this->pageTitle = 'Tìm kiếm tất cả danh mục';
$description = $locality . 'rao vặt, thông tin rao vặt nhanh, tìm kiếm rao vặt hàng đầu việt nam | saobang.vn trang ' . $currentPage . ' - ' . $site;
Yii::app()->clientScript->registerMetaTag($description, 'description');
?>

<div class="grid_9"><div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a class="active" href="<?php echo Yii::app()->createUrl('home/all'); ?>">Tất cả danh mục</a></li>
        </ul>
    </div>

    <div class="br-noticebox">
        <div class="Tab-br-NewsRv">
            <ul class="clearfix">
                <?php
                echo '<li class="active"><a href="' . Yii::app()->createUrl('home/category') . '">Tất cả&nbsp;</a></li>';
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
                <a class="slted" id="statusSort" onclick="showDropDown('sortcatpage', '_sortcatpage');" href="javascript:void(0);"><?php echo TopicModel::model()->getAttributeLabel($sort); ?></a>
                <input type="hidden" name="dropdownfucntion" value="1" id="sortcatpage" />
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => 'category/_all',
                    'template' => "{sorter}",
                    'sortableAttributes' => array(
                        'title',
                        'createDate',
                        'price',
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
        /**
         * list topic 
         */
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'category/_all',
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

        /**
         * send email 
         */
        $this->renderPartial('email', array('emailNotify' => $emailNotify));

        /**
         * paging 
         */
        $this->widget('zii.widgets.CListViewSaoBang', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'category/_all',
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
