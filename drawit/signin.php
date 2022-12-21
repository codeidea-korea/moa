<?php // Header load
	include_once ("./_common.php");
	include_once (G5_PATH."/head.php");

?>


<div class="contents grid-md container">
	
	<div class="empty">
		<div class="empty-icon">
			<i class="icon icon-3x icon-emoji"></i>
		</div>
		<p class="empty-title h4">1:1 드로잉 수업, <strong class="logo-text">Draw!t</strong></p>
	</div>

	<div class="signin columns">
		<div class="login-set column">
			<form>
				<div class="form-group">
					<label class="form-label" for="login-id">이메일 ID</label>
					<input class="form-input" id="login-id" type="text" placeholder="ex) drawit@test.com" />
				</div>
				<div class="form-group">
					<label class="form-label" for="login-pass">비밀번호</label>
					<input class="form-input" id="login-pass" type="password" placeholder="Password" />
				</div>
				<div class="form-group">
					<label class="form-checkbox">
					  <input type="checkbox"><i class="form-icon"></i> 로그인 정보 기억하기
					</label>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block">로그인하기</button>
				</div>
				<div class="form-group">
					<a class="d-block text-center">아이디/비밀번호가 생각이 안 나요</a>
				</div>
			</form>
		</div>
		<div class="divider-vert" data-content="OR"></div>
		<div class="register-set column">
			<form>
				<div class="form-group">
					<button class="btn btn-block btn-kakao"><span class="typcn typcn-message"></span> 카카오톡으로 시작하기</button>
				</div>
				<div class="form-group">
					<button class="btn btn-block btn-success"><span class="typcn typcn-naver">N</span> 네이버로 시작하기</button>
				</div>
				<div class="form-group">
					<button class="btn btn-block btn-error"><span class="typcn typcn-social-google-plus"></span> 구글로 시작하기</button>
				</div>
				<div class="form-group">
					<button class="btn btn-block"><span class="typcn typcn-mail"></span> 이메일로 새로 가입하기</button>
				</div>
			</form>
		</div>
	</div>

</div>

<?php // footer load
	include_once (G5_PATH."/tail.php");
?>
    
</body>
</html>