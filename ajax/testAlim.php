<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");

$mb_name = "전민우";
$mb_hp = "01077564321";

{
    $replaceText = ' [모아프렌즈]
    안녕하세요. '.$mb_name.' 님
    
    모아프렌즈에
    회원가입 해주셔서 
    진심으로 감사드립니다~😊';
    $reserve_type = 'NORMAL';
    $start_reserve_time = date('Y-m-d H:i:s');
    $reciver = '{"name":"'.$mb_name.'","mobile":"'.$mb_hp.'","note1":"https://\"'.$_SERVER['HTTP_HOST'].'"}';
    sendBfAlimTalk(6, $replaceText, $reserve_type, $reciver, $start_reserve_time);
}

