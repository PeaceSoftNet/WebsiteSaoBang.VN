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
echo '<div style="height: 300px">';
if ($code == 'Success') {
    echo '<p>Bạn đã kích hoạt tài khoản thành công!</p>';
} elseif ($code == 'Error') {
    echo 'Kích hoạt tài khoản không thành công, vui kiểm tra lại email và kích hoạt lại';
} elseif ($code == 'login') {
    echo '<h3>Kích hoạt tài khoản người dùng</h3>';
    echo 'Tài khoản của bạn chưa được kích hoạt, vui lòng kiểm tra email <i>(Inbox hoặc Spam)</id> và kích hoạt tài khoản trước khi đăng nhập.';
}
echo '</div>';