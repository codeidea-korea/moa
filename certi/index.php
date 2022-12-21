<?php
include_once("./_common.php");

$token = $_GET['token'];

$token = str_replace("'","",$token);
$token = str_replace("\"","",$token);

$sql = "SELECT * FROM deb_certi_mail where cert_token = '{$token}' limit 1 ";
$row = sql_fetch($sql);

if ($row['cert_yn']==2) {
    alert("만료된 인증입니다.",G5_URL);
}

if ($row['cert_yn']==1) {
    alert("이미 인증되었습니다.",G5_URL);
}

$sql2 = "UPDATE deb_certi_mail SET cert_yn = '1' where cert_token = '{$token}'";
sql_query($sql2);

$sql3 = "UPDATE g5_member SET com_cert_yn = '1', com_email = '{$row['to_email']}' where mb_id = '{$row['mb_id']}'";
sql_query($sql3);
//echo $sql2."<BR>".$sql3."<BR>";
alert("인증이 완료되었습니다.",G5_URL);