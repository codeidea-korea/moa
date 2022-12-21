<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 스킨 불러오기

$page_name = $board['bo_subject'];
//print_r2($board);
if(isset($header_skin) && $header_skin) {
	$header_skin_path = G5_SKIN_PATH.'/header/'.$header_skin;
	$header_skin_url = G5_SKIN_PATH.'/header/'.$header_skin;
	
	//echo "header_skin_path : ".$header_skin_path."<BR>";
	// 스킨 체크
	list($header_skin_path, $header_skin_url) = apms_skin_thema('header', $header_skin_path, $header_skin_url); 

	@include_once($header_skin_path.'/header.skin.php');
}

?>