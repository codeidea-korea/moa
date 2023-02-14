<?php
$noheader = true;
$page_title = '호스트 관리자 - 회원가입';
include_once('./header.php');
?>


<section class="container" style="max-width:860px;">
	
	<div class="join-step-container">
		<ul>
			<li class="">약관동의</li>
			<li class="">호스트 정보</li>
			<li class="">호스트 인증</li>
			<li class="active">회원가입 완료</li>
		</ul>
	</div>

	<div class="h2 tcenter mb20">회원가입 완료</div>
	
	<div class="tcenter mt60">
		<img src="./img/join_complete.png">
		<p class="tcenter fs19 noto600 mt40">
			Moa에 오신 걸 환영합니다!🎉
			<br>동일한 계정으로 Moa 이용이 가능합니다.
		</p>
		<p class="tcenter fs15 mt20">
			호스트 가입 후 관리자 승인이 필요합니다<br>
			*관리자 인증완료까지 평일 기준 1~2일, 주말 기준 최대 3일까지 소요될 수 있습니다.
		</p>
	</div>

	<div class="mt80"></div>

	<div class="btnSet">
		<a href="#" class="btn large submit span300">로그인</a>		
	</div>

</section>

<?php include_once('./footer.php'); ?>