<?php
include_once('./header.php');
?>

<link href="<?=get_url('//design01.codeidea.io/link_style.css')?>" rel="stylesheet">
<div id="publishingContainer">
	<ul class="page-link">
		<li class="title" data-label="Moa (호스트관리자) - 팝업 모음">
			<ul>
				<li><button data-href="#pop-login-msg" class="pop-inline">로그인 실패 메시지</button></li>
				<li><button data-href="#pop01" class="pop-inline">모임 관리 - 모임 내역 – 폐강여부</a></li>
				<li><button data-href="#pop02" class="pop-inline">모임 관리 - 모임 내역(인원수)-> 모임신청인원정보이동(P-MEET-01) - 1회차 고정형</button></li>
				<li><button data-href="#pop03" class="pop-inline">모임 관리 - 모임 내역(인원수)-> 모임신청인원정보이동(P-MEET-01) - N회차 고정형</button></li>
				<li><button data-href="#pop04" class="pop-inline">정산관리 - 정산내역 –  정산 상세</button></li>
				<li><button data-href="#pop05" class="pop-inline">정산관리 - 정산내역 –  정산 상세 – 1</button></li>
			</ul>
		</li>
	</ul>	
</div>
<script src='//design01.codeidea.io/link_script.js'></script>


<?php
//Moa (호스트관리자) 팝업
include_once('pop-login-msg.php');
include_once('pop01.php');
include_once('pop02.php');
include_once('pop03.php');
include_once('pop04.php');
include_once('pop05.php');
?>

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

<?php include_once('./footer.php'); ?>