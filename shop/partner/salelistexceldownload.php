<?php
//if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
//include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
include_once( './_common.php');
include_once(G5_LIB_PATH . '/PHPExcel.php');

function column_char($i) { return chr( 65 + $i ); }

//print_r2($_GET);

$list = array();

$sch_startdt = ($sch_startdt) ? $sch_startdt : date("Ym01", G5_SERVER_TIME);
$sch_enddt = ($sch_enddt) ? $sch_enddt : date("Ymd", G5_SERVER_TIME);
$sch_startdt = str_replace(".","-",$sch_startdt);
$sch_enddt = str_replace(".","-",$sch_enddt);
unset($save);
unset($tot);


$sql_common = " FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c, g5_write_class d 
				WHERE a.od_id = b.od_id
				and b.pt_id = '{$member['mb_id']}' 
				and b.ct_select = '1'
				and b.it_id = c.it_id
				and c.it_2 = d.wr_id 
				and a.od_status in ('입금', '완료') 
				and replace(SUBSTRING(c.it_4,1,10),'.','-') < NOW() 
				and SUBSTRING(a.od_time,1,10) between '$sch_startdt' and '$sch_enddt'	";

$sql_order = "order by od_time desc";



// 자료 생성
$headers = array('NO', '결제상태', '일자', '구매자', '주문 번호', '호스트매출', '상품명', '결제금액', '쿠폰 사용', '포인트사용');

$rows = array();


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
        ";
		//limit $from_record, $rows ";
		
//echo nl2br($sql)."<BR>";
$result= sql_query($sql);

 $num = 1;
 while ($row = sql_fetch_array($result)) {
	
	$data = array(
		$num++,
		"".$row['od_status'],
		"".$row['od_date'],
		"".$row['od_name'],
		"".$row['od_id'],
		"".number_format($row['host_price'],2),
		"".$row['it_name'],
		"".number_format($row['ct_price']),
		"".number_format($row['od_coupon']),
		"".number_format($row['od_receipt_point'])
	);

	array_push($rows, $data);
    
}

$data = array_merge(array($headers), $rows);

//print_r2($data); exit;
// 스타일 지정
$widths = array(10, 12, 15, 15, 15, 15, 30, 10, 10, 10, 10);
$header_bgcolor = 'FFABCDEF';
 
// 엑셀 생성
$last_char = column_char( count($headers) - 1 );
 
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data,NULL,'A1');
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="salelist_' . date('YmdHis') . '.xls"');
header('Cache-Control: max-age=0');

$writer->save('php://output');