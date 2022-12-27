<?php
include_once("./_common.php");

//-----------------------------------------------
// 발송번호
$sql = "SELECT mb_hp from {$g5['member_table']} where mb_id = 'admin'";
$mb_hp = sql_fetch($sql);
$send_hp = $mb_hp['mb_hp'];
//-----------------------------------------------

$hp_no = $_POST['hp_no'];
$rtn = "";

if ($hp_no) {

    
    $hp_no = str_replace('-', '', $hp_no);
    $sql = "SELECT * from {$g5['member_table']} where mb_hp = '{$hp_no}'";
    $mb = sql_fetch($sql);

    if ($mb['mb_id'] != '')  {
        $sql = "UPDATE deb_find_email SET status = 4, statuschangedate = now() WHERE status=0 and hp_no = '{$mb['mb_hp']}' ";
        sql_query($sql);
        $rnum = get_random_num();
        $sql = "INSERT into deb_find_email SET ";
        $sql .=" hp_no = '{$mb['mb_hp']}' ";
        $sql .=" , certitext = '{$rnum}' ";
        $sql .=" , mb_id = '{$mb['mb_id']}' ";
        $sql .=" , email = '{$mb['mb_email']}' ";
        $sql .=" , regdate = now() ";
        sql_query($sql);
        $no = sql_insert_id();

        
        // 수신번호
        $recv_hp = $mb['mb_hp'];
        // 인증번호
        $msg = "MOA Email 찾기 인증번호 ".$rnum."입니다";
        //chk = smsSend($send_hp, $recv_hp, $msg);
        $receiver = '[{"name":"none","mobile":"'.$recv_hp.'","note1":"","note2":"","note3":"","note4":"","note5":""}]';




        $subject = "[MOA] 요청하신 인증번호입니다.";
        $body = '<!doctype html>
        <html lang="ko">
        <head>
        <meta charset="utf-8">
        <title>회원정보 찾기 안내</title>
        </head>

        <body>

        <div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">
            <div style="border:1px solid #dedede">
                <h1 style="padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em">
                    회원정보 찾기 안내
                </h1>
                <span style="display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right">
                    <a href="'.G5_URL.'" target="_blank">MOA</a>
                </span>
                <p style="margin:20px 0 0;padding:30px 30px 30px;border-bottom:1px solid #eee;line-height:1.7em">
                    MOA Email 찾기 인증번호 '.$rnum.'입니다.
                </p>
            </div>
        </div>
        </body>
        </html>';
        $body = urlencode($body); //'링크 : ' . $request->down_url;
        $receiver = '{"name":"'.$mb['mb_name'].'", "email":"'.$mb['mb_email'].'", "mobile":"'.$mb['mb_hp'].'", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}';
        $receiver = '['.$receiver.']';
        $bodytag = '0';
        $mail_type = 'NORMAL';


        $chk = sendDirectMail($subject, $body, 'greenpasskorea@gmail.com', 'moa-admin', $receiver, 0, 'NORMAL');
        if ($chk) {
            $sql = "UPDATE deb_find_email SET ";
            $sql .= " certi_send_yn = 'Y' ";
            $sql .= " certi_senddate = now() ";
            $sql .= " WHERE no = '{$no}' ";
            sql_query($sql);
            $rtn = "MOA Email찾기의 인증코드를 발송했습니다.";
        }
        else {
            $rtn = "MOA Email찾기 인증문자 발송시 오류가 발생했습니다.\n관리자에게 문의하세요";
        }

    } 
    else {
        $rtn = "입력하신 번호는 없는 번호입니다.";

    }
}
else {
    $rtn = "번호가 입력되지 않았습니다.";
}
//die("{\"data\":\"$rtn\"}");
die($rtn);