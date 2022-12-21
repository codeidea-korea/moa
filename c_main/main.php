<?php
include_once("./_common.php");

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/main_head.php");
//contents 영역
//$sql = "select si.*, wc.as_thumb, wc.wr_content, wc.wr_subject from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id where si.pt_plan = 1 order by wc.wr_id limit 0, 3";
$sql = "select * from g5_shop_banner where bn_position = '메인' and (bn_begin_time <= '".date('Y-m-d H:i:s')."' and bn_end_time >= '".date('Y-m-d H:i:s')."') order by bn_order asc limit 0, 3";
$main = sql_query($sql);
include_once(MOA_MAIN_SKIN."/main_slide.skin.php");
$query = "select * from g5_shop_category where ca_id LIKE '10%' order by ca_order, ca_id";
$category = sql_query($query);
// include_once(MOA_MAIN_SKIN."/menu_slide.skin.php");

$joinQuery = 'join (select wr_id, it_id, min(day) as first_day from deb_class_item group by wr_id, it_id) as deb on si.it_id = deb.it_id';
$whereQuery = "and (wc.moa_form = '자율형' or (wc.moa_form = '고정형' and deb.first_day >= '".date('Y-m-d')."')) ";


// $query2 = "select si.*, wc.as_thumb from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id where wc.moa_status = 1 and wc.moa_pick = '모아픽' group by wc.wr_id order by wc.wr_hit desc";
$query2 = "select si.*, wc.as_thumb, wc.wr_subject,wc.wr_id from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id ".$joinQuery." where wc.moa_status = 1 and wc.moa_pick = '모아픽' ".$whereQuery." group by wc.wr_id order by wc.moa_pick_time, wc.wr_hit desc";
$result2 = sql_query($query2);
include_once(MOA_MAIN_SKIN."/pick.skin.php");


// ### New 모임 Start #############################################################################################################################
$query3 = "select wc.*, si.it_id, si.it_price, si.it_cust_price from g5_write_class as wc 
			left JOIN (select it_id, it_2, it_price, it_cust_price from g5_shop_item GROUP BY it_2) as si on wc.wr_id = si.it_2 
			".$joinQuery." 
			WHERE wc.moa_status = 1
			".$whereQuery."
			order by wc.wr_id desc limit 0, 6";
$result3 = sql_query($query3);
include_once(MOA_MAIN_SKIN."/meeting.skin.php");

// $query1 = "select si.*, wc.as_thumb from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id where wc.moa_status = 1 and wc.moa_pick = '기획전' group by wc.wr_id order by wc.wr_hit desc";
// $query1 = "select si.*, wc.as_thumb,wc.wr_subject,wc.wr_id from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id ".$joinQuery." where wc.moa_status = 1 and wc.moa_pick = '기획전' ".$whereQuery." group by wc.wr_id order by wc.wr_hit desc";
$query1 = "select si.*, wc.as_thumb,wc.wr_subject,wc.wr_id from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id ".$joinQuery." where wc.moa_status = 1 and wc.ca_name = '오리지널' ".$whereQuery." group by wc.wr_id order by wc.wr_hit desc";
$result = sql_query($query1);
include_once(MOA_MAIN_SKIN."/exhibitions.skin.php");

// $sql1 = "select *, count(c.it_id) as cnt from g5_write_class a join g5_shop_item b on a.wr_id = b.it_2 join deb_class_aplyer c on b.it_id = c.it_id group by c.it_id having count(c.it_id) > 0 and wc.moa_status = 1";
$sql1 = "select *, count(player.it_id) as cnt from g5_write_class wc join g5_shop_item si on wc.wr_id = si.it_2 ".$joinQuery." join deb_class_aplyer player on si.it_id = player.it_id where 1=1 ".$whereQuery." group by player.it_id having count(player.it_id) > 0 and wc.moa_status = 1 limit 10";
$result7 = sql_query($sql1);
include_once(MOA_MAIN_SKIN."/ranking.skin.php");
// $query4 = "select si.*, wc.as_thumb, wc.moa_area1 from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id order by si.it_hit where wc.moa_status = 1 desc limit 0, 10";
$query4 = "select si.*, wc.as_thumb, wc.moa_area1,wc.wr_id from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id ".$joinQuery." where 1=1 ".$whereQuery." order by si.it_hit where wc.moa_status = 1 desc limit 0, 10";
$result4 = sql_query($query4);
include_once(MOA_MAIN_SKIN."/main_banner01.skin.php");
include_once(MOA_MAIN_SKIN."/collect.skin.php");
/*
$query6 = "select si.*, wc.as_thumb from g5_write_class as wc join g5_shop_item si on wc.wr_id = si.it_2 
join g5_apms_good a on si.it_id = a.it_id
where a.mb_id = '{$member['mb_id']}' and wc.moa_status = 1 group by si.it_2";
*/
$query6 = "select si.*, wc.as_thumb, wc.wr_subject,wc.wr_id from g5_write_class as wc join g5_shop_item si on wc.wr_id = si.it_2 
join g5_apms_good a on si.it_id = a.it_id and a.pg_flag = 'good' 
".$joinQuery." 
where a.mb_id = '{$member['mb_id']}' ".$whereQuery." and wc.moa_status = 1 group by si.it_2";
$result6 = sql_query($query6);
include_once(MOA_MAIN_SKIN."/favoritegroup.skin.php");
// $query5 = "select iu.*,wc.as_thumb from g5_shop_item_use as iu join g5_shop_item as si on iu.it_id = si.it_id join g5_write_class wc on si.it_2 = wc.wr_id where iu.is_confirm = 1 and moa_status = 1 order by iu.is_time desc limit 0, 5";
$query5 = "select iu.*,wc.as_thumb,wc.wr_id from g5_shop_item_use as iu join g5_shop_item as si on iu.it_id = si.it_id join g5_write_class wc on si.it_2 = wc.wr_id ".$joinQuery." 
where iu.is_confirm = 1 
and moa_status = 1 ".$whereQuery." 
and iu.is_score >= 4 
order by iu.is_time desc limit 0, 5";
$result5 = sql_query($query5);
include_once(MOA_MAIN_SKIN."/best_review.skin.php");
include_once(MOA_MAIN_SKIN."/main_banner02.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");
