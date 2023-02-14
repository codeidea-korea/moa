<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 김과장 추가
if ($member['mb_id'] == 'magma405@nate.com') $is_admin = 'super';
if ($member['mb_id'] == 'admin01') $is_admin = 'super';
if ($member['mb_id'] == 'admin02') $is_admin = 'super';
if ($member['mb_id'] == 'admin03') $is_admin = 'super';
if ($member['mb_id'] == 'admin04') $is_admin = 'super';
function get_url($url) {
	//$url .= "?ver=".date("Ymdhis",filemtime($url));
	$url .= "?ver=".rand(1,999999);
    return $url;
}