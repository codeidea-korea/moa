<?php
include_once('./_common.php');
//include_once('./admin.head.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');


$html_title = '회원인증메일 발송';



$countgap = 10; // 몇건씩 보낼지 설정
$maxscreen = 500; // 몇건씩 화면에 보여줄건지?
$sleepsec = 200;  // 천분의 몇초간 쉴지 설정

$com_email = trim($_POST['com_email']);
$emailchk = '@';
$emailchk2 = '.';
//alert($com_email);
//echo $com_email."<BR>";
if (strrpos($com_email,$emailchk) === false || strrpos($com_email,$emailchk) === false)
    alert($com_email."정상적인 Email로 신청하세요.", G5_URL."/c_login/certification_rectal.php");
//print_r2($_POST); EXIT;
//$member_list = explode("\n", conv_unescape_nl($select_member_list));

$name = $member['mb_name'];
$nick = $member['mb_nick'];
$mb_id = $member['mb_id'];
$to_email = $com_email;
$token = getComEmailToken($mb_id, $to_email);
$to_link = G5_URL."/certi/?token=".$token;

function getComEmailToken($mb_id, $to_email) {
    global $g5;
    
    $keychk = 1;
    while ($keychk) {
        $key = get_random_str();
        $keychk = checkCertiTokenDup($key);
    }

    $sql = "UPDATE deb_certi_mail set cert_yn = 2 where mb_id = '{$mb_id}' and cert_yn = 0 ";
    sql_query($sql);

    $sql = "INSERT INTO deb_certi_mail set";
    $sql .= " mb_id = '{$mb_id}'";
    $sql .= ", to_email = '{$to_email}'";
    $sql .= ", cert_token = '{$key}'";
    sql_query($sql);
    return $key;
}

function checkCertiTokenDup($key) {
    global $g5;

    $sql = "SELECT count(*) cnt from deb_certi_mail where cert_token = '{$key}' ";
    $row = sql_fetch($sql);
    return $row['cnt'];
}


flush();
ob_flush();


// echo "<span style='font-size:9pt;'>";
// echo "<p>메일 발송중 ...<p><font color=crimson><b>[끝]</b></font> 이라는 단어가 나오기 전에는 중간에 중지하지 마세요.<p>";
// echo "</span>";

// 메일내용 가져오기
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
        $receiver = '[{"name":"'.$nick.'", "email":"'.$to_email.'", "mobile":"", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}]';
//        $content = 'test';
//         die( $config['cf_admin_email_name']." : ". $config['cf_admin_email']." : ".  $to_email." : ".  $subject." : ".  $content." <br>");
        sendDirectMail($subject, $content, $config['cf_admin_email'], $config['cf_admin_email_name'], $receiver, 0, 'NORMAL');
        // echo "<script> document.all.cont.innerHTML += '$cnt. $to_email ($mb_id : $name)<br>'; </script>\n";
        //echo "+";
        flush();
        ob_flush();
        ob_end_flush();
        usleep($sleepsec);
//        $texts = $to_email.$subject;
        $texts = '';

// 2022.09.05. 멘트 이후 마이페이지 이동
//       alert("인증용 메일이 발송되었습니다.");
?>
<script>
    alert('인증용 메일이 발송되었습니다.');
    location.href = '/c_my/my_page01.php';
</script>
<?
// end 2022.09.05. 멘트 이후 마이페이지 이동