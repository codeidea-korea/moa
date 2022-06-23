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

//해시테그 클릭 시 화면 타이틀 재테크,예술,자기계발,다이어트 변경해야함

 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

//contents 영역
include_once(MOA_MAIN_SKIN."/s_menu03.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");