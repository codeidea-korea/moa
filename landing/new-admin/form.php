<?php
$page_title = 'Form';
include_once('header.php');
?>

<section class="container background">
	<div class="page-title"><?=$page_title?></div>

	<div class="boxContainer write">
		
		<form name="" action="" method="post">
		<div class="wr-wrap line label200">

			<div class="wr-list">
				<div class="wr-list-label required">채크박스</div>
				<div class="wr-list-con">
					<label class="checkbox-wrap"><input type="checkbox" name="" value="" checked  /><span></span>옵션A</label>
					<label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span>옵션B</label>
					<label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span>옵션C</label>
					<label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span>옵션D</label>
					<label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span>옵션E</label>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label required">채크박스 (toggle style)</div>
				<div class="wr-list-con">
					<label class="toggle-light"><input type="checkbox" name="" value="1" class="toggle-light" checked  /><span></span><span class="labelOn">공개</span><span class="labelOff">비공개</span></label>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">라디오버튼</div>
				<div class="wr-list-con">
					<div>
						<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>옵션A</label>
						<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>옵션B</label>
						<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>옵션C</label>
						<label class="radio-wrap"><input type="radio" name="r1" value="dong"><span></span>옵션D(추가선택)</label>
						<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>옵션E</label>
					</div>
					<div id="sel-dong" class="mt15">
						<select multiple data-actions-box="true" title="동 선택">
							<option>OOO동</option>
							<option>OOO동</option>
							<option>OOO동</option>
							<option>OOO동</option>
						</select>
					</div>
					<script>$(function(){ matchOnOff('input[name="r1"]', 'dong', '#sel-dong'); });</script>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">라디오버튼 (버튼스타일)</div>
				<div class="wr-list-con">
					<div class="radio-btn-wrap">
						<label class="radio-btn"><input type="radio" name="r2" value="" checked><span>일반</span></label>
						<label class="radio-btn"><input type="radio" name="r2" value=""><span>긴급</span></label>
						<label class="radio-btn"><input type="radio" name="r2" value=""><span>중요</span></label>
					</div>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">키워드</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder=""><a href="#" class="btn black ml5">추가</a>
					<div class="mt10">
						<span class="srtag">태그A<i class="del"></i></span><span class="srtag">태그B<i class="del"></i></span><span class="srtag">태그C<i class="del"></i></span><span class="srtag">태그D<i class="del"></i></span>
					</div>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">셀렉트 박스<br><sub class="color-gray"'>(bootstrap-select)</sub></div>
				<div class="wr-list-con">
					<select data-style="selectColor-black">
						<option data-subtext="(Sub1)">검정 셀렉트</option>
						<option data-subtext="(Sub2)">옵션A</option>
						<option data-subtext="(Sub3)">옵션B</option>
						<option data-subtext="(Sub4)">옵션C</option>
					</select>
					<select data-style="selectColor-gray">
						<option data-subtext="(Sub1)">회색 셀렉트</option>
						<option data-subtext="(Sub2)">옵션A</option>
						<option data-subtext="(Sub3)">옵션B</option>
						<option data-subtext="(Sub4)">옵션C</option>
					</select>
					<select data-live-search="true">
						<option>검색가능 셀렉트</option>
						<option>옵션A</option>
						<option>옵션B</option>
						<option>옵션C</option>
						<option>옵션D</option>
						<option>옵션E</option>
						<option>옵션F</option>
						<option>옵션G</option>
						<option>옵션H</option>
						<option>옵션I</option>
					</select>
					<select id="search-cate">
						<option>일반 셀렉트</option>
						<option>옵션A</option>
						<option>옵션B</option>
						<option>옵션C</option>
						<option>옵션D</option>
						<option>옵션E</option>
						<option>옵션F</option>
						<option>옵션G</option>
						<option>옵션H</option>
						<option>옵션I</option>
					</select>
					<select multiple data-actions-box="true" title="전부선택+전부선택안함">
						<option>옵션A</option>
						<option>옵션B</option>
						<option>옵션C</option>
						<option>옵션D</option>
					</select>

					<div class="mt10"></div>

					<select data-style="selectColor-blue">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select data-style="selectColor-green">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select data-style="selectColor-black">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select data-style="selectColor-red">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select data-style="selectColor-yellow">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>

					<div class="mt10"></div>
					
					<select title="선택불가 옵션">
						<option>옵션A</option>
						<option>옵션B</option>
						<option disabled>선택불가 옵션</option>
						<option>옵션D</option>
						<option>옵션E</option>
						<option disabled>선택불가 옵션</option>
					</select>

					<select disabled title="셀렉트 비활성화 (disabled)">
						<option>옵션A</option>
						<option>옵션B</option>
						<option >선택불가</option>
						<option>옵션D</option>
						<option>옵션E</option>
						<option>옵션F</option>
					</select>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">멀티형 셀렉트 박스</div>
				<div class="wr-list-con">
					<select multiple class="span700" class="multipleSelect" data-live-search="true"  title="태그를 추가해주세요.">
						<option>태그A</option>
						<option>태그B</option>
						<option>태그C</option>
						<option>태그D</option>
						<option>태그E</option>
						<option>태그F</option>
						<option>태그G</option>
						<option>태그H</option>
						<option>태그I</option>
						<option>TagA</option>
						<option>TagB</option>
						<option>TagC</option>
						<option>TagD</option>
						<option>TagE</option>
						<option>TagF</option>
						<option>TagG</option>
						<option>TagH</option>
						<option>TagI</option>
					</select>
					<div class="mt10">
						<span class="srtag">태그A<i class="del"></i></span><span class="srtag">태그B<i class="del"></i></span><span class="srtag">태그C<i class="del"></i></span><span class="srtag">태그D<i class="del"></i></span>
					</div>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">셀렉트 박스 (js없이)</div>
				<div class="wr-list-con">
					<select class="default selectColor-black">
						<option data-subtext="(Sub1)">검정 셀렉트</option>
						<option data-subtext="(Sub2)">옵션A</option>
						<option data-subtext="(Sub3)">옵션B</option>
						<option data-subtext="(Sub4)">옵션C</option>
					</select>
					<select class="default selectColor-gray">
						<option data-subtext="(Sub1)">회색 셀렉트</option>
						<option data-subtext="(Sub2)">옵션A</option>
						<option data-subtext="(Sub3)">옵션B</option>
						<option data-subtext="(Sub4)">옵션C</option>
					</select>
					<select id="search-cate" class="default">
						<option>일반 셀렉트</option>
						<option>옵션A</option>
						<option>옵션B</option>
						<option>옵션C</option>
						<option>옵션D</option>
						<option>옵션E</option>
						<option>옵션F</option>
						<option>옵션G</option>
						<option>옵션H</option>
						<option>옵션I</option>
					</select>

					<div class="mt10"></div>

					<select class="default selectColor-blue">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select class="default selectColor-green">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select class="default selectColor-black">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select class="default selectColor-red">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
					<select class="default selectColor-yellow">
						<option data-subtext="(Sub1)">옵션A</option>
						<option data-subtext="(Sub2)">옵션B</option>
						<option data-subtext="(Sub3)">옵션C</option>
						<option data-subtext="(Sub4)">옵션D</option>
					</select>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span" placeholder="입력">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT (수정불가)</div>
				<div class="wr-list-con">
					<input type="text" name="" value="입력값" class="span200" readOnly placeholder="입력">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT + 버튼</div>
				<div class="wr-list-con flex">
					<input type="text" name="" value="" class="span" placeholder="입력">
					<a href="#" class="btn span60">버튼</a>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT + 버튼</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="" placeholder="입력">
					<a href="#" class="btn">버튼</a>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT + 크기</div>
				<div class="wr-list-con">
					<label class="inp-wrap right-label"><input type="text" name="" value="" class="span80 mini"><span class="label">까지 사용가능</span></label><span class="help-block">(ex. 총 12개월)</span>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT + LABEL</div>
				<div class="wr-list-con">					
					<label class="inp-wrap left-label"><span class="label">왼쪽 라벨</span><input type="text" name="" value="" class="span130"></label>
					<label class="inp-wrap right-label"><input type="text" name="" value="" class="span130"><span class="label">오른쪽 라벨</span></label>
					<label class="inp-wrap left-label right-label"><span class="label">왼쪽 라벨</span><input type="text" name="" value="" class="span130"><span class="label">오른쪽 라벨</span></label>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT + LABEL(inline)</div>
				<div class="wr-list-con">					
					<label class="inp-wrap label-inline"><span class="label">왼쪽 라벨</span><input type="text" name="" value="" class="span200"></label>
					<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span200"><span class="label">오른쪽 라벨</span></label>
					<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span200"><span class="label search"></span></label>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT 날짜</div>
				<div class="wr-list-con">					
					<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span130 datepicker" placeholder="날짜 선택"><span></span></label>
					<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span130 datepicker"><span></span></label>
					<label class="inp-wrap left-label"><span class="label">날짜</span><input type="text" name="" value="" class="span130 datepicker"><span></span></label>
					<label class="inp-wrap label-inline"><span>날짜</span><input type="text" name="" value="" class="span110 datepicker" placeholder=" "><span></span></label>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT 금액</div>
				<div class="wr-list-con">					
					<label class="inp-wrap right-label"><input type="text" name="" value="" class="span130 price tright"><span class="label">원</span></label>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT 전화번호</div>
				<div class="wr-list-con">					
					<input type="text" name="" value="" class="span160 phone">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">범위 지정</div>
				<div class="wr-list-con">					
					<div class="rangeContainer span400">
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
				<div class="wr-list-label">옵션입력<p class="mt5"><span class="btn mini blue add-list">+ 필드추가</span></p></div>
				<div class="wr-list-con">
					<ul class="option-list">
						<li>
							<input type="text" name="" value="" class="span300 mr15" placeholder="옵션명 입력">
							<label class="inp-wrap right-label"><input type="text" name="" value="" class="span150 price"placeholder="가격입력"><span class="label">원</span></label>
						</li>
					</ul>
				</div>
			</div>	

			<div class="wr-list flex-top">
				<div class="wr-list-label">TEXTAREA</div>
				<div class="wr-list-con">
					<div class="relative">
						<textarea name="" class="autoSize limited" placeholder="10글자 이내로 작성해주세요." maxlength="10" data-maxlength="10"></textarea>
						<div class="textCount-wrap"><span class="textCount">0</span> / 10</span></div>
					</div>
				</div>
			</div>

			<div class="wr-list flex-top">
				<div class="wr-list-label">TEXTAREA (autoSize)</div>
				<div class="wr-list-con">
					<textarea name="" class="mini autoSize" placeholder="메모"></textarea>
				</div>
			</div>	
			
			<div class="wr-list">
				<div class="wr-list-label block">TEXTAREA (autoSize)</div>
				<div class="wr-list-con">
					<textarea name="" class="span" placeholder="메모"></textarea>
				</div>
			</div>	

			<div class="wr-list flex-top">
				<div class="wr-list-label">파일 업로드</div>
				<div class="wr-list-con">
					<div class="my-filebox">
						<input name="" type="file" id="upload-0" multiple />
						<input type="text" value="선택된 파일이 없습니다." class="upload-name" disabled="disabled">
						<label for="upload-0" class="upload-btn">파일찾기</label>
					</div>
					<span class="ml15"><span class="color-red bold">00</span>가 <span class="color-red bold">000</span> 확인되었습니다.</span>
					<p class="help-block mt10 mb10">
						※ 파일은 총 00개 까지 등록 가능하며, 파일당 업로드 용량은 최대 00MB 까지 가능합니다.<br/>
						※ 이미지 파일 (JPG, PNG, GIF) 및 문서 파일 (PDF, WORD, HWP, EXCEL)만 등록 가능합니다<br/>
						※ 샘플 엑셀 양식은 <a href="#" target="_blank" class="bold color-blue">(여기)를 클릭</a>하여 다운로드 받아 사용해주세요.
					</p>
					<ul class="upload-file">
						<li>아파트 울타리 공사 공문_20201015.pdf<i class="del"></i></li>
						<li>아파트 울타리 공사 공문_20201015.hwp<i class="del"></i></li>
					</ul>
				</div>
			</div>

			<div class="wr-list flex-top">
				<div class="wr-list-label">이미지 업로드 <span class="help-block">- 미리보기</span></div>
				<div class="wr-list-con">
					<div class="fileContainer">									
						<div class="inner">
							<input type="file" name="" id="upload-01" class="img" />
							<label for="upload-01" class="upload-btn">이미지 업로드</label>
							<p class="help-block">
								권장 사이즈 : 가로 1000px * 세로 1000px<br>
								최소 사이즈 : 가로 600px * 세로 600px <br>
								용량 : 10MB 이하 <br>
								파일 유형 : JPG, PNG, GIF
							</p>							
						</div>
						<div class="upImg-preview"></div>
					</div>										
				</div>
			</div>

			<div class="wr-list flex-top">
				<div class="wr-list-label">이미지 업로드 (멀티) <span class="help-block">- 미리보기</span></div>
				<div class="wr-list-con">
					<div class="fileContainer">									
						<div class="inner">
							<input type="file" name="" id="upload-02" class="multiple" multiple>
							<label for="upload-02" class="upload-btn">이미지 업로드</label>
							<p class="help-block">
								최소 1장 최대 5장의 이미지를 올려주세요.<br>
								권장 사이즈 : 가로 1000px * 세로 1000px<br>
								최소 사이즈 : 가로 600px * 세로 600px <br>
								용량 : 10MB 이하 <br>
								파일 유형 : JPG, PNG, GIF
							</p>
						</div>
						<ul class="upImg-preview">
							<li><label for="upload-02" class="upload-empty">사진 추가</label></li>
						</ul>
					</div>					
				</div>
			</div>
			
		</div>
		</form>
		
	</div>

	<script type="text/javascript">
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

	<div class="btnSet">
		<a href="#" class="btn blue">미리보기</a>
		<a href="#" class="btn submit">확인</a>
		<a href="#" class="btn gray">취소</a>
	</div>

	<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


	<div class="mt100"></div>

