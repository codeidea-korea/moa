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

//MOA인증 화면 타이틀 MOA인증 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = '소속 인증하기';
//head(공통영역)
include_once(CLASS_PATH."/head.php");

//contents영역
include_once(MOA_LOGIN_SKIN."/certification.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer02.php");