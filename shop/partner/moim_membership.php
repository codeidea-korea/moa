<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$wr_id = $_GET['wr_id'];
if($wr_id == '') {
    $query = "select * from g5_member as m join deb_class_aplyer as a on m.mb_id = a.mb_id join g5_write_class as c on a.it_id = c.wr_10 where a.it_id != '' and c.mb_id = '" . $member['mb_id'] . "' order by a.idx desc";
} else {
    $query = "select * from g5_member as m join deb_class_aplyer as a on m.mb_id = a.mb_id join g5_write_class as c on a.it_id = c.wr_10 where a.it_id != '' and a.wr_id = '" . $wr_id . "' order by a.idx desc";
}

$result = sql_query($query);

$moim = "select * from g5_write_class where mb_id = '" . $member['mb_id'] . "' order by mb_id desc";

$result2 = sql_query($moim);
include_once($skin_path.'/moim_membership.skin.php');