<?php
include_once('./_common.php');
header("Content-Type: application/json; charset=utf-8");

$data = array();
$data['data'] = array();
$data['max'] = array();
$data['from_record'] = array();

$act = $_POST['act'];

//refresh
$mb_nick= $_POST['mb_nick'];
$send_mb_id= $_POST['send_mb_id'];
$recv_mb_id= $_POST['recv_mb_id'];
$max_id= intval($_POST['max_id']);

//history
$from_record = $_POST['from_record'];
$limit_record = $_POST['limit_record'];
$from_record = $from_record - $limit_record;

if($from_record < 0) {
    $limit_record = $limit_record + $from_record;
    $from_record = 0;
}

//update
//$me_memo = strip_tags($_POST['me_memo']); // 태그제거후 인서트함
$me_memo = strip_tags(nl2br($_POST['me_memo']),"<br>"); // 줄바꿈 사용하기 위해 추가


$msg = '';
$error_list  = array();
$data['error_msg'] = array();

if($act == "search_member") {
    if ($mb_nick) {
        $que = "select * from {$g5['member_table']} where mb_nick = '".$mb_nick."' and mb_level > 1";
        $data[] = sql_fetch($que);
    }
}

if ($act == "refresh") {

    if ($send_mb_id && $recv_mb_id) {
        
        //5.4 쪽지알림 부분
        $sql = " update `{$g5['member_table']}` set mb_memo_cnt = '".get_memo_not_read($member['mb_id'])."' where mb_id = '{$member['mb_id']}' ";
        sql_query($sql);
        
        //읽지 않은 쪽지가 있으면 업데이트
        $aaa = "select * from {$g5['memo_table']} where me_recv_mb_id ='".$send_mb_id."' and me_send_mb_id = '".$recv_mb_id."' and me_read_datetime = '0000-00-00 00:00:00'";
        $bbb = sql_query($aaa);
        
        //한개씩 읽은 날짜를 업데이트
        for($i=0;$ccc=sql_fetch_array($bbb);$i++) {
            $up = "update {$g5['memo_table']} set me_read_datetime = '".G5_TIME_YMDHIS."' where me_id = '".$ccc['me_id']."'";
            sql_query($up);
        }

        $sql = "select * from {$g5['memo_table']} where ((me_recv_mb_id ='".$recv_mb_id."' and me_send_mb_id = '".$send_mb_id."') or (me_recv_mb_id = '".$send_mb_id."' and me_send_mb_id = '".$recv_mb_id."')) and me_id > ".$max_id." order by me_send_datetime limit 99999";
        $res = sql_query($sql);
        for($i=0;$row=sql_fetch_array($res);$i++) {
            $data['data'][] = $row;
        }
        
       
        $que = "select max(me_id) as max from {$g5['memo_table']} where (me_recv_mb_id ='".$recv_mb_id."' and me_send_mb_id = '".$send_mb_id."') or (me_recv_mb_id = '".$send_mb_id."' and me_send_mb_id = '".$recv_mb_id."')";
        $data['max'] = sql_fetch($que);
    }
    
}


if($act == "history") {
    if ($send_mb_id && $recv_mb_id) {
        $sql = "select * from {$g5['memo_table']} where (me_recv_mb_id ='".$recv_mb_id."' and me_send_mb_id = '".$send_mb_id."') or (me_recv_mb_id = '".$send_mb_id."' and me_send_mb_id = '".$recv_mb_id."') order by me_send_datetime asc limit  {$from_record}, {$limit_record}";
        $res = sql_query($sql);
        for($i=0;$row=sql_fetch_array($res);$i++) {
            $data['data'][] = $row;
        }
        $data['from_record'] = $from_record;
    }
}

if($act == "update") {

    $row = sql_fetch(" select mb_id, mb_nick, mb_open, mb_leave_date, mb_intercept_date from {$g5['member_table']} where mb_id = '{$recv_mb_id}' ");
    
    //관리자가 아니면서 정보공개를 하지 않았거나, 탈퇴, 접근차단 인 회원일 때
    if ((!$row['mb_id'] || !$row['mb_open'] || $row['mb_leave_date'] || $row['mb_intercept_date']) && !$is_admin) {
        $data['error_msg'] = '탈퇴하거나 접근차단된 회원입니다. 대화를 시작할 수 없습니다.';
    }

    if (!$is_admin) {
        $point = (int)$config['cf_memo_send_point'];
        //포인트 체크
        // 2022.08.21. botbinoo, 쪽지 발송시 포인트 차감 로직 삭제
        /*
        if ($point) {
            if ($member['mb_point'] - $point < 0) {
                $data['error_msg'] = '보유하신 보인트가 부족하여 대화를 시작할 수 없습니다.';
            }
        }
        */
        // end 2022.08.21. botbinoo, 쪽지 발송시 포인트 차감 로직 삭제
    }

    if(!$data['error_msg']) {
        $tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
        $me_id = $tmp_row['max_me_id'] + 1;

        $recv_mb_nick = get_text($row['mb_nick']);

// ./bbs/ajax.memo.php 파일 (112라인)
        // 쪽지 INSERT 쿼리문을 아래 내용으로 변경
        $sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime ) values ( '$me_id', '{$recv_mb_id}', '{$send_mb_id}', '".G5_TIME_YMDHIS."', '{$me_memo}', '0000-00-00 00:00:00' ) ";
        sql_query($sql);
        // 쪽지 INSERT
        // $sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime, me_type, me_send_ip ) values ( '$me_id', '{$recv_mb_id}', '{$send_mb_id}', '".G5_TIME_YMDHIS."', '{$me_memo}', '0000-00-00 00:00:00', 'recv', '{$_SERVER['REMOTE_ADDR']}') ";
        // sql_query($sql);

        // 쪽지 알림
        $sql = " update {$g5['member_table']} set mb_memo_call = '{$member['mb_id']}', mb_memo_cnt = '".get_memo_not_read($recv_mb_id)."' where mb_id = '$recv_mb_id' ";
        sql_query($sql);

        // 2022.08.21. botbinoo, 쪽지 발송시 포인트 차감 로직 삭제
        /*
        if (!$is_admin) {
            insert_point($send_mb_id, (int)$config['cf_memo_send_point'] * (-1), $recv_mb_nick.'('.$recv_mb_id.')님께 쪽지 발송', '@memo', $recv_mb_id, $me_id);
            
        }
        */
        // end 2022.08.21. botbinoo, 쪽지 발송시 포인트 차감 로직 삭제
    }
}

die(json_encode($data));
?>