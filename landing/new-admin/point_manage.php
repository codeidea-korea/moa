<?php
$page_title = '포인트 관리';
include_once('header.php');
?>


<section id="wrtie" class="container">

	<div class="section-header">포인트 기본설정</div>
	<div class="wrtieContents">
		<div class="wr-wrap line label160">
			<div class="wr-list">
				<div class="wr-list-label">포인트 유효기간</div>
				<div class="wr-list-con">
					<p>1. 제한없음</p>
					<p>2. 지급일 기준 <label class="inp-wrap mini right-label ml10"><input type="text" name="" value="" class="span80"><span class="label">까지 사용가능</span></label><span class="help-block">(ex. 총 12개월)</span></p>
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">적립금 만료</div>
				<div class="wr-list-con">
					<p>
						<label class="radio-wrap"><input type="radio" name="o1" value="" checked><span></span>설정함</label>
						<label class="radio-wrap"><input type="radio" name="o1" value=""><span></span>설정안함</label>
					</p>
					<p>알림시점 만료일 기준</p>
				</div>
			</div>
		</div>
	</div>

	<div class="section-header">포인트 유형 설정</div>
	<div class="wrtieContents">
		<div class="wr-wrap line label160">
			<div class="wr-list">
				<div class="wr-list-label">회원가입 포인트</div>
				<div class="wr-list-con">
					<p>
						<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>사용함</label>
						<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>사용안함</label>
					</p>
					<label class="inp-wrap right-label mt10"><input type="text" name="" value="" class="span140"><span class="label">point</span></label>
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label required">추천인 포인트</div>
				<div class="wr-list-con">
					<p>
						<label class="radio-wrap"><input type="radio" name="r2" value="" checked><span></span>사용함</label>
						<label class="radio-wrap"><input type="radio" name="r2" value=""><span></span>사용안함</label>
					</p>
					<label class="inp-wrap right-label mt10"><input type="text" name="" value="" class="span140"><span class="label">point</span></label>
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">로그인 포인트</div>
				<div class="wr-list-con">
					<p>
						<label class="radio-wrap"><input type="radio" name="r3" value="" checked><span></span>사용함</label>
						<label class="radio-wrap"><input type="radio" name="r3" value=""><span></span>사용안함</label>
					</p>
					<label class="inp-wrap right-label mt10"><input type="text" name="" value="" class="span140"><span class="label">point</span></label>
				</div>
			</div>
		</div>
	</div>
	
	<div class="btnSet">
		<a href="notice_write.php" class="btn submit">저장</a>
	</div>
	

</section>


<?php include_once('footer.php'); ?>