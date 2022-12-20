<?php
include_once("./_common.php");

$mb_id = implode("','", $_POST['ids']);
$msg = $_POST['msg'];
$host = $_POST['host']?"호스트":"회원";

$sql = "update g5_apms_partner set pt_host_status = '반려' where pt_id IN ('{$mb_id}')";
$result = sql_query($sql);
$sql = "update g5_member set mb_level = 2 where mb_id IN ('{$mb_id}')";
$result = sql_query($sql);


$sql = "SELECT mb_nick, mb_email, mb_hp, mb_id FROM g5_member where mb_id IN ('{$mb_id}')";
$result = sql_query($sql);

$html = '<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>회원 승인신청 반려</title>
</head>

<body>

<div style="margin:30px auto;width:600px;">
	<div style="border:1px solid #ededed">
		<h1 style="padding:24px 30px 10px 30px;background:#fff;font-size:inherit;margin:0;border-bottom:1px solid #ccc;">
			<p style="font-size:24px;color:#111;margin-bottom: 8px;">회원 승인신청이 반려되었습니다.</p>
			<p style="margin-top:10px;font-size:16px;color:#555;font-weight: 400;">아래 반려사유를 참고해주세요.</p>
		</h1>
		<p style="margin:0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em;background:#f3f3f3">
			'.$msg.'
		</p>
		<span style="display:block;padding:25px 25px;background:#fff;text-align:center">
			<a style="padding: 8px 22px;background:#E3EF27;color:#4C4338;border-radius: 4px;" href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>
		</span>
	</div>
</div>
</body>
</html>';

$subject = '[MOA] '.$host.' 신청이 반려되었습니다.';
$body = urlencode($html);
include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");

while($row = sql_fetch_array($result)) {
    $receiver = '{"name":"'.$row['mb_nick'].'", "email":"'.$row['mb_email'].'", "mobile":"'.$row['mb_hp'].'", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}';
    $receiver = '['.$receiver.']';
    $bodytag = '0';
    $mail_type = 'NORMAL';
	sendDirectMail($subject, $body, $config['cf_admin_email'], $config['cf_admin_email_name'], $receiver, $bodytag, $mail_type);
	
	// 쪽지 INSERT
	$tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
	$me_id = $tmp_row['max_me_id'] + 1;
	$sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_read_datetime ) values 
		( '$me_id', '{$row['mb_id']}', 'admin', '".G5_TIME_YMDHIS."', $msg, '0000-00-00 00:00:00' ) ";
	sql_query($sql);
		

	if($host == "호스트")
	{
		$sql = "SELECT m.* FROM g5_member m where m.mb_id = '" . $row['mb_id'] . "'";
		$memb = sql_fetch($sql);
		$replaceText = ' [모아프렌즈] [호스트 승인 반려 알림]

		#{이름} 사원 님!
		모아 호스트 승인 요청이 반려되었습니다 :(
		
		아래 사유에 해당되는지 확인 후 다시 신청해 주세요!
		
		1. 작성해 주신 사용자 정보가 불충분해요!
		2. 회사 명함, 사업자 증빙 서류 등의 기타 증빙 사진이 선명하지 않아요!';
		$reserve_type = 'NORMAL';
		$start_reserve_time = date('Y-m-d H:i:s');
		$reciver = '{"name":"'.$memb['mb_name'].'","mobile":"'.$memb['mb_hp'].'","note1":""}';
		sendBfAlimTalk(63, $replaceText, $reserve_type, $reciver, $start_reserve_time);
	} 

    $data = $row;
}

echo json_encode($data);