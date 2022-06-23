<?php
include_once("./_common.php");


//로직영역
$str = "샘플페이지가 정상적으로 나와라";
/*******************
 * 
 * 
 * 
 * 개발자가 처리할 영역
 */

 //이메일 가입02 화면

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//head(공통영역)
include_once(CLASS_PATH."/head.php");
//print_r2($_POST);
extract($_POST);
$emailchk = '@';
$emailchk2 = '.';
if (strrpos($mb_id,$emailchk) === false || strrpos($mb_id,$emailchk) === false)
    alert("이메일ID로 가입하셔야 합니다.");

if (strrpos($mb_password, $mb_password_re) === false)
    alert("비밀번호 확인이 불일치합니다.");

if ($member){
    $mb_email = $member['mb_email'];
    $mb_nick = $member['mb_nick'];
    $mb_name=  $member['mb_name'];
    $mb_id = $member['mb_id'];
}

//contents영역
include_once(MOA_LOGIN_SKIN."/e-mail02.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer02.php");