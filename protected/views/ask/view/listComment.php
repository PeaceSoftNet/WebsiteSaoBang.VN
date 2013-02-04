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
<span class="arr-quote">&nbsp;</span>
<div class="cont-quote">
    <div class="toptit clearfix">
        <span class="cl99 fs11">
            <?php
            if ($itemCount) {
                echo 'Có tất cả ' . $itemCount . ' trả lời.';
            } else {
                echo 'Bạn có thể là người đầu tiên trả lời.';
            }
            ?>
        </span>
        <span class="arrange"><a href="javascript:void(0);"><i class="dticon-errors"></i>&nbsp;Than phiền</a>
            <a href="javascript:void(0);"><i class="dticon-errors"></i>&nbsp; Ẩn tin này</a>
        </span>
    </div>
    <ul class="list-quote" id="list_comment_all_<?php echo $askId; ?>">
        <?php
        foreach ($dataProvider as $index => $data) {
            ?>
            <li>
                <div class="reply">
                    <div><b class="name"><?php echo GlobalComponents::hiddenEmail($data['email']); ?></b>
                        <span>&nbsp;&nbsp;</span>
                        <span><?php echo $data['comment']; ?> </span>
                    </div>
                    <div class="price"><?php if ($data['price']) { ?>Giá: <span class="org-clr"><?php echo GlobalComponents::numberFomat($data['price']); ?> VNĐ</span><?php } ?>&nbsp;&nbsp;
                        <span class="cl99 fs11"> &nbsp;&nbsp;•   <?php echo GlobalComponents::convertTimeValue($data['createDate']); ?>    </span>
                        <?php if ($data['link']) { ?>•&nbsp;&nbsp;<a target="_black" rel="nofollow" href="<?php echo $data['link']; ?>"><?php echo $data['link']; ?></a><?php } ?></div>
                </div>
            </li>
            <?php
        }
        ?>    
    </ul>
</div>
<div class="form-quote clearfix">
    <?php
    $modelReport = new AskReport();
    $form = $this->beginWidget('CActiveForm');
    //set attributes value form inport
    if (GlobalComponents::isLogin()) {
        $contentAtt = array('value' => 'Nội dung', 'onclick' => 'if(this.value=="Nội dung") this.value=\'\'', 'onchange' => 'if(this.value==\'\') this.value="Nội dung"');
        $priceAtt = array('value' => 'Giá đề nghị', 'onclick' => 'if(this.value=="Giá đề nghị") this.value=\'\'', 'onchange' => 'if(this.value==\'\') this.value="Giá đề nghị"', 'onkeyup' => '$.priceFormat(this);');
        $linkAtt = array('value' => 'Link tham khảo (nếu có)', 'onclick' => 'if(this.value=="Link tham khảo (nếu có)") this.value=\'\'', 'onchange' => 'if(this.value==\'\') this.value="Link tham khảo (nếu có)"');
        $submitAtt = array('class' => 'sent-price');
    } else {
        $contentAtt = array('value' => 'Bạn chưa đăng nhập, vui lòng đăng ký hoặc đăng nhập để trả lời', 'disabled' => 'disabled');
        $priceAtt = array('value' => 'Giá đề nghị', 'disabled' => 'disabled');
        $linkAtt = array('value' => 'Link tham khảo (nếu có)', 'disabled' => 'disabled');
        $submitAtt = array('class' => 'sent-price', 'disabled' => 'disabled');
    }
    ?>
    <div class="form1">
        <?php echo $form->textField($modelReport, 'comment', $contentAtt); ?>
    </div>
    <div class="form2">
        <?php echo $form->textField($modelReport, 'price', $priceAtt); ?>
        <span>VNĐ</span>
    </div>
    <div class="form3">
        <?php echo $form->textField($modelReport, 'link', $linkAtt); ?>
    </div>
    <?php echo $form->hiddenField($modelReport, 'askId', array('value' => $askId)); ?>
    <?php echo CHtml::submitButton('', $submitAtt); ?>
    <?php $this->endWidget(); ?>
</div>
