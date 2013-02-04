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
<style type="text/css">
    .input-keyword{border: 1px solid #ccc; padding: 3px 10px; width: 450px; height: 20px; background: #fcfcfc; float: left;}
    .input-submit{border: 1px solid #ccc; height: 28px; line-height: 28px; width: 120px; background: #c3c3c3; color: #FFF; font-weight: 700; cursor: pointer;}
    .input-submit:hover{color: #f3f3f3;}
</style>
<div class="grid_9">

    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li>Tìm kiếm đối tác</li>
        </ul>
    </div>    
    <strong>Bước 1</strong>. Tìm kiếm đối tác
    <div>
        <p style="margin: 10px;">
        <form method="POST" action="">            
            <input type="text" class="input-keyword" name="keyword" value="Nhập từ khóa tìm kiếm" id="keySearchCustomer">
            <input class="input-submit" type="submit" value="Tìm kiếm đối tác">
        </form>
        </p>
    </div>
    <div style="margin: 50px 10px;">
        <strong>Chú ý:</strong>
        <p>
        <p>- Tìm kiếm đối tác bằng cách nhập từ khóa tìm kiếm các đối tượng khách hàng của bạn. Ví dụ để tìm người đang cần mua điện thoại cũ bạn có thể nhập từ khóa: "cần mua điện thoại cũ".</p>
        <p>- Hệ thống sẽ tự động tìm kiếm email của những người đang có nhu cầu theo từ khóa bạn đã tìm kiếm.</p>
        <p>- Từ danh sách email trả về, chúng tôi tiếp tục hỗ trợ các bạn gửi email bài đăng của bạn tới các đối tượng khách hàng trên.</p>
        </p>
    </div>
</div>
<script type="text/javascript">
    $('#keySearchCustomer').click(function(){
        if(this.value=="Nhập từ khóa tìm kiếm") this.value='';
    });
</script>