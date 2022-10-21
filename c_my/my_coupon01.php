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

// 타이틀 쿠폰함

 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = '쿠폰';
//main head(공통파일)
include_once(CLASS_PATH."/head.php");
$skin_path = $member_skin_path;
$skin_url = $member_skin_url;

$sql = " select cp_id, cp_subject, cp_method, cp_target, cp_start, cp_end, cp_type, cp_price
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."'
            order by cp_no ";
$result = sql_query($sql);

$cp = array();

$k = 0;
for($i=0; $row=sql_fetch_array($result); $i++) {
    if(is_used_coupon($member['mb_id'], $row['cp_id']))
        continue;

    $cp_href = '';
    if($row['cp_method'] == 1) {
        $sql = " select ca_name from {$g5['g5_shop_category_table']} where ca_id = '{$row['cp_target']}' ";
        $ca = sql_fetch($sql);
        $cp_target = $ca['ca_name'].'의 상품할인';
        $cp_href = G5_SHOP_URL.'/list.php?ca_id='.$row['cp_target'];
    } else if($row['cp_method'] == 2) {
        $cp_target = '결제금액 할인';
    } else if($row['cp_method'] == 3) {
        $cp_target = '배송비 할인';
    } else {
        $sql = " select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['cp_target']}' ";
        $it = sql_fetch($sql);
        $cp_target = $it['it_name'].' 상품할인';
        $cp_href = G5_SHOP_URL.'/item.php?it_id='.$row['cp_target'];
    }

    if($row['cp_type'])
        $cp_price = $row['cp_price'].'%';
    else
        $cp_price = number_format($row['cp_price']).'원';

    $cp[$k] = $row;
    $cp[$k]['cp_href'] = $cp_href;
    $cp[$k]['cp_target'] = $cp_target;
    $cp[$k]['cp_price'] = $cp_price;

    $k++;
}
//contents 영역
include_once(MOA_MY_SKIN."/my_coupon01.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");