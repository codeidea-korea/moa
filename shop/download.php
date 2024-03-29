<?php
include_once('./_common.php');

// clean the output buffer
ob_end_clean();

// 세션확인
$ss_name = 'ss_item_'.$pf_id;
if(!get_session($ss_name)) {
	alert("정상적인 접근이 아닙니다.");
}

if(!$pf_id) {
	alert("값이 제대로 넘어오지 않았습니다.");
}

// 상품정보
$it = apms_it($pf_id);

if(!$it['it_id']) {
	alert("존재하지 않는 자료입니다.");
}

// 다운로드
$no = (int)$no;

$file = sql_fetch(" select * from {$g5['apms_file']} where pf_id = '$pf_id' and pf_dir = '1' and pf_no = '$no' ");
if (!$file['pf_file']) {
    alert('파일 정보가 존재하지 않습니다.');
}

$filepath = G5_DATA_PATH.'/item/'.$pf_id.'/'.$file['pf_file'];
$filepath = addslashes($filepath);
if (!is_file($filepath) || !file_exists($filepath)) {
    alert('파일이 존재하지 않습니다.');
}

// 최고관리자와 판매자는 통과...
if(apms_admin($xp['xp_manager']) || ($is_member && $member['mb_id'] == $it['pt_id'])) {
	;
} else {
	if(!$file['pf_download_use']) { 
		alert("다운로드가 불가능한 파일입니다.");
	}

	if($file['pf_purchase_use']) { 

		// 비회원은 이용불가
		if($is_guest) {
			alert("회원만 다운로드 가능합니다.");
		}

		// 구매여부
		$is_purchaser = false;
		$is_remaintime = '';
		$purchase = apms_it_payment($it['it_id']);
		$is_purchaser = ($purchase['ct_qty'] > 0) ? true : false;
		if($it['pt_day'] > 0) { //기간제 상품일 경우
			$is_remaintime = strtotime($purchase['pt_datetime']) + ($it['pt_day'] * $purchase['ct_qty'] * 86400);
			$is_purchaser = ($is_remaintime >= G5_SERVER_TIME) ? true : false;
		}

		// 사용로그 
		if($is_purchaser) {
			apms_it_used($purchase['od_id'], $it['pt_id'], $it['it_id'], $it['it_name'], $file['pf_source']);
		} else if($is_remaintime) {
			alert_close("이용기간(".date("Y/m/d H:i", $is_remaintime).")이 만료되었습니다.\\n\\n재구매후 이용가능합니다.");
		} else {
			alert_close("구매가 완료된 회원만 이용가능합니다.");
		}
	} else {
		// 비회원은 이용불가
		if(!$file['pf_guest_use'] && $is_guest) {
			alert("회원만 다운로드 가능합니다.");
		}
	}

    // 다운로드 카운트 증가
    sql_query(" update {$g5['apms_file']} set pf_download = pf_download + 1 where pf_id = '$pf_id' and pf_dir = '1' and pf_no = '$no' ");
}

//파일명에 한글이 있는 경우
/*
if(preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $file['pf_source'])){
    // 2015.09.02 날짜의 파이어폭스에서 인코딩된 문자 그대로 출력되는 문제가 발생됨, 2018.12.11 날짜의 파이어폭스에서는 해당 현상이 없으므로 해당 코드를 사용 안합니다.
	$original = iconv('utf-8', 'euc-kr', $file['pf_source']); // SIR 잉끼님 제안코드
} else {
    $original = urlencode($file['pf_source']);
}
*/

$original = urlencode($file['pf_source']);

/*
// Required for some browsers 
if(ini_get('zlib.output_compression')) 
	ini_set('zlib.output_compression', 'Off');

// Determine Content Type 
$ext = apms_get_ext($original); 
switch ($ext) { 
	case 'pdf'	: $fctype = 'application/pdf'; break; 
	case 'exe'	: $fctype = 'application/octet-stream'; break; 
	case 'zip'	: $fctype = 'application/zip'; break; 
	case 'doc'	: $fctype = 'application/msword'; break; 
	case 'xls'	: $fctype = 'application/vnd.ms-excel'; break; 
	case 'ppt'	: $fctype = 'application/vnd.ms-powerpoint'; break; 
	case 'gif'	: $fctype = 'image/gif'; break; 
	case 'png'	: $fctype = 'image/png'; break; 
	case 'jpeg'	: 
	case 'jpg'	: $fctype = 'image/jpg'; break; 
	default		: $fctype = 'application/force-download'; break;
} 

header("Pragma: public");
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Cache-Control: private", false);
header("Content-Type: $fctype"); 
header("Content-Disposition: attachment; filename=\"$original\"");
header("Content-Transfer-Encoding: binary"); 
header("Content-Length: ".filesize("$filepath"));
ob_clean(); 
flush(); 
*/

if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else if (preg_match("/Firefox/i", $_SERVER['HTTP_USER_AGENT'])){
    header("content-type: file/unknown");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"".basename($file['pf_source'])."\"");
    header("content-description: php generated data");
} else {
    header("content-type: file/unknown");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen($filepath, 'rb');

// 4.00 대체
// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
//if (!fpassthru($fp)) {
//    fclose($fp);
//}

$download_rate = 10;

while(!feof($fp)) {
    //echo fread($fp, 100*1024);
    /*
    echo fread($fp, 100*1024);
    flush();
    */

    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose ($fp);
flush();
?>
