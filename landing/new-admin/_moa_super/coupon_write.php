<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">쿠폰 등록/수정</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<form name="" action="" method="post">
		<div class="wr-wrap line label200">
			
			<div class="wr-list">
				<div class="wr-list-label">...</div>
				<div class="wr-list-con">...</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">...</div>
				<div class="wr-list-con">...</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">...</div>
				<div class="wr-list-con">...</div>
			</div>
			
			<div class="wr-list">
				<div class="wr-list-label">혜택 제한</div>
				<div class="wr-list-con">
					<label class="checkbox-wrap type2"><input type="checkbox" name="" value="" checked  /><span></span>포인트 적립 불가</label>
					<label class="checkbox-wrap type2"><input type="checkbox" name="" value=""  /><span></span>중복 쿠폰 적용 불가</label>
				</div>
			</div>
			<div class="wr-list flex-top">
				<div class="wr-list-label">이미지 등록</div>
				<div class="wr-list-con">
					<div class="fileContainer">									
						<div class="inner span180">
							<input type="file" name="" id="upload-01" class="default" placeholder="">
							<label for="upload-01" class="upload-btn span">쿠폰 이미지 등록</label>
							<p class="mt10"><input type="text" name="" class="upload-name span"></p>
						</div>
						<div class="upImg"></div>
					</div>
				</div>
			</div>

		</div>
		</form>		

		<div class="btnSet">
			<a href="#" class="btn submit span150">저장</a>
		</div>

	</div>

	

</section>

<script>
// 업로드 이미지 미리보기
$('.fileContainer').each(function(index) {
	var inp = $(this).find('input[type="file"]');
	var upload = inp[0];
	var upname = $(this).find('.upload-name');
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
			if(window.FileReader){ // modern browser
				var filename = inp[0].files[0].name;
			} else { // old IE
				var filename = inp.val().split('/').pop().split('\\').pop();
			}			
			upname.val(filename);
		};
		reader.readAsDataURL(file);			
		return false;
	};
});
</script>

<?php include_once('footer.php'); ?>