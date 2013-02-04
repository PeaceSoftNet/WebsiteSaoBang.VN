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
$askId = $askData->id;
$this->pageTitle = $askData->title;
?>
<style type="text/css">
    .cont h1{font-size: 20px;}
    .cont h2{float: left;padding-right: 10px;}
    .list-Asktobuy{min-height: 550px;}
</style>
<div class="grid_12">
    <?php
    $this->bannerA2b();
    ?>
    <div class="title-page">
        <h1><?php echo ucfirst('Hỏi mua: Mua nhanh - Đúng giá - Chất lượng tốt'); ?></h1>
    </div>
    <ul class="list-Asktobuy">
        <li>
            <div class="fl">
                <span class="corner"></span>
                <div class="col">
                    <b><?php echo $askData->visit; ?></b>
                    <br />
                    lượt xem
                </div>
                <div class="col">
                    <b><?php echo $askData->report; ?></b>
                    <br />
                    Báo giá
                </div>
                <div class="avatar">
                    <a href="mailto:<?php echo $askData->email; ?>"><img title="<?php echo $askData->email; ?>" alt="<?php echo $askData->email; ?>" height="40px" src="<?php echo SERVER_DATA; ?>/themes/homepage/pictures/mailbox.jpg" /></a>
                </div>
            </div>
            <div class="fr">
                <div class="cont">
                    <h2 class="title"><b class="name"><?php echo GlobalComponents::hiddenEmail($askData->email); ?></b></h2>
                    <h1><?php echo $askData->title; ?></h1>
                    <p><?php echo $askData->content; ?> <span class="hint">• <?php echo GlobalComponents::convertTimeValue($askData->createDate); ?> </span></p>
                </div>
                <ul class="keyword">
                    <?php
                    $tags = json_decode($askData->tag);
                    if ($tags) {
                        foreach ($tags as $key => $tag) {
                            echo '<li><a href="' . Yii::app()->createUrl('ask/tag', array('id' => $key)) . '">' . $tag . '</a></li>';
                        }
                    }
                    ?>
                </ul>
                <div class="clear"></div>
                <div class="quote-box">
                    <div class="toptit clearfix">
                        Có tất cả <?php echo $itemCount; ?> trả lời:
                        <span class="arrange">Sắp xếp theo:&nbsp;&nbsp;<a id="orderByCreateDate<?php echo $askId; ?>" class="active" onclick="loadCommentAll('<?php echo $askId; ?>')" href="javascript:void(0)">Mới nhất</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a id="orderByPrice<?php echo $askId; ?>" onclick="loadCommentPrice('<?php echo $askId; ?>');" href="javascript:void(0);">Giá thấp nhất</a></span>
                    </div>

                    <ul class="list-quote" id="list_comment_all_<?php echo $askId; ?>">
                        <?php
                        foreach ($dataProvider as $index => $askData) {
                            ?>
                            <li>
                                <div class="number"><?php echo ($index + 1); ?></div>
                                <div class="reply">
                                    <p><?php echo $askData->comment; ?></p>
                                    <div class="price">Giá: <span class="org-clr"><?php echo GlobalComponents::numberFomat($askData->price); ?> VNĐ</span>&nbsp;&nbsp;•&nbsp;&nbsp;<a target="_black" rel="nofollow" href="<?php echo $askData->link; ?>"><?php echo $askData->link; ?></a></div>
                                </div>
                                <div class="infoUser">
                                    <p><?php echo GlobalComponents::convertTimeValue($askData->createDate); ?> </p>
                                    <p><?php echo GlobalComponents::hiddenEmail($askData->email); ?></p>
                                    <p>Uy tín: 50</p>
                                </div>
                            </li>
                            <?php
                        }
                        ?>    
                    </ul>
                    <div class="form-quote clearfix">
                        <?php
                        $modelReport = new AskReport();
                        $form = $this->beginWidget('CActiveForm');
                        //set attributes value form inport
                        if (GlobalComponents::isLogin()) {
                            $contentAtt = array('value' => 'Nội dung', 'onclick' => 'if(this.value=="Nội dung") this.value=\'\'', 'onchange' => 'if(this.value==\'\') this.value="Nội dung"');
                            $priceAtt = array('value' => 'Giá đề nghị', 'onclick' => 'if(this.value=="Giá đề nghị") this.value=\'\'', 'onchange' => 'if(this.value==\'\') this.value="Giá đề nghị"');
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
                </div>
            </div>
            </div>
        </li>
    </ul>

    <script type="text/javascript">
        function loadCommentAll(askId){
            $('#list_comment_all_'+askId).load('<?php echo Yii::app()->createUrl('ask/listCommentAll') ?>', {'askId':askId}, function(){
                $('#orderByCreateDate'+askId).addClass('active'); $('#orderByPrice'+askId).removeClass();
            });
        }
        function loadCommentPrice(askId){
            $('#list_comment_all_'+askId).load('<?php echo Yii::app()->createUrl('ask/listCommentPrice') ?>', {'askId':askId}, function(){
                $('#orderByPrice'+askId).addClass('active'); $('#orderByCreateDate'+askId).removeClass();
            });
        }
    </script>
