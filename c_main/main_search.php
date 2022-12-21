<?php
include_once("./_common.php");


//로직영역
$str = "샘플페이지가 정상적으로 나와라";
/*******************
 * 
 * 
 * 
 * 개발자가 처리할 영역
 * 
 * select wc.*, si.it_id from g5_write_class wc join g5_shop_item si on wc.wr_id = si.it_2 join deb_class_item as deb on si.it_id = deb.it_id 
 * where (wc.wr_subject like '%{$word}%' or wc.wr_content like '%{$word}%') and and deb.day > group by wc.wr_id order by wc.wr_datetime desc
 */

//

//메인 검색 클릭 시 화면 타이틀 검색 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

$word = $_GET['word'] ? $_GET['word'] : '';
if($word) {

    $joinQuery = 'join deb_class_item as deb on si.it_id = deb.it_id';
    $whereQuery = "and deb.day > '".date('Y-m-d')." 00:00:00'";

//    $sql = " select a.*, b.it_id from g5_write_class a join g5_shop_item b on a.wr_id = b.it_2 where a.wr_subject like '%{$word}%' or a.wr_content like '%{$word}%' group by a.wr_id order by a.wr_datetime desc";
    $sql = " select wc.*, si.it_id from g5_write_class wc join g5_shop_item si on wc.wr_id = si.it_2 ".$joinQuery." where (wc.wr_subject like '%{$word}%' or wc.wr_content like '%{$word}%') ".$whereQuery." group by wc.wr_id order by wc.wr_datetime desc";
    $query = sql_query($sql);
    //echo $sql;
    $i = 0;
    while($row = sql_fetch_array($query)) {
        $review = "select (SUM(b.is_score) / count(b.it_id)) as score, count(b.it_id) as cnt, a.it_id from g5_shop_item a join g5_shop_item_use b on a.it_id = b.it_id where a.it_2 = {$row['wr_id']}";
        $number = sql_fetch($review);
        $list[$i] = $row;
        $list[$i]['is_score'] = $number['score'] ? $number['score'] : 0;
        $list[$i]['cnt'] = $number['cnt'] ? $number['cnt'] : 0;
        $i++;
    }
}

//contents 영역
include_once(MOA_MAIN_SKIN."/main_search.skin.php");
include_once(MOA_MAIN_SKIN."/s_menu02.skin.php");

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");