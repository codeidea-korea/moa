<?php
include_once("./_common.php");

$order = $_POST['order'];
$bn_id = $_POST['bn_id'];

if($order == 'up') {
    $sql = "update g5_shop_banner set bn_order = (bn_order + 1) where bn_id = {$bn_id}";
} else {
    $sql = "update g5_shop_banner set bn_order = (bn_order - 1) where bn_id = {$bn_id}";
}

sql_query($sql);
