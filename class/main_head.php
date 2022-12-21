<?php
include_once("./_common.php");


//로직영역
$title = "메인 헤드";
/*******************
 * 
 * 
 * 
 * 개발자가 처리할 영역
 */

$sql = "SELECT * FROM g5_write_class a join g5_shop_item b on a.wr_id = b.it_2 where b.it_id = '{$it_id}'";
$result = sql_fetch($sql);
include_once(CLASS_SKIN_PATH."/main_head.skin.php");
