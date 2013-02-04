<?php
/**
 * 
 * @author  Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
$this->pageTitle = 'Quy chế thành viên | Saobang.vn ';
$description = 'Khi sử dụng Saobang.vn đồng nghĩa với việc bạn sẽ tuân thủ các quy chế & quy định của Saobang.vn';
Yii::app()->clientScript->registerMetaTag($description, 'description');
$currentUrl = Yii::app()->createUrl('home/regulation');
$breadcrumb = array(
    '0' => array(
        'url' => $currentUrl,
        'name' => 'Quy chế thành viên',
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
            <li><a class="active" href="<?php echo Yii::app()->createUrl('home/regulation'); ?>">Quy chế thành viên</a></li>
        </ul>
    </div>
    <div class="br-noticebox">
        <div class="ntc-title clearfix">
            <h4>Quy chế Saobang.vn</h4>
        </div>
        <div class="html-content">
            <p>Khi sử dụng Saobang.vn đồng nghĩa với việc bạn sẽ tuân thủ các quy chế &amp; quy định của Saobang.vn. Chúng tôi giữ quyền thay đổi thông tin của Quy chế này mà không cần phải thông báo trước.</p>
            <strong>I. Nguyên tắc chung </strong>
            <p>
            <ul class="ml30">
                <li>Saobang.vn được đăng ký và sở hữu bởi công ty Peacesoft, hoạt động theo các quy định của Pháp luật Việt Nam.</li>
                <li>Tổ chức &amp; Cá nhân tham  sử dụng Saobang.vn trên tinh thần tự nguyện, tôn trọng quyền và lợi ích hợp pháp của các thành viên khác và tuân thủ các quy định pháp luật của Việt Nam. <strong> </strong></li>
                <li>Thông tin, hàng hóa, sản phẩm và dịch vụ đăng tải trên Saobang.vn phải đáp ứng đầy đủ các quy định của pháp luật có liên quan, không thuộc các trường hợp cấm kinh doanh, cấm quảng cáo theo quy định của pháp luật.<strong></strong></li>
                <li>Hoạt động mua bán hàng hóa qua Saobang.vn phải được thực hiện công khai, minh bạch, đảm bảo quyền lợi của người tiêu dùng.<strong> </strong></li>
            </ul>
            </p>
            <strong>II. Kiểm duyệt thông tin </strong>
            <p>
            <ul class="ml30">
                <li>Người đăng tin: Khi đăng ký tham gia Saobang.vn, thành viên phải cung cấp đầy đủ các thông tin liên quan và phải hoàn toàn chịu trách nhiệm đối với các thông tin này.</li>
                <li> Các nội dung thông tin trên Saobang.vn được lấy tự động từ các website liên kết, vì vậy Saobang.vn không chịu trách nhiệm về các nội dung thông tin được đăng tải. Khi kiểm duyệt và phát hiện thông tin vi phạm các quy định của Saobang.vn, hệ thống được quyền xóa hoặc cung cấp cho các cơ quan chức năng mà không cần phải thông báo trước cho người đăng. </li>
            </ul>
            </p>
            <strong>III. Bảo vệ quyền lợi của thành viên</strong>
            <p>
            <ul class="ml30">
                <li>Để bảo vệ quyền lợi cho các thành viên khi đăng tin tại SaoBang.vn, BQT Saobang.vn cung cấp cho các thành viên các thông tin và điều khoản sử dụng trước khi tham gia Saobang.vn.</li>
                <li>Thành viên tự đăng tin không mất phí, Saobang.vn thu phí dịch vụ Up tin, đăng tin Vip theo đúng quy định đăng tin.</li>
                <li>Thành viên đang bán phải chịu hoàn toàn trách nhiện về chất lượng hàng hóa, dịch vụ đăng tải trên Saobang.vn. Trong mọi trường hợp thành viên đăng tin phải có trách nhiệm giải quyết của thành viên mua liên quan đến chất lượng hàng hóa, dịch vụ cung cấp.</li>
                <li>Saobang.vn sẽ nỗ lực giải quyết hợp lý các khiếu nại của thành viên về việc truy cập hoặc sử dụng dịch vụ của Saobang.vn. </li>
                <li>Thông tin cá nhân của khách hàng trên Saobang.vn được cam kết bảo mật tuyệt đối theo chính sách bảo vệ thông tin cá nhân.Việc thu thập và sử dụng thông tin của mỗi khách hàng chỉ được thực hiện khi có sự đồng ý của khách hàng đó trừ những trường hợp pháp luật có quy định khác</li>
            </ul>
            </p>
            <strong>IV. Nghĩa vụ của thành viên</strong>
            <p>
            <ul class="ml30">
                <li>Thành viên sẽ tự chịu trách nhiệm về bảo mật và lưu giữ và mọi hoạt động sử dụng dịch vụ dưới tên đăng ký, mật khẩu và hộp thư điện tử của mình. Thành viên có trách nhiệm thông báo kịp thời cho Sàn về những hành vi sử dụng trái phép, lạm dụng, vi phạm bảo mật, lưu giữ tên đăng ký và mật khẩu của mình để hai bên cùng hợp tác xử lý.</li>
                <li>Thành viên cam kết những thông tin cung cấp cho Saobang.vn và những thông tin đang tải lên Saobang.vn là chính xác và hoàn chỉnh. </li>
                <li>Thành viên tự chịu trách nhiệm về nội dung, hình ảnh của thông tin Doanh nghiệp và các thông tin khác cũng như toàn bộ quá trình giao dịch với các đối tác của mình.</li>
                <li>Thành viên cam kết, đồng ý không sử dụng dịch vụ của Sàn rao vặt Saobang.vn vào những mục đích bất hợp pháp, không hợp lý, lừa đảo, đe doạ, thăm rò thông tin bất hợp pháp, phá hoại, tạo ra và phát tán virus gây hư hại tới hệ thống, cấu hình, truyền tải thông tin của SaoBang.vn. Trong trường hợp vi phạm thì thành viên phải chịu trách nhiệm về các hành vi của mình trước pháp luật.</li>
                <li>Thành viên không được hành động gây mất uy tín của Sàn rao vặt Saobang.vn dưới mọi hình thức như gây mất đoàn kết giữa các thành viên bằng cách sử dụng tên đăng ký thứ hai, thông qua một bên thứ ba hoặc tuyên truyền, phổ biến những thông tin không có lợi cho uy tín của Saobang.vn. </li>
            </ul>
            </p>
            <strong>V. Quyền và nghĩa vụ của SaoBang.vn</strong>
            <p>
            <ul class="ml30">
                <li>Trong trường hợp có cơ sở để chứng minh thành viên cung cấp thông tin cho Saobang.vn là không chính xác, sai lệch, không đầy đủ hoặc vi phạm pháp luật hay thuần phong mỹ tục Việt Nam thì có quyền từ chối, tạm ngừng hoặc chấm dứt quyền sử dụng dịch vụ của thành viên.</li>
                <li>Saobang.vn có thể chấm dứt ngay quyền sử dụng dịch vụ và quyền thành viên của thành viên nếu phát hiện thành viên đã phá sản, bị kết án hoặc đang trong thời gian thụ án, trong trường hợp thành viên tiếp tục hoạt động có thể gây cho Sàn trách nhiệm pháp lý, có những hoạt động lừa đảo, giả mạo, gây rối loạn thị trường, gây mất đoàn kết đối với các thanh viên hoặc hoạt động vi phạm pháp luật hiện hành của Việt Nam.</li>
                <li>Trong trường hợp chấm dứt quyền thành viên và quyền sử dụng dịch vụ thì tất cả các chứng nhận, các quyền của thành viên được cấp sẽ mặc nhiên hết giá trị và bị chấm dứt.</li>
                <li>Saobang.vn giữ quyền được thay đổi bảng, biểu giá dịch vụ và phương thức thanh toán trong thời gian cung cấp dịch vụ cho thành viên theo nhu cầu và điều kiện khả năng của SaoBang.vn.</li>
                <li>Saobang.vn sẽ tiến hành các hoạt động xúc tiến, quảng bá Sàn rao vặt Saobang.vn ra thị trường nước ngoài trong phạm vi và điều kiện cho phép, góp phần mở rộng, kết nối đáp ứng các nhu cầu tìm kiếm bạn hàng và phát triển thị trường nước ngoài của các thành viên tham gia. </li>
                <li>Sàn rao vặt Saobang.vn sẽ cố gắng đến mức cao nhất trong phạm vi và điều kiện có thể để duy trì hoạt động bình thường của website và khắc phục các sự cố như: sự cố kỹ thuật về máy móc, lỗi phần mềm, hệ thống đường truyền internet, nhân sự, các biến động xã hội, thiên tai, mất điện, các quyết định của cơ quan nhà nước hay một tổ chức liên quan thứ ba. Tuy nhiên nếu những sự cố trên xẩy ra nằm ngoài khả năng kiểm soát, là những trường hợp bất khả kháng mà gây thiệt hại cho thành viên thì Saobang.vn không phải chịu trách nhiệm liên đới.</li>
            </ul>
            </p>

            <strong>VI. Điều khoản áp dụng</strong>
            <p>
            <ul class="ml30">
                <li>Mọi tranh chấp phát sinh giữa Saobang.vn và thành viên sẽ được giải quyết trên cơ sở thương lượng. Trường hợp không đạt được thỏa thuận như mong muốn, một trong hai bên có quyền đưa vụ việc ra Tòa án nhân dân có thẩm quyền tại Hà Nội để giải quyết. </li>
                <li>Quy chế của Sàn rao vặt Saobang.vn chính thức có hiệu lực thi hành kể từ ngày ký quyết định ban hành kèm theo quy chế này. Sàn rao vặt Saobang.vn có quyền và có thể thay đổi quy chế này bằng cách thông báo lên Sàn cho các thành viên biết. Quy chế sửa đổi có hiệu lực kể từ ngày quyết định về việc sửa đổi quy chế có hiệu lực. Việc thành viên tiếp tục sử dụng dịch vụ sau khi quy chế sửa đổi được công bố và thực thi đồng nghĩa với việc họ đã chấp nhận quy chế sửa đổi này. </li>
            </ul> 
            </p>
        </div>
    </div>
</div>
