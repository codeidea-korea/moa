<?php
$common_path = '..';
include_once($common_path.'/lib/common.lib.php');
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>MOA 호스트 관리자</title>
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
echo '<link rel="stylesheet" href="'.get_url('./theme.css').'">'.PHP_EOL;

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

<body class="moa" data-themeColor="" data-header-type="toggleSlide" data-font-family="noto">

<?php include_once($common_path.'/_theme_change.php'); //테마컬러 & 헤더타입 미리보기?>

<?php if(!$noheader) { ?>
<header id="header" class="show">
	<div class="header_container">
		<div class="logo"><a href="./index.php"><img src="./img/logo.png"></a></div>		
		<nav id="nav">
			<ul id="nav_ul">
				<li class="<?=defined("_INDEX_")?'active':''?>"><a href="index.php">홈</a></li>

				<li class="<?=$page_title=='내 정보'?'active':''?>">
					<a href="#">내 정보</a>
					<ul>
						<li class="<?=$page_title=='프로필 관리'?'active':''?>"><a href="#">프로필 관리</a></li>
						<li class="<?=$page_title=='추가 정보 관리'?'active':''?>"><a href="#">추가 정보 관리</a></li>
						<li class="<?=$page_title=='정산 정보 관리'?'active':''?>"><a href="#">정산 정보 관리</a></li>
					</ul>
				</li>
				<li class="<?=$page_title==''?'active':'모임 관리'?>">
					<a href="#">모임 관리</a>
					<ul>
						<li class="<?=$page_title=='모임 내역'?'active':''?>"><a href="#">모임 내역</a></li>
						<li class="<?=$page_title=='진행중인 모임'?'active':''?>"><a href="#">진행중인 모임</a></li>
						<li class="<?=$page_title=='모임 신청자 관리'?'active':''?>"><a href="#">모임 신청자 관리</a></li>
						<li class="<?=$page_title=='문의 관리'?'active':''?>"><a href="#">문의 관리</a></li>
						<li class="<?=$page_title=='후기 관리'?'active':''?>"><a href="#">후기 관리</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='모임 생성'?'active':''?>"><a href="#">모임 생성</a></li>
				<li class="<?=$page_title=='정산 관리'?'active':''?>">
					<a href="#">정산 관리</a>
					<ul>
						<li class="<?=$page_title=='정산 내역'?'active':''?>"><a href="#">정산 내역</a></li>
						<li class="<?=$page_title=='매출 현황'?'active':''?>"><a href="#">매출 현황</a></li>
						<li class="<?=$page_title=='정산 신청'?'active':''?>"><a href="#">정산 신청</a></li>
					</ul>
				</li>	
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
		<div class="member">
			<div class="thumb" style="background-image:url(<?=$common_path?>/img/temp/temp_user.png);"></div>
			<span class="name">모아모아 님</span>
		</div>
	</div>
<?php } ?>