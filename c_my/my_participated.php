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

$header_title = '참여모임';
//main head(공통파일)
include_once(CLASS_PATH."/head.php");

// 2022.08.21. botbinoo, 예약 확정된 나의 모임 내역 리스트 조회
// AS-IS
/*
$sql = "select o.*, c.it_id, c.it_name, wc.as_thumb, wc.moa_onoff, i.it_time, i.it_4
       from deb_class_aplyer as o join g5_shop_cart as c on o.it_id = c.it_id join g5_shop_item as i on c.it_id = i.it_id JOIN g5_write_class wc ON i.it_2 = wc.wr_id
      where o.mb_id = '{$member['mb_id']}' and o.it_id = c.it_id and c.it_id = i.it_id 
      group by o.idx order by o.idx desc";
      */
// TO-BE

$sql = "
      select distinct 
            player.*, cart.it_id, cart.it_name, class.as_thumb, class.moa_onoff, item.it_time, item.it_4
      from deb_class_aplyer as player
            join g5_shop_cart as cart on player.it_id = cart.it_id
            join g5_shop_item as item on cart.it_id = item.it_id
            join g5_write_class as class on item.it_2 = class.wr_id
            join deb_class_item as dclass on item.it_id = dclass.it_id
      where player.mb_id = '{$member['mb_id']}'
            and player.status = '예약확정'
      order by dclass.day desc";
// end 2022.08.21. botbinoo, 예약 확정된 나의 모임 내역 리스트 조회

$result = sql_query($sql);

//contents 영역
include_once(MOA_MY_SKIN."/my_participated.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");