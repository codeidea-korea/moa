<?php
include_once('./_common.php');


if (!isset($cid))
	$cid = isset($_REQUEST['cid']);

$channels = apms_member($cid);
//if (!$is_member)
//    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_BBS_URL."/celeb.php"));

$mb_homepage = set_http(clean_xss_tags($channels['mb_homepage']));
$mb_profile = ($channels['mb_profile']) ? conv_content($channels['mb_profile'],0) : '';
$mb_signature = ($channels['mb_signature']) ? apms_content(conv_content($channels['mb_signature'], 1)) : '';

// Page ID
$pid = ($pid) ? $pid : 'channel';
$at = apms_page_thema($pid);
include_once(G5_LIB_PATH.'/apms.thema.lib.php');

// 스킨 체크
list($member_skin_path, $member_skin_url) = apms_skin_thema('member', $member_skin_path, $member_skin_url); 

// 설정값 불러오기
$is_channel_sub = false;
@include_once($member_skin_path.'/config.skin.php');

$g5['title'] = $member['mb_nick'].'님 채널';

if($is_channel_sub) {
	include_once(G5_PATH.'/head.sub.php');
	if(!USE_G5_THEME) @include_once(THEMA_PATH.'/head.sub.php');
} else {
	include_once('./_head.php');
}

$skin_path = $member_skin_path;
$skin_url = $member_skin_url;

// 스킨설정
$wset = (G5_IS_MOBILE) ? apms_skin_set('member_mobile') : apms_skin_set('member');

$setup_href = '';
if(is_file($skin_path.'/setup.skin.php') && ($is_demo || $is_designer)) {
	$setup_href = './skin.setup.php?skin=member&amp;ts='.urlencode(THEMA);
}

include_once($skin_path.'/channel.skin.php');

if($is_channel_sub) {
	if(!USE_G5_THEME) @include_once(THEMA_PATH.'/tail.sub.php');
	include_once(G5_PATH.'/tail.sub.php');
} else {
	include_once('./_tail.php');
}
?>