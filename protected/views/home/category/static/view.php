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
$homeDemand = ExtensionClass::getDemandHomeByCategory($catId);
if ($catId)
    $model = CategoryModel::model()->findByPk($catId);
$this->renderPartial('category/static/left', array('catId' => $catId, 'catName' => $model->name, 'childCat' => $childCat, 'sort' => $sort, 'listAttr' => $listAttr, 'currUrl' => $currUrl, 'aid' => $aid, 'site' => $site, 'did' => $dId, 'statistic' => $statistic));
$this->pageTitle = $model->name;
if (!$model->description)
    $model->description = 'Mạng xã hội mua sắm, rao vặt, tích hợp thanh toán trực tuyến Việt Nam';
Yii::app()->clientScript->registerMetaTag($model->name . ' - ' . $model->description, 'description');
?>
<div class="grid_9"><div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a <?php if (!$childCat) echo 'class="active"'; ?> href="<?php echo Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($model->name), 'TopicModel_sort' => $sort)); ?>"><?php echo $model->name; ?></a></li>
            <?php
            if ($childCat) {
                $childModel = CategoryModel::model()->findByPk($childCat);
                ;
                $this->pageTitle = $childModel->name;
                if (!$childModel->description)
                    $childModel->description = 'Mạng xã hội mua sắm, rao vặt, tích hợp thanh toán trực tuyến Việt Nam';
                Yii::app()->clientScript->registerMetaTag($childModel->name . ' - ' . $childModel->description, 'description');
                echo '<li><a class="active" href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $childModel->name . '</a></li>';
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
                //statistic
                $countVal = ExtensionClass::statisticDetail($statistic, $demanUrl);
                $countVal = GlobalComponents::numberFomat($countVal);
                if (!$dId) {
                    echo '<li class="active"><a href="' . Yii::app()->createUrl('home/category', $demanUrl) . '">Tất cả&nbsp;<span>(' . $countVal . ')</span></a><a href="' . Yii::app()->createUrl('statistic/category', $demanUrl) . '">...</a></li>';
                } else {
                    echo '<li><a href="' . Yii::app()->createUrl('home/category', $demanUrl) . '">Tất cả&nbsp;<span>(' . $countVal . ')</span></a><a href="' . Yii::app()->createUrl('statistic/category', $demanUrl) . '">...</a></li>';
                }
                if (is_array($homeDemand)) {
                    foreach ($homeDemand as $key => $value) {
                        $currUrl = array_merge($currUrl, array('did' => $value['id']));
                        $countVal = ExtensionClass::statisticDetail($statistic, $currUrl);
                        $countVal = GlobalComponents::numberFomat($countVal);
                        if ($dId == $value['id']) {
                            echo '<li class="active"><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $value['name'] . '&nbsp;<span>(' . $countVal . ')</span></a><a href="' . Yii::app()->createUrl('statistic/category', $currUrl) . '">...</a></li>';
                        } else {
                            echo '<li><a href="' . Yii::app()->createUrl('home/category', $currUrl) . '">' . $value['name'] . '&nbsp;<span>(' . $countVal . ')</span></a><a href="' . Yii::app()->createUrl('home/statistic', $currUrl) . '">...</a></li>';
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
                    'itemView' => 'category/static/_listtopic',
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
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'category/static/_listtopic',
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
        ?>
    </div>