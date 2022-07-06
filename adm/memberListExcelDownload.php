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

$sql_common = " FROM g5_member
				WHERE mb_datetime BETWEEN '$sch_startdt' AND '$sch_enddt' ";

if($sca || $stx) {
    $sql_common .= " AND $sca like '%$stx%'";
}


$sql_order = "order by mb_no desc";



// 자료 생성
$headers = array('NO', '승인', '호스트/게스트', '직장인/프리랜서', '회원코드', '아이디', '닉네임', '이름', '이메일', '가입일', '직장');

$rows = array();


$sql = "SELECT
        mb_status, 
        (CASE WHEN mb_level = '1' THEN '게스트' WHEN mb_level = '2' THEN '호스트' WHEN mb_level = '3' THEN '슈퍼호스트' END) AS 'mb_level',
        job_kind,
        invite_code,
        mb_id,
        mb_nick,
        mb_name,
        mb_email,
        mb_datetime,
        company_name
		$sql_common
		$sql_order
        ";
$result= sql_query($sql);
$num = 1;
while ($row = sql_fetch_array($result)) {

    $data = array(
        $num++,
        "".$row['mb_status'],
        "".$row['mb_level'],
        "".$row['job_kind'],
        "".$row['invite_code'],
        "".$row['mb_id'],
        "".$row['mb_nick'],
        "".$row['mb_name'],
        "".$row['mb_email'],
        "".$row['mb_datetime'],
        "".$row['company_name']
    );

    array_push($rows, $data);

}

$data = array_merge(array($headers), $rows);

//print_r2($data); exit;
// 스타일 지정
$widths = array(10, 12, 15, 15, 15, 15, 30, 10, 10, 10, 10,10);
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
header('Content-Disposition: attachment; filename="mamberList_' . date('YmdHis') . '.xls"');
header('Cache-Control: max-age=0');

$writer->save('php://output');