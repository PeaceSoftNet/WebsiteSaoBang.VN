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
<div class="block-comment" id="boxComment">
    <div class="title-page">
        <h4 class="fl">Comment</h4>
        <div class="social-share clearfix fr">
            <b class="fl">CHIA SẺ QUA</b>&nbsp;&nbsp;
            <?php
            $this->widget('ext.sharebox.EShareBox', array(
                'url' => $this->createAbsoluteUrl(Yii::app()->request->requestUri),
                'title' => $topicModel->title,
            ));
            ?>
        </div>
    </div>
    <ul>
        <?php
        if (!$itemCount) {
            echo '<li><p style="color: #666; width: 500px;">Rao vặt này chưa có trả lời, bạn có thể là người đầu tiên.<br /></p></li>';
        }
        foreach ($dataProvider as $index => $data) {
            ?>
            <li>
                <p><a href="<?php echo 'mailto:' . $data->email; ?>"><?php echo $data->email; ?></a>  <span class="cl66">▪ <?php echo GlobalComponents::convertTimeValue($data->createDate); ?> </span></p>
                <p><?php echo $data->content; ?></p>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="frm-comment">
        <style type="text/css">textarea{width:656px;height:66px; display: block; padding: 10px;}.errorMessage{color: red; font-size: 11px; padding-left: 20px;} .frm-comment textarea.error{border-color: red;}</style>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'formComment', 'action' => '#boxComment')); ?>
        <?php
        $userEmail = Yii::app()->session['email'];
        if ($userEmail) {
            echo $form->textArea($model, 'content');
        } else {
            $model->content = 'Vui lòng đăng nhập để tham gia bình luận.';
            echo $form->textArea($model, 'content', array('disable' => 'disable'));
        }
        ?>        
        <p>
            <?php
            $model->isNotify = 1;
            echo $form->checkBox($model, 'isNotify');
            echo $form->labelEx($model, 'isNotify');
            ?>
        </p>
        <?php echo $form->error($model, 'content'); ?>
        <div class="postNews-Rv" style="top:106px"> <a <?php if ($userEmail) echo 'onclick="$(\'#formComment\').submit();"'; ?> href="javascript:void(0);">Đăng rao vặt</a></div>
        <?php $this->endWidget(); ?>
    </div>
</div>