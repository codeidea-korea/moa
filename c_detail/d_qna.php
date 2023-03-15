<?php
include_once("./_common.php");

if($is_guest)
    alert('회원이시라면 로그인 후 이용해 보십시오.', '/c_login/login.php?url='.urlencode(G5_URL.'/shop/item.php?it_id=' . $_POST['it_id']));
    
//로직영역
$str = "샘플페이지가 정상적으로 나와라";
/*******************
 *
 *
 *
 * 개발자가 처리할 영역
 */

//BEST 후기 리스트 페이지 화면 타이틀 BEST 후기 변경해야함

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");
$sql = "select * from g5_shop_item a join g5_write_class b on a.it_2 = b.wr_id where a.it_id = '" . $it_id . "'";
$data = sql_fetch($sql);
//contents 영역
include_once(MOA_DETAIL_SKIN."/d_qna.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");