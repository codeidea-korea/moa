<?php
$noheader = true;
$page_title = '호스트 관리자 - 회원가입';
include_once('./header.php');
?>


<section class="container" style="max-width:600px;">
	
	<div class="h2 tcenter mt40 mb50">추가 호스트 정보</div>

	<form name="" action="" method="post">
	<div class="wr-wrap label140">
		<div class="wr-list">
			<div class="wr-list-label required">직군</div>
			<div class="wr-list-con">
				<select name="" title="대분류" class="span">
					<option>개발</option>
					<option>디자인</option>
					<option>경영</option>
					<option>고객 서비스 / 리테일</option>
					<option>영업</option>
					<option>인사</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
				</select>
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">직무</div>
			<div class="wr-list-con">
				<select name="" title="소분류" class="span">
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
					<option>OOOO</option>
				</select>
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">직장</div>
			<div class="wr-list-con">
				<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span" placeholder="회사명을 입력해주세요."><span class="label search"></span></label>
				<p class="mt5"><a href="#" class="underline">직접입력</a></p>
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">범위 지정</div>
			<div class="wr-list-con">
				<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>옵션A</label>
				<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>옵션B</label>
				<div class="rangeContainer mt15">
					<input type="range" min="1" max="10" value="3">
					<span class="range-track"></span>
					<span class="range-track-fill"></span>
					<div class="range-label">
						<span>1년</span><span>2년</span><span>3년</span><span>4년</span><span>5년</span><span>6년</span><span>7년</span><span>8년</span><span>9년</span><span>10년~</span>
					</div>
				</div>
			</div>
		</div>
		<div class="wr-list flex-top">
			<div class="wr-list-label required">닉네임</div>
			<div class="wr-list-con">
				<input type="text" name="" value="" class="span" placeholder="초대코드를 입력해주세요.">
			</div>
		</div>
		
	</div>
	</form>
	
	<div class="mt100"></div>

	<div class="btnSet">
		<a href="#" class="btn gray">이전</a>
		<a href="#" class="btn submit">확인</a>
	</div>

</section>

<?php include_once('./footer.php'); ?>