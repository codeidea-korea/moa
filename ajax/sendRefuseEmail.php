<?php
include_once("./_common.php");

$mb_id = implode("','", $_POST['ids']);
$msg = $_POST['msg'];
$host = $_POST['host']?"호스트":"회원";

$sql = "SELECT mb_nick, mb_email, mb_hp FROM g5_member where mb_id IN ('{$mb_id}')";
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
while($row = sql_fetch_array($result)) {
    $receiver = '{"name":"'.$row['mb_nick'].'", "email":"'.$row['mb_email'].'", "mobile":"'.$row['mb_hp'].'", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}';
    $receiver = '['.$receiver.']';
    $bodytag = '0';
    $mail_type = 'NORMAL';
    sendDirectMail($subject, $body, $config['cf_admin_email'], $config['cf_admin_email_name'], $receiver, $bodytag, $mail_type);
    $data = $row;
}

echo json_encode($data);