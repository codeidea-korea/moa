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

//

//메인 검색 클릭 시 화면 타이틀 검색 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

$word = $_GET['word'] ? $_GET['word'] : '';
if($word) {
    $sql = " select * from g5_write_class where wr_subject like '%{$word}%' or wr_content like '%{$word}%' order by wr_datetime desc";
    $query = sql_query($sql);
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