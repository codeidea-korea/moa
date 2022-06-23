<?php
include_once('./_common.php');
define('_INDEX_', true);

if(!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$is_index = true;
$is_main = true;

include_once('./head.sub.php');
include_once('./_head.php');
include_once(THEMA_PATH.'/assets/thema.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/apms.lib.php');


if($is_main && !$hid && !$gid ) {
	$newwin_path = (G5_IS_MOBILE) ? G5_MOBILE_PATH : G5_BBS_PATH;
	@include_once ($newwin_path.'/newwin.inc.php'); // 팝업레이어
}

// 루트 index를 쇼핑몰 index 설정했을 때
if(IS_YC && isset($default['de_root_index_use']) && $default['de_root_index_use'] && (!isset($ci) || !$ci)) {
    require_once(G5_SHOP_PATH.'/index.php');
    //return;
} else {
	if(USE_G5_THEME && defined('G5_THEME_PATH')) {
		require_once(G5_THEME_PATH.'/index.php');
		//return;
	}
	define('IS_SHOP', false);
}

require_once(G5_PATH.'/c_main/main.php');


include_once('./_tail.php');
?>
