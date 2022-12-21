<?php
include_once('./_common.php');

if ($_POST['withdrawal_type'] == "sel"){
	$pp_ids = implode(',', $_POST['chk']);
}else{
	$strSql = "select group_concat(pp_id) as pp_ids from g5_apms_payment where pp_confirm='0'";
	$tmp = sql_fetch($strSql);
	$pp_ids = $tmp['pp_idx'];
}

$arr_pp_id = explode(',', $pp_ids);
foreach($arr_pp_id as $key => $val){
	$strSql = "select pp_od_ids from g5_apms_payment where pp_id=".$val;
	$pp_row = sql_fetch($strSql);

	// 주문건 출금신청건 정리
	$strSql = "update g5_shop_order set calculate_status='2' where od_id in (" . $pp_row['pp_od_ids'] . ")";
	sql_query($strSql);
	
	// 출금처리
	$strSql = "update g5_apms_payment set pp_confirm='1', pp_confirmtime=now() where pp_id=".$val;
	sql_query($strSql);
}

goto_url('/adm/apms_admin/apms.admin.php?ap=payment');
exit;
?>