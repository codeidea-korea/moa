<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">메인배너 등록</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<div class="wr-wrap label200">
			<div class="wr-list">
				<div class="wr-list-label block">공통</div>
				<div class="wr-list-con">
					<div class="tbl-excel td-h4 ">
						<table>
							<colgroup>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>제목</th>
									<td class="tleft">
										<input type="text" name="" value="" class="span" placeholder="제목을 입력해주세요">
									</td>
								</tr>
								<tr>
									<th>노출기간</th>
									<td class="tleft">
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span130 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
										<select class="" title="몇시">
											<option>OO시</option>
											<option>OO시</option>
											<option>...</option>
										</select>
										<select class="" title="몇분">
											<option>OO분</option>
											<option>OO분</option>
											<option>...</option>
										</select>
										<span>~</span>
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span130 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
										<select class="" title="몇시">
											<option>OO시</option>
											<option>OO시</option>
											<option>...</option>
										</select>
										<select class="" title="몇분">
											<option>OO분</option>
											<option>OO분</option>
											<option>...</option>
										</select>
									</td>
								</tr>
							</tbody>			
						</table>
					</div>
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label block">링크 URL</div>
				<div class="wr-list-con">
					<div class="tbl-excel td-h4">
						<table>
							<colgroup>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>홈페이지</th>
									<td class="tleft">
										<input type="text" name="" value="" class="span" placeholder="">
									</td>
								</tr>
								<tr>
									<th>모바일웹</th>
									<td class="tleft">
										<input type="text" name="" value="" class="span" placeholder="">
									</td>
								</tr>
							</tbody>			
						</table>
					</div>
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label block">배너이미지</div>
				<div class="wr-list-con">
					<div class="tbl-excel td-h4">
						<table>
							<colgroup>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>홈페이지</th>
									<td class="tleft">
										<img src="./img/gall-img01.png" class="span95">
										<button class="btn mini reverse">삭제</button>
									</td>
								</tr>
								<tr>
									<th>모바일웹</th>
									<td class="tleft">
										<div class="fileContainer flex">									
											<div class="inner">
												<input type="file" name="" id="upload-01" class="default" placeholder="">
												<label for="upload-01" class="upload-btn">썸네일 이미지 등록</label>
											</div>
											<div class="upImg" style="width:100px;"></div>
										</div>
									</td>
								</tr>
							</tbody>			
						</table>
					</div>
				</div>
			</div>
		</div>
		

		<div class="btnSet">
			<a href="#" class="btn reverse gray span150">취소</a>
			<a href="#" class="btn span150 submit">저장</a>
		</div>

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

<?php include_once('footer.php'); ?>