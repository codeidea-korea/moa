<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
//include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

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
unset($save);
unset($tot);

$sql_common_all = " FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c, g5_write_class d 
				WHERE a.od_id = b.od_id
				and b.ct_select = '1'
				and b.it_id = c.it_id 
				and c.it_2 = d.wr_id 
				and d.mb_id = '{$member['mb_id']}' 
				and a.od_status in ('입금', '완료') 
				and d.moa_status != '폐강' and d.moa_status != '5'
				and d.moa_status != '정산' and d.moa_status != '6'
				and replace(SUBSTRING(c.it_4,1,10),'.','-') < NOW() ";

$sql_common = " FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c, g5_write_class d 
				WHERE a.od_id = b.od_id
				and b.ct_select = '1'
				and b.it_id = c.it_id 
				and c.it_2 = d.wr_id 
				and d.mb_id = '{$member['mb_id']}' 
				and a.od_status in ('입금', '완료') 
				and replace(SUBSTRING(c.it_4,1,10),'.','-') < NOW() 
				and d.moa_status != '폐강' and d.moa_status != '5'
				and d.moa_status != '정산' and d.moa_status != '6'
				and SUBSTRING(a.od_time,1,10) between '$sch_startdt' and '$sch_enddt'	";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_'.MOBILE_.'page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql_order = "order by od_time desc";


$sql = "SELECT od_status, 
		a.od_time, 
		substring(a.od_time,1,10) od_date, 
		a.od_name,
		a.od_id,
		a.od_cart_price,
		a.od_pg,
		a.od_cash,
		a.od_tax_flag,
		a.od_tax_mny,
		c.it_name,
		b.it_sc_price,
		b.ct_price,
		b.ct_point,
		b.ct_point_use,
		a.od_coupon,
		a.od_cart_coupon,
		a.od_cancel_price,
		a.od_receipt_point, 
		b.ct_price - ROUND((b.ct_price * ((select pt_commission_2 from g5_apms_partner where pt_id = '{$member['mb_id']}') / 100)),2) host_price,
		(SELECT pt_commission_2 from g5_apms_partner where pt_id = '{$member['mb_id']}') commissions,
		ROUND((SELECT pt_commission_2 from g5_apms_partner where pt_id = '{$member['mb_id']}'),2) round_commissions

		$sql_common
		$sql_order
		limit $from_record, $rows ";

		
//echo nl2br($sql)."<BR>";


$result= sql_query($sql);
$list = array();
$sum = array();
for ($i=0; $row = sql_fetch_array($result);$i++) {
	$list[$i] = $row;
	if ($i == 0) {
		$sum['cart_price'] = 0;
		$sum['it_sc_price'] = 0;
		$sum['od_cart_price'] = 0;
		$sum['od_cash'] = 0;
		$sum['ct_price'] = 0;
		$sum['ct_point'] = 0;
		$sum['od_coupon'] = 0;
		$sum['od_cart_coupon'] = 0;
		$sum['od_cancel_price'] = 0;
	}
	$sum['cart_price'] += $row['od_cart_price'];
	$sum['it_sc_price'] += $row['it_sc_price'];
	$sum['od_cart_price'] += $row['od_cart_price'];
	$sum['od_cash'] += $row['od_cash'];
	$sum['ct_price'] += $row['ct_price'];
	$sum['ct_point'] += $row['ct_point'];
	$sum['od_coupon'] += $row['od_coupon'];
	$sum['od_cart_coupon'] += $row['od_cart_coupon'];
	$sum['od_cancel_price'] += $row['od_cancel_price'];
	
}

// 호스트의 수수료
$strSql = "select pt_commission_2 from g5_apms_partner where pt_id = '" . $member['mb_id'] . "'";
$commission = sql_fetch($strSql);

// 기간 내 매출 (수수료 미적용)
$strSql = "SELECT sum(b.ct_price) as sum_sales ".$sql_common;
$sales = sql_fetch($strSql);

// 기간내 매출 (수수료 적용)
$sum_sales = $sales['sum_sales'] - ($sales['sum_sales'] * $commission['pt_commission_2']) / 100;

// 전체 매출 (수수료 적용)
$strSql = "SELECT sum(b.ct_price) as sum_sales ".$sql_common_all;
$tsales = sql_fetch($strSql);
$tsum_sales = $tsales['sum_sales'] - ($tsales['sum_sales'] * $commission['pt_commission_2']) / 100;

$totsql = "SELECT 
			sum_price - (sum_price * ((select pt_commission_2 from g5_apms_partner where pt_id = '{$member['mb_id']}') / 100)) sum_price
		  FROM (
			SELECT sum(ct_price)  sum_price  
			FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c
			WHERE a.od_id = b.od_id
				and b.pt_id = '{$member['mb_id']}' 
				and b.ct_select = '1'
				and b.it_id = c.it_id
		   ) xx ";
$totrow = sql_fetch($totsql);
$totsum = $totrow['sum_price'];

// 페이징
$write_pages = (G5_IS_MOBILE) ? $config['cf_mobile_pages'] : $config['cf_write_pages'];
$list_page = './?ap='.$ap.'&amp;sca='.$sca.'&amp;sch_startdt='.$sch_startdt.'&amp;sch_enddt='.$sch_enddt.'&amp;save_stx='.$stx.'&amp;stx='.$stx.'&amp;page=';


$exceldownlink = '/shop/partner/salelistexceldownload.php?ap='.$ap.'&amp;sch_startdt='.$sch_startdt.'&amp;sch_enddt='.$sch_enddt.'&amp;sca='.$sca.'&amp;save_stx='.$stx.'&amp;stx='.$stx.'&amp;page=';

echo '<script src="./script.js"></script>'.PHP_EOL;

//print_r3($list[0]);
//print_r3($sum);
//print_r3($totsum);
include_once($skin_path.'/salelist.skin.php');
