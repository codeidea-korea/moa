<?php
include_once("./_common.php");

$sql = "delete from deb_class_item where wr_id=".$_POST['wr_id']." and idx=".$_POST['cls_id'];
$result = sql_query($sql);

$sql = "delete from g5_shop_item where it_2=".$_POST['wr_id']." and it_7=".$_POST['cls_id'];
$result = sql_query($sql);

$subSql = "select * from deb_class_item where wr_id=".$_POST['wr_id']." order by cls_no asc";
$res = sql_query($subSql);
$i = 0;
while($row = sql_fetch_array($res)) {
    $upSql = "update deb_class_item set cls_no=".$i." where idx=".$row['idx'];
    sql_query($upSql);
    $i++;
}

echo ($result) ? 'success' : 'failed';