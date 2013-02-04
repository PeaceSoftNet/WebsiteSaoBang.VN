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
$this->pageTitle = 'Hỏi mua thành công';
?>
<div id="wrapper">
    <div class="main clearfix">
        <div class="clearfix">
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>" >Hỏi mua</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view'); ?>" class="active">Đăng hỏi mua</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <div class="clear"></div>
        <div class="grid_12">
            <div class="title-page">
                <h1>Đăng hỏi mua thành công</h1>
            </div>
            <div class="sm-forminfo clearfix">
                <div style="height: 350px; font-size: 13px;">
                    <p>
                        Bạn vừa đăng hỏi mua thành công tại Saobang.vn
                    </p>
                    <div style="margin-left: 5px">
                        <p>
                            Để kích hoạt nội dung tin đăng, bạn vui lòng kiểm tra lại nội dung email tại <strong><i><?php echo $model->email; ?></i></strong> và click vào đường link kích hoạt hoặc nhắn tin theo cú pháp sau để kích hoạt:
                        <p><strong style="color: green;">SB KH <?php echo $model->id; ?></strong> gửi tới 8008 (phí 500đ/sms).</p>
                        Bạn có tìm hiểu thêm về quy trình và chính sách đăng tin hỏi mua tại Saobang.vn <a href="javascript:void(0);">tại đây</a>.
                        </p>
                        <p style="margin: 20px;">
                            <a href="<?php echo Yii::app()->createUrl('ask/view', array('type' => '1', 'name' => 'can-mua')); ?>"><button style="padding: 5px 15px;" value="Quay lại trang hỏi mua">Quay lại trang hỏi mua</button></a>
                            <a style="margin-left: 50px;" href="<?php echo Yii::app()->createUrl('ad/index') ?>">Quay lại trang chủ saobang.vn</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>