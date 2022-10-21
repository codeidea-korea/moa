<?php
$page_title = '호스트 관리자 - 추가된 폼';
include_once('./header.php');
?>


<section class="container background">

	<div class="page-title">추가된 폼</div>
	
	<div class="boxContainer write" style="max-width:1250px;">
		<form name="" action="" method="post">
		<div class="wr-wrap label140">
			<div class="wr-list flex-top">
				<div class="wr-list-label required">수수료</div>
				<div class="wr-list-con">
					<select disabled title="수수료 선택" class="span500">
						<option>O.O%</option>
						<option>O.O%</option>
						<option selected>19.8%</option>
						<option>O.O%</option>
						<option>O.O%</option>
						<option>O.O%</option>
					</select>
					<p class="fs12 mt10 color-gray">
						모임 수수료는 호스트 회원의 서비스 화면에서 확인가능합니다.<br>
						모임 수수료는 회사 정책에 따라 변경될 수 있으며, 변경사항은 판매회원의 서비스 화면에 게시 또는 고지합니다.
					</p>
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label required">범위 지정</div>
				<div class="wr-list-con">
					<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>옵션A</label>
					<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>옵션B</label>
					<div class="rangeContainer span500 mt15">
						<input type="range" min="1" max="10" value="3">
						<span class="range-track"></span>
						<span class="range-track-fill"></span>
						<div class="range-label">
							<span>1년</span><span>2년</span><span>3년</span><span>4년</span><span>5년</span><span>6년</span><span>7년</span><span>8년</span><span>9년</span><span>10년~</span>
						</div>
					</div>
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">INPUT 날짜</div>
				<div class="wr-list-con">					
					<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				</div>
			</div>

			<div class="wr-list flex-top">
				<div class="wr-list-label required">모임 스케쥴</div>
				<div class="wr-list-con">					
					<div class="tbl-excel auto">
						<table>
							<colgroup>
								<col width="80">
								<col>
								<col>
								<col>
								<col>
								<col>
							</colgroup>
							<thead>
								<tr>
									<th>회차</th>
									<th>날짜</th>
									<th>시간</th>
									<th>진행시간</th>
									<th>진행 인원</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>1회차</th>
									<td class="bg">
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
									</td>
									<td class="bg">
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
									<td class="bg">
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span50" maxlength="2"><span class="label">분</span></label>
									</td>
									<td class="bg">
										<span class="bold">최소</span>
										<select class="" title="선택">
											<option>1명</option>
											<option>2명</option>
											<option>3명</option>
											<option>...</option>
										</select>
										<span class="bold ml5 mr5"><span class="color-light">~</span> 최대</span>
										<select class="" title="선택">
											<option>1명</option>
											<option>2명</option>
											<option>3명</option>
											<option>...</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>2회차</th>
									<td class="bg">
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
									</td>
									<td class="bg">
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
									<td class="bg">
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span50" maxlength="2"><span class="label">분</span></label>
									</td>
									<td class="bg">
										<span class="bold">최소</span>
										<select class="" title="선택">
											<option>1명</option>
											<option>2명</option>
											<option>3명</option>
											<option>...</option>
										</select>
										<span class="bold ml5 mr5"><span class="color-light">~</span> 최대</span>
										<select class="" title="선택">
											<option>1명</option>
											<option>2명</option>
											<option>3명</option>
											<option>...</option>
										</select>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="wr-list flex-top">
				<div class="wr-list-label required">모임 타임</div>
				<div class="wr-list-con">					
					<div class="tbl-excel " id="moim">
						<table>
							<colgroup>
								<col width="120">
								<col>
							</colgroup>
							<thead>
								<tr>
									<th>시간</th>
									<th>모임내용</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="bg">
										<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span" maxlength="2"><span class="label">분</span></label>
									</td>
									<td class="bg">
										<div class="flex flex-middle">
											<input type="text" name="" value="" class="span" placeholder="모임 해당 내용을 입력해주세요.">
										</div>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2" class="bg">
										<span class="add-list">+ 추가하기</span>
									</td>								
								</tr>								
							</tfoot>
						</table>
					</div>
				</div>
			</div>

			<script>
			$(function() {
				$(document).on("click", ".add-list", function() {
					add_list();
				});

				$(document).on("click", ".del-list", function() {
					if(!confirm("선택하신 OOO이 삭제됩니다. 계속하시겠습니까?"))
						return false;
					var $tr = $(this).closest("tr");
					$tr.remove();        
				});
			});	

			function add_list() {
				var $moim = $("#moim");
				var list = '<tr>';
				list += '<td class="bg"><label class="inp-wrap label-inline"><input type="text" name="" value="" class="span50" maxlength="2"><span class="label">분</span></label></td>';
				list += '<td>';
				list += '<div class="flex flex-middle">';
				list += '<input type="text" name="" value="" class="span" placeholder="모임 해당 내용을 입력해주세요.">';
				list += '<span class="btn small gray del-list">삭제</span>';
				list += '</div>';
				list += '</td>';
				list += '</tr>';
				var $tr_last = null;
				var $tr_last = $moim.find("tbody tr:last");
				$tr_last.after(list);
				$('select').selectpicker('refresh');
			}
			</script>


			<div class="wr-list flex-top">
				<div class="wr-list-label required">모임포함사항<p class="fs14  color-gray">(선택)</p></div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span500" placeholder="모임 포함 사항을 입력하세요.">
					<a href="#" class="btn reverse span100">등록</a>
				</div>
			</div>

			<div class="wr-list flex-top">
				<div class="wr-list-label required">모임 대표이미지</div>
				<div class="wr-list-con">
					<div class="fileContainer">									
						<div class="inner">
							<input type="file" name="" id="upload-01" class="multiple" multiple>
							<label for="upload-01" class="upload-btn">모임 대표 이미지 업로드</label>
							<p class="help-block fs13">
								최소 1장 최대 5장의 이미지를 올려주세요.<br>
								권장 사이즈 : 가로 1000px * 세로 1000px<br>
								최소 사이즈 : 가로 600px * 세로 600px <br>
								용량 : 10MB 이하 <br>
								파일 유형 : JPG, PNG, GIF
							</p>										
						</div>
						<ul class="upImg-preview">
							<li><img src="../img/temp/temp04.png"><span class="del"></span></li>
							<li><img src="../img/temp/temp05.jpg"><span class="del"></span></li>
							<li><img src="../img/temp/temp06.jpg"><span class="del"></span></li>
							<li><img src="../img/temp/temp07.jpg"><span class="del"></span></li>
							<li><label for="upload-01" class="upload-empty">사진 추가</label></li>
						</ul>
					</div>
					
				</div>
			</div>

			<script type="text/javascript">
			//업로드 이미지 미리보기
			$('.fileContainer input[type="file"].multiple').each(function(index) {
				var inp = $(this);
				var upload = $(this)[0];
				$(this).parent().parent().find('.upImg-preview').attr('id', 'holder_' + index);
				var holder = document.getElementById('holder_' + index);
				var last = $(holder).find('li:last');
				upload.onchange = function (e) {
					e.preventDefault();
					var file = upload.files[0],
					reader = new FileReader();
					reader.onload = function (event) {
						var img = new Image();
						img.src = event.target.result;
						var imgtag = '<img src="' + reader.result + '">';
						//holder.children('img').remove();
						last.before('<li>' + imgtag + '<span class="del"></span></li>');
						//$(holder).css('background-image', 'url("' + reader.result + '")'); //background로 추출
						deleteImageAction('.del');
					};			
					reader.readAsDataURL(file);			
					return false;		
				};
			});
			function deleteImageAction(el) {
				$(el).click(function() {
					$(this).parent('li').remove(); 
				});
			}
			deleteImageAction('.upImg-preview .del');
			</script>
			
		</div>
		</form>
		
		<div class="mt100"></div>

		<div class="btnSet">
			<a href="#" class="btn gray">이전</a>
			<a href="#" class="btn submit">확인</a>		
		</div>

	</div>

</section>

<?php include_once('./footer.php'); ?>