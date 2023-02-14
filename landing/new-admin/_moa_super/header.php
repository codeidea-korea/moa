<?php
$common_path = '..';
include_once($common_path.'/lib/common.lib.php');
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>MOA 슈퍼 관리자</title>
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
				<li class="<?=defined("_INDEX_")?'active':''?>"><a href="index.php">대시보드</a></li>

				<li class="<?=$page_title=='전체 회원 관리'?'active':''?>">
					<a href="#">전체 회원 관리</a>
					<ul>
						<li class="<?=$page_title=='전체 회원 목록'?'active':''?>"><a href="#">전체 회원 목록</a></li>
						<li class="<?=$page_title=='회원 등록'?'active':''?>"><a href="#">회원 등록</a></li>
						<li class="<?=$page_title=='블랙리스트 등록'?'active':''?>"><a href="#">블랙리스트 등록</a></li>
						<li class="<?=$page_title=='회원 탈퇴'?'active':''?>"><a href="#">회원 탈퇴</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='전체 모임 관리'?'active':''?>">
					<a href="#">전체 모임 관리</a>
					<ul>
						<li class="<?=$page_title=='모임 관리'?'active':''?>"><a href="#">모임 관리</a></li>
						<li class="<?=$page_title=='모임 등록 추가'?'active':''?>"><a href="#">모임 등록 추가</a></li>
						<li class="<?=$page_title=='모임 수정'?'active':''?>"><a href="#">모임 수정</a></li>
						<li class="<?=$page_title=='참여자 목록'?'active':''?>"><a href="#">참여자 목록</a></li>
						<li class="<?=$page_title=='폐강여부'?'active':''?>"><a href="#">폐강여부</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='승인 관리'?'active':''?>">
					<a href="#">승인 관리</a>
					<ul>
						<li class="<?=$page_title=='회원 승인'?'active':''?>"><a href="#">회원 승인</a></li>
						<li class="<?=$page_title=='신청한 모임 승인 관리'?'active':''?>"><a href="#">신청한 모임 승인 관리</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='커뮤니티 관리'?'active':''?>">
					<a href="#">커뮤니티 관리</a>
					<ul>
						<li class="<?=$page_title=='커뮤니티 컨텐츠 관리'?'active':''?>"><a href="#">커뮤니티 컨텐츠 관리</a></li>
					</ul>
				</li>

				<li class="<?=$page_title=='수익 | 정산 관리'?'active':''?>">
					<a href="#">수익 | 정산 관리</a>
					<ul>
						<li class="<?=$page_title=='호스트 입출금'?'active':''?>"><a href="#">호스트 입출금</a></li>
						<li class="<?=$page_title=='정산비율 설정'?'active':''?>"><a href="#">정산비율 설정</a></li>
						<li class="<?=$page_title=='정산내역 보기'?'active':''?>"><a href="#">정산내역 보기</a></li>
						<li class="<?=$page_title=='세금계산서'?'active':''?>"><a href="#">세금계산서</a></li>
						<li class="<?=$page_title=='부가세 신고'?'active':''?>"><a href="#">부가세 신고</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='쿠폰 관리'?'active':''?>">
					<a href="#">쿠폰 관리</a>
					<ul>
						<li class="<?=$page_title=='쿠폰 등록'?'active':''?>"><a href="#">쿠폰 등록</a></li>
						<li class="<?=$page_title=='쿠폰 이용현황'?'active':''?>"><a href="#">쿠폰 이용현황</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='포인트 관리'?'active':''?>">
					<a href="#">포인트 관리</a>
					<ul>
						<li class="<?=$page_title=='회원별 포인트'?'active':''?>"><a href="#">회원별 포인트</a></li>
						<li class="<?=$page_title=='포인트 사용내역'?'active':''?>"><a href="#">포인트 사용내역</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='통계 관리'?'active':''?>">
					<a href="#">통계 관리</a>
					<ul>
						<li class="<?=$page_title=='통계'?'active':''?>"><a href="#">통계</a></li>
						<li class="<?=$page_title=='수익기록'?'active':''?>"><a href="#">수익기록</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='기타 관리'?'active':''?>">
					<a href="#">기타 관리</a>
					<ul>
						<li class="<?=$page_title=='이벤트 관리'?'active':''?>"><a href="#">이벤트 관리</a></li>
						<li class="<?=$page_title=='메인배너 관리'?'active':''?>">
							<a href="#">메인배너 관리</a>
							<ul>
								<li class="<?=$page_title=='메인 팝업'?'active':''?>"><a href="#">메인 팝업</a></li>
								<li class="<?=$page_title=='앱푸쉬'?'active':''?>"><a href="#">앱푸쉬</a></li>
							</ul>
						</li>
						<li class="<?=$page_title=='QnA 관리'?'active':''?>"><a href="#">QnA 관리</a></li>
						<li class="<?=$page_title=='Review 관리'?'active':''?>"><a href="#">Review 관리</a></li>
						<li class="<?=$page_title=='팝업관리'?'active':''?>"><a href="#">팝업관리</a></li>
						<li class="<?=$page_title=='문자발송관리'?'active':''?>"><a href="#">문자발송관리</a></li>
					</ul>
				</li>
				<li class="<?=$page_title=='1:1 문의사항'?'active':''?>"><a href="#">1:1 문의사항</a></li>
				<li class="<?=$page_title=='공지사항'?'active':''?>"><a href="#">공지사항</a></li>
				<li class="<?=$page_title=='채팅'?'active':''?>">
					<a href="#">채팅</a>
					<ul>
						<li class="<?=$page_title=='1:1 채팅관리'?'active':''?>"><a href="#">1:1 채팅관리</a></li>
						<li class="<?=$page_title=='그룹채팅관리'?'active':''?>"><a href="#">그룹채팅관리</a></li>
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