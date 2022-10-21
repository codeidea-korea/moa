<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$til_date = date("Y-m-d H:i:s", strtotime("+5 days"));

/*
$sql_common_all = " FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c, g5_write_class d 
				WHERE a.od_id = b.od_id
				and b.ct_select = '1'
				and b.it_id = c.it_id 
				and c.it_2 = d.wr_id 
				and d.mb_id = '{$member['mb_id']}' 
				and a.od_status in ('입금', '완료') 
				and a.calculate_status = '0' 
				and replace(SUBSTRING(c.it_4,1,10),'.','-') < '" . $til_date . "'";
				*/
				/*
$sql_common_all = " FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c, g5_write_class d, deb_class_aplyer p
				WHERE a.od_id = b.od_id
				and b.ct_select = '1'
				and b.it_id = c.it_id 
				and c.it_2 = d.wr_id 
				and d.mb_id = '{$member['mb_id']}' 
				and a.od_status in ('입금', '완료') 
				and a.calculate_status = '0' 
				and replace(SUBSTRING(c.it_4,1,10),'.','-') < '" . $til_date . "'
				and a.mb_id = p.mb_id 
				and d.wr_id = p.wr_id 
				and p.status = '예약확정'
				and d.moa_status != '폐강' and d.moa_status != '5'
				and d.moa_status != '정산' and d.moa_status != '6'
				";
				*/
$sql_common_all = " FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c, g5_write_class d, (select mb_id,wr_id,it_id,status from deb_class_aplyer group by mb_id,wr_id,it_id,status) p
WHERE a.od_id = b.od_id
and b.ct_select = '1'
and b.it_id = c.it_id 
and c.it_2 = d.wr_id 
and d.mb_id = '{$member['mb_id']}' 
and a.od_status in ('입금', '완료') 
and a.calculate_status = '0' 
and replace(SUBSTRING(c.it_4,1,10),'.','-') < '" . $til_date . "'
and a.mb_id = p.mb_id and d.wr_id = p.wr_id and b.it_id = p.it_id 
and p.status = '예약확정'
and d.moa_status != '폐강' and d.moa_status != '5'
and d.moa_status != '정산' and d.moa_status != '6'
				
				";
				// and 예약확정 아닌 경우 제외
				// and 폐강이 아닌 경우 


$strSql = "select sum(od_cart_price) as sum_sales " . $sql_common_all; 
$sales = sql_fetch($strSql);

// 호스트의 정보
$strSql = "select * from g5_apms_partner where pt_id = '" . $member['mb_id'] . "'";
$host_data = sql_fetch($strSql);

// 전체 매출 (수수료 적용)
$tsum_sales = $sales['sum_sales'] - ($sales['sum_sales'] * $host_data['pt_commission_2']) / 100;

$strSql = "select group_concat(at.od_id) as od_id_list " . $sql_common_all; 
$od_id_list = sql_fetch($strSql);

@include_once($skin_path.'/payrequest.skin.php');

?>
