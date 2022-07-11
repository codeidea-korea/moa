<?php
include_once("./_common.php");

$mb_id = implode("','", $_POST['ids']);
$msg = $_POST['msg'];
$host = $_POST['host']?"호스트":"회원";

$sql = "SELECT mb_nick, mb_email, mb_hp FROM g5_member where mb_id IN ('{$mb_id}')";
$result = sql_query($sql);

$subject = '[MOA] '.$host.' 신청이 반려되었습니다.';
while($row = sql_fetch_array($result)) {
    $body = $msg;
    $receiver = '{"name":"'.$row['mb_nick'].'", "email":"'.$row['mb_email'].'", "mobile":"'.$row['mb_hp'].'", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}';
    $receiver = '['.$receiver.']';
    $bodytag = '0';
    $mail_type = 'NORMAL';
    sendDirectMail($subject, $body, $config['cf_admin_email'], $config['cf_admin_email_name'], $receiver, $bodytag, $mail_type);
    $data = $row;
}

echo json_encode($data);