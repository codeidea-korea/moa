<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$wr_id = $_GET['wr_id'];
if($wr_id == '') {
    $query = "select distinct a.*, m.mb_name, m.mb_id as uid, i.it_name as it_name from deb_class_aplyer a left join g5_member m on m.mb_id = a.mb_id left join g5_write_class c on a.wr_id = c.wr_id left join g5_shop_item i on i.it_2 = a.wr_id ";
    $query .= "WHERE a.it_id != '' and c.mb_id = '" . $member['mb_id'] . "' order by a.idx desc";
} else {
    $query = "SELECT distinct a.*, m.mb_name, m.mb_id as uid, i.it_name as it_name FROM deb_class_aplyer a LEFT JOIN g5_member m ON m.mb_id=a.mb_id LEFT JOIN g5_write_class c ON a.wr_id = c.wr_id  left join g5_shop_item i on i.it_2 = a.wr_id ";
    $query .= "WHERE a.it_id != '' and a.wr_id='" . $wr_id . "' order by a.idx DESC";
}
//echo $query;
$result = sql_query($query);

// 현재 호스트인 모임 목록
$moim = "select * from g5_write_class where mb_id = '" . $member['mb_id'] . "' order by mb_id desc";
$result2 = sql_query($moim);

include_once($skin_path.'/moim_membership.skin.php');

