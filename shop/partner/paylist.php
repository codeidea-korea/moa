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

$partner['pt_flag'] = apms_pay_flag($partner['pt_flag']);

//계정현황
$account = apms_balance_sheet($member['mb_id']);
$search_sql = " and A.pp_datetime between '{$sch_startdt} 00:00:00' and '{$sch_enddt} 23:59:59' ";
//신청현황
$sql_common = " from g5_apms_payment A left join g5_shop_order B on A.pp_id=B.calculate_pp_id 
				where A.mb_id = '{$member['mb_id']}' 
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

$sql  = " select A.*, B.od_id, B.od_receipt_price $sql_common order by A.pp_id desc limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$list[$i] = $row;
	$list[$i]['pp_num'] = $total_count - ($page - 1) * $rows - $i;
	$list[$i]['pp_date'] = date("Y.m.d H:i", strtotime($row['pp_datetime']));

	switch($row['pp_confirm']) {
		case '1'	: $pp_confirm = '완료'; break;
		case '2'	: $pp_confirm = '취소'; break;
		default		: $pp_confirm = '신청'; break;
	}
	$list[$i]['pp_confirm'] = $pp_confirm;

	$sql = "select I.it_name, I.it_brand from g5_shop_cart C left join g5_shop_item I on C.it_id=I.it_id where C.od_id=".$row['od_id'];
	$it = sql_fetch($sql);
	$list[$i]['it_name'] = $it['it_name'];
	$list[$i]['it_brand'] = $it['it_brand'];

	$commission = ($row['od_receipt_price'] * $partner['pt_commission_2']) / 100;
	$list[$i]['commission'] = $commission;
}

// 페이징
$write_pages = (G5_IS_MOBILE) ? $config['cf_mobile_pages'] : $config['cf_write_pages'];
$list_page = './?ap='.$ap.'&amp;page=';
$action_url = './payconfirm.php';

$exceldownlink = '/shop/partner/paylistexceldownload.php?sch_startdt='.$sch_startdt.'&sch_enddt='.$sch_enddt;

@include_once($skin_path.'/paylist.skin.php');

?>
