<?php
$noheader = true;
$page_title = '호스트 관리자 - 회원가입';
include_once('./header.php');
?>


<section class="container" style="max-width:720px;">
	
	<div class="join-step-container">
		<ul>
			<li class="">약관동의</li>
			<li class="">호스트 정보</li>
			<li class="active">호스트 인증</li>
			<li class="">회원가입 완료</li>
		</ul>
	</div>

	<div class="h2 tcenter mb20">호스트 인증</div>

	
	<div class="tabs-wraper moa">
		<div class="tabs-group gap0">
			<span class="tab active">회사원 인증</span>
			<span class="tab">프리랜서 인증</span>
		</div>

		<form name="" action="" method="post">
		<div class="tabsContainer">

			<div class="tabCon active">
				<div class="wr-wrap label140">
					<div class="wr-list flex-top">
						<div class="wr-list-label">인증방식 선택</div>
						<div class="wr-list-con">
							<div class="">
								<label class="radio-wrap"><input type="radio" name="radio1" value="" checked><span></span>회사 이메일로 인증</label>
								<div class="flex mt10">
									<input type="text" name="" value="" class="span" placeholder="회사 이메일을 입력해주세요.">
									<a href="#" class="btn reverse span130">중복확인</a>
								</div>
							</div>
							<div class="mt15">
								<label class="radio-wrap"><input type="radio" name="radio1" value=""><span></span>회사 명함으로 인증</label>
								<div class="fileContainer flex mt10 mb10">									
									<div class="inner">
										<input type="file" name="" id="upload-01" class="default" placeholder="">
										<label for="upload-01" class="upload-btn">회사 명함 사진 업로드</label>
										<p class="msg">2MB 이하의 png, jpg파일로 올려주세요.</p>										
									</div>
									<div class="upImg"></div>
								</div>
								<input type="text" name="" value="" class="span" placeholder="첨부파일 이름">
							</div>							
						</div>
					</div>					
				</div>
			</div>
			<div class="tabCon">
				<div class="wr-wrap label140">
					<div class="wr-list flex-top">
						<div class="wr-list-label">인증방식 선택</div>
						<div class="wr-list-con">
							<div class="">
								<label class="radio-wrap"><input type="radio" name="radio1" value=""><span></span>회사 명함으로 인증</label>
								<div class="fileContainer mt10 mb15">									
									<div class="inner">
										<input type="file" name="" id="upload-02" class="default" placeholder="">
										<label for="upload-02" class="upload-btn">사업자 등록증 혹은 프리랜서 인증(명함 등) 파일 업로드</label>
										<p class="msg">2MB 이하의 png, jpg파일로 올려주세요.</p>										
									</div>
									<div class="upImg"></div>
								</div>
								<input type="text" name="" value="" class="span" placeholder="첨부파일 이름">
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		</form>

	</div>
	
	<div class="mt80"></div>

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
			var img = new Image();
			img.src = event.target.result;
			holder.innerHTML = '';	
			holder.appendChild(img);
		};			
		reader.readAsDataURL(file);			
		return false;
	};
});
</script>

<?php include_once('./footer.php'); ?>