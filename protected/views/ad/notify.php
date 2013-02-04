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
<div id="wrapper">
    <div class="main clearfix">
        <div class="clearfix">
            <div class="pathway fl">
                <ul class="clearfix">
                    <li class="home"><a href="<?php echo Yii::app()->createUrl('ad/index'); ?>">Trang chủ</a></li>
                    <li><a href="javascript:void(0);" class="active">Thông báo</a></li>
                </ul>
            </div>
            <?php $this->setLocal(); ?>
        </div>
        <div class="clear"></div>
        <div class="grid_12">
            <div class="title-page">
                <h1><?php echo $model->title; ?></h1>
            </div>
            <div class="sm-forminfo clearfix">
                <div>
                    <?php echo $model->content; ?>
                </div>
            </div>
            <div class="sm-forminfo clearfix">
                <p style="width: 100%; font-size: 14px; border-bottom: 1px dotted #ccc; text-align: right;">Xem thêm các thông báo khác.</p>
                <ul>
                    <?php
                    foreach ($dataProvider as $index => $data) {
                        $link = Yii::app()->createUrl('ad/notify', array('id' => $data->id, 'title' => ExtensionClass::utf8_to_ascii($data->title)));
                        ?>
                        <li>&RightTriangle; <a href="<?php echo $link; ?>"><?php echo $data->title; ?> <span style="color: #ccc; font-style: italic; font-size: 10px;">(<?php echo $data->createDate; ?>)</span></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div
        </div>
    </div>
</div>