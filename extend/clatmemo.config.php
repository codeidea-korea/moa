<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


/******************************************************************************************
***  본 파일은  플래토의  저작물입니다.                                                  ***
***  본 파일의 내용을 허가업이 도용 / 사용할경우 저작권법에 위배됩니다.                     ***
***  허가한 사용자/업체만 사용가능하고, 다른용도로 사용/배포는 불가합니다.                  ***
***  본내용을 다른 용도를 원하실경우 저작자인 플래토 에게 구입하여 사용하시기 바랍니다.      ***
***                                                                                    ***
***                                                                                    ***
***  연락처 => 이메일 :   pletho@gmail.com   , 텔레그램 : @pletho , 카카오톡 : @pletho    ***
******************************************************************************************/



 
// ./extend/user.config.php 파일 아래내용 추가
function get_memo_not_read($mb_id)
{
    global $g5;
    $sql = " SELECT count(*) as cnt FROM {$g5['memo_table']} WHERE me_recv_mb_id = '$mb_id' and me_read_datetime like '0%' ";
    $row = sql_fetch($sql, false);
    return $row['cnt'];
}
 
// // ./bbs/ajax.memo.php 파일 (112라인)
// // 쪽지 INSERT 쿼리문을 아래 내용으로 변경
// $sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime ) values ( '$me_id', '{$recv_mb_id}', '{$send_mb_id}', '".G5_TIME_YMDHIS."', '{$me_memo}', '0000-00-00 00:00:00' ) ";
// sql_query($sql);