<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 테마 head.sub.php 파일
if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
	if(defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/head.sub.php')) {
	    require_once(G5_THEME_PATH.'/head.sub.php');
		return;
	}
} else if(USE_G5_THEME) {
	if(!defined('G5_IS_ADMIN') && defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/head.sub.php')) {
		require_once(G5_THEME_PATH.'/head.sub.php');
	    return;
	}
}

// 관리자쪽 체크...
if(!defined('_RESPONSIVE_')) {
	define('_RESPONSIVE_', true);
}

$begin_time = get_microtime();

if (isset($g5['title']) && $g5['title']) {
    $g5_head_title = $g5['title']; //.' > '.$config['cf_title'];
} else { // 상태바에 표시될 제목
	$g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="<?php echo $aslang['html_lang']; //ko ?>">
<head>
<meta charset="utf-8">
<title><?php echo $g5_head_title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, target-densitydpi=medium-dpi">
<?php
//body_mode = 'is-pc';
if (G5_IS_MOBILE) {
	$body_mode = 'is-mobile';
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
    echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
}
echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
echo '<meta http-equiv="X-UA-Compatible" content="IE=Edge">'.PHP_EOL;

echo '<link rel="shortcut icon" href="/imgs/symbol.png">';
echo '<link rel="icon" href="/imgs/symbol.png">';
echo '<link rel="apple-touch-icon" href="/imgs/favorite.png" />';

if(APMS_PRINT){  //프린트 상태일 때는 검색엔진에서 제외합니다.
	echo '<meta name="robots" content="noindex, nofollow">'.PHP_EOL;
}
if($config['cf_add_meta']) echo $config['cf_add_meta'].PHP_EOL;

// SEO META
$is_use_h1 = false;
if(!APMS_PRINT && !defined('G5_IS_ADMIN')) {
	include_once(G5_LIB_PATH.'/apms.meta.lib.php');
	$is_use_h1 = ($is_no_meta) ? false : true;
}

if (defined('G5_IS_ADMIN')) {
	if (!defined('ADMIN_SKIN_PATH')) {
		$admin_skin = $config['cf_8'];
		$admin_skin = ($admin_skin && is_file(G5_SKIN_PATH.'/admin/'.$admin_skin.'/head.php')) ? $admin_skin : 'basic';
		define('ADMIN_SKIN_PATH', G5_SKIN_PATH.'/admin/'.$admin_skin);
		define('ADMIN_SKIN_URL', G5_SKIN_URL.'/admin/'.$admin_skin);
	}
    echo '<link rel="stylesheet" href="'.ADMIN_SKIN_URL.'/css/admin.css">'.PHP_EOL;
} else {
    $shop_css = '';
    if (defined('_SHOP_')) $shop_css = '_shop';
    echo '<link rel="stylesheet" href="'.G5_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').$shop_css.'.css?ver='.APMS_SVER.'">'.PHP_EOL;
}
echo '<link rel="stylesheet" href="'.G5_CSS_URL.'/apms.css?ver='.APMS_SVER.'">'.PHP_EOL;
if($xp['xp_icon'] == 'txt') {
	echo '<link rel="stylesheet" href="'.G5_CSS_URL.'/level/'.$xp['xp_icon_css'].'.css?ver='.APMS_SVER.'">'.PHP_EOL;
}

echo '<link rel="stylesheet" href="/dist/typicons.css">';
//echo '<link rel="stylesheet" href="/dist/spectre-icons.min.css">';
//echo '<link rel="stylesheet" href="/dist/spectre-exp.min.css">';
echo '<link rel="stylesheet" href="/css/q.css">';
$_url = $_SERVER['PHP_SELF'];
if (strrpos($_url,'/adm/') === false) {
//	echo '<link rel="stylesheet" href="/dist/spectre.min.css">';
	echo '<link rel="stylesheet" href="/dist/owl.carousel.min.css">';
	//echo '<link rel="stylesheet" href="/css/cq_common.css">';
}

echo '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">';
echo '<link rel="stylesheet" href="'.G5_JS_URL.'/font-awesome/css/font-awesome.min.css">';
echo '<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>';
echo '<link rel="stylesheet" href="'.get_url(MOA_URL.'/css/cq_common.css').'">'; // 위에 것 주석처리하고 충돌있는 stlye 수정 (김과장)
//echo '<link rel="stylesheet" href="'.MOA_URL.'/css/reset.css">';
echo '<link rel="stylesheet" href="'.get_url(MOA_URL.'/css/reset.css').'">';

echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">';
//echo '<link rel="stylesheet" href="'.MOA_URL.'/css/style.css?_v='.G5_CSS_VER.'">';
echo '<link rel="stylesheet" href="'.get_url(MOA_URL.'/css/style.css').'">';

if (defined('MOA_HEAD')) {

	echo '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">';
	echo '<!-- <script src="<?php echo MOA_URL;?>/js/rolldata.min.js?_v=<?php echo G5_JS_VER;?>"></script> -->';
	
}


//김과장추가 (임시...)
$header_title = '';
if($board['bo_subject']) $header_title = $board['bo_subject'];
if(strpos($_url, '/c_category/') !== false) $header_title = '카테고리';

if (strpos($_SERVER['REQUEST_URI'], 'c_my/my_inquiry02') > 0 ){
	$header_title = "나의문의";
}

?>
<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var moa_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_pim       = "<?php echo APMS_PIM ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_responsive    = "<?php echo (_RESPONSIVE_) ? 1 : '';?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
<?php if($is_admin || defined('G5_IS_ADMIN')) { ?>
var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
<?php } ?>
var g5_purl = "<?php echo $seometa['url']; ?>";
</script>

<script src="/js/jquery-1.11.3.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script src="<?php echo MOA_URL;?>/js/calendar.js"></script>
<?php /*
<script src="<?php echo MOA_URL;?>/js/rolldata.min.js?_v=<?php echo G5_JS_VER;?>"></script>
<script type="text/javascript" src="<?php echo MOA_URL;?>/js/jquery.min.js"></script> */
?>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script type="text/javascript" src="<?=get_url(MOA_URL.'/js/myScript.js')?>"></script>

<script src="<?php echo APMS_LANG_URL ?>/lang.js?ver=<?php echo APMS_SVER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/common.js?ver=<?php echo APMS_SVER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo APMS_SVER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/placeholders.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/apms.js?ver=<?php echo time(); ?>"></script>
<script src="<?php echo G5_JS_URL ?>/masonry.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
 

<?php if(!defined('G5_IS_ADMIN') && $config['cf_add_script']) echo $config['cf_add_script'].PHP_EOL; ?>

</head>
<body<?php echo (isset($g5['body_script']) && $g5['body_script']) ? $g5['body_script'].' ' : ''; ?> class="<?php echo (_RESPONSIVE_) ? '' : 'no-';?>responsive <?php echo $body_mode;?>">

<div id="page-wrapper">
<?php
if(APMS_PRINT) {
	@include_once($print_skin_path.'/print.head.php');
}
if($is_use_h1) {
	echo '<h1 style="display:inline-block !important;position:absolute;top:0;left:0;margin:0 !important;padding:0 !important;font-size:0;line-height:0;border:0 !important;overflow:hidden !important">';
	echo $g5_head_title;
	echo '</h1>';
}
?>