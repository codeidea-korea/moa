<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 버튼
$btn1 = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'navy';
$btn2 = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';

// 헤더
$header_skin = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
if($header_skin != 'none') {
	$page_name = (isset($wset['title']) && $wset['title']) ? $wset['title'] : '상품문의';
	$header_color = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
	include_once('./header.php');
}

?>
