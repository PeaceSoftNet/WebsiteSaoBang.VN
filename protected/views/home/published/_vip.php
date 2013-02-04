<li>
    <h3 class="title-Br-NewsRv">
        <a class="fl" target="_black" href="<?php echo Yii::app()->createUrl('home/TopicDetail', array('id' => $data->id, 'name' => ExtensionClass::utf8_to_ascii($data->title))); ?>"><?php echo $data->title; ?></a>
    </h3>
    <p class="Br-NewsRv-cont" rel="false" >
        <span class="green-clr">• Đăng vip từ: <?php echo $data->createDate; ?></span>&nbsp;
        <span class="green-clr"> đến: <?php echo date('d-m-Y h:i:s', $data->timeValue); ?></span>
    <div style="color: red; font-style: italic;">Tìm kiếm đối tác qua email <img src="http://data.saobang.vn/new.gif"> &nbsp;-&nbsp;là chức năng cho phép người dùng tìm kiếm khách đối tác và gửi email sản phẩm đăng VIP trên saobang.vn tới các khách hàng này. Click vào <a class="detail-NewsRv" href="<?php echo Yii::app()->createUrl('email/autofind', array('tpid' => $data->id)); ?>" ><i class="gr-icon-expand"></i> <span>Tìm kiếm đối tác qua email</span></a> để trải nghiệm tính năng này</div>
</p>
<div class="Navi-Br-NewsRv clearfix">
    <div class="fl">            
        <a class="detail-NewsRv" href="<?php echo Yii::app()->createUrl('email/autofind', array('tpid' => $data->id)); ?>" ><i class="gr-icon-expand"></i> <span>Tìm kiếm đối tác qua email</span></a>
        <?php if (Yii::app()->user->id) { ?><a class="detail-NewsRv" href="<?php echo Yii::app()->createUrl('post/otherRun', array('tid' => $data->id)) ?>" ><i class="gr-icon-expand"></i> <span>Tự động đăng tin trên site khác</span></a><?php } ?>
    </div>
</div>
</li>