<?php
include_once("./_common.php");

$mb_id = $_POST['mb_id'];
$status = $_POST['status'];
if(is_array($mb_id)) {
    $mb_id = implode("','", $mb_id);
}
if($mb_id) {
    $sql = "update g5_member set mb_status = '{$status}' where mb_id in ('{$mb_id}')";
} else {
    $sql = "update g5_member set mb_status = '{$status}'";
}
$result = sql_query($sql);

echo json_encode($result);