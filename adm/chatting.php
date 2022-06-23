<?php
$sub_menu = "580900";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '채팅';
include_once (G5_ADMIN_PATH.'/admin.head.php');
?>
<h1>채팅 내용 필요함</h1>

<?php
include_once ('./admin.tail.php');
?>
