<?php
include_once('./_common.php');

$mb_no = $_POST['mb_no'];

$sql = "delete from g5_member where mb_no = '{$mb_no}'";
$query = sql_query($sql);

return 'success';