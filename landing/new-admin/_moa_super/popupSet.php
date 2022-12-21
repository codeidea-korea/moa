<?php
include_once('./header.php');
?>

<link href="<?=get_url('//design01.codeidea.io/link_style.css')?>" rel="stylesheet">
<div id="publishingContainer">
	<ul class="page-link">
		<li class="title" data-label="Moa (슈퍼어드민) - 팝업 모음">
			<ul>
				<li><button data-href="#pop-coupon_add" class="pop-inline">쿠폰 관리 2 > 추가</button></li>
				<li><button data-href="#pop-coupon_send" class="pop-inline">쿠폰 관리 2 > 발송</button></li>
				<li><button data-href="#pop-qna" class="pop-inline">QnA관리</button></li>
				<li><button data-href="#pop-qna_write" class="pop-inline">QnA관리</button></li>
			</ul>
		</li>
	</ul>	
</div>
<script src='//design01.codeidea.io/link_script.js'></script>


<?php
//Moa (슈퍼어드민) 팝업
include_once('pop-coupon_add.php');
include_once('pop-coupon_send.php');
include_once('pop-qna.php');
include_once('pop-qna_write.php');
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