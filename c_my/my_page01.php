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

// 타이틀 마이페이지
$host = $member['as_partner'];
$hostlink = MOA_HOSTJ_URL.'/host_join01.php';
if ($host)
    $hostlink = G5_URL."/shop/partner/";
 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");
$sql = " select count(*) cnt
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."'
            order by cp_no ";
$result = sql_fetch($sql);
//contents 영역
include_once(MOA_MY_SKIN."/my_page01.skin.php");

if ($member['mb_id']!="") 
    include_once(MOA_MY_SKIN."/m_btlist.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");