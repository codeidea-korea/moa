
<?php

include_once('./_common.php');

$name = $member['mb_name'];
$nick = $member['mb_nick'];
$mb_id = $member['mb_id'];
$to_email = $com_email;
$token = getComEmailToken($mb_id, $to_email);
$to_link = G5_URL."/certi/?token=".$token;
$sql = "select ma_subject, ma_content from {$g5['mail_table']} where ma_id = '1' ";
$ma = sql_fetch($sql);

$subject = $ma['ma_subject'];



$mb_md5 = md5($mb_id.$to_email.$datetime);

$content = $ma['ma_content'];
$content = preg_replace("/{이름}/", $name, $content);
$content = preg_replace("/{닉네임}/", $nick, $content);
$content = preg_replace("/{회원아이디}/", $mb_id, $content);
$content = preg_replace("/{이메일}/", $to_email, $content);
$content = preg_replace("/{링크}/", $to_link, $content);

$content = $content . "<hr size=0><p><span style='font-size:9pt; font-familye:굴림'>▶ 더 이상 정보 수신을 원치 않으시면 [<a href='".G5_BBS_URL."/email_stop.php?mb_id={$mb_id}&amp;mb_md5={$mb_md5}' target='_blank'>수신거부</a>] 해 주십시오.</span></p>";
//$subject = '[MOA] 안녕하세요';
////$body = urlencode($str_html); //'링크 : ' . $request->down_url;
//
//
//$body = '<!doctype html>
//<html lang="ko">
//<head>
//<meta charset="utf-8">
//<title>회원정보 찾기 안내</title>
//</head>
//
//<body>
//
//<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">
//	<div style="border:1px solid #dedede">
//		<h1 style="padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em">
//			회원정보 찾기 안내
//		</h1>
//		<span style="display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right">
//			<a href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>
//		</span>
//		<p style="margin:20px 0 0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">
//			홍길동 회원님은 며칠 에 회원정보 찾기 요청을 하셨습니다.<br>
//			저희 사이트는 관리자라도 회원님의 비밀번호를 알 수 없기 때문에, 비밀번호를 알려드리는 대신 새로운 비밀번호를 생성하여 안내 해드리고 있습니다.<br>
//			아래에서 변경될 비밀번호를 확인하신 후, <span style="color:#ff3061"><strong>비밀번호 변경</strong> 링크를 클릭 하십시오.</span><br>
//			비밀번호가 변경되었다는 인증 메세지가 출력되면, 홈페이지에서 회원아이디와 변경된 비밀번호를 입력하시고 로그인 하십시오.<br>
//			로그인 후에는 정보수정 메뉴에서 새로운 비밀번호로 변경해 주십시오.
//		</p>
//		<p style="margin:0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">
//			<span style="display:inline-block;width:100px">회원아이디</span> 1234<br>
//			<span style="display:inline-block;width:100px">변경될 비밀번호</span> <strong style="color:#ff3061">12345</strong>
//		</p>
/*		<a href="<?php echo $href;?>" target="_blank" style="display:block;padding:30px 0;background:#484848;color:#fff;text-decoration:none;text-align:center">비밀번호 변경</a>*/
//	</div>
//</div>
//
//</body>
//</html>
//';
$body = urlencode($body);






$sender = 'moa@test.com';
$sender_name = 'MOA';
$receiver = '{"name":"회원님", "email":"p2squareb@gmail.com", "mobile":"01056835840", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}';
$receiver = '['.$receiver.']';
$bodytag = '0';
$mail_type = 'NORMAL'; 


$username = "codeidea";
$key = "mUJrCPVuyMOq02W";

$ch = curl_init();
$postvars = '"subject":"'.$subject.'"';
$postvars = $postvars.', "body":"'.$body.'"';
$postvars = $postvars.', "sender":"'.$sender.'"';
$postvars = $postvars.', "sender_name":"'.$sender_name.'"';
$postvars = $postvars.', "username":"'.$username.'"';
$postvars = $postvars.', "receiver":'.$receiver;

$postvars = $postvars.', "mail_type":"'.$mail_type.'"';
//$postvars = $postvars.', "bodytag":"'.$bodytag.'"';
$postvars = $postvars.', "key":"'.$key.'"';
$postvars = '{'.$postvars.'}';      //JSON 데이터

// URL
$url = "https://directsend.co.kr/index.php/api_v2/mail_change_word";

//헤더정보
$headers = array(
	"cache-control: no-cache",
	"content-type: application/json; charset=utf-8"
);

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);		//JSON 데이터
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
curl_setopt($ch,CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);

die($response);
if(curl_errno($ch)){
	echo 'Curl error: ' . curl_error($ch);

}else{
	print_R($response);
}

curl_close ($ch);

sendDirectMail($subject, urlencode($content), $config['cf_admin_email'], $config['cf_admin_email_name'], $to_email, 0, 'NORMAL');

//sendDirectMail($subject, $body, $sender, $sender_name, $receiver, $bodytag, $mail_type);
//return 'success';
?>