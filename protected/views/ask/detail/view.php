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
<div id="wrapper">
    <div class="main clearfix">
        <div class="pathway-tab clearfix" >
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index') ?>">Trang chủ</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('ask/view'); ?>" class="active">Hỏi mua</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <div class="grid_12">

            <?php $this->getListShopVip(); ?>

            <div class="Tab-br-NewsRv clearfix" >
                <?php $this->widget('zii.widgets.CMenu', GlobalComponents::askTypelMenu()); ?>
            </div>
            <ul class="list-Asktobuy">
                <li>
                    <div class="fl">
                        <span class="corner"></span>
                        <div class="col">
                            <b><?php echo $askData->visit; ?></b>
                            <br />lượt xem
                        </div>
                        <div class="col green">
                            <b><?php echo $askData->report; ?></b>
                            <br />Báo giá
                        </div>
                    </div>
                    <div class="fr">
                        <div class="cont">
                            <b class="title name" style="float: left; font-size: 16px !important; padding-right: 15px;"><?php echo GlobalComponents::hiddenEmail($askData->email); ?></b>
                            <h1 class="title">
                                <?php echo $askData->title; ?>
                            </h1>
                            <p><?php echo $askData->content; ?> <span class="hint"> <?php if (Yii::app()->user->id) echo '• <a href="' . Yii::app()->createUrl('ask/remove', array('id' => $askData->id)) . '">Xóa</a>'; ?>  </span></p>                             
                        </div>
                        <div class="clear"></div>
                        <div class="quote-box askBuy fr" >
                            <span class="arr-quote">&nbsp;</span>

                            <div class="cont-quote">
                                <div class="toptit clearfix">
                                    <span class="cl99 fs11"><i class="dticon-clock">&nbsp;</i><?php echo $askData->createDate; ?></span>
                                    <span class="arrange"><a href="javascript:void(0);"><i class="dticon-errors"></i>&nbsp;Than phiền</a>
                                        <a href="javascript:void(0);"><i class="dticon-errors"></i>&nbsp; Ẩn tin này</a>
                                    </span>
                                </div>
                                <?php if ($itemCount > 0) { ?>
                                    <div class="askBuy-total">
                                        <div style="float:left">Có <b class="org-clr"><?php echo $itemCount; ?> </b> trả lời:</div>
                                        <div class="arrang ">
                                            <span class="fl">Sắp xếp theo </span>
                                            <a class="slted" onclick="dropdownMenu('sortComment');" href="javascript:void(0);" style="margin:0"> Mới nhất</a>
                                            <div id="sortComment" class="sub-sltbox" style="display: none;width:96px; right:20px; height: auto;">
                                                <div class="inner-sub-sltbox" >
                                                    <ul>
                                                        <li><a id="orderByCreateDate<?php echo $askId; ?>" class="active" onclick="loadCommentAll('<?php echo $askId; ?>')" href="javascript:void(0)">Mới nhất</a></li>
                                                        <li><a id="orderByPrice<?php echo $askId; ?>" onclick="loadCommentPrice('<?php echo $askId; ?>');" href="javascript:void(0);">Giá thấp nhất</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <ul class="list-quote">
                                        <?php
                                        foreach ($dataProvider as $index => $askData) {
                                            ?>
                                            <li>
                                                <div class="reply">
                                                    <div><b class="name"><?php echo GlobalComponents::hiddenEmail($askData->email); ?></b>
                                                        <span><?php echo $askData->comment; ?></span>
                                                    </div>
                                                    <div class="price"> <b class="org-clr"><?php echo GlobalComponents::numberFomat($askData->price); ?> VNĐ</b>
                                                        <span class="cl99 fs11"> &nbsp;&nbsp;•  <?php echo GlobalComponents::convertTimeValue($askData->createDate); ?> </span>
                                                        <a target="_black" rel="nofollow" href="<?php echo $askData->link; ?>"><?php echo $askData->link; ?></a>
                                                    </div>
                                            </li>
                                            <?php
                                        }
                                        ?>                                    
                                    </ul>                                
                                </div>
                            <?php } else { ?>
                                <div class="askBuy-total" style="height: 50px">
                                    <p>Chưa có bình luận nào, bạn có thể là người đầu tiên bình luận và đưa báo giá</p>
                                </div>
                            <?php } ?>
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
                            <?php $this->replationAsk($this->pageTitle, $askId); ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>