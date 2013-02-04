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
<div class="grid_3">

    <div class="Mysb-Categ">
        <h4>Đăng rao vặt trên site khác</h4>
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
            <li><a  style="color: green;" href="<?php echo Yii::app()->createUrl('home/vip'); ?>">Tin VIP &nbsp;&nbsp;<img src="/data/icon-hot.gif"></a></li>
            <li><a  style="color: green;" href="<?php echo Yii::app()->createUrl('post/otherRun'); ?>" class="active">Đăng tin &nbsp;&nbsp;</a></li>
        </ul>
    </div>    

    <div>
        <h4><?php echo $topic->title; ?></h4>
    </div>
    <div>
        <table cellpadding="0" cellspacing="0" width="100%" class="table-content">
            <tr class="title-list">
                <td width="40px">STT</td>
                <td>Tên trang</td> 
                <td>Nội dung</td> 
                <td width="80px">Chức năng</td>        
            </tr>
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_run',
                'template' => "{items}",
                'emptyText' => '',
                    )
            );
            ?>
        </table>
    </div>
</div>

<script type="text/javascript">
    function runPost(sid){
        $('#func'+sid).html('Waiting...');
        $('#result'+sid).load('<?php echo Yii::app()->createUrl('post/process'); ?>', {'sid': sid, 'tTitle': '<?php echo $topic->title; ?>', 'tid': '<?php echo $topic->id; ?>'}, function(){
            $('#func'+sid).html('Success');
        });
    }
</script>
<style type="text/css">
    .publishauto{border: 1px solid #ccc; margin: 5px; color: green; font-weight: bold; text-align: center; cursor: pointer;}
</style>