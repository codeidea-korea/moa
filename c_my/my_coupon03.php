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

// 타이틀 포인트

 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

$query = "select * from {$g5['point_table']} where mb_id = '" . $member['mb_id'] . "'";
$result = sql_query($query);

//contents 영역
include_once(MOA_MY_SKIN."/my_coupon03.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");