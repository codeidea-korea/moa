<?php
include_once("./_common.php");

$data = array();

/*
$query = "select * from g5_shop_item as i join g5_write_class as c on i.it_2 = c.wr_id 
        join deb_class_item as ci on c.wr_id = ci.wr_id 
        where i.it_id = '" . $it_id . "' order by i.it_id desc";
*/
$query = "select i.it_name, i.it_time, i.it_id, i.it_4, c.wr_2, c.wr_1, 
        (select count(idx) as tot from deb_class_aplyer where wr_id=".$_POST['wr_id']." and status='예약확정') as tot
        from g5_shop_item as i join g5_write_class as c on i.it_2 = c.wr_id 
        join deb_class_item as ci on c.wr_id = ci.wr_id 
        where i.it_2=".$_POST['wr_id']. " group by i.it_id order by ci.cls_no asc";
$result = sql_query($query);
$list=  array();
while ($row = sql_fetch_array($result)) {
    $list[] = $row;
}
$data['moims'] = $list;

$info = getAplyerMoaClass($_POST['wr_id']);  // 모임 신청자 목록

$data['info'] = $info;
echo json_encode($data);