<?php
include_once("./_common.php");

$wr_parent = $_POST['wr_parent'];
$answer = $_POST['answer'];
$mb_id = $_POST['mb_id'];
$wr_name = $_POST['wr_name'];

$result = array();
$result['successed'] = false;

if(empty($wr_parent) || empty($answer)){
    $result['msg'] = '답변을 작성하여주세요.';
    echo json_encode($result);
}

$reply = sql_fetch("SELECT * FROM classboard01.g5_board_new n join g5_write_qa c on n.wr_id = c.wr_id
where n.bo_table = 'qa' 
and n.wr_id != n.wr_parent 
and n.wr_parent = '{$wr_parent}'  
order by n.bn_id");

// 하나의 질의에 단 하나의 답변이 있습니다.

if(empty($reply)) {
    // insert
	$sql = " insert into g5_write_qa 
        set wr_num = '-1',
            wr_reply = '$wr_reply',
            wr_comment = 0,
            ca_name = '$ca_name',
            wr_option = '$html,$secret,$mail',
            wr_subject = '$wr_subject',
            wr_content = '$answer',
            wr_link1 = '$wr_link1',
            wr_link2 = '$wr_link2',
            wr_link1_hit = 0,
            wr_link2_hit = 0,
            wr_hit = 0,
            wr_good = 0,
            wr_nogood = 0,
            mb_id = '{$mb_id}',
            wr_password = '$wr_password',
            wr_parent = '$wr_parent',
            wr_name = '$wr_name',
            wr_email = '$wr_email',
            wr_homepage = '$wr_homepage',
            wr_datetime = '".G5_TIME_YMDHIS."',
            wr_last = '".G5_TIME_YMDHIS."',
            wr_ip = '{$_SERVER['REMOTE_ADDR']}',
            wr_1 = '$wr_1',
            wr_2 = '$wr_2',
            wr_3 = '$wr_3',
            wr_4 = '$wr_4',
            wr_5 = '$wr_5',
            wr_6 = '$wr_6',
            wr_7 = '$wr_7',
            wr_8 = '$wr_8',
            wr_9 = '$wr_9',
            wr_10 = '$wr_10',
            as_type = '0' ";
    sql_query($sql);
    $wr_id = sql_insert_id();

    sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id, as_reply, as_re_mb ) values 
    ( 'qa', '{$wr_id}', '{$wr_parent}', '".G5_TIME_YMDHIS."', '{$mb_id}', '{$wr_reply}', '{$as_re_mb}' ) ");

} else {
    // update
	$sql = " update g5_write_qa 
        set 
            wr_content = '$answer',
            mb_id = '{$mb_id}',
            wr_parent = '$wr_parent',
            wr_name = '$wr_name',
            wr_datetime = '".G5_TIME_YMDHIS."',
            wr_last = '".G5_TIME_YMDHIS."',
            as_type = '0' 
        where wr_parent = '{$wr_parent}' ";
    sql_query($sql);

    sql_query(" update {$g5['board_new_table']} set mb_id = '{$mb_id}' where wr_parent = '{$wr_parent}' ");
}

$result['successed'] = true;
echo json_encode($result);