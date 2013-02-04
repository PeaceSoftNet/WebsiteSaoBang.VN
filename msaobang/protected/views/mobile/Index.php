<?php
/**
 * 
 * @author             Linhnt 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
 
$sess = Yii::app()->session['loginName'] = "Linhnt";
?>

<h1 class="title-page">Danh mục</h1>
<ul class="all-category">         
    <?php  echo $content; ?>            
</ul>