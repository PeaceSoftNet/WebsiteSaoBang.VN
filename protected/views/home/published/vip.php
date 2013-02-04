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

    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a  style="color: green;" href="<?php echo Yii::app()->createUrl('home/vip'); ?>" class="active">Tin VIP &nbsp;&nbsp;<img src="/data/icon-hot.gif"></a></li>
        </ul>
    </div>    

    <?php
    if ($dataProvider->totalItemCount) {

        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'published/_vip',
            'template' => "{items}",
            'emptyText' => '',
            'itemsTagName' => 'ul',
            'htmlOptions' => array(
                'class' => false,
            ),
            'viewData' => array(
            ),
            'itemsCssClass' => 'list-Browse-NewsRv',
                )
        );
        echo '<div class="pagination clearfix">';
        $this->widget('zii.widgets.CListViewSaoBang', array(
            'dataProvider' => $dataProvider,
            'itemView' => 'published/_vip',
            'template' => "{pager}",
            'pager' => array(
                'header' => false,
                'prevPageLabel' => '&laquo; Trước',
                'nextPageLabel' => 'Sau &raquo;',
            ),
            'pagerCssClass' => 'list-Browse-NewsRv',
                )
        );
        echo '</div>';
    } else {
        ?>
        <style type="text/css">
            .grid_9 ul{margin: 0px 10px;}
            .grid_9 li{padding: 5px 20px;}
        </style>
        <h4>1. Giới thiệu tin VIP</h4>
        <div>
            <p>Bạn cần đưa sản phẩm đến gần hơn với người dùng. Muốn tin đăng được nổi bật.</p>
            <p>Hãy sử dụng ngay tin VIP tại saobang.vn</p>
            <ul>
                <li>- Tin VIP được xuất hiện thường xuyên tại box trang chủ trong vị trí nổi bật.</li>
                <li>- Tin VIP được bôi viền màu vàng và nổi bật trên mục đầu tiên trong các danh mục con.</li>
                <li>- Tin VIP được ưu tiên xuất hiện khi người dùng tìm kiếm.</li>
                <li>- Tin VIP được  sử dụng chức năng tìm kiếm khách hàng qua email.</li>
                <li>- Tin VIP được đăng tin tự động trên hàng nghìn website, diễn đàn rao vặt khác (tính năng này đang được thử nghiệm và sẽ cập nhật trong thời gian sớm nhất).</li>
                <li>- Tin VIP được ưu tiên trong các hoạt động truyền thông của Saobang.vn. Thông qua các hoạt động quảng cáo trực tuyến, email marketing, facebook, báo điện tử....</li>
            </ul>
            <i><a style="color: blue; text-align: right; float: right;" target="_black" href="http://saobang.vn/thong-bao-ve-quyen-loi-cua-tin-rao-vat-vip-tren-saobangvn-tb3sb.html">Xem thêm thông báo</a></i>
            <div style="clear: both"></div>
        </div>
        <h4>Cách đăng tin VIP</h4>
        <p>- Soạn tin SMS <strong style="color: red;">SB VIP XXX</strong> gửi 8708 trong đó XXX là mã số tin rao vặt.</p>
        <p><img alt="" src="../data/images/vip/image001.png"></p>
        <div style="margin: 30px 0px; color: #333">
            <p>Mọi thắc mắc và cần hỗ trợ vui lòng liên hệ</p>
            <p>Bộ phận chăm sóc khách hàng saobang.vn</p>
            <p>Hotline: 0436 321 125 - 093 696 6263</p>
            <p>Email: <a href="mailto:info@saobang.vn">info@saobang.vn</a></p>
        </div>

        <?php
    }
    ?>    
</div>
<style type="text/css">
    .detail-NewsRv{padding: 0 5px;}
</style>