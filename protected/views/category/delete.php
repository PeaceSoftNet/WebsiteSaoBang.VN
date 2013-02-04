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
echo '<h3><span style="color:red;">Chú ý</span>: Xóa danh mục không hợp lệ!</h3>';
echo '<p>Để xóa danh mục, bạn phải chắc chắn danh mục đó <b>không có các bài viết</b>, <b>không có bộ lọc</b>, <b>không có nhu cầu</b>, <b>không có thuộc tính</b>, <b>không có danh mục con</b></p>';
echo '<h4>' . $errorMsg . '</h4>';
echo '<strong>Ví dụ</strong>';
echo '<pre>';
if (isset($rsTopic)) {
    print_r($rsTopic);
}

if (isset($sqlfilter)) {
    print_r($sqlfilter);
}

if (isset($sqlDemand)) {
    print_r($sqlDemand);
}

if (isset($sqlAttributes)) {
    print_r($sqlAttributes);
}

if (isset($rs)) {
    print_r($rs);
}

echo '<pre>';

echo '<a href="javascript: void(0);" onclick="history.go(-1);">Quay lại</a>';