<pre class="html-help">
<span class="help-title">기본 등록페이지 (필수입력 표기 2가지 타입)</span>
&lt;div class="<span class="color-yellow">"boxContainer write</span>"&gt;
	&lt;div class="<span class="color-yellow">wr-wrap</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;
			&lt;div class="<span class="color-yellow">wr-list-label</span>"&gt;타이틀&lt;/div&gt
			&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
		&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;
			&lt;div class="<span class="color-yellow">wr-list-label required</span>"&gt;타이틀&lt;/div&gt
			&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
			&lt;div class="<span class="color-yellow">wr-list-label</span>"&gt;타이틀&lt;/div&gt
			&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
		&lt;/div&gt
		...
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;
			&lt;div class="<span class="color-yellow">wr-list-label required2</span>"&gt;타이틀&lt;/div&gt
			&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
		&lt;/div&gt
	&lt;/div&gt
&lt;/div&gt
</pre><br>

	<div class="boxContainer write">
		<div class="wr-wrap">
			<div class="wr-list ">
				<div class="wr-list-label">타이틀</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder="입력">
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label required">타이틀</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder="입력">
				</div>
				<div class="wr-list-label">타이틀</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder="입력">
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label">타이틀</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder="입력">
				</div>
				<div class="wr-list-label">타이틀</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder="입력">
				</div>
			</div>
			<div class="wr-list">
				<div class="wr-list-label required2">타이틀</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span200" placeholder="입력">
				</div>
			</div>			
		</div>		
	</div>
	
	<div class="mt100"></div>
	
	<div class="flex">		
		<div class="flex1">
