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
<style type="text/css">
    .nav{display: block; width: 1010px;}
    .nav h1{text-align: center; font-size: 18px;}
    .nav .form-left{width: 600px; float: left; display: block; min-height: 500px; border: 1px solid #ccc;}

    .nav .form-right{width: 400px; float: left; display: block; min-height: 500px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;}
    .nav .form-right .product{width: 100%; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;}
    .nav .form-right .product img{float: left;}
    .nav .form-right h2{font-size: 15px; text-align: center;}
</style>
<div class="nav">
    <div>
        <a href="/">Trang chủ</a>&NestedGreaterGreater;Kiếm tiền online
    </div>
    <h1>Chia sẻ link nhận tiền mặt</h1>
    <div class="form-left">
        <table width="100%" style="border-bottom: 1px solid #ccc; padding: 10px">
            <tr>
                <td width="50%" height="30px">Đối tượng cá nhân (tab mặc định)</td>
                <td width="50%" height="30px" style="background: #ccc">Đối tượng doanh nghiệp</td>
            </tr>
        </table>
        <h4>Giới thiệu</h4>
        <div>
            <img src="http://www.hellochao.vn/images/make-money-online.jpg" width="200px">
            <p>Kiếm tiền trực tuyến giúp bạn làm việc onlien kiếm thu nhập cao</p>
            <img src="http://www.time-management-central.net/image-files/time-management-clock.jpg" width="200px">
            <p>Hoàn toàn chủ động về thời gian làm việc</p>
            <img src="http://b.vimeocdn.com/ps/180/194/1801948_300.jpg" width="200px">
            <p>Mỗi click tới link bạn bạn đã chia sẻ, và lưu lại đọc tin trong vòng 59 giây sẽ mang lại cho bạn một điểm</p>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC3mQ-JxHglKTe019dDANrFc2FS-Fw50t_t-aGAp0tjARdzr0BaA" width="200px">
            <p>Đổi điểm lấy tiền</p>

            <a href="<?php echo Yii::app()->createUrl('articles/about'); ?>">Xem chi tiết</a>
        </div>
        <hr />
        <h4>Cách tham gia</h4>
        <ul>
            <li>1. Đăng ký tài khoản tại http://saobang.vn</li>
            <li>2. Kích hoạt tài khoản đã đăng ký qua email.</li>
            <li>3. Đăng nhập tại saobang.vn</li>
            <li>4. Chọn 1 sản phẩm đang tham gia chương trình <a href="<?php echo Yii::app()->createUrl('articles/view') ?>">Kiếm tiền online</a></li>
            <li>5. Gửi nội dung của sản phẩm tới bạn bè thông qua facbook, tweet, google+, yaoo</li>
            <hr />
            <div>
                <h4>Nhà tài chợ chương trình</h4>
                <img src="http://t0.gstatic.com/images?q=tbn:ANd9GcSs1gk9cRCDoTQf44gEw-Ed86Y68QHsf4mULsq-0vMBarukmuox0gnRuhtR" width="200px">
                <p>Ngân lượng.vn</p>

                <img src="http://media2.ichodientuvn.com/storedata/community/blog/news/image/7f6836490e4a9fcb910958a5717664b5.png" width="200px">
                <p>Ebay.vn</p>
                <img src="http://media2.ichodientuvn.com/storedata/community/blog/news/image/1001adf7c6b3a0954e43f9037f9ddde3.png" width="200px">
                <p>Chodientu.vn</p>
            </div>
    </div>
    <div class="form-right">
        <h2>Các sản phẩm đang tham gia chương trình</h2>
        <?php
        foreach ($dataProvider as $index => $data) {
            echo '<div class="product">';
            echo '<a href="' . Yii::app()->createUrl('articles/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '"><img width="200px" src="' . $data->avata . '" /></a>';
            echo '<div><a href="' . Yii::app()->createUrl('articles/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '">' . $data->title . '</a></div>';
            echo '<div style=" clear: both;"></div>';
            echo '</div>';
            echo '<div style="height: 10px;"></div>';
        }
        ?>
        <hr />
        <h4>Các sản phẩm sẽ tham gia chương trình trong thời gian tới</h4>
        <?php
        foreach ($dataProvider as $index => $data) {
            echo '<div class="product">';
            echo '<a href="' . Yii::app()->createUrl('articles/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '"><img width="200px" src="' . $data->avata . '" /></a>';
            echo '<div><a href="' . Yii::app()->createUrl('articles/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '">' . $data->title . '</a></div>';
            echo '<div style=" clear: both;"></div>';
            echo '</div>';
            echo '<div style="height: 10px;"></div>';
        }
        ?>
    </div>
</div>