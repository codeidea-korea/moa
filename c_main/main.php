<?php
include_once("./_common.php");


//로직영역
$str = "샘플페이지가 정상적으로 나와라";
/*******************
 *
 *
 *
 * 개발자가 처리할 영역
 */
//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/main_head.php");
//contents 영역
//$sql = "select si.*, wc.as_thumb, wc.wr_content, wc.wr_subject from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id where si.pt_plan = 1 order by wc.wr_id limit 0, 3";
$sql = "select * from g5_shop_banner where bn_position = '메인' and (bn_begin_time <= '".date('Y-m-d H:i:s')."' and bn_end_time >= '".date('Y-m-d H:i:s')."') order by bn_id desc limit 0, 3";
$main = sql_query($sql);
include_once(MOA_MAIN_SKIN."/main_slide.skin.php");
$query = "select * from g5_shop_category where ca_id LIKE '10%' order by ca_id";
$category = sql_query($query);
include_once(MOA_MAIN_SKIN."/menu_slide.skin.php");
$query1 = "select si.*, wc.as_thumb from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id where si.pt_plan = 1 order by wc.wr_id";
$result = sql_query($query1);
include_once(MOA_MAIN_SKIN."/exhibitions.skin.php");
$query2 = "select si.*, wc.as_thumb from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id where si.pt_pick = 1 order by wc.wr_id";
$result2 = sql_query($query2);
include_once(MOA_MAIN_SKIN."/pick.skin.php");
$query3 = "select wc.*, si.it_id from g5_write_class as wc join g5_shop_item as si on wc.wr_id = si.it_2 order by wc.wr_id desc limit 0, 3";
$result3 = sql_query($query3);
include_once(MOA_MAIN_SKIN."/meeting.skin.php");
$sql1 = "select *, count(c.it_id) as cnt from g5_write_class a join g5_shop_item b on a.wr_id = b.it_2 join deb_class_aplyer c on b.it_id = c.it_id group by c.it_id having count(c.it_id) >0";
$result7 = sql_query($sql1);
include_once(MOA_MAIN_SKIN."/ranking.skin.php");
$query4 = "select si.*, wc.as_thumb, wc.moa_area1 from g5_shop_item as si join g5_write_class as wc on si.it_2 = wc.wr_id order by si.it_hit desc limit 0, 10";
$result4 = sql_query($query4);
include_once(MOA_MAIN_SKIN."/main_banner01.skin.php");
include_once(MOA_MAIN_SKIN."/collect.skin.php");
$query6 = "select si.*, wc.as_thumb from g5_write_class as wc join g5_shop_item si on wc.wr_id = si.it_2 
join g5_apms_good a on si.it_id = a.it_id 
where a.mb_id = '{$member['mb_id']}' group by si.it_2";
$result6 = sql_query($query6);
include_once(MOA_MAIN_SKIN."/favoritegroup.skin.php");
$query5 = "select iu.*,wc.as_thumb from g5_shop_item_use as iu join g5_shop_item as si on iu.it_id = si.it_id join g5_write_class wc on si.it_2 = wc.wr_id where iu.is_confirm = 1 order by iu.is_time desc limit 0, 5";
$result5 = sql_query($query5);
include_once(MOA_MAIN_SKIN."/best_review.skin.php");
include_once(MOA_MAIN_SKIN."/main_banner02.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");
