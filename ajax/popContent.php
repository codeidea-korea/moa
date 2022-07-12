<?php
include_once("./_common.php");

$pop_id = $_POST['id'];

$sql = "select * from g5_new_win where nw_id = '{$pop_id}'";
$result = sql_fetch($sql);

echo json_encode($result);