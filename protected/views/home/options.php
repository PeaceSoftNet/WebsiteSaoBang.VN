<?php
/*
 * chienlv@peacesoft.net
 * 
 */
?>
<div class="grayModule">
    <div class="dtinfo-user clearfix">         
        <?php if (isset($data->code)) { ?>
            <div class="regisVIP-sms">
                Soạn<span class="code-sms red-clr">SB&nbsp;&nbsp;VIP&nbsp;&nbsp;<?php echo $data->code; ?></span>gửi&nbsp;&nbsp;<span class="red-clr">8708</span>&nbsp;&nbsp;Để mua tin VIP
                <br />
                <span class="charges-sms">Phí: 15.000đ/tin. Tìm hiểu <a rel="facebox" href="<?php echo Yii::app()->createUrl('home/vipRules') ?>">chính sách tin VIP</a></span>
            </div>
        <?php } ?>
        <div class="controlAd fr">
            <div class="sltbox clearfix">
                <a class="dtpostNews" onclick="updateTopic('<?php echo $data->id; ?>');" href="javascript:void(0);"><i class="dticon-postNews"></i>&nbsp;Up tin</a>
                <a style="display: none;" class="dtbNews-VIP" href="javascript:void(0);"><i class="dticon-bNewsVIP"></i>&nbsp;Mua tin VIP</a>
            </div>
            <div class="sltbox dtNews-share">
                <a class="slted" onclick="showDropDown('sharedetailpage<?php echo $data->id; ?>', '_sharedetailpage<?php echo $data->id; ?>');" href="javascript:void(0);"><i class="dticon-NewsShare"></i>Chia sẻ</a>
                <input type="hidden" name="dropdownfucntion" value="1" id="sharedetailpage<?php echo $data->id; ?>" />
                <div class="w250 sub-sltbox none" id="_sharedetailpage<?php echo $data->id; ?>">
                    <div class="inner-sub-sltbox" style="height: 135px;">      
                        <style type="text/css">
                            #___plusone_0{float: right !important;}
                        </style>
                        <ul>
                            <li><a onclick="$('#sharelink').select();" href="javascript:void(0);">Share Link: </a>
                                <a style="margin: 0px !important;vertical-align:inherit;" href="javascript:void(0);" onclick="share_facebook();">
                                    <img width="15" height="15" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/fontend/images/icon-facebook.gif"/>
                                </a>
                                <a style="margin: 0px !important;vertical-align:inherit;" href="javascript:void(0);" onclick="share_google();">
                                    <img width="15" height="15" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/fontend/images/icon-google.png"/>
                                </a>
                                <a style="margin: 0px !important;vertical-align:inherit;" href="javascript:void(0);" onclick="share_buzz();">
                                    <img width="15" height="15" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/fontend/images/icon-yahoo.png"/>
                                </a>
                                <a style="margin: 0px !important;vertical-align:inherit;" href="javascript:void(0);" onclick="share_twitter();">
                                    <img width="15" height="15" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/fontend/images/icon-twitter.png"/>
                                </a>
                            <center><input id="sharelink" onclick="this.select();" style="width: 225px;" type="text" name="shareLink" value="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . GlobalComponents::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId); ?>" /></center></li>
                            <li><a onclick="$('#sharecode').select();" href="javascript:void(0);">Forum code:</a>
                            <center><textarea id="sharecode" onclick="this.select()" style="width: 220px; height: 50px;">[url=<?php echo 'http://' . $_SERVER['SERVER_NAME'] . GlobalComponents::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId); ?>] </textarea></center>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="boxModule">
    <div style="display: block;">
        <?php echo GlobalComponents::processContent($dataDetail->content); ?>
    </div>
</div>
<script type="text/javascript">
            
    function updateTopic(){
        $('.dtpostNews').html('<i class="dticon-postNews"></i>&nbsp;Uploading');
        $.get('/home/updateTopic', {'topicId' : '<?php echo $data->id; ?>', 'code':'true'}, function(){ alert('<?php
        $value = Yii::app()->cache->get('ab_upload_' . $data->id);
        if ($value === false) {
            echo 'Cập nhật thành công';
        } else {
            echo 'Rao vặt đã cập nhật, vui lòng chờ 30 phút sau để upload lại';
        }
        ?>'); $('.dtpostNews').css('color', '#666'); $('.dtpostNews').html('<i class="dticon-postNews"></i>&nbsp;Success'); $('.dtpostNews').attr('onclick', 'void(0)'); });
                }
</script>