<?php
include_once("./_common.php");

$mb_id = $_POST['mb_id'];
$status = $_POST['status'];
if(is_array($mb_id)) {
    $mb_id = implode("','", $mb_id);
}
if($mb_id) {
//    $sql = "update g5_member set com_cert_yn = {$status}, mb_status = '승인' where mb_id in ('{$mb_id}')";
    // 2022-09-29. botbinoo, 최초 회원가입시 [대기->승인] 처리일때 포인트 지급 추가
    $sql = "select mb_status,mb_recommend from g5_member where mb_id in ('{$mb_id}')";
    $user = sql_fetch($sql);
    if($user['mb_status'] == '대기' && $status == '승인'){
        $config = sql_fetch("select * from {$g5['config_table']} ");
        $add_point = isset($config['cf_register_point']) && $config['cf_register_point'] > 0 ? $config['cf_register_point'] : 0;
        
        // 2022-09-29. botbinoo, 추천 회원가입시 추천받은자, 추천한자 모두 포인트 지급 추가
        if(isset($user['mb_recommend']) && $user['mb_recommend'] != ''){
            $cf_recommend_point = isset($config['cf_recommend_point']) && $config['cf_recommend_point'] > 0 ? $config['cf_recommend_point'] : 0;
            $add_point = $add_point + $cf_recommend_point;
            $sql = "update g5_member set mb_point = mb_point + {$cf_recommend_point} where mb_id in ('{$mb_recommend}')";
            $result = sql_query($sql);
        }
        $sql = "update g5_member set mb_point = mb_point + {$add_point} where mb_id in ('{$mb_id}')";
        $result = sql_query($sql);
    }

    $sql = "update g5_member set com_cert_yn = {$status}, mb_status = '{$status}' where mb_id in ('{$mb_id}')";
}
$result = sql_query($sql);

echo json_encode($result);