<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가



// // 게시판 관리의 상단 내용
// if (G5_IS_MOBILE) {
//     // 모바일의 경우 설정을 따르지 않는다.
//     include_once(CLASS_PATH.'/_head.php');
// 	if($is_bo_content_head) {
// 	    echo html_purifier(stripslashes($board['bo_mobile_content_head']));
// 	}
// } else {
    if(is_include_path_check($board['bo_include_head'])) {  //파일경로 체크
        @include ($board['bo_include_head']);
    } else {    //파일경로가 올바르지 않으면 기본파일을 가져옴
        include_once($board_skin_path.'/_head.php');
    }
	if($is_bo_content_head) {
	    echo html_purifier(stripslashes($board['bo_content_head']));
	}
//}
