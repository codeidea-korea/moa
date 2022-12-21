<?php
$sub_menu = '400820';
include_once('./_common.php');
include_once(G5_LIB_PATH . '/PHPExcel.php');

function column_char($i) { return chr( 65 + $i ); }

auth_check($auth[$sub_menu], "r");

$sql = "select * from {$g5['g5_shop_coupon_offline_table']} where co_id = '{$co_id}' ";
$co = sql_fetch($sql);

if (empty($co)) {
	alert('오프라인 쿠폰 정보가 없습니다.');
}

$sql_common = " from {$g5['g5_shop_coupon_table']} ";
$sql_search = " where (1) ";

$sql_search .= " and co_id = '{$co_id}' ";


$sql = "select * {$sql_common} {$sql_search} ";
$result = sql_query($sql);

 
// 자료 생성
$headers = array('쿠폰번호', '회원아이디', '쿠폰이름', '쿠폰종류', '적용대상', '사용시작일', '사용종료일', '할인금액/비율', '최소주문금액', '최대할인금액');
/*
$rows = array(
	array(1, 1, '한놈', 'maarten@example.com', 24),
	array(2, 1, '두시기', 'paul@example.com', 30),
	array(3, 2, '석삼', 'bill.a@example.com', 29),
	array(4, 3, '석삼', 'bill.g@example.com', 25),
);
*/
$rows = array();

while ($row = sql_fetch_array($result)) {
	switch($row['cp_method']) {
	    case '0':
	        $sql3 = " select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['cp_target']}' ";
	        $row3 = sql_fetch($sql3);
	        $cp_method = '개별상품할인';
	        $cp_target = get_text($row3['it_name']);
	        break;
	    case '1':
	        $sql3 = " select ca_name from {$g5['g5_shop_category_table']} where ca_id = '{$row['cp_target']}' ";
	        $row3 = sql_fetch($sql3);
	        $cp_method = '카테고리할인';
	        $cp_target = get_text($row3['ca_name']);
	        break;
	    case '2':
	        $cp_method = '주문금액할인';
	        $cp_target = '주문금액';
	        break;
	    case '3':
	        $cp_method = '배송비할인';
	        $cp_target = '배송비';
	        break;
	}
	
	switch($row['cp_type']) {
		case '0' :
			$cp_type = '정액할인(원)';
			$cp_price = number_format($row['cp_price']).'원';
			break;
		case '1' :
			$cp_type = '정률할인(%)';
			$cp_price = number_format($row['cp_price']).'%';
			break;
	}
	
	
	$data = array(
		$row['cp_id'],
		($row['mb_id'] ? $row['mb_id'] : '미발급'),
		$row['cp_subject'],
		$cp_method,
		$cp_target,
		$row['cp_start'],
		$row['cp_end'],
		$cp_price,
		number_format($row['cp_minimum']),
		number_format($row['cp_maximum'])
	);
	array_push($rows, $data);
}

$data = array_merge(array($headers), $rows);
 
// 스타일 지정
$widths = array(30, 20, 50, 15, 15, 15, 15, 10, 10, 10);
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
header('Content-Disposition: attachment; filename="coupon_' . date('YmdHis') . '.xls"');
header('Cache-Control: max-age=0');

$writer->save('php://output');