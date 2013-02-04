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
if (isset($topicDetail->content) && isset($topicModel->title)) {
    $linkDetail = Yii::app()->createUrl('ad/detail', array('categoryName' => $categoryName, 'id' => $topicDetail->id, 'title' => $title));
    ?>

    <div  style="margin: 15px; height: 350px; width: 600px; font-size: 12px; overflow: hidden;">
        <a href="<?php echo $linkDetail; ?>"><h1 style="width: 550px; overflow: hidden; font-size: 20px;"><?php echo $topicModel->title; ?></h1></a>
        <p style="color: #666; float: right;">Đăng lúc: <span><?php echo $topicModel->createDate; ?></span></p>
        <div>
            <?php echo $topicDetail->content; ?>
        </div>
    </div>
    <?php
    echo '<div style="text-align: right;font-size: 16px;"><a href="' . $linkDetail . '">Xem chi tiết...</a></div>';
} else {
    echo 'Tin này đã xóa hoặc không tồn tại trên hệ thống.';
}
?>