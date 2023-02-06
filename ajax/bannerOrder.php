<?php
include_once("./_common.php");

$order = $_POST['order'];
$bn_id = $_POST['bn_id'];
$bn_order = $_POST['bn_order'];


if($order == 'up') {
    $sql = "update g5_shop_banner set bn_order = ({$bn_order} - 1) where bn_id = {$bn_id}";
    $sql2 = "update g5_shop_banner set bn_order = {$bn_order} where bn_id != {$bn_id} and bn_order = {$bn_order}-1";
} else {
    $sql = "update g5_shop_banner set bn_order = ({$bn_order} + 1) where bn_id = {$bn_id}";
    $sql2 = "update g5_shop_banner set bn_order = {$bn_order} where bn_id != {$bn_id} and bn_order = {$bn_order}+1";

}

sql_query($sql);
sql_query($sql2);