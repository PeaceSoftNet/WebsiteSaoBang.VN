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
// Get client script

$cs = Yii::app()->clientScript;
$cs->registerCSSFile('/themes/backend/styles/styles.css');
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

<div class="grid_9">

    <div class="pathway">
        <ul class="clearfix">
            <li class="home"><a href="<?php echo Yii::app()->createUrl('home/index'); ?>">Trang chủ</a></li>
            <li>Tìm kiếm đối tác</li>
        </ul>
    </div>    
    <div style="margin: 10px 0px;">
        <p>
            <strong style="text-decoration: underline;">Từ khóa tìm kiếm</strong>: <i><?php echo $keyword; ?></i>
        </p>
    </div>
    <div><strong>Bước 2</strong>. Chọn tài khoản email dùng để gửi thư đi</div>
    <div style="margin: 10px 50px;">
        <p>
            <input type="radio" value="1" id="value1" checked="true" name="accountEmail"><label for="value1"><strong>Sử dụng hệ thống email của saobang.vn</strong></label> <i style="color: green; display: block; font-size: 11px;">(có thể vào spam, và không nhận được email phản hồi của khách hàng)</i>
        </p>
        <p>
            <input type="radio" onchange="addAccount();" value="2" id="value2" name="accountEmail"><label for="value2"><strong>Sử dụng hệ thống gmail của tôi</strong></label> <i style="color: red;">(Khuyến cáo nên dùng)</i> <i style="color: green;  display: block; font-size: 11px;">(vào hộp thư đến, có thể nhận được email phản hồi)</i>
        </p>
    </div>
    <style type="text/css">
        .mybox input{border: 1px solid #ccc; padding: 1px 10px; height: 20px; width: 300px}
        .emailForm{line-height: 22px;  display: block;}
        #myAccount{margin: 2px 0px 30px 100px;}     
        .table-content tr td {border-bottom: 1px dotted #E3E3E3; vertical-align: top;}
        .table-content{margin: 20px 0px;}
        .table-content tr{height: 28px;}
        .tdleft{text-align: left !important}
        #sendAll{float: right; padding: 3px 15px; line-height: 22px; height: 22px; cursor: pointer; background: #fcfcfc; color: blue; font-weight: 800;}
        .title-list{line-height: 30px;}
    </style>
    <div id="myAccount">

    </div>
    <div><strong>Bước 3</strong>. Tự động gửi email</div>
    <div class="mod-ct">
        <table class="table-content" width="100%" cellspacing="0" cellpadding="0">
            <tr class="title-list">
                <td>STT</td>
                <td>Email khách hàng</td>
                <td>Tình trạng gửi</td>
            </tr>
            <?php
            foreach ($dataProvider->getData() as $index => $data) {
                if ($data->email) {
                    if ($index % 2) {
                        echo '<tr>';
                    } else {
                        echo '<tr class="odd">';
                    }
                    echo '<td>' . ($index + 1) . '</td>';
                    echo '<td class="tdleft">' . $data->email . '<input type="hidden" value="' . $data->email . '" id="mail_' . $index . '" /></td>';
                    echo '<td id="tab_' . $index . '"><a href="javascript:void(0)" onclick="sendEmail(' . $index . ');">Gửi</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <input type="button" value="Gửi tất cả" id="sendAll" onclick="sendAllEmail(<?php echo $index; ?>)" />
    </div>
    <div>
        <a href="<?php echo Yii::app()->createUrl('email/autofind', array('tpid' => $topicId)); ?>">Quay lại, tìm kiếm thêm các đối tượng khách hàng khác</a>
    </div>
</div>
<script type="text/javascript">
    function addAccount(){
        $('#myAccount').html('<p class="mybox"><label class="emailForm" for="emailAddress">Gmail</label> <input type="text" id="emailAddress" name="email"></p><p class="mybox"> <label  class="emailForm" for="emailPasswd">Passsword</label> <input id="emailPasswd" type="password" name="email"></p>');
    }
    function sendEmail(numberItem){
        var email = $('#emailAddress').val();
        var passwd = $('#emailPasswd').val();
        var emailTo = $('#mail_'+numberItem).val();
        $('#tab_'+numberItem).html('<img src="http://data.saobang.vn/loading.gif" height="22px" />');
        $('#tab_'+numberItem).load('<?php echo Yii::app()->createUrl('email/customerSend') ?>', {'mailto': emailTo, 'mailfrom': email, 'passwd': passwd, 'topicId':'<?php echo $topicId; ?>'});
    }
    
    function sendAllEmail(maxValue){
        for (var i=0;i<=maxValue;i++){
            sendEmail(i);
        }
    }
</script>