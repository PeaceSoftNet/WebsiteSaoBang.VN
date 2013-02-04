<?php
/**
 * 
 * @author          Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$this->pageTitle = 'Giới thiệu dự án | Saobang.vn ';
$description = 'Saobang.vn là website tổng hợp rao vặt lớn nhất Việt Nam, thông tin về đầy đầy đủ các ngành hàng và lĩnh vực, dữ liệu được trường hóa chi tiết.';
Yii::app()->clientScript->registerMetaTag($description, 'description');
$currentUrl = Yii::app()->createUrl('home/aboutUs');
$breadcrumb = array(
    '0' => array(
        'url' => $currentUrl,
        'name' => 'Giới thiệu',
    )
);
//echo GlobalComponents::createSnippets($this->pageTitle, $description, $currentUrl, $breadcrumb);
?>
<div class="grid_3">
    <div class="Mysb-Categ">
        <h4>Tìm hiểu Saobăng.vn</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::contentHtmlMenu()); ?>
    </div>
</div>
<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a class="active" href="<?php echo Yii::app()->createUrl('home/aboutUs'); ?>">Giới thiệu Saobang.vn</a></li>
        </ul>
    </div>
    <div class="br-noticebox">
        <div class="ntc-title clearfix">
            <h4>Giới thiệu dự án Saobang.vn</h4>
        </div>
        <div class="html-content">            
            <p>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/homepage/images/logo-Rv.png" />
            </p>
            <p>Saobang.vn - Dự án TMĐT thuộc công ty Cổ phần Giải pháp Phần Mềm Hòa Bình (Peacesoft Solutions.) chính thức ra mắt từ ngày <strong>1.9.2012</strong>. Mục tiêu của Saobang.vn là cung cấp cho người dùng một Cơ sở dữ liệu khổng lồ về thông tin mua bán, rao vặt và việc làm, với công cụ tìm kiếm nhanh &amp; chính xác nhất. Tại Saobang.vn, người dùng có thể tìm kiếm mọi thông tin mình cần mà không cần phải vào bất kỳ trang thông tin mua bán rao vặt nào khác.</p>
            <p>
                Với hơn 5.000.000 tin rao vặt luôn có mặt trên hệ thống, <strong>Saobang.vn</strong> trở thành website tổng hợp rao vặt lớn nhất Việt Nam, thông tin về đầy đầy đủ các ngành hàng và lĩnh vực, dữ liệu được trường hóa chi tiết, giúp người xem  tìm kiếm thông tin và thao tác dễ dàng. </p>
            <p>
                Với công cụ đăng tin miễn phí, không cần đăng nhập, hỗ trợ đăng ảnh nhanh và dễ dàng, giúp người đăng có thể tiết kiệm thời gian. Đặc biệt, hệ thống Saobang.vn sẽ kết nối tự động với tất cả các website rao vặt để thông tin khi đăng tại Saobang.vn cũng sẽ được đăng trên các website liên kết.
            </p>
            <p>
                Ông Nguyễn Hòa Bình, TGĐ Peacesoft, đơn vị xây dựng Saobang.vn cho biết: <em>&quot;Sự ra đời của Saobang.vn sẽ giúp người dùng tiết kiệm thời gian gấp 10 lần khi muốn đăng tải các thông tin rao vặt vì không phải vào từng website để đăng tin như trước đây nữa, đồng thời với hệ sinh thái các sản phẩm của Peacesoft, thông tin của họ có thể đến với người xem nhanh và nhiều gấp mười lần so với các website khác.&quot;</em> </p>
            <p>
                Với kinh nghiệm gần 8 năm hoạt động trong lĩnh vực TMĐT và sở hữu nhiều hệ thống các website TMĐT lớn, Peacesoft hy vọng Saobang.vn đáp ứng được sự mong đợi của người dùng và sự tâm huyết của đội ngũ triể khai, xây dựng sản phẩm.
            </p>
            <p>Mọi câu hỏi, thắc mắc, góp ý xin vui lòng gửi về email <a href="mailto:support@saobang.vn">support@saobang.vn</a> </p>
        </div>
    </div>
</div>