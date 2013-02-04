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
        <h4>Hướng dẫn</h4>
        <?php $this->widget('zii.widgets.CMenu', GlobalComponents::contentHelpMenu()); ?>
    </div>
</div>
<div class="grid_9">
    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li><a class="active" href="<?php echo Yii::app()->createUrl('home/help', array('contentCode' => $contentCode)); ?>">Hướng dẫn</a></li>
        </ul>
    </div>
    <div class="br-noticebox">

        <?php
        if ($contentCode == 'huong-dan-dang-ky-dang-nhap') {
            $this->pageTitle = 'Hướng dẫn đăng ký & đăng nhập | Saobang.vn ';
            Yii::app()->clientScript->registerMetaTag('Bạn có thể đăng tin trên Saobang.vn mà không cần đăng nhập. Tuy nhiên, chúng tôi khuyến cáo các bạn hãy đăng ký và đăng nhập tài khoản để sử dụng nhiều tính năng hơn như: sửa đổi, xóa, làm mới, (đưa tin lên đầu)  tin đăng, đăng tin Vip…', 'description');
            ?>
            <div class="ntc-title clearfix">
                <h4>Hướng dẫn đăng ký & đăng nhập</h4>
            </div>
            <div class="html-content">            
                <p>
                    Bạn có thể đăng tin trên Saobang.vn mà không cần đăng nhập. Tuy  nhiên, chúng tôi khuyến cáo các bạn hãy đăng ký và đăng nhập tài khoản để sử dụng  nhiều tính năng hơn như: sửa đổi, xóa, làm mới, (đưa tin lên đầu)  tin đăng, đăng tin Vip…
                </p>
                <strong>I. Đăng ký</strong><br />
                <p>
                    <b><i>Bước 1: Lựa chọn Đăng ký</i></b>
                    <br />
                    Đầu tiên click vào <a href="<?php echo Yii::app()->createUrl('user/register') ?>">Đăng ký</a> tại  góc phải trang.</p>
                <p align="center"><img src="/data/help/bigin1.png" alt="Hướng dẫn đăng ký" height="90" /></p>
                <br />
                Website sẽ đưa bạn tới trang đăng ký của Saobang.vn, tại đây bạn có thể  nhập thông tin đăng ký tài khoản của mình<br />
                <b><i>Bước 2:Nhập thông tin</b></i>
                <p>
                    Bạn có thể chọn đăng ký thành viên bằng cách sử dụng các tài khoản google, yahoo,  facebook hoặc nhập tài khoản email khác.
                </p>

                <em><span style="text-decoration:underline">Cách 1</span>: </em><em>Sử dụng tài khoản google, yahoo, </em><em>F</em><em>acebook</em><br />
                Bạn có thể đăng ký tài khoản bằng  cách click vào các nút bên trái để lựa chọn tài khoản. <br />
                <p align="center"><img width="244" height="266" src="/data/help/bigin2.png" alt="Hướng dẫn đăng ký" /></p> <br />
                Ở đây tôi lựa chọn tài khoản google, sau đó bạn điền mật khẩu truy nhập  của bạn để có thể đăng nhập:<br />
                <p align="center"><img src="/data/help/bigin3.png" alt="Hướng dẫn đăng ký" height="320" /></p> <br />
                </p>
                <em><span style="text-decoration:underline">Cách 2</span>: Đăng ký tài khoản mới</em>
                <ul class="ml30">
                    <li>Nhập thông tin cá nhân cần thiết.</li>
                    <li>Lưu ý địa chỉ email phải chính xác.</li>
                </ul>
                <p>Nếu hòm thư là yahoo thì cần lưu ý chính  xác đuôi của hòm thư là <a href="mailto:xxxx@yahoo.com">xxxx@yahoo.com</a> hay <a href="mailto:xxxx@yahoo.com.vn">xxxx@yahoo.com.vn</a> <br />
                <p align="center"><img src="/data/help/bigin4.png" alt="Hướng dẫn đăng ký" height="554" border="0" /></p> <br />
                <strong>Bước 3:</strong> Hoàn tất đang ký</p>
                <ul class="ml30">
                    <li>Sau khi hoàn tất đăng ký bạn hãy kiểm hòm thư để nhận email kích hoạt.</li>
                </ul>
                <p><strong>II. Đăng nhập</strong><br />
                    Khi đăng nhập trên Saobang.vn bạn có thể <a target="_black" href="<?php echo Yii::app()->createUrl('user/login'); ?>">đăng nhập</a> qua tài khoản đã đăng  ký tại Saobang.vn hoặc có thể đăng nhập thông qua các tài khoản của bạn tại  Facebook, Google, Yahoo.<br /></p>
                <p align="center"><img src="/data/help/bigin5.png" alt="Hướng dẫn đăng nhập" height="313" border="0" /></p>
                <p>&nbsp;</p>
            </div>
            <?php
        } else if ($contentCode == 'dang-tin-rao-vat') {
            $this->pageTitle = 'Đăng tin rao vặt | Saobang.vn ';
            Yii::app()->clientScript->registerMetaTag('Để đăng tin mới bạn chọn nút Đăng tin rao vặt, Nhập tiêu đề ( có sử dụng dấu Tiếng Việt), Nhập địa chỉ email (bắt buộc), và số điện thoại', 'description');
            ?>
            <div class="ntc-title clearfix">
                <h4>Đăng tin rao vặt</h4>
            </div>
            <div class="html-content">            
                <p>
                    Để đăng tin mới bạn chọn nút Đăng tin rao vặt:
                </p>
                <p>
                    <i>(Nếu bạn đã đang nhập thì email tự động cập cập, nếu bạn chưa thì khi đang tin bắt buộc bạn phải nhập email để chúng tôi có thể gửi password về cho bạn)</i>
                </p>

                <ul class="ml30">
                    <li>Nhập tiêu đề ( có sử dụng dấu Tiếng Việt)</li>
                    <li>Nhập địa chỉ email (bắt buộc), và số điện thoại</li>
                    <li>Nhập nội dung (mô  tả chi tiết cho sản phẩm)</li>
                    <li>Up ảnh: up load ảnh từ máy tính của bạn.( lưu ý về dung lượng và kích thước ảnh, số lượng ảnh đăng tối đa là 10 ảnh).
                        <ul class="ml30">
                            <li>Nhập đầy đủ Tên, Giá, Mô tả sản phẩm cho từng ảnh</li>
                            <li>Chèn ảnh: dùng để chèn ảnh và thông tin ảnh vào nội dung
                                <p style="text-align: center; width: 690px; overflow: hidden;"><br />
                                    <img src="/data/help/topic1.png" />
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li>Lựa chọn danh mục cha và danh mục con để đăng tin rao vặt cho phù hợp
                        <p style="text-align: center; width: 690px; overflow: hidden;"><br />
                            <img src="/data/help/topic2.png" />
                        </p>
                    </li>
                    <li>Chọn nhu cầu  và các thuộc tính phù hợp với sản phẩm, dich vụ đăng tin
                        <p style="text-align: center; width: 690px; overflow: hidden;"><br />
                            <img src="/data/help/topic3.png" />
                        </p>
                    </li>
                    <li>Chọn nơi giao bán sản phẩm</li>
                    <li>Sau khi đã hoàn tất thông tin đăng và xác nhận tin bán chon Đăng tin rao vặt để hoàn tất tin bán.</li>
                </ul>

            </div>
            <?php
        } elseif ($contentCode == 'quan-ly-tin-rao-vat') {
            $this->pageTitle = 'Quản lý tin rao vặt | Saobang.vn ';
            Yii::app()->clientScript->registerMetaTag('Để đảm bảo an toàn và tránh những rủi ro mất tài khoản, bạn có thể thường đổi lại mật khẩu đăng nhập tài khoản của mình bằng cách', 'description');
            ?>
            <div class="ntc-title clearfix">
                <h4>Quản lý tin rao vặt</h4>
            </div>
            <div class="html-content">            
                <p>
                    Để đảm bảo an toàn và tránh những rủi ro mất tài khoản, bạn có thể thường đổi lại mật khẩu đăng nhập tài khoản của mình bằng cách:
                </p>
                <p>
                    Trên trang chủ Saobang.vn bạn chọn <i><b>Tin đã đăng</b></i> để có thể thực hiện toàn bộ các thao tác quản trị:
                <p style="text-align: center; width: 690px; overflow: hidden;"><br />
                    <img src="/data/help/manager0.png" />
                </p>
                </p>
                <ul class="ml30">
                    <li>Thông tin cá nhân</li>
                    <li>Nhập đầy đủ các thông tin tài khoản
                        <ul class="ml30">
                            <li>Thêm thông tin liên hệ: số điện thoại, địa chỉ</li>
                            <li>Thêm thông tin giới thiệu về bạn.</li>
                        </ul>
                        <p style="text-align: center; width: 690px; overflow: hidden;"><br />
                            <img src="/data/help/manager1.png" />
                        </p>
                    </li>
                    <li>Đổi mật khẩu
                        <p style="text-align: center; width: 690px; overflow: hidden;"><br />
                            <img src="/data/help/manager2.png" />
                        </p>
                    </li>
                </ul>
                <p>Để đảm bảo an toàn và tránh những rủi ro mất tài khoản, bạn có thể  thường đổi lại mật khẩu đăng nhập tài khoản của mình bằng cách:</p>
                <ul class="ml30">
                    <li>Đăng ký nhận email</li>
                </ul>
                <p>
                    Để nhận email thông báo về các chương trình đặc biêt của Saobang.vn bạn có thể đăng ký nhận email từ saobang.vn bằng cách cung cấp cho Saobang.vn địa chỉ email mà bạn muốn nhận tin:
                </p>
                <ul class="ml30">
                    <li>Quản lý tin rao vặt</li>
                    <li>Tin đã duyệt
                        <p>Phần này sẽ hiển thị các tin bạn gửi đã được chúng tôi kiểm duyệt.</p>
                    </li>
                    <li>Tin chờ duyệt
                        <p>Phần này sẽ hiển thị các tin bạn mới gửi, chưa được kiểm duyệt.</p>
                    </li>
                    <li>Tin đã xóa
                        <p>Phần này sẽ hiển thị các tin bạn đã gửi nhưng không hợp lệ.</p>
                    </li>
                </ul>
            </div>
            <?php
        } elseif ($contentCode == 'huong-dan-mua-tin-vip') {
            $this->pageTitle = 'Hướng dẫn mua tin VIP | Saobang.vn ';
            Yii::app()->clientScript->registerMetaTag('gửi 8708 để hiển thị tin VIP tại trang chủ và các trang chi tiết theo chuyên mục (Phí: 15.000đ/sms)', 'description');
            ?>
            <style type="text/css">
                .html-content p{padding: 3px 0px; }
            </style>
            <div class="ntc-title clearfix">
                <h4>QUYỀN LỢI - VÀ CÁCH ĐĂNG TIN VIP <img src="/data/new.gif" /></h4>
            </div>        
            <div class="html-content">
                <strong>Quyền lợi:</strong>

                <p>-          Tin VIP được xuất hiện thường xuyên tại box trang chủ trong vị trí nổi bật.</p>

                <p>-          Tin VIP được bôi viền màu vàng  và nổi bật trên mục đầu tiên trong các danh mục con.</p>

                <p>-          Tin VIP được ưu tiên xuất hiện khi người dùng tìm kiếm.</p>

                <p>-          Tin VIP được chạy chương trình đăng tin tự động trên hàng nghìn các website, diễn đàn rao vặt khác <em>(tính năng này đang được thử nghiệm và sẽ cập nhật trong thời gian sớm nhất)</em>.</p>

                <p>-          Tin VIP được ưu tiên trong các hoạt động truyền thông của Saobang.vn. Thông qua các hoạt động quảng cáo trực tuyến, email marketing, facebook, báo điện tử....</p>

                <strong>Cách đăng tin VIP</strong>

                <p>-          SOẠN  TIN  SMS <strong style="color: blue;">SB VIP XXX  gửi 8708</strong> trong đó XXX là mã số tin rao vặt.</p>

                <p><img src="/data/images/vip/image001.png"></p>

                <p>-          Có thể nhắn nhiều tin SMS để gia hạn thời gian sử dụng tin vip trong nhiều ngày.</p>

                <strong>Làm mới tin VIP</strong>

                <p>-          Khi hết thời gian đăng tin vip. Bạn có thể click <strong>UP-TIN</strong> để làm tiếp tục được được ưu tiên xuất hiện trong các trang danh mục sản phẩm</p>

                <strong>Vị trí hiển thị tin VIP</strong>
                <div style="margin: 15px 0px;">
                    <p><img width="700px" src="/data/images/vip/image003.png"></p>
                    <p style="text-align: center"><em>Tin VIP trên trang chủ</em></p>
                    <p><img width="700px" src="/data/images/vip/image005.png"></p>
                    <p style="text-align: center"><em>Tin VIP trên các trang danh mục</em></p>
                    <p><img width="700px" src="/data/images/vip/image007.png"></p>
                    <p style="text-align: center"><em>Tin VIP trên trang chi tiết</em></p>
                </div>
            </div>
        </div>  
        <?php
    }
    ?>

</div>
</div>