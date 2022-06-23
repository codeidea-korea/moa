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

//카테고리 페이지 화면 타이틀 카테고리 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

$category_img = array(
    "액티비티"=>"activity_ic_.svg",
    "자기개발"=>"self-development_ic_.svg",
    "힐링"=>"healing_ic_.svg",
    "문화예술"=>"culture_ic_.svg",
    "쿠킹/베이킹"=>"cooking_ic_.svg",
    "소셜링"=>"social_ic_.svg",
    "뷰티"=>"beauty_ic_.svg",
    "커리어"=>"career_ic_.svg",
    );
$sql = "SELECT * from {$g5['g5_shop_category_table']} 
            where ca_id like '10%' 
            and length(ca_id) = '4' 
            order by ca_id asc";
//echo $sql."<BR>";
$result = sql_query($sql);
//contents 영역
include_once(MOA_CATEGORY_SKIN."/category01.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");