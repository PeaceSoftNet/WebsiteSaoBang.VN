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
$this->pageTitle = 'Đăng tin rao vặt - Bước 3: Chia sẻ';
$topicId = $topicModel->id;
$categoryId = $topicModel->categoryId;
$categoryModel = AdExtension::getCategoryById($categoryId);
$categoryLink = Yii::app()->createUrl('ad/category', array('categoryId' => $categoryId, 'title' => ExtensionClass::utf8_to_ascii($categoryModel->name)));
$topicDetailLink = Yii::app()->createUrl('ad/detail', array('categoryName' => ExtensionClass::utf8_to_ascii($categoryModel->name), 'id' => $topicId, 'title' => ExtensionClass::utf8_to_ascii($topicModel->title)));
?>
<div id="wrapper" style="background: #fff;">
    <div class="main clearfix">
        <div class="grid_12">  

            <div class="title-page">
                <h1 class="fl">Đăng rao vặt bước 3: Chia sẻ tin rao vặt của bạn</h1>
                <span class="cl99 fr">Bước <b>3</b>/3</span>
            </div>
            <p style="color: blue; text-align: center;">Like và comment facebook để chia sẻ thông tin với thành viên của Saobang.vn khác</p>
            <div class="box-shareface">
                <div>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=290595207712125";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-comments" data-href="http://saobang.vn<?php echo $topicDetailLink; ?>" data-width="550" data-num-posts="2"></div>
                </div>
            </div>
            <div class="box-likeus">
                <div>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=290595207712125";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                </div>
                <div class="fb-like" data-href="http://facebook.com/saobang.vn" data-send="true" data-width="350" data-show-faces="true"></div>

            </div>
        </div>

        <div class="grid_12">   

            <div class="box-smsVip clearfix">
                <span class="iconVip">&nbsp;</span>
                <span class="fl">Soạn tin  <b class="clRed">SB  VIP  <?php $topicModel->code; ?></b>  gửi  <span class="clRed">8708</span>  để đăng tin VIP và sử dụng các dịch vụ rao vặt VIP 
                    <a target="_black" href="http://saobang.vn/huong-dan/huong-dan-mua-tin-vip.html">chính sách tin VIP</a> </span>
            </div>
            <br />
            <br />
            <div class="notice-suc">
                <p class="title"><img src="<?php echo SERVER_DATA; ?>/template/icon/icon-succes.png" alt="Bạn đã đăng tin thành công"/> Bạn đã đăng tin thành công</p>
                <ul>
                    <li><a href="#">Xem chính sách người dùng VIP</a></li>
                    <li><a href="<?php echo $topicDetailLink; ?>" title="<?php echo $topicModel->title; ?>">Xem lại tin bạn vừa đăng</a></li>
                    <li><a href="<?php echo $categoryLink; ?>">Quay lại danh mục:  <strong><?php echo $categoryModel->name; ?></strong></a></li>

                </ul>
            </div>


        </div>
    </div>
</div>