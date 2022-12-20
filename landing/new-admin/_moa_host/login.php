<?php
$noheader = $nowrapper = true;
include_once('./header.php');
?>

<section id="login-wrapper">

	<div class="bg" style="background-image:url('<?=get_url('./img/login-bg.png')?>');">
		<div class="title noto200">
			여기는 직장인들의<br>
			건전한 커뮤니티,<br>
			Moa 입니다.
		</div>
	</div>

	<div class="loginContainer flex-center">
	<form name="#" action="#" method="post">
		<div class="inner">
			<div class="logo"><img src="./img/login-logo.png"></div>
			<div class="title">호스트 로그인</div>

			<label class="input-wrap icon-login-id"><input type="text" name="#" id="" required class="large span" placeholder="아이디(이메일)를 입력해주세요."></label>
			<label class="input-wrap icon-login-pw"><input type="password" name="#" id="" required class="large span" placeholder="비밀번호를 입력해주세요."></label>
			<a href="#" class="btn login mt40">로그인</a>
			<ul class="sbtn-set">
				<li><a href="#">호스트가입</a></li>
				<li><a href="#">비밀번호 찾기</a></li>
			</ul>

			<div class="hr mt35 mb30">or</div>
			
			<div class="btn-set">
				<a href="#" class="btn-naver"><img src="./img/btn-naver.png">네이버로 로그인</a>
				<a href="#" class="btn-kakao"><img src="./img/btn-kakao.png">카카오로 로그인</a>
			</div>	
		</div>
	</form>
	</div>

</section>

<?php include_once('./footer.php'); ?>