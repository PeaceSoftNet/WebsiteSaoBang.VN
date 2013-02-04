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
$this->pageTitle = 'Liên hệ quảng cáo | Saobang.vn ';
$description = 'Khách hàng có nhu cầu đăng tin VIP hoặc quảng cáo thương hiệu, sản phẩm trên Saobang.vn bằng các hình thức treo Banner, Pop Under xin vui lòng liên hệ';
Yii::app()->clientScript->registerMetaTag($description, 'description');
$currentUrl = Yii::app()->createUrl('home/contactAd');
$breadcrumb = array(
    '0' => array(
        'url' => $currentUrl,
        'name' => 'Liên hệ quảng cáo',
    )
);
//echo GlobalComponents::createSnippets($this->pageTitle, $description, $currentUrl, $breadcrumb);
?>
<div class="grid_3">

    <div class="Mysb-Categ">
        <h4>Tìm hiểu Saobang.vn</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::contentHtmlMenu()); ?>
    </div>

</div>

<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a class="active" href="<?php echo Yii::app()->createUrl('home/contactAd'); ?>">Liên hệ quảng cáo</a></li>
        </ul>
    </div>
    <div class="br-noticebox">
        <div class="ntc-title clearfix">
            <h4>Dịch vụ đăng tin & quảng cáo trên Saobang.vn</h4>
        </div>
        <div class="html-content">            
            <p>
                Khách hàng có nhu cầu đăng tin VIP hoặc quảng cáo thương hiệu, sản phẩm trên Saobang.vn bằng các hình thức treo Banner, Pop Under xin vui lòng liên hệ với bộ phận Quảng cáo theo thông tin bên dưới:
            </p>         
            <p>
                Hotline: 1900-585-888
            </p>
            <p>
                Fax: 04-36320987
            </p>
            <p>
                Email : support@saobang.vn 
            </p>
            <p>
                Địa chỉ: Tầng 12A, tòa nhà VTC Online – 18 Tam Trinh, Quận Hai Bà Trưng, TP. Hà Nội
            </p> 
        </div>
    </div>
</div>