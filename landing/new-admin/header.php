<?php
$common_path = '.';
$doc_title = 'new-admin';
$is_theme = false;

if(file_exists('./theme.lib.php')) {
	$is_theme = true;
	$common_path = '..';
	include_once('./theme.lib.php');
}
include_once($common_path.'/lib/common.lib.php');
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?=$doc_title?></title>
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
<?php
if(file_exists('./img/favorite/favorite.ico')) {
	echo '<link rel="shortcut icon" href="./img/favorite/favorite.ico" />';
} else {
	echo '<link rel="shortcut icon" href="'.$common_path.'/img/favorite/favorite.ico" />';
}
echo '<link rel="stylesheet" href="'.get_url($common_path.'/css/root.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url($common_path.'/js/magnific-popup/magnific-popup.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url($common_path.'/js/form/datepicker/datepicker.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url($common_path.'/js/form/myform.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url($common_path.'/js/form/bootstrap-select/bootstrap-select.css').'">'.PHP_EOL;	
echo '<link rel="stylesheet" href="'.get_url($common_path.'/css/styleDefault.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url($common_path.'/css/style.css').'">'.PHP_EOL;
if($is_theme) echo '<link rel="stylesheet" href="'.get_url('./theme.css').'">'.PHP_EOL;

echo '<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.$common_path.'/js/animation/easing.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.$common_path.'/js/magnific-popup/jquery.magnific-popup.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.$common_path.'/js/dropdown.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.$common_path.'/js/form/bootstrap-select/bootstrap.min.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url($common_path.'/js/form/bootstrap-select/bootstrap-select.js').'"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url($common_path.'/js/form/datepicker/datepicker.js').'"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.$common_path.'/js/form/datepicker/datepicker.ko-KR.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url($common_path.'/js/form/myform.js').'"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url($common_path.'/js/myScript.js').'"></script>'.PHP_EOL;
?>
</head>

<body class="<?=$theme_name?>" data-themeColor="" data-header-type="<?=$header_type?>" data-font-family="<?=$font_family?>">

<?php include_once($common_path.'/_theme_change.php'); //테마컬러 & 헤더타입 미리보기?>

<?php if(!$noheader) { ?>
<header id="header">
	<div class="header_container">
		<div class="logo"><a href="./index.php"><img src="./img/logo.png"></a></div>		
		<nav id="nav">
			<ul id="nav_ul">
				<li class="<?=defined("_INDEX_")?'active':''?>"><a href="index.php" class="mont">index</a></li>
				<li class="<?=$page_title=='Widgets'?'active':''?>"><a href="widgets.php" class="mont">Widget</a></li>
				<li class="<?=$page_title=='Font'?'active':''?>"><a href="font.php" class="mont">Font</a></li>
				<li class="<?=$page_title=='Button'?'active':''?>"><a href="button.php" class="mont">Button</a></li>
				<li class="<?=$page_title=='Form'?'active':''?>">
					<a href="form.php" class="mont">Form</a>
					<ul>
						<li class="<?=$page_title=='Form'?'active':''?>"><a href="form.php" class="mont">Form (기본)</a></li>
						<li class="<?=$page_title=='form_layout'?'active':''?>"><a href="form_layout.php" class="mont">Form (layout)</a></li>
						<li class="<?=$page_title=='form_js'?'active':''?>"><a href="form_js.php" class="mont">Form (js버전)</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='Table'?'active':''?>"><a href="table.php" class="mont">Table</a></li>
				<li class="<?=$page_title=='Form'?'active':''?>">
					<a href="gallery.php" class="mont">Gallery</a>
					<ul>
						<li class="<?=$page_title=='Gallery'?'active':''?>"><a href="gallery.php" class="mont">Gallery (기본)</a></li>
						<li class="<?=$page_title=='Gallery (Webzine)'?'active':''?>"><a href="gallery_webzine.php" class="mont">Gallery (webzine)</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='View'?'active':''?>"><a href="view.php" class="mont">View</a></li>
				<li class="<?=$page_title=='예약현황'?'active':''?>"><a href="booking.php" class="mont">Booking</a></li>
				
				<li class="<?=$page_title=='비밀번호 변경'?'active':''?>"><a href="password.php" class="mont">password</a></li>
				<li><a href="login.php" target="_blank" class="mont">login (A)</a></li>
				<li><a href="login02.php" target="_blank" class="mont">login (B)</a></li>
			</ul>
		</nav>
	</div>
</header>
<?php } ?>


<?php if(!$nowrapper) { ?>
<div id="wrapper">
	
	<div id="topContainer">
		<?php if(!$noheader) { ?><button class="navOpener">메뉴열기</button><?php } ?>
		<div class="logo"><a href="./index.php"><img src="./img/logo.png"></a></div>
		<div class="loaction"></div>
		<ul class="gbMenu">
			<li>
				<select id="lang">
					<option data-content='<span class="icon_lang"></span>한국어'>한국어</option>
					<option data-content='<span class="icon_lang"></span>영어'>영어</option>
					<option data-content='<span class="icon_lang"></span>일본어'>일본어</option>
				</select>
			</li>
			<li><a href="password.php">비밀번호 변경</a></li>
			<li><a href="#">로그아웃</a></li>
		</ul>
		<div class="member">
			<div class="thumb" style="background-image:url(<?=$common_path?>/img/temp/temp_user.png);"></div>
			<span class="name">모아모아 님</span>
		</div>
	</div>
<?php } ?>