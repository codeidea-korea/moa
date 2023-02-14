<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">이벤트 관리</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<div class="wr-wrap label250">
			<div class="wr-list">
				<div class="wr-list-con">
					<div class="tbl-excel td-h5">
						<table>
							<colgroup>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>작성일</th>
									<td colspan="3" class="tleft">
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span200 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
									</td>
								</tr>
								<tr>
									<th>제목</th>
									<td colspan="3" class="tleft">
										<input type="text" name="" value="" class="span" placeholder="제목을 입력해주세요.">
									</td>
								</tr>
								<tr>
									<th>댓글 허용</th>
									<td class="tleft">
										<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>사용함</label>
										<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>사용안함</label>
									</td>
									<th>댓글 노출</th>
									<td class="tleft">
										<label class="radio-wrap"><input type="radio" name="r2" value="" checked><span></span>노출함</label>
										<label class="radio-wrap"><input type="radio" name="r2" value=""><span></span>노출안함</label>
									</td>
								</tr>
								<tr>
									<th>썸네일 이미지</th>
									<td colspan="3" class="tleft">
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

		...<br>
		...<br>
		...<br>
		...<br>
		...<br>
		...<br>
		...

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