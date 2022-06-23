<?php
//include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
include_once( './_common.php');
include_once(G5_LIB_PATH . '/PHPExcel.php');

function column_char($i) { return chr( 65 + $i ); }
include_once(G5_LIB_PATH.'/apms.account.lib.php');

// APMS Config
$account = array();
$list = array();

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

//신청현황
$sql_common = " from {$g5['apms_payment']} where mb_id = '{$member['mb_id']}' and pp_field = '0' ";

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
	
//echo nl2br($sql)."<BR>";
$result= sql_query($sql);


// 자료 생성
$headers = array('번호', '상태', '접수번호', '신청일', '출금방법', '정산유형', '신청금액', '공급가', '부가세', '제세공과', '실지급액', '메모', '비고');



$rows = array();
 $num = 1;
 for ($i=0;$i < count($list);$i++) {
	$row = $list[$i];
	$data = array(
		"".$row['pp_num'],
		"".$row['pp_confirm'],
		"".$row['pp_no'],
		"".$row['pp_date'],
		"".$row['pp_means'],
		"".$row['pp_company'],
		"".number_format($row['pp_amount'],2),
		"".number_format($row['pp_net'],2),
		"".number_format($row['pp_vat'],2),
		"".number_format($row['pp_tax'],2),
		"".number_format($row['pp_pay'],2),
		"".$row['pp_memo'],
		"".$row['pp_ans']
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