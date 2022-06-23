<?php
include_once("./_common.php");

$wr_id = $_POST['wr_id'];
$status = $_POST['status'];
if(is_array($wr_id)) {
    $wr_id = implode(',', $wr_id);
}
if($wr_id) {
    $sql = "update g5_write_class set moa_status = {$status} where wr_id in ({$wr_id})";
} else {
    $sql = "update g5_write_class set moa_status = {$status}";
}
$result = sql_query($sql);

echo json_encode($result);