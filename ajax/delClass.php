<?php
include_once("./_common.php");

$wr_id = $_POST['wr_id'];

$sql = "update g5_write_class set moa_status = '3' where wr_id = '{$wr_id}'";
$result = sql_query($sql);

echo json_encode($result);