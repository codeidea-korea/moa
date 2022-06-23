<?php
$sub_menu = '750300';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

if ($sfl == 'album')   {
    $view_column = " sum(a.admin_adju) admin_sum, ";
    $sql_add = " and y.album_company = x.album_company ";
}
else if ($sfl == 'singer')   {
    $view_column = " x.singer, ";
    $sql_add = " and y.singer = x.singer "; 
}
else if ($sfl == '')   {
    $view_column = " sum(a.admin_adju) admin_sum, 
                    x.singer, ";
    $sql_add = " and y.album_company = x.album_company ";
}


if ($sfl == "singer") {
    $orders = "singer";
}
if ($sfl == "album") {
    $orders = "album_company";
}

if (!$orders)
    $orders = "album_company";

$sql_order = " order by {$orders} asc ";

$sql_common_str = getSqlCommonStr($sql_order, $sfl);
$sql_common = " FROM ( {$sql_common_str } ) xx ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'album' :
            $sql_search .= " (album_compnay like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


// 주문정보
  $sql = " SELECT
                
                xx.* 
                 {$sql_common} 
                 {$sql_search} 
                 
                  ";

//echo $sql."<BR><BR>";

    $result = sql_query($sql);
$result = sql_query($sql);

if(!@sql_num_rows($result))
    alert_close('다운로드할 내역이 없습니다.');

/*================================================================================
php_writeexcel http://www.bettina-attack.de/jonny/view.php/projects/php_writeexcel/
=================================================================================*/

include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_workbook.inc.php');
include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_worksheet.inc.php');

$fname = tempnam(G5_DATA_PATH, "tmp-serialprodlist.xls");
$workbook = new writeexcel_workbook($fname);
$worksheet = $workbook->addworksheet();

// Put Excel data
       

    $data = array('No', '정산월', '가창자', '앨범명(제작사)', '국내로열티', '해외로열티', '관리자 기본정산용', '당월합계','누적합계');
    if ($sfl == 'singer'){
        $data = array('No', '정산월', '가창자', '국내로열티', '해외로열티', '관리자 기본정산용', '당월합계','누적합계');
    }
    else if ($sfl == "album") {
        $data = array('No', '정산월', '앨범명(제작사)', '국내로열티', '해외로열티', '관리자 기본정산용', '당월합계','누적합계');
    }
    $data = array_map('iconv_euckr', $data);

$col = 0;
foreach($data as $cell) {
    $worksheet->write(0, $col++, $cell);
}

for($i=1; $row=sql_fetch_array($result); $i++) {
    $row = array_map('iconv_euckr', $row);
    $j = 0;

    $worksheet->write($i, $j++, ' '.$row['no']);
    $worksheet->write($i, $j++, ' '.$row['adju_ym']);
    if ($sfl <> "album")
    $worksheet->write($i, $j++, ' '.$row['singer']);
    if ($sfl <> "singer")
    $worksheet->write($i, $j++, ' '.$row['album_company']);
    $worksheet->write($i, $j++, ' '.$row['in_royalty']);
    $worksheet->write($i, $j++, ' '.$row['out_royalty']);
    $worksheet->write($i, $j++, ' '.$row['admin_adju']);
    $worksheet->write($i, $j++, ' '.$row['adju_ym_sum']);
    $worksheet->write($i, $j++, ' '.$row['adju_sum']);
}

$workbook->close();

header("Content-Type: application/x-msexcel; name=\"adju_basic_list-".date("ymd", time()).".xls\"");
header("Content-Disposition: inline; filename=\"adju_basic_list-".date("ymd", time()).".xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>