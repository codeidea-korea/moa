<!DOCTYPE html>
<html lang="en">
<head>
    <title> Drawit.com </title>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Drawit는 희망하는 선생님의 포트폴리오를 확인하고, 1:1 화상 및 음성기반의 맞춤 수업을 신청하고 진행 할 수 있습니다.">
    <meta name="author" content="Classiqo teams">
    <meta property="og:url" content="https://Drawit.com/">
    <meta property="og:title" content="Drawit.com">
    <meta property="og:description" content="1:1 맞춤 수업을 하고싶은 선생님의 포트폴리오를 확인하고 효과적인 수업을 시작하세요!">
    <link rel="shortcut icon" href="/imgs/symbol.png">
    <link rel="icon" href="/imgs/symbol.png">
    <link rel="stylesheet" href="/dist/spectre.min.css">
    <link rel="stylesheet" href="/dist/spectre-icons.min.css">
    <link rel="stylesheet" href="/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="/dist/typicons.css">
    <link rel="stylesheet" href="/dist/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/cq_common.css">
</head>
<body>

<!-- 글로벌 헤더 -->
<div class="header">
	<header class="navbar container grid-lg">
		<section class="navbar-section">
			<a href="./" class="navbar-brand"><img src="/imgs/logo.png" alt="DRAWIT logo" /></a>
			<a href="/drawit/list_class.php" class="btn btn-link">수업</a>
			<a href="/drawit/list_teacher.php" class="btn btn-link">선생님들</a>
			<a href=/drawit/"board_list.php" class="btn btn-link">커뮤니티</a>
		</section>
		<section class="navbar-center">
			<button type="button" class="btn-search"><i class="form-icon icon icon-search"></i></button>
			<div class="search-set input-group grid-lg">
				<form action="search_result.php">
					<input class="form-input" type="text" placeholder="찾고 있는 선생님이나 수업이 있나요?" autofocus="true"/>
					<input type="submit" hidden="true" value="검색" />
					<div class="search-recommend container grid-lg">
						<a href="search_result.php" class="label">웹툰</a>
						<a href="search_result.php" class="label">드로잉</a>
						<a href="search_result.php" class="label">일러스트</a>
						<a href="search_result.php" class="label">아이패드</a>
						<a href="search_result.php" class="label">입시전문</a>
						<a href="search_result.php" class="label">3D</a>
					</div>
				</form>
			</div>
		</section>
		<section class="navbar-section account-set">
		    <button class="btn btn-link text-secondary">로그인상태 미리보기</button>
			<div class="btn-group btn-group-block">
				<button type="button" class="btn">로그인</button>
				<button type="button" class="btn">회원가입</button>
			</div>

			<!-- CSS만으로 팝업 위치 찾아가려면 레이어 코드가 여기 있어야 함 -->
			
			<!-- 로그인 레이어 -->
		    <div id="pop-login" class="layer-set layer-sticky">
		        <div class="layer layer-sm">
		            <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
		            <div class="layer-header">
		                <h4>시작하기</h4>
		            </div>
		            <div class="layer-body">
		                <form>
							<fieldset>
								<div class="form-group">
									<label class="form-label" for="input-login-id">이메일 아이디</label>
									<input class="form-input" type="text" id="input-login-id" placeholder="ex) user@drawit.com" autocomplete="email" />
								</div>
								<div class="form-group">
									<label class="form-label" for="input-login-pass">비밀번호</label>
									<input class="form-input" type="password" id="input-login-pass" placeholder="●●●●●●" />
								</div>
								<div class="form-group">
									<label class="form-switch">
										<input type="checkbox">
										<i class="form-icon"></i> 내 로그인 정보 기억하기
									</label>
								</div>
								<button class="btn btn-block btn-primary btn-lg">로그인 <i class="icon icon-forward"></i></button>
							</fieldset>
		                </form>
		            </div>
		            <div class="layer-tint">
			            <a href="#" class="text-dark">아이디/비밀번호를 찾아주세요</a>
		            </div>
		        </div>
		    </div>
		    
			<!-- 계정찾기 레이어 -->
		    <div id="pop-find-account" class="layer-set layer-sticky">
		        <div class="layer layer-sm">
		            <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
		            <div class="layer-header">
		                <h4>내 정보 찾기</h4>
		            </div>
		            <div class="layer-body">
			            <p class="box-desc">가입된 이메일 정보를 입력해주시면, 비밀번호를 리셋할 수 있는 URL을 메일로 보내드려요.</p>
		                <form>
							<fieldset>
								<div class="form-group has-error">
									<label class="form-label" for="input-find-id">이메일</label>
									<input class="form-input" type="text" id="input-find-id" placeholder="ex) user@drawit.com" autocomplete="email" />
									<p class="form-input-hint">존재하지 않는 가입 정보입니다.</p>
								</div>
								<button class="btn btn-block btn-primary btn-lg">메일보내기 <i class="icon icon-forward"></i></button>
							</fieldset>
		                </form>
		            </div>
		        </div>
		    </div>
		    
			<!-- 회원가입 레이어 -->
		    <div id="pop-register" class="layer-set layer-sticky">
		        <div class="layer layer-sm">
		            <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
		            <div class="layer-header">
		                <h4>회원가입하기</h4>
		            </div>
		            <div class="layer-body">
		                <form>
							<fieldset>
								<div class="form-group">
									<label class="form-label" for="input-register-id">이메일 아이디</label>
									<input class="form-input" type="text" id="input-register-id" placeholder="ex) user@drawit.com" autocomplete="email" />
								</div>
								<div class="form-group">
									<label class="form-label" for="input-register-pass">비밀번호</label>
									<input class="form-input" type="password" id="input-register-pass" placeholder="6글자 이상 특수문자를 혼용해주세요." />
								</div>
								<div class="form-group has-success">
									<label class="form-label" for="input-register-name">이름</label>
									<input class="form-input" type="text" id="input-register-name" autocomplete="username" value="크라시코팀" />
									<p class="form-input-hint">사용할 수 있는 이름입니다.</p>
								</div>
								<div class="form-group">
									<label class="form-switch">
										<input type="checkbox">
										<i class="form-icon"></i> <a href="#" class="text-dark">이용약관</a>에 동의합니다.
									</label>
								</div>
								<button class="btn btn-block btn-primary btn-lg">회원가입 완료 <i class="icon icon-forward"></i></button>
							</fieldset>
		                </form>
		            </div>
		            <div class="layer-tint">
			            <a href="#" class="text-dark">이미 가입한 정보를 찾아주세요</a>
		            </div>
		        </div>
		    </div>
		</section>
	</header>
</div>

<div class="clearfix"></div>
	
	<?php if($page_title) { // 페이지 타이틀 ?>
		<div class="at-title">
			<div class="at-container">
				<div class="page-title en">
					<strong<?php echo ($bo_table) ? " class=\"cursor\" onclick=\"go_page('".G5_BBS_URL."/board.php?bo_table=".$bo_table."');\"" : "";?>>
						<?php echo $page_title;?>
					</strong>
				</div>
				<?php if($page_desc) { // 페이지 설명글 ?>
					<div class="page-desc hidden-xs">
						<?php echo $page_desc;?>
					</div>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php } ?>

	<div class="at-body">
		<?php if($col_name) { ?>
			<div class="at-container">
			<?php if($col_name == "two") { ?>
				<div class="row at-row">
					<div class="col-md-<?php echo $col_content;?><?php echo ($at_set['side']) ? ' pull-right' : '';?> at-col at-main">		
			<?php } else { ?>
				<div class="at-content">
			<?php } ?>
		<?php } ?>
