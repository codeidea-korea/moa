<?php
include_once("./_common.php");

$wr_id = $_POST['wr_id'];
$pick = $_POST['pick'];

if(isset($pick) && $pick != '') {
    $pickTime = ', moa_pick_time = now() ';
} else {
    $pickTime = ', moa_pick_time = null ';
}
$sql = "update g5_write_class set moa_pick = '{$pick}' {$pickTime} where wr_id = '{$wr_id}'";
$result = sql_query($sql);

echo json_encode($result);