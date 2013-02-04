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
$this->pageTitle = 'Đăng ký tài khoản mới | Saobang.vn ';
Yii::app()->clientScript->registerMetaTag('Trang đăng ký thành viên Saobang.vn.', 'description');

if ($msg) {
    $this->pageTitle = $msg;
    echo '<div class="error" style="display: block; height: 250px; width: 100%;"><br />';
    echo $msg;
    echo '</div>';
} else {
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'registerForm',
        'enableAjaxValidation' => false,
            ));
    ?>
<div id="wrapper" style="background: #fff;">
        <div class="main clearfix">
            <div class="block clearfix">
                <div class="lgbl-left">
                    <h2>Đăng ký tài khoản mới</h2>

                    <?php if (Yii::app()->user->hasFlash('register')) { ?>
                        <div id="top-message"><?php echo Yii::app()->user->getFlash('register'); ?></div>            
                    <?php } ?>

                    <div class="formlg">
                        <div class="title"><code style="color: red;" title="Bắt buộc">*</code> Địa chỉ Email : </div>
                        <?php echo $form->textField($model, 'email', array('class' => 'inp-formlg', 'tabindex' => 1)); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                    <div class="formlg">
                        <div class="title">
                            <code style="color: red;" title="Bắt buộc">*</code>  Mật khẩu : 
                        </div>
                        <?php echo $form->passwordField($model, 'password', array('onclick' => 'this.value = ""', 'class' => 'inp-formlg', 'tabindex' => 2)); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                    <div class="formlg">
                        <div class="title">
                            <code style="color: red;" title="Bắt buộc">*</code> Nhập lại mật khẩu : 
                        </div>
                        <?php echo $form->passwordField($model, 'password2', array('onclick' => 'this.value = ""', 'class' => 'inp-formlg', 'tabindex' => 3)); ?>
                        <?php echo $form->error($model, 'password2'); ?>
                    </div>
                </div>
                <div class="lgbl-right">
                    <h2>Hoặc sử dụng tài khoản:</h2>
            <!--        <p>
                        <a class="lg-partners" href="?openSite=chodientu.vn">
                            <span class="left"><i class="icon-CDT"></i></span>
                            <span class="right">ChợĐiệnTử</span>
                        </a>
                    </p>-->
                    <p>
                        <a class="lg-partners" href="?openSite=facebook" tabindex="4">
                            <span class="left"><i class="icon-facebook"></i></span>
                            <span class="right">Facebook</span>
                        </a>
                    </p>
                    <p>
                        <a class="lg-partners" href="?openSite=google" tabindex="5">
                            <span class="left"><i class="icon-google"></i></span>
                            <span class="right">Google</span>
                        </a>
                    </p>
                    <p>
                        <a class="lg-partners" href="?openSite=yahoo" tabindex="6">
                            <span class="left"><i class="icon-yahoo"></i></span>
                            <span class="right">Yahoo!</span>
                        </a>
                    </p>
                </div>
                <div class="clear"></div>
                <div class="bt-regisbox">
                    <h2>Thỏa ước thành viên</h2>
                    <div class="rules " style="overflow: auto">
                        <h4>Điều 1: Thông tin tài khoản</h4>
                        <p>
                            Khách hàng giao dịch trên Saobang.vn nên đăng ký tài khoản và khai báo trung thực thông tin cá nhân đăng ký giao dịch với trung tâm.
                            Khi kích hoạt tài khoản trên sàn rao vặt này là bạn chấp nhận tuân thủ theo mọi quy định của Saobang.vn.
                            Mọi khách hàng phải khai báo thông tin đầy đủ, chính xác theo form đăng ký của Saobang.vn
                        </p>
                        <h4>Điều 2: Quyền và nghĩa vụ thành viên</h4>
                        <p>
                            Khách hàng có quyền đăng tin rao vặt trên Saobang.vn 
                            Khách hàng có quyền xếp loại tin bài trên Saobang.vn
                            Khách hàng chịu trách nhiệm các thông tin, sản phẩm đã đăng tải trên Saobang.vn theo như quy chế đăng tin.
                        </p>
                        <h4>Điều 3: Cấm giao dịch</h4>
                        <p>
                            Không tuân theo các quy định của sàn rao vặt saobang.vn
                            Rao bán những vật dụng, hàng hóa mà Pháp luật Việt Nam ngăn cấm.
                            Có hành vi lừa đảo, gian lận trong giao dịch.
                            Có hành vi nói xấu, bội nhọ các thành viên trong cộng đồng giao dịch.
                            Nghiêm cấm các bài viết liên quan đến chính trị, tôn giáo vi phạm đến pháp luật và thuần phong mỹ tục của Việt Nam.
                            Sử dụng email của người khác trong giao dịch.
                            Gây ách tắc, chống phá hệ thống giao dịch của trung tâm.
                        </p>
                        <h4>Điều 4: Quản lý tài khoản và mật khẩu</h4>
                        <p>
                            Thành viên sau khi đăng ký phải có trách nhiệm tự quản lý tên tài khoản và mật khẩu. 
                            Thành viên phải có nghĩa vụ thay đổi mật khẩu định kỳ, công ty chúng tôi không chịu trách nhiệm về những tổn hại phát sinh nếu thành viên mất mật khẩu do không thay đổi. 
                            Thành viên phải có trách nhiệm tự bảo quản về tài khoản và mật khẩu của mình, nếu thành viên không quản lý tốt để người thứ ba lấy được thông tin, chúng tôi không chịu trách nhiệm về bất ký những tổn thất phát sinh do việc để mất thông tin trên gây ra. 
                            Thành viên không được cho người khác mượn sử dụng, bán, chuyển nhượng lại tài khoản và mật khẩu. 
                            Nếu trong một thời gian nhất định chúng tôi thấy rằng tài khoản và mật khẩu của thành viên không được sử dụng, chúng tôi có thể tạm ngưng việc sử dụng tài khoản đó. Trong trường hợp khẩn cấp, chúng tôi có thể xóa tài khoản và mật khẩu của thành viên mà không cần được thành viên chấp thuận. Và chúng tôi cũng không chịu trách nhiệm về sự tổn hại phát sinh từ việc thành viên không quản lý được tài khoản của mình.

                        </p>
                        <h4>Điều 5: Thông báo</h4>
                        <p>
                            Chúng tôi sẽ gửi các bản tin thông báo vào địa chỉ email do thành viên đăng ký trong trường hợp cần thiết. Trong trường hợp khẩn cấp chúng tôi sẽ thông báo bằng các phương tiện khác.
                        </p>
                        <h4>Điều 6: Sử dụng dịch vụ</h4>
                        <p>
                            Các thành viên phải tuân thủ các quy định chung, và các hướng dẫn, quy định của từng dịch vụ riêng.
                            Trong trường hợp chúng tôi tiến hành bảo trì, nâng cấp hệ thống để nâng cấp dịch vụ, tiến hành bảo mật thông tin, hệ thống bị quá tải, và những trường hợp khác mang tính khách quan gây ảnh hưởng đến hệ thống, chúng tôi có thể dừng một phần, hoặc toàn bộ dịch vụ, và sẽ không chịu trách nhiệm về tổn thất phát sinh do việc dừng cung cấp với lý do trên gây ra.
                        </p>
                        <h4>Điều 7: Các trường hợp công bố thông tin tài khoản.</h4>
                        <p>
                            Chúng tôi có thể công bố thông tin về tài khoản khi chúng tôi tin chắc rằng, việc công
                            bố thông tin đó là thực sự cần thiết để:
                            Bảo vệ quyền lợi, tài sản hoặc sự an toàn cho Saobang.vn, những người của chúng tôi hoặc những người khác, để điều tra hoặc ngăn ngừa các hành động phạm pháp, hoặc vi phạm các điều khoản yêu cầu khi đăng ký tài khoản của saobang.vn
                            Theo yêu cầu của pháp luật, phải cung cấp thông tin cho các cơ quan chức năng.
                        </p>
                        <h4>Điều 8 : Giải quyết tranh chấp, luật áp dụng</h4>
                        <p>
                            Trong quá trình sử dụng nếu xảy ra tranh chấp giữa người sử dụng và công ty chúng tôi, hai bên sẽ tiến hành đàm phán hòa giải với tinh thần hữu nghị. Trong trường hợp không giải quyết được bằng hòa giải sẽ đưa ra toà án kinh tế Hà Nội giải quyết.
                        </p>
                    </div>
                    <p>
                        <input type="checkbox" value="1" name="UserModel[remember_me]" id="rulesOkie">
                        <label for="rulesOkie"><code style="color: red;" title="Bắt buộc">*</code> Tôi đã đọc và hoàn toàn đồng ý với các Điều khoản và Quy định của SaoBăng.vn </label>
                        <?php echo $form->error($model, 'remember_me'); ?>
                    </p>
                    <div class="lgbtn">
                        <a href="javascript:void(0);" onclick="submitRegister();" class="btn-skblue" tabindex="7"><span>Đăng ký</span></a>
                    </div>
                    <!--  <div class="lgbtn">
                            <input type="submit" name="Register" id="submit-contact" class="btn-skblue" value="Đăng ký" />
                        </div>-->
                </div>
            </div>     
        </div></div>
    <?php
    $this->endWidget();
}
?>
<script type="text/javascript">
    $('body').addClass('login-page');
    function submitRegister(){
        $('#registerForm').submit();
    }
</script>