<pre class="html-help">
<span class="help-title">기본 등록페이지</span>
&lt;div class="<span class="color-yellow">"boxContainer write</span>"&gt;
	&lt;div class="<span class="color-yellow">wr-wrap</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;...&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;...&lt;/div&gt
		...
	&lt;/div&gt
&lt;/div&gt
</pre><br>

			<div class="boxContainer write">
				<div class="wr-wrap">
					<div class="wr-list ">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							내용
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<input type="text" name="" value="" class="span" placeholder="입력">
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							내용
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<input type="text" name="" value="" class="span" placeholder="입력">
						</div>
					</div>			
				</div>		
			</div>
		</div>

		<div class="flex1">
<pre class="html-help">
<span class="help-title">기본 등록페이지 (라인)</span>
&lt;div class="<span class="color-yellow">"boxContainer write</span>"&gt;
	&lt;div class="<span class="color-yellow">wr-wrap line</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;...&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;...&lt;/div&gt
		...
	&lt;/div&gt
&lt;/div&gt
</pre><br>

			<div class="boxContainer write">
				<div class="wr-wrap line">
					<div class="wr-list ">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							내용
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<input type="text" name="" value="" class="span" placeholder="입력">
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							내용
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<input type="text" name="" value="" class="span" placeholder="입력">
						</div>
					</div>			
				</div>		
			</div>
		</div>

		<div class="flex1">
