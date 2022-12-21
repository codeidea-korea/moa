<?php
include_once("./_common.php");



// echo "<BR><BR><BR><BR><BR><BR>";
// print_r2($_REQUEST);
//로직영역
$str = "샘플페이지가 정상적으로 나와라";
/*******************
 * 
 * 
 * 
 * 개발자가 처리할 영역
 */

//프리랜서 인증중 화면 타이틀 프리랜서 인증 또는 직장인 인증 변경해야함
include_once(C_LOGIN_PATH."/member_cert_file_upload.php");
if(!$file_upload_msg) {
//헤더영역(공통파일)
    include_once(CLASS_PATH . "/header.php");

//head(공통영역)
    include_once(CLASS_PATH . "/head.php");

//contents영역
//echo C_LOGIN_PATH."<BR>";
    include_once(MOA_LOGIN_SKIN . "/certification_loading.skin.php");
//

//푸터영역(공통파일)
    include_once(CLASS_PATH . "/footer02.php");
} else {
    echo "<script>alert('" . $file_upload_msg . "');</script>";
    echo "<script>location.href='". G5_URL ."';</script>";
}