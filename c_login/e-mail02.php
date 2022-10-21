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
include_once(G5_LIB_PATH.'/register.lib.php');

//print_r2($_POST);
//extract($_POST);
$mb_id = $_POST['mb_id'];
$mb_email = $_POST['mb_id'];
$mb_password = $_POST['mb_password'];
$mb_password_re = $_POST['mb_password_re'];
$mb_name = $_POST['mb_name'];
$mb_nick = $_POST['mb_nick'];
$mb_hp = $_POST['mb_hp'];
$mb_birth = $_POST['mb_birth'];
////print_r2($member);
//$emailchk = '@';
//$emailchk2 = '.';
//if (strrpos($mb_id,$emailchk) === false || strrpos($mb_id,$emailchk) === false)
//    alert("이메일ID로 가입하셔야 합니다.");

// 체크
if ($msg = reserve_mb_id($mb_id))       alert($msg, "", true, true);
if ($msg = empty_mb_email($mb_email))   alert($msg, "", true, true);
if ($msg = exist_mb_hp($mb_hp, $mb_id)) alert($msg, "", true, true);
if($mb_password != $mb_password_re) alert('비밀번호가 일치하지 않습니다.');


$sql = "SELECT count(*) cnt from g5_member where mb_id = '{$mb_id}'";
$row = sql_fetch($sql);
if ($row['cnt'] > 0 || $row1['cnt'] > 0)
    alert("이미 가입된 ID입니다.", "", true, false);
//echo "--------------여기는--------<br>";
if (strrpos($mb_password, $mb_password_re) === false)
    alert("비밀번호 확인이 불일치합니다.", "", true, false);

$nick = "SELECT count(*) cnt from g5_member WHERE mb_nick = '{$mb_nick}'";
$result = sql_fetch($nick);
if($result['cnt'] > 0) {
    alert('이미 등록된 닉네임입니다.', "", true, false);
}

// 2022.09.04. botbinoo, 14세 체크 로직 추가
$year = date("Y", time());
$birthYear = isset($_POST['mb_birth']) ? $_POST['mb_birth'] : date("Y-m-d", time());
$birthYear = substr($birthYear, 0, 4);

if((int)$year - (int)$birthYear < 14) {
	alert('14세 이상만 회원가입 하실 수 있습니다.', "", true, false);
}
// end 2022.09.04. botbinoo, 14세 체크 로직 추가

if ($member['mb_id']){
    $mb_email = $member['mb_email'];
    $mb_nick = $member['mb_nick'];
    $mb_name=  $member['mb_name'];
    $mb_id = $member['mb_id'];
}
$register_action_url = "/bbs/register_form_update.php";
//contents영역
//echo MOA_LOGIN_SKIN."<BR>";
include_once(MOA_LOGIN_SKIN."/e-mail02.skin.php");
//echo "---------------여기도--------";
//푸터영역(공통파일)
include_once(CLASS_PATH."/footer02.php");