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
$categoryId = $topicModel->categoryId;
$categoryModel = AdExtension::getCategoryById($categoryId);
$childCategoryId = $topicModel->childCatId;
$listChildCategory = AdExtension::getListChildCategory($categoryId);
$this->pageTitle = $topicModel->title;
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix" >
            <?php $this->pathWay($categoryModel, $childCategoryId); ?>
            <?php $this->setLocal(); ?>
        </div>
        <div class="grid_3">
            <?php $this->vipDetailPage(); ?>
            <?php $this->bannerAd(); ?>
        </div>
        <!--end grid_3-->
        <div class="grid_9">
            <?php $this->listChildCategoryItem($listChildCategory, $categoryModel, $childCategoryId); ?>
            <!--end filter-->
            <div class="clearfix">
                <?php $this->sellerNotify(); ?>
                <?php $this->getShopByTitle($topicModel->title); ?>
            </div>
            <div class="box-smsVip clearfix">
                <span class="iconVip">&nbsp;</span>
                <span class="fl">Soạn tin  <b class="clRed">SB VIP <?php echo $topicModel->code; ?></b>  gửi  <span class="clRed">8708</span>  để đăng tin VIP    
                    <a target="_blank" href="/thong-bao-3/thong-bao-ve-quyen-loi-cua-tin-rao-vat-vip-tren-saobangvn.html"> Chính sách tin VIP</a> </span>
            </div>
            <h1 class="dtprd-name mgt20"><?php echo $topicModel->title; ?></h1>
            <div class="postinfo-prd clearfix bd-bt">
                <div class="fl">
                    <span class="coderv"> Mã rao vặt: <span class="org-clr"><?php echo $topicModel->code; ?></span></span>
                </div>

                <div class="fr">
                    <div class="controlAd fr">
                        <style type="text/css">
                            td .pls{display: none !important;}
                        </style>
                        <div class="sltbox clearfix" style="float: right; height: 22px; margin-left: 5px;">
                            <a href="javascript:void(0);" id="uploadtingButton" onclick="updateTopic('<?php echo $topicModel->id; ?>');" class="dtpostNews"><i class="dticon-postNews"></i>&nbsp;Up tin</a>
                        </div>
                        <div class="fb-like" style="width: 55px; overflow: hidden; float: right;" data-href="http://saobang.vn<?php echo Yii::app()->request->requestUri; ?>" data-send="false" data-width="55px"  data-show-faces="false" data-stream="false" data-header="false" data-font="arial"></div>
                    </div>
                </div>
            </div>
            <div class="postinfo-prd clearfix">
                <?php
                $listDate = array('am' => 'sáng', 'pm' => 'chiều');
                $stringDate = $listDate[date('a', strtotime($topicModel->createDate))];
                $dateDay = date('d/m/Y', strtotime($topicModel->createDate));
                $dateBase = date('h:i:s', strtotime($topicModel->createDate));
                if ($topicModel->locality != 0) {
                    $localName = AdExtension::getLocalById($topicModel->locality);
                    $localName = 'tại&nbsp;' . $localName->name;
                } else {
                    $localName = '•&nbsp;Rao vặt toàn quốc';
                }
                ?>
                <div class="fl"><i class="dticon-clock"></i>&nbsp;Đăng lúc: <?php echo $dateBase; ?>, <?php echo $stringDate; ?> ngày <?php echo $dateDay; ?> &nbsp;<?php echo $localName; ?>
                    &nbsp;&nbsp;<i class="dticon-mail"></i>&nbsp;<a href="mailto:<?php echo $topicModel->email; ?>"><?php echo $topicModel->email; ?></a></div>
                <div class="fr"><a href="javascript:void(0);"><i class="dticon-errors"></i>&nbsp;Than phiền</a></div>
            </div>
            <div>
                <?php
                if (!$topicModel->isDelete) {
                    echo GlobalComponents::processContent($topicDetail->content);
                } else {
                    echo 'Tin này không tồn tại hoặc đã bị xóa.';
                }
                ?>
            </div>


            <?php $this->comment($topicModel); ?>
            <!--end comment-->      
            <?php $this->keyRelation($categoryId, $childCategoryId); ?>
        </div>	
        <!--end grid_9-->
    </div>
</div>