<pre class="html-help">
<span class="help-title">라벨 가로사이즈 조절</span>
&lt;div class="<span class="color-yellow">"boxContainer write</span>"&gt;
	&lt;div class="<span class="color-yellow">wr-wrap line label100</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list</span>"&gt;...&lt;/div&gt
		...
	&lt;/div&gt
&lt;/div&gt
<span class="color-gray">label50, label60, label70 ~ label290</span>
</pre><br>

			<div class="boxContainer write">
				<div class="wr-wrap line label100">
					<div class="wr-list ">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							내용
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<input type="text" name="" value="" class="span" placeholder="입력">
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							내용
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<input type="text" name="" value="" class="span" placeholder="입력">
						</div>
					</div>			
				</div>		
			</div>
		</div>
	</div>

	<div class="mt100"></div>
	<div class="flex">		
		<div class="flex1">
			<div class="boxContainer write">
				<pre class="html-help">
<span class="help-title">라벨 높이 정렬</span>
&lt;div class="<span class="color-yellow">wr-wrap</span>"&gt;
	&lt;div class="<span class="color-yellow">wr-list</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list-label</span>"&gt;타이틀&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
	&lt;/div&gt
	&lt;div class="<span class="color-yellow">wr-list flex-top</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list-label</span>"&gt;타이틀 (위로맞춤)&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
	&lt;/div&gt
	&lt;div class="<span class="color-yellow">wr-list flex-bottom</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list-label</span>"&gt;타이틀 (아래로맞춤)&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
	&lt;/div&gt
