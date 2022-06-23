<?php
include_once("./_common.php");

//-----------------------------------------------
// 발송번호
$sql = "SELECT mb_hp from {$g5['member_table']} where mb_id = 'admin'";
$mb_hp = sql_fetch($sql);
$send_hp = $mb_hp['mb_hp'];
//-----------------------------------------------


$hp_no = $_POST['hp_no'];
$certino = $_POST['certino'];
$rtn = "{$hp_no}, {$certino}";
$code = "0";


if ($hp_no) {
   

    $sql = "SELECT * from {$g5['member_table']} where mb_hp = '{$hp_no}'";
    $mb = sql_fetch($sql);
    $code="5";
    if ($mb['mb_id'] != '')  {
        $sql = "SELECT * from deb_find_email WHERE ";
        $sql .=" hp_no = '{$mb['mb_hp']}' ";
        $sql .=" and status = '0' ";
        $row = sql_fetch($sql);
        $code="6";
        $rtn .= " : {$row['certitext']}";
        if ($row['certitext'] == $certino) {
            $rtn = "정상적으로 인증되었습니다.[email : {$mb['mb_email']} ]";
            $code = "1";


           
            // 수신번호
            $recv_hp = $mb['mb_hp'];
            // 인증번호
            $msg = "MOA Email찾기 Email은\n".$mb['mb_email']."\n입니다";
            $chk = smsSend($send_hp, $recv_hp, $msg);
            if ($chk) {
    
                $sql = "UPDATE deb_find_email SET ";
                $sql .= " certi_yn = 'Y' ";
                $sql .= " , certidate = now() ";
                $sql .= " , status = 1, statuschangedate = now() ";
                $sql .= " WHERE status=0 and hp_no = '{$mb['mb_hp']}'";
                sql_query($sql);
                
            }
            else {
                $rtn = "MOA Email찾기 인증문자 발송시 오류가 발생했습니다.\n관리자에게 문의하세요";
                $code="2";
            }
        }
        else {
            $rtn = "인증값이 불일치 합니다. 다시 확인하고 시도해주세요";
            $code = "9";
        }




    } 
    else {
        $rtn = "전화번호가 변경되었습니다. 다시 확인하세요.";
        $code="3";

    }
}
else {
    $rtn = "번호가 입력되지 않았습니다.";
    $code="4";
}
die("{\"msg\":\"$rtn\", \"code\":\"$code\"}");

