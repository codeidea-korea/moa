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

// 타이틀 프로필 설정

 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = '내 프로필 보기';
//main head(공통파일)
include_once(CLASS_PATH."/head.php");

//contents 영역
include_once(MOA_MY_SKIN."/my_page05.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer02.php");