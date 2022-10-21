<?php
$noheader = $nowrapper = true;
include_once('./header.php');
?>

<section id="login-wrapper">

	<div class="loginContainer flex-center">
	<form name="#" action="#" method="post">
		<div class="inner">
			<p class="fs32 noto300 tcenter mb50">
				직장인들의 커뮤니티,<br>
				Moa 관리자 페이지입니다.
			</p>
			<div class="logo"><img src="./img/login-logo.png"></div>
			<div class="title">관리자 로그인</div>
			<label class="input-wrap icon-login-id"><span>아이디 :</span><input type="text" name="#" id="" required class="span" placeholder="아이디(이메일)를 입력해주세요."></label>
			<label class="input-wrap icon-login-pw"><span>비밀번호 :</span><input type="password" name="#" id="" required class="span" placeholder="비밀번호를 입력해주세요."></label>
			<a href="#" class="btn login mt40">로그인</a>
			<ul class="sbtn-set">
				<li><label class="checkbox-wrap"><input type="checkbox" name="" value="" checked  /><span></span>로그인 유지</label></li>
				<li><a href="#">비밀번호 찾기</a></li>
			</ul>			
			<div class="btn-set mt40">
				<a href="#" class="btn large reverse gray">또 다른 관리자 회원가입</a>
			</div>	
		</div>
	</form>
	</div>

</section>

<?php include_once('./footer.php'); ?>