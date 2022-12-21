<?php
$noheader = $nowrapper = true;
include_once('header.php');
?>

<section id="login-wrapper" class="type02" style="">	

	<div class="loginContainer" style="">
	<form name="#" action="#" method="post">
		<div class="inner">
			<div class="logo"><img src="<?=$root_url?>/img/logo.png"></div>
			<div class="title">코드아이디어 관리자 로그인</div>
			<input type="text" name="#" id="login_id2" required class="large span" placeholder="아이디">
			<input type="password" name="#" id="login_pw2" required class="large span" placeholder="비밀번호">
			<div class="mb40">
				<label class="checkbox-wrap" style="font-size:13px;font-weight:bold"><input type="checkbox" name="" value="" checked  /><span></span>아이디 저장</label>
			</div>
			<div class="tcenter">
				<a href="#" class="btn login">로그인</a>
			</div>
		</div>
	</form>
	</div>

</section>

<?php include_once('footer.php'); ?>