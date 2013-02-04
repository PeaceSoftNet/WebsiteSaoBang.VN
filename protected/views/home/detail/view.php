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
if (!isset($data->categoryId)) {
    echo '<div style="min-height: 320px">Lỗi dữ liệu, rao vặt không hợp lệ hoặc đã bị xóa</div>';
    return false;
}
$localName = ExtensionClass::getLocalityById($data->locality);
$statistic = ExtensionClass::getStatistic($data->categoryId);
$listCategory = ExtensionClass::getListChildCategory($data->categoryId);
$this->renderPartial('advertising/detailPage', array('dataProviderAd' => $dataProviderAd, 'code' => $data->code));
$catName = ExtensionClass::getCategoryNameById($data->categoryId);
$this->pageTitle = $data->title . ' - Rao vặt ' . $localName;
Yii::app()->clientScript->registerMetaTag($data->description, 'description');

$currentUrl = Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title)));
if ($data->childCatId) {
    $breadcrumb = array(
        '0' => array(
            'url' => Yii::app()->createUrl('home/category', array('catId' => $data->categoryId, 'name' => ExtensionClass::utf8_to_ascii($catName))),
            'name' => $catName,
        ),
        '1' => array(
            'url' => Yii::app()->createUrl('home/category', array('catId' => $data->categoryId, 'name' => ExtensionClass::utf8_to_ascii($catName), 'childCat' => $data->childCatId, 'childName' => ExtensionClass::utf8_to_ascii(ExtensionClass::getCategoryNameById($data->childCatId)))),
            'name' => ExtensionClass::getCategoryNameById($data->childCatId),
        ),
        '2' => array(
            'url' => $currentUrl,
            'name' => $data->title,
        )
    );
} else {
    $breadcrumb = array(
        '0' => array(
            'url' => Yii::app()->createUrl('home/category', array('catId' => $data->categoryId, 'name' => ExtensionClass::utf8_to_ascii($catName))),
            'name' => $catName,
        ),
        '1' => array(
            'url' => $currentUrl,
            'name' => $data->title,
        )
    );
}
echo GlobalComponents::createSnippetsDetail($this->pageTitle, $data->description, $currentUrl, $breadcrumb, $dataProviderKeyword);
?>

