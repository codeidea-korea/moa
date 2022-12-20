<?php
include_once('./_common.php');

$mb_no = $_POST['mb_no'];

// NOTICE: 그냥 삭제하면 로직에 맞지 않으며, 동시에 관리자쪽 데이터에서 멤버 join 이 존재하면 멤버 관련 정보가 전부 null 이 되거나 모임관련 정보, 정산 정보등이 전부 안나오게 됨.
// 호스트야 탈퇴하였으니 안보여도 되지만, 관리자는 해당 회원이 탈퇴해도 관리가 되는것이 맞음.
// 기존 로직이 잘못되었으나 정책을 모르나 원칙상 소프트 딜리트를 하고, 로그인 체크나 가입시에도 mb_id 로 조인하는 것이 아니라 mb_no 로 조인하고 관리해야만 함. 
// mb_id 는 탈퇴하여도 재가입이 되어야 하지만, 같은 아이디여도 탈퇴전 사용자의 이력과 재가입 사용자 이력은 별도로 보아야 하기 때문이다.
/*
$sql = "delete from g5_member where mb_no = '{$mb_no}'";
$query = sql_query($sql);


// NOTICE: 혹시나 하드 딜리트 요청이 올 경우, 리스크 내용 전달하고 아래 내용도 추가
// sns 멤버 탈퇴시 삭제 - 재가입/연동
$sql = "delete from g5_member_social_profiles where mb_id = '{$mb['mb_id']}'";
$query = sql_query($sql);
*/
$mb = sql_fetch(" select * from g5_member where mb_no = '{$mb_no}' ", false);

if($mb['mb_apply_yn'] == 1) {
    alert('회원 탈퇴 신청중입니다. 관리자 승인후 탈퇴 처리 됩니다.');
}

$today = date("Ymd", time());
$sql = "update g5_member set mb_apply_leave_date = '{$today}', mb_apply_yn = 1 where mb_no = '{$mb_no}'";
$query = sql_query($sql);

return 'success';