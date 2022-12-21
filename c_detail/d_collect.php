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

//인기모임 모아보기 리스트 페이지 화면 타이틀 인기모임 모아보기 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

//contents 영역
include_once(MOA_MAIN_SKIN."/menu_slide02.skin.php");
include_once(MOA_DETAIL_SKIN."/d_collect.skin.php");
include_once(MOA_MAIN_SKIN."/s_menu02.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");