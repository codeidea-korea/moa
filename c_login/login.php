<?php
include_once("./_common.php");


//로직영역
$str = "샘플페이지가 정상적으로 나와라";
/*******************
 * 
 * 
 * 
 * 개발자가 처리할 영역
 */

//로그인 화면

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");
if ($_SESSION['ss_mb_id']){goto_url("/");}
//contents영역
// MOA_LOGIN_SKIN : /home/secondclass/www/skin/class/c_login
include_once(MOA_LOGIN_SKIN."/login.skin.php");
//include_once (G5_PATH."/includers.php");
//푸터영역(공통파일)
include_once(CLASS_PATH."/footer02.php");