<?php
$page_title = '비밀번호 변경';
include_once('header.php');
?>

<section class="container ">
	<div class="page-title"><?=$page_title?></div>
	
	<div class="boxContainer write bg">
		<div class="wr-wrap line label160">

			<div class="wr-list">
				<div class="wr-list-label">기존 비밀번호</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder="">
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">변경할 비밀번호</div>
				<div class="wr-list-con">
					<input type="password" name="" value="" class="span200" placeholder="">
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">비밀번호 재입력</div>
				<div class="wr-list-con">
					<input type="password" name="" value="" class="span200" placeholder="">
					<p class="help-block">
						※ 보안을 위해 패스워드는 대, 소문자 및 숫자, 특수문자 중 2가지 이상 사용하여야 합니다.<br/>
						※ 최소 6자리 이상 입력해주세요.
					</p>
				</div>
			</div>
			
		</div>
	</div>

	<div class="btnSet">
		<a href="#" class="btn submit">비밀번호 변경</a>
		<a href="index.php" class="btn gray">취소</a>
	</div>

</section>

<?php include_once('footer.php'); ?>