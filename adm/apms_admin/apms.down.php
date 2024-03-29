<?php
include_once('./_common.php');

if(!$type) exit;

// clean the output buffer
ob_end_clean();

$filename = basename(urlencode($filename));
$filename = str_replace('../', '', $filename);

switch($type) {
	case 'main'		: $filepath = G5_DATA_PATH.'/apms/main/'.$filename; break;
	case 'page'		: $filepath = G5_DATA_PATH.'/apms/page/'.$filename; break;
	default			: exit; break;
}

$filepath = addslashes($filepath);
if (!is_file($filepath) || !file_exists($filepath))
    alert('파일이 존재하지 않습니다.');

//파일명에 한글이 있는 경우
if(preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $filename)){
    $original = iconv('utf-8', 'euc-kr', $filename); // SIR 잉끼님 제안코드
} else {
    $original = urlencode($filename);
}

if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else if (preg_match("/Firefox/i", $_SERVER['HTTP_USER_AGENT'])){
    header("content-type: file/unknown");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"".basename($filename)."\"");
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

$download_rate = 10;

while(!feof($fp)) {
    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose ($fp);
flush();
?>
