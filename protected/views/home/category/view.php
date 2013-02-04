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
$page = isset($_GET['TopicSlaveModel_page']) ? $_GET['TopicSlaveModel_page'] : 1;
$locality = ExtensionClass::getListLocality();
$attributes = ExtensionClass::getAllAttributesByCategory($catId);
$demand = ExtensionClass::getDemandByCategory($catId);
$homeDemand = ExtensionClass::getDemandHomeByCategory($catId);
if ($catId) {
    $model = Yii::app()->cache->get('home_category_nameCategory' . $catId);
    if ($model === false) {
        $model = CategoryModel::model()->findByPk($catId);
        Yii::app()->cache->set('home_category_nameCategory' . $catId, $model, 6 * 60 * 60);
    }
    $this->renderPartial('category/left', array('catId' => $catId, 'catName' => $model->name, 'childCat' => $childCat, 'sort' => $sort, 'listAttr' => $listAttr, 'currUrl' => $currUrl, 'aid' => $aid, 'site' => $site, 'did' => $dId, 'statistic' => $statistic));

    $this->pageTitle = $model->name;
}
?>
<div class="grid_9"><div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a <?php if (!$childCat) echo 'class="active"'; ?> href="<?php echo Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name))); ?>"><?php echo $model->name; ?></a></li>
            <?php
            if ($childCat) {
                $childModel = Yii::app()->cache->get('home_category_childModel_' . $childCat);
                if ($childModel === false) {
                    $childModel = CategoryModel::model()->findByPk($childCat);
                    Yii::app()->cache->set('home_category_childModel_' . $childCat, $childModel, 5 * 60);
                }

                $this->pageTitle = $childModel->name;

                echo '<li><a class="active" href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $childModel->name . '</a></li>';
                //set snippets
                $currentUrl = Yii::app()->createUrl('home/category', $currUrl);
                $breadcrumb = array(
                    '0' => array(
                        'url' => Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name))),
                        'name' => $model->name,
                    ),
                    '1' => array(
                        'url' => $currentUrl,
                        'name' => $childModel->name,
                    ),
                );
//                echo GlobalComponents::createSnippets($this->pageTitle, $childModel->description, $currentUrl, $breadcrumb);
            } else {
                //set snippets
                $currentUrl = Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name)));
                $breadcrumb = array(
                    '0' => array(
                        'url' => Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name))),
                        'name' => $model->name,
                    ),
                );
//                echo GlobalComponents::createSnippets($this->pageTitle, $model->description, $currentUrl, $breadcrumb);
            }
            ?>
        </ul>
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
                    echo '<li class="active"><a href="' . Yii::app()->createUrl('home/category', $demanUrl) . '">Tất cả&nbsp;<span>(' . $countVal . ')</span></a></li>';
                } else {
                    echo '<li><a href="' . Yii::app()->createUrl('home/category', $demanUrl) . '">Tất cả&nbsp;<span>(' . $countVal . ')</span></a></li>';
                }
                if (is_array($homeDemand)) {
                    foreach ($homeDemand as $key => $value) {
                        $demandName = isset($value['name']) ? $value['name'] : 'Tất cả';
                        if ($value['id'])
                            $currUrl = array_merge($currUrl, array('did' => $value['id'], 'demandName' => ExtensionClass::utf8_to_ascii($demandName)));
                        $countVal = ExtensionClass::statisticDetail($statistic, $currUrl);
                        $countVal = GlobalComponents::numberFomat($countVal);
                        if ($dId == $value['id']) {
                            //set page title
                            $this->pageTitle = $this->pageTitle . ' - ' . $value['name'];
                            //set current link
                            echo '<li class="active"><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $value['name'] . '&nbsp;</a></li>';
                        } else {
                            echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $value['name'] . '&nbsp;</a></li>';
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
                <a class="slted" id="statusSort" onclick="showDropDown('sortcatpage', '_sortcatpage');" href="javascript:void(0);"><?php echo TopicModel::model()->getAttributeLabel($sort); ?></a>
                <input type="hidden" name="dropdownfucntion" value="1" id="sortcatpage" />
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => 'category/_listtopic',
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
            'itemView' => 'category/_listtopic',
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
                'currUrl' => $currUrl
            ),
            'itemsCssClass' => 'list-Browse-NewsRv',
                )
        );

        /**
         * paging 
         */
        $this->widget('zii.widgets.CListViewSaoBang', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'category/_listtopic',
            'template' => "{pager}",
            'pagerCssClass' => 'pagination clearfix',
            'pager' => array(
                'header' => false,
                'prevPageLabel' => '&laquo; Trước',
                'nextPageLabel' => 'Sau &raquo;',
            ),
                )
        );

        /**
         * send email 
         */
        $this->renderPartial('email', array('emailNotify' => $emailNotify));
        /**
         * set page description
         */
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
        $model->description = $this->pageTitle . ' - Tổng hợp thông tin mua bán, rao vặt về ' . $this->pageTitle . ' cập nhật liên tục trong ngày. Đăng rao vặt nhanh nhất tại Saobang.vn trang ' . $page;
        Yii::app()->clientScript->registerMetaTag($model->description, 'description');
        Yii::app()->clientScript->registerMetaTag('Sản phẩm thuộc Peacesoft Solutions', 'author');
        if ($page > 1)
            $this->pageTitle = $this->pageTitle . ' - Rao vặt trang ' . $page;
        ?>   
    </div>

    <div class="grayModule" style="margin-top: 5px;">
        <ul class="detail-categ clearfix">
            <?php
            foreach ($dataProviderKeyword as $index => $data) {
                if ($index < 3) {
                    echo '<li class="no-bg"><span class="fl"><a href="' . Yii::app()->createUrl('home/search', array('sid' => $data->id, 'catId' => $catId, 'childCat' => $data->childCatId, 'title' => ExtensionClass::utf8_to_ascii($data->name))) . '">' . ucfirst($data->name) . '</a></span></li>';
                } else {
                    echo '<li><span class="fl"><a href="' . Yii::app()->createUrl('home/search', array('sid' => $data->id, 'catId' => $catId, 'childCat' => $data->childCatId, 'title' => ExtensionClass::utf8_to_ascii($data->name))) . '">' . ucfirst($data->name) . '</a></span></li>';
                }
            }
            ?>

        </ul>
    </div>
</div>