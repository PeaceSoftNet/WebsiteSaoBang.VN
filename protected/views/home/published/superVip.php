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
?>
<div class="grid_3">

    <div class="Mysb-Categ">
        <h4>Cá nhân</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::accountPublisherMenu()); ?>
    </div>

    <div class="Mysb-Categ">
        <h4>Tin rao vặt</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::publisherMenu()); ?>
    </div>

</div>

<div class="grid_9">
    <style type="text/css">
        .grid_9 ul{margin: 0px 10px;}
        .grid_9 li{padding: 5px 20px;}
    </style>
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a style="color: red;" href="<?php echo Yii::app()->createUrl('home/superVip'); ?>" class="active">Tài khoản VIP &nbsp;&nbsp;<img src="/data/new.gif" /></a></li>
        </ul>
    </div>
    <h4>1. Giới thiệu tài khoản VIP</h4>
    <div>
        <p>Bạn là người bán hàng chuyên nghiệp. bạn muốn bán được nhiều hàng hơn với chi phí thấp nhất. Hãy trở thành người dùng VIP tại saobang</p>
        <ul>
            <li>- Bạn sẽ được <strong>miễn phí</strong> up 5 tin VIP/1 ngày</li>
            <li>- Tin VIP được xuất hiện thường xuyên tại box trang chủ trong vị trí nổi bật.</li>
            <li>- Tin VIP được bôi viền màu vàng và nổi bật trên mục đầu tiên trong các danh mục con.</li>
            <li>- Tin VIP được ưu tiên xuất hiện khi người dùng tìm kiếm.</li>
            <li>- Tin VIP được  sử dụng chức năng tìm kiếm khách hàng qua email.</li>
            <li>- Tin VIP được  đăng tin tự động trên hàng nghìn website, diễn đàn rao vặt khác <span style="color: #999">(tính năng này đang được thử nghiệm và sẽ cập nhật trong thời gian sớm nhất)</span>.</li>
            <li>- Tin VIP được ưu tiên trong các hoạt động truyền thông của Saobang.vn. Thông qua các hoạt động quảng cáo trực tuyến, email marketing, facebook, báo điện tử....</li>
        </ul>

    </div>
    <h4>2.Để trở thành người dùng VIP</h4>
    <p>Người dùng VIP chỉ cần trả: <strong style="color: red;">100.000VND/01 tháng</strong> bằng cách:</p>
    <ul>
        <li>- <strong>Cách 1</strong>: Soạn liên tục 7 tin nhắn với nội dung (<strong><i>SB VIP XXX  gửi 8708</i></strong>) trong đó XXX là mã số tin rao vặt ( 15.000 VND/1 SMS).</li>
        <li>- <strong>Cách 2</strong>: Kích hoạt thanh toán qua Ngân lượng (Nút Pop Up chọn số tháng -> tiền -> Pop up thanh toán qua Ngân Lượng).</li>
        <li>- <strong>Cách 3</strong>: Liên hệ trực tiếp với saobang.vn (Hotline: 0436 321 125 - 093 696 6263) để được ký hợp đồng trực tiếp.</li>
    </ul>
    <div style="margin: 30px 0px; color: #333">
        <p>Mọi thắc mắc và cần hỗ trợ vui lòng liên hệ</p>
        <p>Bộ phận chăm sóc khách hàng saobang.vn</p>
        <p>Hotline: 0436 321 125 - 093 696 6263</p>
        <p>Email: <a href="mailto:info@saobang.vn">info@saobang.vn</a></p>
    </div>
</div>