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

//Top 랭킹 모임 리스트 페이지 화면 타이틀 Top 랭킹 모임 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

//contents 영역
include_once(MOA_MAIN_SKIN."/menu_slide02.skin.php");
include_once(MOA_DETAIL_SKIN."/d_ranking.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");