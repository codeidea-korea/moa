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

//모임상세 페이지 화면 [오프라인]1회성_고정형 타이틀 모임활동 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

//contents 영역
include_once(MOA_DETAIL_SKIN."/d_01slide.skin.php");
include_once(MOA_DETAIL_SKIN."/d_02title.skin.php");
include_once(MOA_DETAIL_SKIN."/d_04_3schedule.skin.php");
include_once(MOA_DETAIL_SKIN."/d_05tab.skin.php");
include_once(MOA_DETAIL_SKIN."/d_06curriculum.skin.php");
include_once(MOA_DETAIL_SKIN."/d_08infor.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer03.php");