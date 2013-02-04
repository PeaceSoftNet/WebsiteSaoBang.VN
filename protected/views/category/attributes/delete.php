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
echo '<h3><span style="color:red;">Chú ý</span>: Xóa thuộc tính không hợp lệ!</h3>';
echo '<h4>' . $errorMsg . '</h4>';
echo '<pre>';
if (isset($rs)) {
    print_r($rs);
}

echo '<pre>';

echo '<a href="javascript: void(0);" onclick="history.go(-1);">Quay lại</a>';