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
echo '<h3>Thông báo lỗi</h3>';
echo '<p>' . $errorMsg . '</p>';
echo '<pre>';
print_r($rs);
echo '</pre>';
echo '<a href="javascript: void(0);" onclick="history.go(-1);">Quay lại</a>';