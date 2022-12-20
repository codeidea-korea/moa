<?php
include_once("./_common.php");

// 타이틀 마이페이지
// $host = $member['as_partner'];

$sql = "select * from {$g5['apms_partner']} where pt_id = '{$member['mb_id']}'";
$result = sql_fetch($sql);
$prow = sql_fetch_array($result);

$host = $member['as_partner'];

$hostlink = MOA_HOSTJ_URL.'/host_join01.php';
if ($host)
    $hostlink = G5_URL."/shop/partner/";
 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = '마이페이지';
//main head(공통파일)

include_once(CLASS_PATH."/head.php");
/*
$sql = " select count(*) cnt
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."'
            order by cp_no ";
	
$result = sql_fetch($sql);

$result = array();
$result['cnt'] = 0;
*/
$sql = " select count(cp.cp_id) cnt   
            from {$g5['g5_shop_coupon_table']} cp  
            where cp.mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp.cp_start <= '".G5_TIME_YMD."'
              and cp.cp_end >= '".G5_TIME_YMD."'
              and cp.cp_id not in (
                select cp_id from {$g5['g5_shop_coupon_log_table']} where mb_id = cp.mb_id group by cp_id
              )
            order by cp_no ";
$result = sql_fetch($sql);

//contents 영역
include_once(MOA_MY_SKIN."/my_page01.skin.php");

if ($member['mb_id']!="") 
    include_once(MOA_MY_SKIN."/m_btlist.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");