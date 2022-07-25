<?php
include_once("./_common.php");

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

$query = "select * from {$g5['point_table']} where mb_id = '" . $member['mb_id'] . "'";
$result = sql_query($query);

// 15일 내 소멸 예정 포인트 
$temp_expired_date = date("Y-m-d H:i:s", strtotime("+15 days"));
$sql = "select sum(po_point) as expire_sum_point from g5_point where po_expire_date < '".$temp_expired_date."' and po_expired='0' and mb_id = '" . $member['mb_id'] . "'";
$expire_point_15 = sql_fetch($sql);

$ep_day_epoint = 0;
if ($_REQUEST['ep_day'] != ""){
	$tmp_edate = date("Y-m-d H:i:s", strtotime("+".$_REQUEST['ep_day']." days"));
	$sql = "select sum(po_point) as expire_sum_point from g5_point where po_expire_date < '".$tmp_edate."' and po_expired='0' and mb_id = '" . $member['mb_id'] . "'";
	$tmp_row = sql_fetch($sql);
	$ep_day_epoint = $tmp_row['expire_sum_point'];
}else{
	$ep_day_epoint = $expire_point_15['expire_sum_point'];
}


//contents 영역
include_once(MOA_MY_SKIN."/my_coupon03.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");