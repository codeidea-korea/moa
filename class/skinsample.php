<?php
include_once("./_common.php");
//include_once("../common.php");


//로직영역
$str = "샘플페이지가 정상적으로 나와라";
//$class_skin_url = CLASS_SKIN_URL;
/*******************
 * 
 * 
 * 
 * 개발자가 처리할 영역
 */
//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");
//echo G5_PATH."<BR>";
//echo CLASS_PATH."<BR>";

include_once(CLASS_SKIN_PATH."/skinsample.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");