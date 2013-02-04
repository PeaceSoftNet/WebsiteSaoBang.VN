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
$this->pageTitle = 'Quản lý thuộc tính';
$this->breadcrumbs = array(
    'Quản lý thuộc tính' => array('crawler/searchAttributes'),
);
?>

<h3><span class="icon-mod"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/images/icon-product.png"> <span class="sup">2</span></span><?php echo $this->pageTitle; ?></h3>
<div class="fillter"></div>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('crawler/searchAttributes'); ?>" class="addNew"><span>Tìm kiếm thuộc tính</span></a>
    <a href="<?php echo Yii::app()->createUrl('crawler/processDemand'); ?>" class="addNew"><span>Tìm kiếm nhu cầu</span></a>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="table-content">
    <tr class="title-list">
        <td>STT</td>
        <td>ID</td>        
        <td>Tiêu đề</td>
    </tr>
</table>
<div style="margin:10px 0">
    <a href="<?php echo Yii::app()->createUrl('crawler/searchAttributes'); ?>"  class="addNew"><span>Tìm kiếm thuộc tính</span></a>
    <a href="<?php echo Yii::app()->createUrl('crawler/processDemand'); ?>" class="addNew"><span>Tìm kiếm nhu cầu</span></a>
</div>
