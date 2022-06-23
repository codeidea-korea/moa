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
function get_mb_img($mb_id) {
    $mb_dir = substr($mb_id,0,2);
    $icon_file_path = G5_DATA_PATH.'/member_image/'.$mb_dir.'/'.$mb_id.'.gif';
    $icon_file_url = G5_DATA_URL.'/member_image/'.$mb_dir.'/'.$mb_id.'.gif';
    if(file_exists($icon_file_path)) {
        $mb_img = '<img src="'.$icon_file_url.'" class="mb-img">';
    } else {
        $mb_img = '<span class="no-mb-img"></span>';
    }
    return $mb_img;
}
// 타이틀 참여한 모임

 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");

//contents 영역
include_once(MOA_MY_SKIN."/my_inquiry02.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");