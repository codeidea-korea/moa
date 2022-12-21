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

//NEW 모임 페이지 화면 타이틀 NEW 모임 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일) 일회성이라 없앰

//contents 영역
include_once(MOA_DETAIL_SKIN."/c_meeting.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");