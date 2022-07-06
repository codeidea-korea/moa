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

// 타이틀 참여한 모임

 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

$sql = "select o.*, c.it_id, c.it_name, wc.as_thumb, wc.moa_onoff, i.it_time, i.it_4
       from deb_class_aplyer as o join g5_shop_cart as c on o.it_id = c.it_id join g5_shop_item as i on c.it_id = i.it_id JOIN g5_write_class wc ON i.it_2 = wc.wr_id
      where o.mb_id = '{$member['mb_id']}' and o.it_id = c.it_id and c.it_id = i.it_id
      group by o.idx order by o.idx desc";
$result = sql_query($sql);
//contents 영역
include_once(MOA_MY_SKIN."/my_participated.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");