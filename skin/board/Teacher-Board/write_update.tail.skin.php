<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

@include_once($write_skin_path.'/write_update.tail.skin.php');

$status = isset($_POST['status'])?$_POST['status']:"";
if ($status) {
	$write_table = $g5['write_prefix'].$bo_table;
	$sql = "UPDATE {$write_table} SET status = '{$status}' where wr_id = '{$wr_id}'";
	sql_query($sql);
	if ($status == "유효") {
		$mb = get_member($write['mb_id']);
		if ($mb['mb_level'] == '2')
		$sqls = "UPDATE {$g5['member_table']} set mb_level = '3' 
				 where mb_id = '{$mb['mb_id']}' 
				 ";
		sql_query($sqls);
	}
}

$pf_title = isset($_POST['pf_title'])?$_POST['pf_title']:"";
$pf_role = isset($_POST['pf_role'])?$_POST['pf_role']:"";
if ($pf_title)	{
	$cnt = count($pf_title);
	for ($i = 0; $i < $cnt;$i++) {
		$addsql = "";
		$sql = "SELECT * from {$g5['teacher_profile_table']} 
				where bo_table = '{$bo_table}' 
				and wr_id = '{$wr_id}' 
				and bf_no = '{$i}' ";
		$chk = sql_fetch($sql);
		$addsql .= " {$g5['teacher_profile_table']} set ";
		$addsql .= " title = '".$pf_title[$i]."',";
		$addsql .= " role = '".$pf_role[$i]."',";
		$addsql .= " wr_id = '{$wr_id}',";
		$addsql .= " bo_table = '{$bo_table}',";
		$addsql .= " mb_id = '{$member['mb_id']}',";
		$addsql .= " regdate = now() ";
		if ($chk && $chk['idx'] > 0) {
			$upsql = "UPDATE ";
			$addsql2 = " WHERE  idx = '{$chk['idx']}'";
		}
		else {
			$upsql = "INSERT ";
			$addsql .= ", bf_no = '{$i}' ";
			$addsql2 = "";
		}
		sql_query($upsql.$addsql.$addsql2);
	}

}


$ph_asis = isset($_POST['ph_asis'])?$_POST['ph_asis']:"";
$ph_tobe = isset($_POST['ph_tobe'])?$_POST['ph_tobe']:"";
$ph_type = isset($_POST['ph_type'])?$_POST['ph_type']:"";
$ph_content = isset($_POST['ph_content'])?$_POST['ph_content']:"";
if ($pf_title)	{
	$cnt = count($pf_title);
	for ($i = 0; $i < $cnt;$i++) {
		$addsql = "";
		$sql = "SELECT * from {$g5['teacher_history_table']} 
				where bo_table = '{$bo_table}' 
				and wr_id = '{$wr_id}' 
				and bh_no = '{$i}' ";
		$chk = sql_fetch($sql);
		$addsql .= " {$g5['teacher_history_table']} set ";
		$addsql .= " type = '".$ph_type[$i]."',";
		$addsql .= " asis = '".$ph_asis[$i]."',";
		$addsql .= " tobe = '".$ph_tobe[$i]."',";
		$addsql .= " content = '".$ph_content[$i]."',";
		$addsql .= " wr_id = '{$wr_id}',";
		$addsql .= " bo_table = '{$bo_table}',";
		$addsql .= " mb_id = '{$member['mb_id']}',";
		$addsql .= " regdate = now() ";
		if ($chk && $chk['idx'] > 0) {
			$upsql = "UPDATE ";
			$addsql2 = " WHERE  idx = '{$chk['idx']}'";
		}
		else {
			$upsql = "INSERT ";
			$addsql .= ", bh_no = '{$i}' ";
			$addsql2 = "";
		}
		sql_query($upsql.$addsql.$addsql2);
	}

}
//exit;

// 목록으로 이동하기
if($w == '' && isset($is_direct) && $is_direct) {
	if ($file_upload_msg)
		alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
	else
		goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
}

?>