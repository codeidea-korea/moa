<?php
include_once("./_common.php");

$data = array();

/*
$query = "select * from g5_shop_item as i join g5_write_class as c on i.it_2 = c.wr_id 
        join deb_class_item as ci on c.wr_id = ci.wr_id 
        where i.it_id = '" . $it_id . "' order by i.it_id desc";
*/

$query = "select wr_id, wr_subject, ca_name from g5_write_class c";
$result = sql_query($query);
$list=  array();
while ($row = sql_fetch_array($result)) {
    $list[] = $row;
    $ca_name = $row['ca_name'];

    $category = sql_fetch("select ca_id, ca_name from {$g5['g5_shop_category_table']} where ca_use = '1' and ca_name = '{$ca_name}' ");
    if(!empty($category)) {
        sql_query("update {$g5['g5_shop_item_table']} set ca_id2 = '{$category['ca_id']}' where it_2 = '{$row['wr_id']}'");
    }
    sql_query("update {$g5['g5_shop_item_table']} set ca_id3 = '{$ca_name}' where it_2 = '{$row['wr_id']}'");
}

echo json_encode($list);
