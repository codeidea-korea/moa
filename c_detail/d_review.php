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

//main head(공통파일)
include_once(CLASS_PATH."/head.php");
$sql = "select * from g5_shop_item a join g5_write_class b on a.it_2 = b.wr_id where a.it_id = '" . $it_id . "'";
$data = sql_fetch($sql);

// 2022.08.24. botbinoo, 결제상태가 취소가 아닌 결제 고객만 리뷰 작성이 가능하도록 수정

// NOTICE: 이쪽 로직은 심플하게 고객이 자신의 모임만 결제한다는 가정이다. 
//         현재 특정 모임에 대한 고객별 결제 제한은 없지만, 일반적으로 고객 A가 자신의 모임을 결제하고 취소하는 경우,
//         최신 결제 상태가 미결제이거나 취소인지를 판단한다.
//         후기 작성에 대한 제한은 기존 정책이 어떤지 모르겠으나 요구조건에는 없다.
/*
$notCancelOrderSql = "
    SELECT orders.od_status 
    FROM g5_shop_order orders join g5_shop_cart cart ON orders.od_id = cart.od_id 
    AND cart.it_id = '".$it_id."' 
    AND orders.mb_id = '".$member['mb_id']."' 
    ORDER BY orders.od_time DESC LIMIT 1
";

$notCancelOrder = sql_fetch($notCancelOrderSql);
if(!isset($notCancelOrder) || $notCancelOrder['od_status'] == '취소'){
    alert("결제한 모임만 후기 작성이 가능합니다.");
}
*/
// needs 에 따라 오픈 
// NOTICE: 결제 횟수만큼 리뷰 작성이 가능하도록 제한. (결제자 A 가 무조건 개인 고객이 아니라 그룹/법인 고객일 수 있음)
//         원본 로직이나 스키마에는 전혀 필요없으나, 같은 모임에 대해 n 회차 결제, k 회차 결제 취소, r 회차 리뷰가 작성된 경우,
//         n - k > r 인 경우 리뷰 작성이 가능하고 k 값(결제 취소)이 증가하면 리뷰 작성이 불가하도록 제한한다.
//         예를 들어 3번 결제 하였고 리뷰가 1건 있었다. 결제 취소를 1건 하면 최종적으로는 1회의 중간 결제건이 남게 되어 중간 결제건은 리뷰 작성이 가능해야 한다.
//         반대로 2번 결제 하였고 리뷰가 없었다. 결제 취소 2건을 하면 어떤 결제도 하지 않았으므로 리뷰 작성이 불가능하다.
// count(orders.mb_id) as cnt_pay, (select player.status from deb_class_aplyer player where orders.it_2 = player.wr_id and orders.mb_id = player.mb_id) as status 
$notCancelOrderSql = "
    SELECT player.*, orders.od_id 
    FROM g5_shop_order orders join g5_shop_cart cart ON orders.od_id = cart.od_id join g5_shop_item item on item.it_id = cart.it_id 
        join deb_class_aplyer player on player.mb_id = orders.mb_id and player.wr_id = item.it_2 
    where 1=1 
    AND cart.it_id = '".$it_id."' 
    AND orders.mb_id = '".$member['mb_id']."' 
    AND orders.od_status != '취소' 
    and cart.ct_status != '주문취소' 
    order by orders.od_id desc 
";
$notCancelOrder = sql_fetch($notCancelOrderSql);

if(!isset($notCancelOrder)){
    alert("결제한 모임만 후기 작성이 가능합니다.");
}

if($notCancelOrder['status'] != '예약확정'){
    // 예약 확정이 아닌 경우 후기 작성 불가
    alert("예약 확정된 모임만 후기 작성이 가능합니다.");
}
$countCompleteOrder = sql_fetch("
SELECT count(*) as cnt 
FROM (SELECT distinct(orders.od_id) 
FROM g5_shop_order orders join g5_shop_cart cart ON orders.od_id = cart.od_id join g5_shop_item item on item.it_id = cart.it_id 
    join deb_class_aplyer player on player.mb_id = orders.mb_id and player.wr_id = item.it_2 
where 1=1 
AND cart.it_id = '".$it_id."' 
AND orders.mb_id = '".$member['mb_id']."' 
AND orders.od_status != '취소' 
and cart.ct_status != '주문취소' ) o 
");
$notCancelOrder['cnt_pay'] = $countCompleteOrder['cnt'];

$replySql = "
    SELECT count(mb_id) as cnt_reply, mb_id, it_id 
    FROM g5_shop_item_use 
    WHERE it_id = '".$it_id."' 
    AND mb_id = '".$member['mb_id']."' 
";
$reply = sql_fetch($replySql);
if(isset($reply) && $reply['cnt_reply'] >= $notCancelOrder['cnt_pay']){
    // 특정 모임 A에 대해 결제 횟수만큼 후기 작성이 가능
    alert("이미 후기 작성을 하였습니다.");
}

$target_date = date("Y-m-d H:i:s");

// moa_form 고정형인 경우 모임일자 기준
$sql = "SELECT orders.*, cart.it_id, cart.it_name, class.as_thumb, item.it_time, item.it_4 
        FROM g5_shop_order as orders join g5_shop_cart as cart on orders.od_id = cart.od_id 
            JOIN g5_shop_item as item on cart.it_id = item.it_id  
            JOIN g5_write_class class ON item.it_2 = class.wr_id 
            JOIN deb_class_item as deb on item.it_id = deb.it_id 
		where orders.mb_id = '{$member['mb_id']}' 
            AND orders.od_id = cart.od_id 
            AND cart.it_id = item.it_id 
            AND cart.it_id = '".$it_id."' 
            AND orders.od_status != '취소' 
            AND cart.ct_status != '주문취소' 
            AND orders.od_id = '{$notCancelOrder['od_id']}' 
            AND (class.moa_form = '자율형' or (class.moa_form = '고정형' and deb.day < '{$target_date}')) ";
$payed_deb_class = sql_fetch($sql);

if(!isset($payed_deb_class)){
    alert("후기 작성은 모임일자 종료후 가능합니다.");
}
// end 2022.08.24. botbinoo, 결제상태가 취소가 아닌 결제 고객만 리뷰 작성이 가능하도록 수정

//contents 영역
include_once(MOA_DETAIL_SKIN."/d_review.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");