&lt;/div&gt
</pre><br>
				<div class="wr-wrap">
					<div class="wr-list ">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<textarea name="" class="span" placeholder="내용 입력"></textarea>
						</div>
					</div>
					<div class="wr-list flex-top">
						<div class="wr-list-label">타이틀 (위로맞춤)</div>
						<div class="wr-list-con">
							<textarea name="" class="span" placeholder="내용 입력"></textarea>
						</div>
					</div>
					<div class="wr-list flex-bottom">
						<div class="wr-list-label">타이틀 (아래로맞춤)</div>
						<div class="wr-list-con">
							<textarea name="" class="span" placeholder="내용 입력"></textarea>
						</div>
					</div>
				</div>		
			</div>
		</div>

		<div class="flex1">
			<div class="boxContainer write">
				<pre class="html-help">
<span class="help-title">라벨 가운데 정렬</span>
&lt;div class="<span class="color-yellow">wr-wrap</span>"&gt;
	&lt;div class="<span class="color-yellow">wr-list</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list-label</span>"&gt;타이틀&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
	&lt;/div&gt
	&lt;div class="<span class="color-yellow">wr-list</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list-label tcenter</span>"&gt;타이틀 (가운데 정렬)&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
	&lt;/div&gt
	&lt;div class="<span class="color-yellow">wr-list</span>"&gt;
		&lt;div class="<span class="color-yellow">wr-list-label tright</span>"&gt;타이틀 (오른쪽 정렬)&lt;/div&gt
		&lt;div class="<span class="color-yellow">wr-list-con</span>"&gt;...&lt;/div&gt
	&lt;/div&gt
&lt;/div&gt
</pre><br>
				<div class="wr-wrap">
					<div class="wr-list ">
						<div class="wr-list-label">타이틀</div>
						<div class="wr-list-con">
							<textarea name="" class="span" placeholder="내용 입력"></textarea>
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label tcenter">타이틀 (가운데 정렬)</div>
						<div class="wr-list-con">
							<textarea name="" class="span" placeholder="내용 입력"></textarea>
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label tright">타이틀 (오른쪽 정렬)</div>
						<div class="wr-list-con">
							<textarea name="" class="span" placeholder="내용 입력"></textarea>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>

</section>

<script>
$(function() {
	$(document).on("click", ".add-list", function() {
		add_list();
	});

	$(document).on("click", ".del-list", function() {
		if(!confirm("선택하신 OOO이 삭제됩니다. 계속하시겠습니까?"))
			return false;
		var $li = $(this).closest("li");
		$li.remove();        
	});
});	

function add_list() {
	var $option_list = $(".option-list");
	var list = '<li>';
	list += '<input type="text" name="" value="" class="span300 mr15" placeholder="옵션명 입력">';
	list += '<label class="inp-wrap right-label"><input type="text" name="" value="" class="span150 price" placeholder="가격입력"><span class="label">원</span></label>';
	list += '<span class="del-list ml5">삭제</span>';
	list += '</li>';
	var $list_last = null;
	var $list_last = $option_list.find("li:last");
	$list_last.after(list);
	$('select').selectpicker('refresh');
	$("input.price").bind("keyup", function(event) {
		$(this).val(numberFormat($(this).val().replace(/[^0-9]/g,"")));
	});
}
function numberFormat(inputNumber) {
   return inputNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>

<?php include_once('footer.php'); ?>