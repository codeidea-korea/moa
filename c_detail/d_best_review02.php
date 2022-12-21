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

//BEST 솔직 후기 리스트 페이지 화면 타이틀 BEST 솔직 후기 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");
$it_id = $_GET['it_id'];
$sql = "select iu.*,si.it_name,wc.as_thumb from g5_shop_item_use as iu join g5_shop_item as si on iu.it_id = si.it_id join g5_write_class wc on si.it_2 = wc.wr_id where iu.is_confirm = 1 and iu.it_id='{$it_id}' order by iu.is_time desc";
$result = sql_query($sql);
$img = "select as_thumb from g5_shop_item a join g5_write_class b on a.it_2 = b.wr_id where a.it_id  = '{$it_id}'";
$query = sql_fetch($img);
//contents 영역
include_once(MOA_DETAIL_SKIN."/d_best_review02.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");