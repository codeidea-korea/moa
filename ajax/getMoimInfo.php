<?php
include_once("./_common.php");

$it_id = $_POST['it_id'];

$query = "select * from g5_shop_item as i join g5_write_class as c on i.it_2 = c.wr_id join deb_class_item as ci on c.wr_id = ci.wr_id where i.it_id = '" . $it_id . "' order by i.it_id desc";
$result = sql_query($query);

$data = array();
while($row = sql_fetch_array($result)) {
    $data = $row;
}

$info = getAplyerMoaClass($it_id);
$su = countAplyerMoaClass($it_id);

$data['info'] = $info;
$data['su'] = $su;
echo json_encode($data);