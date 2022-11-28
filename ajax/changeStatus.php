<?php
include_once("./_common.php");
include_once(G5_LIB_PATH.'/mailer.lib.php');

$wr_id = $_POST['wr_id'];
$status = $_POST['status'];
$refuse_msg = $_POST['refuse_msg'];
if(is_array($wr_id)) {
    $wr_id = implode(',', $wr_id);
}


if($status == 2) {
    
    $sql = "SELECT m.* FROM g5_write_class cl left join g5_member m on cl.mb_id = m.mb_id where cl.wr_id IN ('{$wr_id}')";
    $result = sql_query($sql);

    $html = '<!doctype html>
    <html lang="ko">
    <head>
    <meta charset="utf-8">
    <title>모임 승인신청 반려</title>
    </head>

    <body>

    <div style="margin:30px auto;width:600px;">
        <div style="border:1px solid #ededed">
            <h1 style="padding:24px 30px 10px 30px;background:#fff;font-size:inherit;margin:0;border-bottom:1px solid #ccc;">
                <p style="font-size:24px;color:#111;margin-bottom: 8px;">모임 승인신청이 반려되었습니다.</p>
                <p style="margin-top:10px;font-size:16px;color:#555;font-weight: 400;">아래 반려사유를 참고해주세요.</p>
            </h1>
            <p style="margin:0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em;background:#f3f3f3">
                '.$refuse_msg.'
            </p>
            <span style="display:block;padding:25px 25px;background:#fff;text-align:center">
                <a style="padding: 8px 22px;background:#E3EF27;color:#4C4338;border-radius: 4px;" href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>
            </span>
        </div>
    </div>
    </body>
    </html>';

    $subject = '[MOA] 모임 신청이 반려되었습니다.';
    $body = urlencode($html);
    while($row = sql_fetch_array($result)) {
        $receiver = '{"name":"'.$row['mb_nick'].'", "email":"'.$row['mb_email'].'", "mobile":"'.$row['mb_hp'].'", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}';
        $receiver = '['.$receiver.']';
        $bodytag = '0';
        $mail_type = 'NORMAL';

        sendDirectMail($subject, $body, $config['cf_admin_email'], $config['cf_admin_email_name'], $receiver, $bodytag, $mail_type);


        $tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
        $me_id = $tmp_row['max_me_id'] + 1;

        $recv_mb_id = $row['mb_id'];
        $send_mb_id = 'admin';

        $sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime ) values ( '$me_id', '{$recv_mb_id}', '{$send_mb_id}', '".G5_TIME_YMDHIS."', '모임신청이 반려되었습니다. [사유] : {$refuse_msg}', '0000-00-00 00:00:00' ) ";
        sql_query($sql);
        // 쪽지 INSERT
        /*
        // 쪽지 알림
        $sql = " update {$g5['member_table']} set mb_memo_call = '{$send_mb_id}', mb_memo_cnt = '".get_memo_not_read($recv_mb_id)."' where mb_id = '$recv_mb_id' ";
        sql_query($sql);
*/

//        $data = $row;
    }
    
    if($wr_id) {
        $sql = "update g5_write_class set moa_status = {$status}, moa_refuse_reason = '{$refuse_msg}' where wr_id in ('{$wr_id}')";
    } else {
        $sql = "update g5_write_class set moa_status = {$status}, moa_refuse_reason = '{$refuse_msg}'";
    }
    sql_query($sql);
    exit;
}


if($wr_id) {
    $sql = "update g5_write_class set moa_status = {$status} where wr_id in ('{$wr_id}')";
} else {
    $sql = "update g5_write_class set moa_status = {$status}";
}
$result = sql_query($sql);

echo json_encode($result);