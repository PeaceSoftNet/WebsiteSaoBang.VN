<?php

/**
 * 
 * @author            Linhnt
 * @package         System SaoBang.vn
 * @version         1.0
 * @since         
 * @copyright         PeaceSoft (c) 2012
 *
 */
 $data = $this->_rawTopicDetailData;
// var_Dump($data); die;
 $idTopic = $data['data']['id'];
 $titleTopic = $data['data']['title'];
 $contentTopic = $data['data']['description'];
 $imageTopic = $data['content']['image'];
 $priceTopic = $data['data']['price'];
 $emailTopic = $data['data']['email'];
 $timeTopic = $data['data']['createDate'];
?>
        <div class="detailPrd">    
            <h1 class="dtprd-name">
                <?php echo $titleTopic; 
                      if ($priceTopic)
                      echo ' - <span>' . GlobalComponents::numberFomat($priceTopic) . ' VNĐ</span>';?>
            </h1>
            <div class="postinfo-prd">
                <i class="dticon-clock"></i>&nbsp;Đăng lúc: <?php echo date('H:i:s', strtotime($timeTopic)); ?>, ngày <?php echo date('d/m/Y', strtotime($timeTopic)); ?>&nbsp;&nbsp;<i class="dticon-mail"></i>&nbsp;<?php echo $emailTopic ;?>
            </div>
            <div class="boxDetail">
                <p>
                    <?php echo $contentTopic ?>
               </p>
            </div>
        </div>
        
        <div class="boxModule">
            <div class="title-folder">Tin tương tự</div>
            <ul class="list-Browse-NewsRv">
                <li>
                    <h3 class="title-Br-NewsRv">
                        <a href="">2009 HONDA CIVIC LX-S SEDAN còn mới 90% / mới chỉ đi được 2000 km / Tiết kiệm xăng tối đa</a>
                        <span class="Br-price">250.320.000 VNĐ</span>
                    </h3>
                    <div class="bl-image fl">
                        <a href=""><img src="images/img60.jpg"></a>
                    </div>
                    <p class="Br-NewsRv-cont">Learn about this 2009 honda civic hybrid for sale in bloomington, ca below. view all available... this 2009 honda civic hybrid for sale in bloomington, ca, learning more about the vehicle, or takin.. super fast, super star.. <span class="green-clr">• 1 tiếng trước tại rongbay.com</span></p>
                    <div class="Navi-Br-NewsRv">
                        <a href="" class="detail-NewsRv"><i class="gr-icon-collapse"></i> <span>Đóng lại</span></a>
                        &nbsp;&nbsp;•&nbsp;&nbsp;
                        <i class="gr-icon-phone"></i> 0983 300 684
                        &nbsp;&nbsp;•&nbsp;&nbsp;
                        <i class="gr-icon-location"></i> Hà Nội
                    </div>
                    <div class="boxDetail">
                        <p>Và cuối cùng là những thứ text kinh dị do user nhập vào:<br>
                        <font style="font-weight: bold; color: #333; font-size: 18px;">Honda Ôtô Mỹ Đình là đại lý ủy quyền của Honda Việt Nam. Chúng tôi chuyên phân phối  các dòng xe</font> <font style="font-weight: bold; color: #ff0000; font-size: 13px;">Honda Civic , Honda CR-V và Honda Accord 3.5 L V6 , Accord 2.4 L nhập khẩu Thái Lan.</font></p>
                        
                        <p align="center">
                        <font style=" color: #00a651; font-size: 18px;">Khách hàng mua xe nhận ngay khuyến mại</font> <font style=" color: #ff0000; font-size: 18px; text-decoration: underline; ">Bất Ngờ &amp; Cao Nhất</font><br>
                        <font style=" color: #ff0000; font-size: 18px; ">CAM KẾT GIÁ RẺ NHẤT TOÀN QUỐC</font><br>
                        <font style=" color: #00a651; font-size: 18px;">Để biết thêm chi tiết xin Quý khách liên hệ:</font><br>
                        <font style=" color: #00a651; font-size: 18px;">Quang Vĩnh - Phòng KD Honda Mỹ Đình:</font> <font style=" color: #ff0000; font-size: 18px; ">0946.633.363</font>
                        </p>
                        <p align="center" class="bl-image"><a href=""><img src="images/img-detail.jpg"></a></p>
                        <p style=" font-size: 13px; color:#ff0000;">Honda Civic 1.8MT ( Số sàn)</p>
                        <p style=" font-size: 13px; color:#ff0000;">Honda Civic 1.8AT ( Số tự động)</p>
                        <p style=" font-size: 13px; color:#ff0000;">Honda Civic 2.0 I-Vtec ( Số tự động)</p>
                        <p style=" font-size: 13px; color:#ff0000;">Honda CR-V 2.4L I-Vtec ( Số tự động)</p>
                        <p style=" font-size: 13px; color:#ff0000;">Honda Accord 2.4L Xe nhập khẩu.</p>
                        <p style=" font-size: 13px; color:#ff0000;">Honda Accord 3.5L V6 Xe nhập khẩu</p>
                    </div>
                </li>
                <li>
                    <h3 class="title-Br-NewsRv">
                        <a href="">2009 HONDA CIVIC LX-S SEDAN còn mới 90% / mới chỉ đi được 2000 km / Tiết kiệm xăng tối đa</a>
                        <span class="Br-price">250.320.000 VNĐ</span>
                    </h3>
                    <p class="Br-NewsRv-cont">Learn about this 2009 honda civic hybrid for sale in bloomington, ca below. view all available... this 2009 honda civic hybrid for sale in bloomington, ca, learning more about the vehicle, or takin.. super fast, super star.. <span class="green-clr">• 1 tiếng trước tại rongbay.com</span></p>
                    <div class="Navi-Br-NewsRv">
                        <a href="" class="detail-NewsRv"><i class="gr-icon-expand"></i> <span>Chi tiết</span></a>
                        &nbsp;&nbsp;•&nbsp;&nbsp;
                        <i class="gr-icon-phone"></i> 0983 300 684
                        &nbsp;&nbsp;•&nbsp;&nbsp;
                        <i class="gr-icon-location"></i> Hà Nội
                    </div>
                </li>
                <li>
                    <h3 class="title-Br-NewsRv">
                        <a href="">2009 HONDA CIVIC LX-S SEDAN còn mới 90% / mới chỉ đi được 2000 km / Tiết kiệm xăng tối đa</a>
                        <span class="Br-price">250.320.000 VNĐ</span>
                    </h3>
                    <p class="Br-NewsRv-cont">Learn about this 2009 honda civic hybrid for sale in bloomington, ca below. view all available... this 2009 honda civic hybrid for sale in bloomington, ca, learning more about the vehicle, or takin.. super fast, super star.. <span class="green-clr">• 1 tiếng trước tại rongbay.com</span></p>
                    <div class="Navi-Br-NewsRv">
                        <a href="" class="detail-NewsRv"><i class="gr-icon-expand"></i> <span>Chi tiết</span></a>
                        &nbsp;&nbsp;•&nbsp;&nbsp;
                        <i class="gr-icon-phone"></i> 0983 300 684
                        &nbsp;&nbsp;•&nbsp;&nbsp;
                        <i class="gr-icon-location"></i> Hà Nội
                    </div>
                </li>
            </ul>
        </div>