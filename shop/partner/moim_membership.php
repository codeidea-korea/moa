<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$wr_id = $_GET['wr_id'];
$exculusiveOutofTimeMoimWhenAdmin = '';

if($is_admin == false) {
    $afterOneDay = date('Y-m-d', strtotime("-1 hours"));
    $afterOneTime = date('H:i', strtotime("-1 hours"));
    $afterOneHour = date('Y-m-d H:i:s', strtotime("-1 hours"));
    $exculusiveOutofTimeMoimWhenAdmin = "and (c.moa_form = '자율형' or (c.moa_form = '고정형' and deb.first_day >= '".$afterOneDay."'))
        and (a.aplydate > '".$afterOneDay."' or (a.aplydate = '".$afterOneDay."' and a.aplytime > '".$afterOneTime."' )) ";
}

if($wr_id == '') {
    $query = "select distinct a.*, m.mb_name, m.mb_sex, m.mb_birth, m.mb_hp, m.job_group, m.company_name, m.mb_id as uid, i.it_name as it_name, o.od_status  
        from deb_class_aplyer a 
            left join g5_member m on m.mb_id = a.mb_id 
            left join g5_write_class c on a.wr_id = c.wr_id 
            left join g5_shop_item i on i.it_2 = a.wr_id 
            left join (
                select wr_id, it_id, min(day) as first_day from deb_class_item group by wr_id, it_id
            ) as deb on i.it_id = deb.it_id and a.wr_id = deb.wr_id 
            left join g5_shop_order o on o.od_id = a.od_id ";
    $query .= "WHERE a.it_id != '' and c.mb_id = '" . $member['mb_id'] . "' ". $exculusiveOutofTimeMoimWhenAdmin . " order by a.idx desc";
} else {
    $query = "SELECT distinct a.*, m.mb_name, m.mb_sex, m.mb_birth, m.mb_hp, m.job_group, m.company_name, m.mb_id as uid, i.it_name as it_name, o.od_status  
        FROM deb_class_aplyer a 
            LEFT JOIN g5_member m ON m.mb_id=a.mb_id 
            LEFT JOIN g5_write_class c ON a.wr_id = c.wr_id  
            left join g5_shop_item i on i.it_2 = a.wr_id 
            left join (
                select wr_id, it_id, min(day) as first_day from deb_class_item group by wr_id, it_id
            ) as deb on i.it_id = deb.it_id and a.wr_id = deb.wr_id 
            left join g5_shop_order o on o.od_id = a.od_id ";
    $query .= "WHERE a.it_id != '' and a.wr_id='" . $wr_id . "' ". $exculusiveOutofTimeMoimWhenAdmin . " order by a.idx DESC";
}
if ($member['mb_no']=="58") { print_r2($query); }
$result = sql_query($query);

// 현재 호스트인 모임 목록
$moim = "select * from g5_write_class where mb_id = '" . $member['mb_id'] . "' order by mb_id desc";
$result2 = sql_query($moim);

include_once($skin_path.'/moim_membership.skin.php');

