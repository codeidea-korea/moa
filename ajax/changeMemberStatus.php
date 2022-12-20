<?php
include_once("./_common.php");

$mb_id = $_POST['mb_id'];
$status = $_POST['status'];
if(is_array($mb_id)) {
    $mb_id = implode("','", $mb_id);
}
    
if($status == '승인') {
    $sql_com_cert_yn = ", com_cert_yn = '1' ";
}
if($mb_id) {
    // 2022-08-11. botbinoo, 최초 회원가입시 [대기->승인] 처리일때 포인트 지급 추가
    $sql = "select mb_status,mb_recommend from g5_member where mb_id in ('{$mb_id}')";
    $user = sql_fetch($sql);
    if($user['mb_status'] == '대기' && $status == '승인'){
        $config = sql_fetch("select * from {$g5['config_table']} ");
        $add_point = isset($config['cf_register_point']) && $config['cf_register_point'] > 0 ? $config['cf_register_point'] : 0;
        
        // 2022-08-11. botbinoo, 추천 회원가입시 추천받은자, 추천한자 모두 포인트 지급 추가
        if(isset($user['mb_recommend']) && $user['mb_recommend'] != ''){
            $cf_recommend_point = isset($config['cf_recommend_point']) && $config['cf_recommend_point'] > 0 ? $config['cf_recommend_point'] : 0;
            $add_point = $add_point + $cf_recommend_point;
            $sql = "update g5_member set mb_point = mb_point + {$cf_recommend_point} where mb_id in ('{$mb_recommend}')";
            $result = sql_query($sql);
        }
        $sql = "update g5_member set mb_point = mb_point + {$add_point} where mb_id in ('{$mb_id}')";
        $result = sql_query($sql);
    }

    include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");
    $sql = "SELECT m.* FROM g5_member m where m.mb_id in ('{$mb_id}')";
    $result = sql_query($sql);
    while($memb = sql_fetch_array($result)) {
        if($status == '반려'){
            {
                $memb = sql_fetch($sql);
                $replaceText = ' [모아프렌즈] [게스트 승인 반려 알림]
        
                #{이름} 사원 님!
                모아 게스트 승인 요청이 반려되었습니다 :(
                
                아래 사유에 해당되는지 확인 후 다시 신청해 주세요!
                
                1. 작성해 주신 사용자 정보가 불충분해요!
                2. 회사 명함, 사업자 증빙 서류 등의 기타 증빙 사진이 선명하지 않아요!';
                $reserve_type = 'NORMAL';
                $start_reserve_time = date('Y-m-d H:i:s');
                $reciver = '{"name":"'.$memb['mb_name'].'","mobile":"'.$memb['mb_hp'].'","note1":""}';
                sendBfAlimTalk(24, $replaceText, $reserve_type, $reciver, $start_reserve_time);
            }
        } else if($status == '승인'){
            {
                $sql = "SELECT m.* FROM g5_member m where m.mb_id = '" . $row['mb_id'] . "'";
                $memb = sql_fetch($sql);
                $replaceText = ' [모아프렌즈] [게스트 승인 알림]
    
                #{이름} 사원 님!
                게스트 승인이 완료되었습니다!
                
                모아에서 즐겁고 알찬 시간 보내세요 :)';
                $reserve_type = 'NORMAL';
                $start_reserve_time = date('Y-m-d H:i:s');
                $reciver = '{"name":"'.$memb['mb_name'].'","mobile":"'.$memb['mb_hp'].'","note1":""}';
                sendBfAlimTalk(21, $replaceText, $reserve_type, $reciver, $start_reserve_time);
            }
        }
    }
    $sql = "update g5_member set mb_status = '{$status}' {$sql_com_cert_yn} where mb_id in ('{$mb_id}')";
} else {
    $sql = "update g5_member set mb_status = '{$status}' {$sql_com_cert_yn} ";
}
$result = sql_query($sql);

echo json_encode($result);