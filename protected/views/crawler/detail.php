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
echo '<div style="border: 1px solid #f4f4f4">';
echo '<a href="' . Yii::app()->createUrl('crawler/detail', array('id' => $data->id)) . '"><h2><i style="color:red;">' . $data->mobile . '</i> ' . base64_decode($data->title) . '</h2></a>';
if (base64_decode($data->address))
    echo '<div><strong>Địa chỉ</strong>: <i>' . base64_decode($data->address) . '</i></div>';
echo 'Tạo lúc: <i>' . base64_decode($data->createDate) . '</i> tại <strong>' . base64_decode($data->Location) . '</strong>';
echo '<p>Nguồn <b>' . $data->domain . '</b>, Xem nội dung gốc tại: ';
echo '<a href="' . base64_decode($data->url) . '">' . base64_decode($data->url) . '</a></p> ';
echo '</div>';
echo '<br /><hr />';
echo '<div>' . base64_decode($data->content) . '</div> ';