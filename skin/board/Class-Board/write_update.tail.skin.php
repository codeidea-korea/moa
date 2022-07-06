<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

@include_once($write_skin_path.'/write_update.tail.skin.php');


$cls_day = isset($_POST['cls_day'])?$_POST['cls_day']:"";
$cls_time = isset($_POST['cls_time'])?$_POST['cls_time']:"";
$cls_minute = isset($_POST['cls_minute'])?$_POST['cls_minute']:"";
$cls_limit = isset($_POST['cls_timelimit'])?$_POST['cls_timelimit']:"";
$cls_type = isset($_POST['cls_type'])?$_POST['cls_type']:"";
$cls_content = isset($_POST['cls_content'])?$_POST['cls_content']:"";
$cls_date_del = isset($_POST['cls_date_del'])?$_POST['cls_date_del']:"";
if ($cls_content)	{
	$cnt = count($cls_content);
	for ($i = 0; $i < $cnt;$i++) {
		
		$addsql = "";
		$sql = "SELECT * from {$g5['class_item_table']} 
				where bo_table = '{$bo_table}' 
				and wr_id = '{$wr_id}' 
				and cls_no = '{$i}' ";
		$chk = sql_fetch($sql);
		$addsql .= " {$g5['class_item_table']} set ";
		$addsql .= " type = '".$cls_type[$i]."',";
		$addsql .= " day = '".$cls_day[$i]."',";
        $addsql .= " time = '".$cls_time[$i]."',";
        $addsql .= " minite = '" . $cls_minute[$i] . "',";
        $addsql .= " timelimit = '" . $cls_limit[$i] . "',";
        $addsql .= " content = '".$cls_content[$i]."',";
		$addsql .= " tot = '".$wr_2."',";
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
			$addsql .= ", cls_no = '{$i}' ";
			$addsql2 = "";
		}
		//echo $upsql.$addsql.$addsql2."<BR>";
		sql_query($upsql.$addsql.$addsql2);
	}

}
if ($cls_date_del) {
	$cnt = count($cls_content);
	//print_r2($cls_date_del);
	for ($i = 0; $i < $cnt;$i++) {
		
		$upsql = $addsql = $addsql2 = "";

		$sql = "SELECT * from {$g5['class_item_table']} 
				where bo_table = '{$bo_table}' 
				and wr_id = '{$wr_id}' 
				and idx = '{$cls_date_del[$i]}' ";
		//echo $sql."<BR>";
		$chk = sql_fetch($sql);
		if ($chk && $chk['idx'] > 0) {
			$upsql = "DELETE ";
			$addsql .= " FROM {$g5['class_item_table']}  ";
			$addsql2 = " WHERE  idx = '{$chk['idx']}'";
			//echo $upsql.$addsql.$addsql2."<BR>";
			sql_query($upsql.$addsql.$addsql2);
		}
		
	}
		//exit;
}


	$it_id = procWrite2Item($bo_table, $wr_id);
	//lec_copy_file($bo_table, $wr_id, $it_id);
	//exit;

// 목록으로 이동하기
if($w == '' && isset($is_direct) && $is_direct) {
	if ($file_upload_msg)
		alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
	else
		goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
}

?>