<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a href="<?php echo Yii::app()->createUrl('home/category', array('catId' => $data->categoryId, 'name' => ExtensionClass::utf8_to_ascii($catName))); ?>"><?php echo $catName; ?></a></li>
            <?php
            if ($data->childCatId) {
                $childCatName = ExtensionClass::getCategoryNameById($data->childCatId);
                echo '<li><a class="active" href="' . Yii::app()->createUrl('home/category', array('catId' => $data->categoryId, 'name' => ExtensionClass::utf8_to_ascii($catName), 'childCat' => $data->childCatId, 'childName' => ExtensionClass::utf8_to_ascii($childCatName))) . '">' . $childCatName . '</a></li>';
            }
            ?>
        </ul>
    </div>


    <div class="grayModule">
        <ul class="detail-categ clearfix">
            <?php
            if ($data->categoryId && $data->childCatId) {
                $this->widget('zii.widgets.CListViewSaoBang', array(
                    'dataProvider' => $listCategory,
                    'itemView' => 'detail/_childCat',
                    'template' => "{items}",
                    'emptyText' => '',
                    'viewData' => array('childCatId' => $data->childCatId, 'catId' => $data->categoryId, 'catName' => $catName, 'statistic' => $statistic)
                        )
                );
            }
            ?> 
        </ul>
        <a class="dtback" onclick="history.go(-1);" href="javascript:void(0);">Quay lại</a>
    </div>

    <!-- LeaderBoard_728x90 -->
    <div id='div-gpt-ad-1352106844912-0' style="margin-bottom: 15px;">
        <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1352106844912-0'); });
        </script>
    </div>

    <?php echo '<span style="color: blue; float:left; font-size: 16px;">[' . $localName . ']&nbsp;</span>'; ?><h1 class="dtprd-name"><?php
    echo $data->title;
    if ($data->price)
        echo '- <span>' . GlobalComponents::numberFomat($data->price) . ' VNĐ</span>';
    ?> </h1>
    <div class="postinfo-prd clearfix">
        <div class="fl">
            <i class="dticon-clock"></i>&nbsp;Đăng lúc: <?php echo date('H:i:s', strtotime($data->createDate)); ?>, ngày <?php echo date('d/m/Y', strtotime($data->createDate)); ?>&nbsp;&nbsp;<i class="dticon-view"></i>Mã tin VIP: <?php echo $data->code; ?>&nbsp;&nbsp;<i class="dticon-mail"></i> <?php echo $data->email; ?>
            <?php if (Yii::app()->user->id) { ?> 
                <?php if ($data->isDelete) { ?>
                    &nbsp;&nbsp;<a class="detail-NewsRv" onclick="releasetopic('<?php echo $data->id ?>')" href="javascript:void(0);" >&nbsp; <span style="color: red;">Release</span></a>
                <?php } else { ?>
                    &nbsp;&nbsp;<a class="detail-NewsRv" onclick="removetopic('<?php echo $data->id ?>')" href="javascript:void(0);" >&nbsp; <span style="color: red;">Xóa tin</span></a>
                <?php } ?>
                &nbsp;&nbsp;<a class="detail-NewsRv" onclick="topicIsVip('<?php echo $data->id ?>')" href="javascript:void(0);" >&nbsp;<span style="color: red;">VIP</span></a>
            <?php } ?>
        </div>
        <div class="fr">            
            <a rel="facebox" href="#reportTopic"><i class="dticon-errors"></i>&nbsp;Than phiền</a>
        </div>
    </div>

    <?php $this->renderPartial('options', array('data' => $data, 'dataDetail' => $dataDetail, 'localName' => $localName)); ?>
    <?php
    if (Yii::app()->user->id) {
        echo 'Nguồn: ' . base64_decode($data->url);
    }
    ?>   

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=290595207712125";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <fb:comments href="http://saobang.vn/<?php echo Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title))); ?>" num_posts="2" width="700"></fb:comments>
    <style type="text/css">
        .fb_iframe_widget{min-height: 123px;}
    </style>
    <?php
//    }
    ?>

    <div id="reportTopic" style="display:none; margin: 15px;">
        <br />
        <strong><i>Mọi ý kiến than phiền sẽ được chúng tôi giải quyết trong thời gian sớm nhất.<br /> Cảm ơn bạn!</i></strong>
        <?php
        $form = $this->beginWidget('CActiveForm');
        echo $form->labelEx($reportTopic, 'content');
        $reportTopic->topicId = $data->id;
        $reportTopic->title = $data->title;
        echo $form->hiddenField($reportTopic, 'topicId');
        echo $form->hiddenField($reportTopic, 'title');
        echo $form->textArea($reportTopic, 'content');
        echo CHtml::submitButton('Gửi', array('class' => 'submitReport'));
        $this->endWidget();
        ?>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#_similarTopic').load('/home/SimilarTopic', {'topicId' : '<?php echo $data->id; ?>'});
        $("#productSelerCDT").load('/home/loadProductCDT', {'category': <?php echo $data->categoryId; ?>});
    });
    
    </script>

    <div id="_similarTopic">       

    </div>
    <div id="productSelerCDT">

    </div>
    <div class="grayModule">
        <ul class="detail-categ clearfix">
            <?php
            foreach ($dataProviderKeyword as $index => $data) {
                if ($index < 3) {
                    echo '<li class="no-bg"><span class="fl"><a href="' . Yii::app()->createUrl('home/search', array('sid' => $data->id, 'catId' => $data->categoryId, 'childCat' => $data->childCatId, 'title' => ExtensionClass::utf8_to_ascii($data->name))) . '">' . ucfirst($data->name) . '</a></span></li>';
                } else {
                    echo '<li><span class="fl"><a href="' . Yii::app()->createUrl('home/search', array('sid' => $data->id, 'catId' => $data->categoryId, 'childCat' => $data->childCatId, 'title' => ExtensionClass::utf8_to_ascii($data->name))) . '">' . ucfirst($data->name) . '</a></span></li>';
                }
            }
            ?>

        </ul>
    </div>
</div>
