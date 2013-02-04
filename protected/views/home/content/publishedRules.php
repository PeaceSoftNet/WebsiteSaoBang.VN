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
$this->pageTitle = 'Quy định đăng tin | Saobang.vn ';
$description = 'Mọi khách hàng đã đăng ký hay chưa đăng ký thành viên đều có thể đăng tin trên Saobang.vn ';
Yii::app()->clientScript->registerMetaTag($description, 'description');
$currentUrl = Yii::app()->createUrl('home/publishedRules');
$breadcrumb = array(
    '0' => array(
        'url' => $currentUrl,
        'name' => 'Quy định đăng tin',
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
            <li><a class="active" href="<?php echo Yii::app()->createUrl('home/publishedRules'); ?>">Quy định đăng tin</a></li>
        </ul>
    </div>

    <div class="br-noticebox">
        <div class="ntc-title clearfix">
            <h4>Quy định đăng tin tại Saobang.vn</h4>
        </div>
        <div class="html-content">            
            <p>   
                <strong>I. Điều kiện đăng tin </strong>
            <ul class="ml30">
                <li>Mọi khách  hàng đã đăng ký hay chưa đăng ký thành viên đều có thể đăng tin trên Saobang.vn </li>
                <li>Việc đăng tin  là hoàn toàn miễn phí. </li>
                <li>Khách hàng  khi đăng tin phải chịu trách nhiệm về nội dung và thông tin đăng rao của mình  trên Saobang.vn the đúng <strong>Quy chế</strong> của Saobang.vn </li>
                <li>Khách hàng  đăng tin rao phải đầy đủ&nbsp;<strong>Tên</strong>,&nbsp;<strong>Giá</strong>&nbsp;và&nbsp;<strong>Thông  tin mô tả</strong>&nbsp;cho từng sản phẩm, tin  đăng phải đúng chuyên mục.</li>
                <li>Bản quyền về  tin đăng thuộc chính khách hàng đăng tin, khách hàng đảm bảo tính trung thực,  chính xác của nội dung tin đăng.</li>
            </ul>
            </p>
            <p> 
                <strong>II. Đăng tin trực tiếp trên Saobang.vn</strong>
            <ul class="ml30">
                <li>Thành viên đăng ký trên Saobang.vn  không được phép sử dụng những nick giả dạng Ban quản trị,dễ gây hiểu nhầm, kích  động, sử dụng tên các chính trị gia như: saobang,  admin, moderator…  làm tên tài khoản của mình. Tất cả những thành viên cố tình đăng ký sẽ bị xóa. </li>
                <li>Tin đăng có thể bị kiểm duyệt trước và sau khi đăng.  </li>
            </ul>
            </p>
            <p><strong>III. Xử lý tin đăng vi phạm</strong><br /><br />
                Tin đăng sẽ bị xóa nếu vi phạm một hoặc nhiều các quy định sau:
            <ul class="ml30">
                <li>Tin làm phá  vỡ giao diện của Saobang.</li>
                <li>Ảnh không liên quan đến sản phẩm bán hoặc ảnh không hợp lệ, vi phạm đạo đức, thuần phong mỹ tục.</li>
                <li>Đăng các tin có nội dung phản động, khiêu dâm, vô văn hóa và vi phạm pháp luật Việt nam.</li>
                <li>Đăng tin quá nhiều, tin spam: tin có nội dung trùng hoặc gần giống nhau.</li>
                <li>Các tin không để sản phẩm cụ thể.</li>
                <li>Các tin đăng không phù hợp với chuyên mục trên Saobang.vn.</li>
            </ul>
            </p>
            <p><strong>IV. Xử lý thành viên vi phạm</strong><br /><br />
                Thành viên vi phạm các quy định sau sẽ bị xử lý bằng việc khóa tài khoản hoặc báo cáo cơ quan chức năng tùy theo mức độ nghiêm trọng và tính chất sự việc:
            <ul class="ml30">
                <li>Spam comment  quảng cáo, rao ké (sẽ khóa theo mức độ vi phạm).</li>
                <li>Nói tục, chửi  bậy không tuân theo quy định của ban quản trị Saobang.</li>
                <li>Cố tình tái  phạm lỗi trên Saobang.vn đã nhắc nhở (sẽ khóa theo mức độ vi phạm).</li>
            </ul>  
            </p> 
        </div>
    </div>
</div>