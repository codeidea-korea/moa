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

//BEST 후기 리스트 페이지 화면 타이틀 BEST 후기 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = 'BEST 후기';
//main head(공통파일)
include_once(CLASS_PATH."/head.php");
$query = "select iu.*,si.it_name,wc.as_thumb 
from g5_shop_item_use as iu join g5_shop_item as si on iu.it_id = si.it_id join g5_write_class wc on si.it_2 = wc.wr_id 
where iu.is_confirm = 1 
and iu.is_score >= 4 
order by iu.is_time desc limit 0, 5";
$result = sql_query($query);
//contents 영역
include_once(MOA_MAIN_SKIN."/menu_slide02.skin.php");
include_once(MOA_DETAIL_SKIN."/d_best_review.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");