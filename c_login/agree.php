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

//개인정보 이용동의 화면

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//head(공통영역)
include_once(CLASS_PATH."/head.php");

//contents영역
include_once(MOA_LOGIN_SKIN."/agree.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer02.php");