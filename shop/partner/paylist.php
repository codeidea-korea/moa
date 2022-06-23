<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/apms.account.lib.php');

// APMS Config
$account = array();
$list = array();

$rday = getSearchDays();

$parter = get_partner($member['mb_id']);

if ($sch_startdt =="") 
	$sch_startdt = $rday['year1ago'];
if ($sch_enddt =="") 
	$sch_enddt = $rday['today'];

$sch_startdt = ($sch_startdt) ? $sch_startdt : $rday['year1ago'];
$sch_enddt = ($sch_enddt) ? $sch_enddt : $rday['today'];
$sch_startdt = str_replace(".","-",$sch_startdt);
$sch_enddt = str_replace(".","-",$sch_enddt);


//세션등록
set_session('pp_payment_id', $member['mb_id']);

$pp_limit = '';
if($apms['apms_payment_limit']) {
	if($apms['apms_payment_day']) {
		$pp_limit = '매주 '.$apms['apms_payment_limit'].'요일만 출금신청이 가능합니다.';
	} else {
		$pp_limit = '매월 '.$apms['apms_payment_limit'].'일만 출금신청이 가능합니다.';
	}
}

$partner['pt_flag'] = apms_pay_flag($partner['pt_flag']);

//계정현황
$account = apms_balance_sheet($member['mb_id']);
$search_sql = " and pp_datetime between '{$sch_startdt} 00:00:00' and '{$sch_enddt} 23:59:59' ";
//신청현황
$sql_common = " from {$g5['apms_payment']} 
				where mb_id = '{$member['mb_id']}' 
				and pp_field = '0' 
				{$search_sql}
				";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_'.MOBILE_.'page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select * $sql_common order by pp_id desc limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$list[$i] = $row;
	$list[$i]['pp_num'] = $total_count - ($page - 1) * $rows - $i;
	$list[$i]['pp_no'] = $row['pp_id'];
	$list[$i]['pp_date'] = date("Y/m/d H:i", strtotime($row['pp_datetime']));

	switch($row['pp_means']) {
		case '1'	: $pp_means = AS_MP.'전환'; break;
		default		: $pp_means = '통장입금'; break;
	}
	$list[$i]['pp_means'] = $pp_means;

	switch($row['pp_confirm']) {
		case '1'	: $pp_confirm = '완료'; break;
		case '2'	: $pp_confirm = '취소'; break;
		default		: $pp_confirm = '신청'; break;
	}
	$list[$i]['pp_confirm'] = $pp_confirm;

	$list[$i]['pp_memo'] = conv_content(trim($row['pp_memo']), 0);
	$list[$i]['pp_memo'] = str_replace("\"", "'", $list[$i]['pp_memo']);
	$list[$i]['pp_ans'] = conv_content(trim($row['pp_ans']), 0);
	$list[$i]['pp_ans'] = str_replace("\"", "'", $list[$i]['pp_ans']);

	list($net, $vat) = apms_vat($row['pp_amount']);

	$list[$i]['pp_net'] = $net;
	$list[$i]['pp_vat'] = $vat;
}

// 페이징
$write_pages = (G5_IS_MOBILE) ? $config['cf_mobile_pages'] : $config['cf_write_pages'];
$list_page = './?ap='.$ap.'&amp;page=';
$action_url = './payconfirm.php';

$exceldownlink = '/shop/partner/paylistexceldownload.php?&amp;sca='.$sca.'&amp;save_stx='.$stx.'&amp;stx='.$stx.'&amp;page=';

@include_once($skin_path.'/paylist.skin.php');

?>
