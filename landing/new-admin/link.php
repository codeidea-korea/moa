<?php include_once('lib/common.lib.php'); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>new-admin</title>
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />
<link rel="shortcut icon" href="img/favorite/favorite.ico" />
<?php
echo '<link rel="stylesheet" href="'.get_url('./css/root.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url('js/magnific-popup/magnific-popup.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url('js/form/myform.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url('js/form/bootstrap-select/bootstrap-select.css').'">'.PHP_EOL;	
echo '<link rel="stylesheet" href="'.get_url('css/styleDefault.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url('css/style.css').'">'.PHP_EOL;

echo '<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>'.PHP_EOL;
echo '<script src="js/magnific-popup/jquery.magnific-popup.js"></script>'.PHP_EOL;
echo '<script src="js/dropdown.js"></script>'.PHP_EOL;
echo '<script src="js/form/bootstrap-select/bootstrap.min.js"></script>'.PHP_EOL;
echo '<script src="js/form/bootstrap-select/bootstrap-select.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url('js/form/myform.js').'"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url('js/myScript.js').'"></script>'.PHP_EOL;
?>

<link href="<?=get_url('//design01.codeidea.io/link_style.css')?>" rel="stylesheet">

<?php
//html 팝업
include_once('pop-style01.php');
include_once('pop-style02.php');
include_once('pop-style03.php');

//magnific-popup(js)
include_once('mfp-pop.style01.php');
include_once('mfp-pop.style02.php');
include_once('mfp-pop.style03.php');
?>

<div class="publishing-help">	
	<span class="label not">작업중</span>
	<span class="label popup">팝업</span>
	<span class="label change">수정</span>		
	<span class="label add">최근 추가</span>
	<a href="./css/iconfont/intaefont/" target="_blank" class="icon">아이콘 모음</a>
</div>

<?php
function txtRecord($dir) {
	$handle  = opendir($dir);
	$files = array();
	while (false !== ($filename = readdir($handle))) {
		if($filename == "." || $filename == "..") continue;
		if(is_file($dir."/".$filename)){
			$files[] = $filename;
		}
	}
	closedir($handle);
	rsort($files);	
	if(count($files) > 0) {
		echo '<div class="_record rsort">';
		echo '<ul>';
		foreach($files as $f) {
			$name = '수정 '.preg_replace("/[^0-9]*/s", "", $f);
			echo '<li><a href="'.$dir.$f.'" target="_black">'.$name.'</a></li>';
		}
		echo '</ul>';
		echo '</div>';
	}
}
echo txtRecord('./@record/');
?>

<div id="publishingContainer" style="">

	<ul class="page-link bg">
		<li><a href="login.php" target="_blank" class="">로그인 (A)</a></li>
		<li><a href="login02.php" target="_blank" class="">로그인 (B)</a></li>
		<li class="mt30"><a href="index.php" target="_blank" class="">Index</a></li>
		<li class="mt30"><a href="widgets.php" target="_blank" class="">Widgets</a></li>
		<li><a href="font.php" target="_blank" class="">Font</a></li>
		<li><a href="button.php" target="_blank" class="">Button</a></li>
		<li class="mt30"><a href="form.php" target="_blank" class="">Form (기본)</a></li>
		<li><a href="form_layout.php" target="_blank" class="">Form (레이아웃)</a></li>
		<li><a href="form_js.php" target="_blank" class="">Form (js버전)</a></li>
		<li class="mt30"><a href="table.php" target="_blank" class="">Table</a></li>
		<!--<li class=""><a href="flex-table.php" target="_blank" class="">flex-table</a></li>-->
		<li class="mt30"><a href="gallery.php" target="_blank" class="">Gallery</a></li>
		<li class=""><a href="gallery_webzine.php" target="_blank" class="">Gallery (webzine)</a></li>
		<li class="mt30"><a href="view.php" target="_blank" class="">View</a></li>
		<li class="mt30"><a href="booking.php" target="_blank" class="">Booking</a></li>
		<li class="mt30"><a href="password.php" target="_blank" class="">password</a></li>
		<li class="mt30" data-label="팝업 (html)">
			<ul>
				<li><button data-href="#pop-style01" class="pop-inline">style(1)</button></li>
				<li><button data-href="#pop-style02" class="pop-inline">style(2)</button></li>
				<li><button data-href="#pop-style03" class="pop-inline">style(3)</button></li>
			</ul>
		</li>
		<li class="mt30" data-label="팝업 (js)">
			<ul>
				<li><a href="#pop-style1" target="_blank" class="popup-inline">style(1)</a></li>
				<li><a href="#pop-style2" target="_blank" class="popup-inline">style(2)</a></li>
				<li><a href="#pop-style3" target="_blank" class="popup-inline">style(3)</a></li>
			</ul>
		</li>
	</ul>

	<ul class="page-link">
		<li class="title toggle show" data-label="Moa (호스트관리자)">
			<ul>
				<li><a href="_moa_host/login.php" target="_blank" class="">로그인</a></li>
				<li><a href="_moa_host/join-step01.php" target="_blank" class="">회원가입 (약관동의)</a></li>
				<li><a href="_moa_host/join-step02.php" target="_blank" class="">회원가입 (호스트 정보)</a></li>
				<li><a href="_moa_host/join-step03.php" target="_blank" class="">회원가입 (호스트 인증)</a></li>
				<li><a href="_moa_host/join-step04.php" target="_blank" class="">회원가입 (회원가입 완료)</a></li>
				<li><a href="_moa_host/join-add.php" target="_blank" class="">추가 호스트 정보</a></li>
				<li class="mt30"><a href="_moa_host/index.php" target="_blank" class="">메인</a></li>
				<li class="mt30"><a href="_moa_host/form_add.php" target="_blank" class="">추가된 form</a></li>
				<li class="mt30"><a href="_moa_host/moim_list.php" target="_blank" class="">모임 내역</a></li>
				<li class=""><a href="_moa_host/moim_view.php" target="_blank" class="">모임 상세페이지</a></li>
				<li class=""><a href="_moa_host/sales_.php" target="_blank" class=" ">정산관리 - 매출신청</a></li>
				<li class=""><a href="_moa_host/calculate_.php" target="_blank" class=" ">정산관리 - 정산신청</a></li>	
				<li class="mt50"><a href="_moa_host/popupSet.php" target="_blank" class="pop">팝업모음</a></li>
				<!--<li class="mt30"><button data-href="#pop01" class="pop-inline">모임 관리 - 모임 내역 – 폐강여부</a></li>
				<li><button data-href="#pop02" class="pop-inline">모임 관리 - 모임 내역(인원수)-> 모임신청인원정보이동(P-MEET-01) - 1회차 고정형</button></li>
				<li><button data-href="#pop03" class="pop-inline">모임 관리 - 모임 내역(인원수)-> 모임신청인원정보이동(P-MEET-01) - N회차 고정형</button></li>
				<li><button data-href="#pop04" class="pop-inline">정산관리 - 정산내역 –  정산 상세</button></li>
				<li><button data-href="#pop05" class="pop-inline">정산관리 - 정산내역 –  정산 상세 – 1</button></li>-->				
			</ul>
		</li>
	</ul>

	<ul class="page-link">
		<li class="title toggle show" data-label="Moa (슈퍼어드민)">
			<ul>
				<li><a href="_moa_super/login.php" target="_blank" class="">로그인</a></li>
				<li><a href="_moa_super/join.php" target="_blank" class="">회원가입</a></li>

				<li class="mt30"><a href="_moa_super/index.php" target="_blank" class="">메인</a></li>

				<li class="mt30"><a href="_moa_super/member_list.php" target="_blank" class="">전체 회원 목록</a></li>
				<li class=""><a href="_moa_super/member_view.php" target="_blank" class="">회원 기본 정보</a></li>

				<li class="mt30"><a href="_moa_super/login-info-password.php" target="_blank" class="">로그인 정보 (비밀번호 변경)</a></li>

				<li class="mt30"><a href="_moa_super/moim_list.php" target="_blank" class="">모임 관리(목록)</a></li>

				<li class="mt30"><a href="_moa_super/cummunity_add.php" target="_blank" class="">커뮤니티 추가</a></li>

				<li class="mt30"><a href="_moa_super/payment_edit.php" target="_blank" class="">결제 내역 상세 - 수정</a></li>

				<li class="mt30"><a href="_moa_super/coupon_write.php" target="_blank" class="">쿠폰 관리 1 > 등록/수정</a></li>
				<!--<li class=""><a href="_moa_super/pop.coupon_add.php" target="_blank" class="pop">쿠폰 관리 2 > 추가</a></li>
				<li class=""><a href="_moa_super/pop.coupon_send.php" target="_blank" class="pop">쿠폰 관리 2 > 발송</a></li>-->

				<li class="mt30"><a href="_moa_super/point_config.php" target="_blank" class="">포인트 관리</a></li>
				<li class=""><a href="_moa_super/point_manual.php" target="_blank" class="">포인트 수동지급 및 차감 관리</a></li>

				<li class="mt30"><a href="_moa_super/event_write.php" target="_blank" class="">이벤트 관리 2</a></li>
				<li class=""><a href="_moa_super/event_view.php" target="_blank" class="">이벤트 관리 3</a></li>

				<li class="mt30"><a href="_moa_super/main-banner_list.php" target="_blank" class="">메인배너 관리</a></li>
				<li class=""><a href="_moa_super/main-banner_write.php" target="_blank" class="">메인배너 등록</a></li>

				<!--<li class="mt30"><a href="_moa_super/pop.qna.php" target="_blank" class="pop">QnA관리</a></li>
				<li class=""><a href="_moa_super/pop.qna_write.php" target="_blank" class="pop">QnA관리</a></li>-->

				<li class="mt30"><a href="_moa_super/inquiry_wrtie.php" target="_blank" class="">1:1 문의 > 문의사항 등록</a></li>

				<li class="mt30"><a href="_moa_super/notice_list.php" target="_blank" class="">공지사항 > 공지목록</a></li>

				<li class="mt50"><a href="_moa_super/popupSet.php" target="_blank" class="pop">팝업모음</a></li>
			</ul>
		</li>
	</ul>
	
</div>


<script src='//design01.codeidea.io/link_script.js'></script>




<script>
//html 팝업 제어
$('.pop-inline').click(function() {
	var target = $(this).attr('data-href');
	$(target).addClass('open');
	$('body, html').css('overflow', 'hidden');
});
$('.pop-closer, .popClose').click(function() {
	var el = $(this).closest('.layer-popup');
	el.removeClass('open');
	$('body, html').css('overflow', '');
});
</script>



</body>
</html>
