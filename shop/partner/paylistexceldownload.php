<?php
//include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
include_once( './_common.php');
include_once(G5_LIB_PATH . '/PHPExcel.php');

function column_char($i) { return chr( 65 + $i ); }
include_once(G5_LIB_PATH.'/apms.account.lib.php');

// APMS Config
$account = array();
$list = array();

$parter = get_partner($member['mb_id']);

//세션등록
set_session('pp_payment_id', $member['mb_id']);

$partner['pt_flag'] = apms_pay_flag($partner['pt_flag']);

//계정현황
$account = apms_balance_sheet($member['mb_id']);
$search_sql = "";
if ($_GET['sch_startdt'] != "" && $_GET['sch_enddt'] != ""){
	$search_sql = " and A.pp_datetime between '".$_GET['sch_startdt']." 00:00:00' and '".$_GET['sch_enddt']." 23:59:59' ";
}

//신청현황
$sql_common = " from g5_apms_payment A left join g5_shop_order B on A.pp_id=B.calculate_pp_id 
				where A.mb_id = '{$member['mb_id']}' 
				{$search_sql}
				";

$sql  = " select A.*, B.od_id, B.od_receipt_price $sql_common order by A.pp_id desc ";
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
	
//echo nl2br($sql)."<BR>";
$result= sql_query($sql);

// 자료 생성
$headers = array('번호', '정산상태', '주문번호', '신청일', '상품명', '호스트명', '결제금액', '수수료율', '정산수수료');



$rows = array();
 $num = 1;
 for ($i=0;$i < count($list);$i++) {
	$row = $list[$i];
	$data = array(
		"".$row['pp_num'],
		"".$row['pp_confirm'],
		"".$row['od_id'],
		"".$row['pp_date'],
		"".$row['it_name'],
		"".$row['it_brand'],
		"".number_format($row['od_receipt_price'],0),
		"".$parter['pt_commission_2'],
		"".number_format($row['commission'],2)
	);

	array_push($rows, $data);
    
}

$data = array_merge(array($headers), $rows);

//print_r2($data); exit;
// 스타일 지정
$widths = array(10, 12, 10, 12, 15, 20, 15, 15, 15, 15, 15, 20, 20);
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
header('Content-Disposition: attachment; filename="paylist_' . date('YmdHis') . '.xls"');
header('Cache-Control: max-age=0');

$writer->save('php://output');