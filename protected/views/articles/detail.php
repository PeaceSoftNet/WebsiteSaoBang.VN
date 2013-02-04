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
header("refresh:59;url=");
?>
<script type="text/javascript">
    $(function () {
        $('#defaultCountdown').countdown({until: 59, format: 'S'});
    });
</script>

<style type="text/css">
    .nav{display: block; width: 1040px;}
    .nav h1{text-align: center; font-size: 18px;}
    .nav .form-left{width: 728px; float: left; padding: 10px; display: block; min-height: 500px; border: 1px solid #ccc;}
    .nav .form-right{width: 250px; float: left; display: block; margin-left: 10px; min-height: 500px; border: 1px solid #ccc;}
    .nav .form-right .product{width: 100%; border: 1px solid #ccc; }
    .nav .form-right .product img{float: left;}
    .nav .form-right h2{font-size: 15px; text-align: center;}
    .share{height: 40px; background: #ccc; width: 100%; padding: 5px; margin: 0px; border: 1px solid red; position: fixed; bottom: 0px; left: 0px;}
    .share input{padding: 2px; width: 600px; border: 1px solid blue;}
    .shareButtom{display: block; width: 80px; height: 350px; border: 1px solid #ccc; position: fixed; left: 0px; top: 150px;}
    .shareButtom li{display: block; height: 50px;  width: 70%;border: 1px solid red; margin: 5px; text-align: center; line-height: 50px;}
    .clock{height: 90px; width: 100%; border-bottom: 1px solid #ccc; text-align: center;}
    #defaultCountdown .countdown_amount{ font-size: 20px;}
</style>
<ul class="shareButtom">
    <li>
        <a href="">Facebook</a>
    </li>
    <li>
        <a href="">Google+</a>
    </li>
    <li>
        <a href="">Tweet</a>
    </li>
    <li>
        <a href="">Email</a>
    </li>
</ul>
<div class="navition">
    <span><a target="_black" href="/">Trang chủ</a></span>&NestedGreaterGreater;<a href="<?php echo Yii::app()->createUrl('articles/view') ?>">Kiếm tiền online</a>&NestedGreaterGreater; <?php echo $articles->title; ?>
</div>
<div class="nav">
    <div class="form-left">
        <h4>Giới thiệu</h4>
        <div style="margin: 20px 0px;">
            <img src="<?php echo $articles->avata; ?>" width="400px" style="float: left;">
            <h1><?php echo $articles->title; ?></h1>
        </div>
        <div style="clear: both;border-bottom: 1px solid #ccc;"></div>

        <div class="share">
            <?php
            if (!Yii::app()->session['userId']) {
                echo '<span style="color: #fff; text-align: center; line-height: 80px;">Bạn chưa đăng nhập, hãy đăng ký thành viên hoặc <a href="' . Yii::app()->createUrl('user/login') . '">đăng nhập</a> để tham gia chương trình!</span>';
            } else {
                ?>

                <?php
                echo '<label>Link chia sẻ: </label>';
                echo CHtml::textField('urlShare', 'http://saobang.vn' . Yii::app()->createUrl('articles/detail', array('id' => $articles->id, 'share' => Yii::app()->session['userId'], 'title' => ExtensionClass::utf8_to_ascii($articles->title))));
            }
            ?>
        </div>
        <div>
            <?php echo $articles->content; ?>
        </div>

    </div>
    <div class="form-right">
        <div class="clock">
            <p>Vui lòng chờ</p> <span id="defaultCountdown">Đếm ngược thời gian</span>
        </div>
        <div>
            <h2>Giới thiệu về kiếm tiền online qua saobang.vn</h2>
            <p>1. Cách tham gia chương trình</p>
            <p>2. Cách tính điểm</p>
            <p>3. Cách thanh toán</p>
        </div>
        <hr />
        <h2>Các sản phẩm khác đang tham gia chương trình</h2>
        <?php
        foreach ($dataProvider as $index => $data) {
            echo '<div class="product">';
            echo '<p><a href="' . Yii::app()->createUrl('articles/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '"><img width="200px" src="' . $data->avata . '" /></a></p>';
            echo '<div style=" clear: both;"></div>';
            echo '<div style="padding: 10px 0px;"><a href="' . Yii::app()->createUrl('articles/detail', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title))) . '">' . $data->title . '</a></div>';
            echo '</div>';
            echo '<div style="height: 10px;"></div>';
        }
        ?>
    </div>
</div>
