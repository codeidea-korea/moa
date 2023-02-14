<?php
$noheader = true;
$page_title = '호스트 관리자 - 회원가입';
include_once('./header.php');
?>


<section class="container" style="max-width:700px;">
	
	<div class="join-step-container">
		<ul>
			<li class="">약관동의</li>
			<li class="active">호스트 정보</li>
			<li class="">호스트 인증</li>
			<li class="">회원가입 완료</li>
		</ul>
	</div>

	<div class="h2 tcenter mb20">호스트 정보</div>

	<form name="" action="" method="post">
	<div class="wr-wrap label140">
		<div class="wr-list flex-top">
			<div class="wr-list-label required">프로필 사진</div>
			<div class="wr-list-con">
				<div class="fileContainer flex">
					<div class="upImg profile-thumb"></div>
					<div class="inner">
						<input type="file" name="" id="upload-01">
						<label for="upload-01" class="upload-btn">프로필 사진 업로드</label>
						<p class="msg">2MB 이하의 png, jpg파일로 올려주세요.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="wr-list flex-top">
			<div class="wr-list-label required">닉네임</div>
			<div class="wr-list-con">
				<div class="flex">
					<input type="text" name="" value="김모아" class="span red" placeholder="">
					<a href="#" class="btn reverse span130">중복확인</a>
				</div>
				<p class="msg color-red">이미 사용중인 닉네임입니다.</p>
			</div>
		</div>
		<div class="wr-list flex-top">
			<div class="wr-list-label required">이메일</div>
			<div class="wr-list-con">
				<div class="flex">
					<input type="text" name="" value="moa@naver.com" class="span green" placeholder="">
					<a href="#" class="btn reverse span130">중복확인</a>
				</div>
				<p class="msg color-green">사용 가능한 이메일입니다.</p>
			</div>
		</div>
		<div class="wr-list flex-top">
			<div class="wr-list-label required">휴대폰번호</div>
			<div class="wr-list-con">
				<div class="flex">
					<input type="text" name="" value="01012345678" class="span" placeholder="">
					<a href="#" class="btn reverse span130">다시보내기</a>
				</div>
				<div class="flex mt10">
					<input type="text" name="" value="" class="span" placeholder="인증번호를 입력해주세요.">
					<a href="#" class="btn reverse span130">확인</a>
				</div>
				<p class="msg">인증번호가 오지 않으면 입력정보가 정확한지 다시 확인해주세요. <span class="ml10">02:58</span></p>
			</div>
		</div>
		<div class="wr-list flex-top">
			<div class="wr-list-label required">휴대폰번호</div>
			<div class="wr-list-con">
				<div class="relative">
					<textarea name="" class="limited" placeholder="30글자 이내로 작성해주세요." maxlength="30" data-max="30" style="height:230px"></textarea>
					<div class="textCount-wrap"><span class="textCount">0</span> / 30</span></div>
				</div>
			</div>
		</div>
	</div>
	</form>

	<div class="btnSet">
		<a href="#" class="btn gray">이전</a>
		<a href="#" class="btn submit">확인</a>		
	</div>

</section>


<script>
// 업로드 이미지 미리보기
$('.fileContainer').each(function(index) {
	var inp = $(this).find('input[type="file"]');
	var upload = inp[0];
	$(this).find('.upImg').attr('id', 'holder_' + index);
	var holder = document.getElementById('holder_' + index);
	upload.onchange = function (e) {
		e.preventDefault();
		var file = upload.files[0],
		reader = new FileReader();
		reader.onload = function (event) {
			$(holder).css('background-image', 'url("' + reader.result + '")');			
		};			
		reader.readAsDataURL(file);			
		return false;
	};
});
</script>

<?php include_once('./footer.php'); ?>