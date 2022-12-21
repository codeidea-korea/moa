<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 버튼컬러
$btn1 = (isset($boset['btn1']) && $boset['btn1']) ? $boset['btn1'] : 'black';
$btn2 = (isset($boset['btn2']) && $boset['btn2']) ? $boset['btn2'] : 'color';

// 보드상단출력
$is_bo_content_head = false;
//if (!$is_admin) 	$sql_apms_where = " and mb_id = '{$member['mb_id']}'";
$moa_onoff = isset($_GET['moa_onoff'])?$_GET['moa_onoff']:"";
$moa_area1 = isset($_GET['moa_area1'])?$_GET['moa_area1']:"";
$moa_area2 = isset($_GET['moa_area2'])?$_GET['moa_area2']:"";
$sca = isset($_GET['sca'])?$_GET['sca']:"";

if ($sca=="전체")
	$sca = "";

if ($moa_onoff) {
	$moa_onoff = str_replace("'","", $moa_onoff);
	$sql_apms_where .= " and moa_onoff = '{$moa_onoff}'";
}
if ($moa_area1) {
	$moa_area1 = str_replace("'","", $moa_area1);
	$sql_apms_where .= " and moa_area1 = '{$moa_area1}'";
}
if ($moa_area2) {
	$moa_area2 = str_replace("'","", $moa_area2);
	$sql_apms_where .= " and moa_area2 = '{$moa_area2}'";
}

?>
