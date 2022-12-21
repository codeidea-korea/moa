<?php
$noheader = $nowrapper = true;
include_once('./header.php');
?>

<section id="join-wrapper">

	<div class="joinContainer flex-center">
	<form name="#" action="#" method="post">
		<div class="inner">
			<div class="logo"><img src="./img/login-logo.png"></div>
			<div class="title">관리자 로그인</div>
			<label class="input-wrap icon-login-id"><span>아이디 :</span><input type="text" name="#" id="" required class="span" placeholder="아이디(이메일)를 입력해주세요."></label>
			<label class="input-wrap icon-login-pw"><span>비밀번호 :</span><input type="password" name="#" id="" required class="span" placeholder="비밀번호를 입력해주세요."></label>
			<label class="input-wrap icon-login-pw"><span>비밀번호 확인 :</span><input type="password" name="#" id="" required class="span" placeholder="비밀번호를 입력해주세요."></label>
			<a href="#" class="btn login mt80">로그인</a>	
		</div>
	</form>
	</div>

</section>

<?php include_once('./footer.php'); ?>