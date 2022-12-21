<?php
include_once("./_common.php");

$nick = $_POST['nick'];

$sql = "select count(*) cnt from g5_member where mb_nick = '{$nick}'";
$result = sql_fetch($sql);

$data['cnt'] = $result['cnt'];
echo json_encode($data);