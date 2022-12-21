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
        $msg = "MOA 인증번호\n".$rnum."\n입니다";
        $chk = smsSend($send_hp, $recv_hp, $msg);
        if ($chk) {

            $sql = "UPDATE deb_find_email SET ";
            $sql .= " certi_send_yn = 'Y' ";
            $sql .= " certi_senddate = now() ";
            $sql .= " WHERE no = '{$no}' ";
            sql_query($sql);
            $rtn = "MOA 인증코드를 발송했습니다.";
        }
        else {
            $rtn = "MOA 인증문자 발송시 오류가 발생했습니다.\n관리자에게 문의하세요";
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