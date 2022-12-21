<?php
$noheader = $nowrapper = true;
include_once('header.php');
?>

<section id="login-wrapper" class="type01">

	<div class="bg" style="background-color:rgba(0,162,172,0.05);background-image:url('<?=get_url('./img/login-img.png')?>');background-position:center right 100px;"></div>

	<div class="loginContainer flex-left"><!-- flex-left, flex-center -->
	<form name="#" action="#" method="post">
		<div class="inner">
			<div class="logo"><img src="./img/logo.png"></div>
			<div class="title">관리자 로그인</div>
			<input type="text" name="#" id="login_id" required class="large span" placeholder="아이디">
			<input type="password" name="#" id="login_pw" required class="large span" placeholder="비밀번호">
			<p class="mt10"><label class="checkbox-wrap"><input type="checkbox" name="" value="" checked  /><span></span>아이디 저장</label></p>
			<div class="mt30 tcenter">
				<a href="#" class="btn login">로그인</a>
				<a href="#" class="pw-find">패스워드 찾기</a>
			</div>
		</div>
	</form>
	</div>

</section>

<?php include_once('footer.php'); ?>