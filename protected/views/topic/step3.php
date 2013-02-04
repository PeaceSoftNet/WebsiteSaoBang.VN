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
$this->pageTitle = 'Đăng rao vặt - ' . $title;
?>

<div id="wrapper">
    <div class="main clearfix">

        <div class="notice-submit-cpl">
            <h1>Đăng rao vặt thành công</h1>
            <p><strong>Bạn có thể:</strong></p>
            <ul>
                <li>Xem lại chi tiết:  <a target="_black" href="<?php echo GlobalComponents::topicDetail($tid, $title, $catId, $childCatId); ?>"><strong><i><?php echo $title; ?></i></strong></a></li>
                <li>Xem lại danh mục: <a target="_black" href="<?php echo Yii::app()->createUrl('home/category', array('catId' => $catId, 'name' => ExtensionClass::utf8_to_ascii($catname))); ?>"><strong><em><?php echo $catname; ?></em></strong></a></li>
            </ul>
        </div>

        <div class="block policysmsVIP">
            <h1 class="title">Giới thiệu dịch vụ<span class="org-clr">Tin Vip<b>15K</b></span>3 ngày / tin / sms</h1>
            <div class="regisVIP-sms">
                Soạn<span class="code-sms red-clr">SB&nbsp;&nbsp;VIP&nbsp;&nbsp;793779</span>gửi&nbsp;&nbsp;<span class="red-clr">8780</span>&nbsp;&nbsp;Để mua tin VIP
                <br>
                <span class="charges-sms">Phí: 15.000đ/tin. Tìm hiểu <a target="_black" href="http://saobang.vn/thong-bao-ve-quyen-loi-cua-tin-rao-vat-vip-tren-saobangvn-tb3sb.html">chính sách tin VIP</a></span>
            </div>
            <ul class="interestsmsVIP clearfix">
                <li><a target="_black" href="http://saobang.vn/thong-bao-chuc-nang-tim-kiem-doi-tac-qua-email-cho-tin-vip-tai-saobangvn-tb5sb.html" style="border: 0">
                        <p><img src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/policysmsVIP04.png" /></p>
                        <h1>Được sử dụng chức năng tìm kiếm đối tác thông qua email</h1>
                    </a>
                </li>
                <li>
                    <p><img src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/policysmsVIP01.png" /></p>
                    <h1>Hiển thị tại box nổi bật trang chủ<br />và chi tiết các tin</h1>
                </li>
                <li>
                    <p><img src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/policysmsVIP02.png" /></p>
                    <h1>Hiển thị đóng khung tại trang browse/search<br />Hiển thị ưu tiên khi browse/search</h1>
                </li>
                <li>
                    <p><img src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/policysmsVIP03.png" /></p>
                    <h1>Được đăng trên các site khác tự động</h1>
                </li>

            </ul>
        </div>        

    </div>
</div>
