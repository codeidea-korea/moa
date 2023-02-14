<?php
$page_title = 'form_js';
include_once('header.php');
?>

<section class="container">
	<div class="page-title"><?=$page_title?></div>
	
	<div class="padding10">

		<form name="" action="" method="post">
		<div class="wr-wrap line label200">

			<div class="wr-list">
				<div class="wr-list-label">채크박스</div>
				<div class="wr-list-con">
					<input type="checkbox" name="" value="" checked data-label="옵션A" />
					<input type="checkbox" name="" value="" data-label="옵션B" />
					<input type="checkbox" name="" value="" data-label="옵션C" />
					<input type="checkbox" name="" value="" data-label="옵션D" />
					<input type="checkbox" name="" value="" data-label="옵션E" />
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">채크박스 (toggle style)</div>
				<div class="wr-list-con">
					<input type="checkbox" name="" value="1" class="toggle-light" checked data-on="공개" data-off="비공개" />
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label flex-start">라디오버튼</div>
				<div class="wr-list-con">
					<input type="radio" name="r1" value="" checked data-label="옵션A">
					<input type="radio" name="r1" value="" data-label="옵션B">
					<input type="radio" name="r1" value="" data-label="옵션C">
					<input type="radio" name="r1" value="dong" data-label="옵션D(추가선택)">
					<input type="radio" name="r1" value="" data-label="옵션E">
					<div id="sel-dong" class="mt15">
						<select multiple data-actions-box="true" title="동 선택">
							<option>OOO동</option>
							<option>OOO동</option>
							<option>OOO동</option>
							<option>OOO동</option>
						</select>
					</div>
				</div>
				<script>$(function(){ matchOnOff('input[name="r1"]', 'dong', '#sel-dong'); });</script>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">라디오버튼 (버튼스타일)</div>
				<div class="radio-btn-wrap">
					<input type="radio" name="r2" value="" class="radio-btn" data-label="일반" checked>
					<input type="radio" name="r2" value="" class="radio-btn" data-label="긴급">
					<input type="radio" name="r2" value="" class="radio-btn" data-label="중요">
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
				<div class="wr-list-label">INPUT + 크기</div>
				<div class="wr-list-con">
					<input type="text" name="" value="" class="span80 mini" data-label-right="까지 사용가능">
					<span class="help-block">(ex. 총 12개월)</span>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label flex-start">INPUT + LABEL</div>
				<div class="wr-list-con">					
					<input type="text" name="" value="" class="span130" data-label="왼쪽 라벨">
					<input type="text" name="" value="" class="span130" data-label-right="오른쪽 라벨">
					<input type="text" name="" value="" class="span130" data-label="왼쪽 라벨" data-label-right="오른쪽 라벨">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT + LABEL(inline)</div>
				<div class="wr-list-con">					
					<input type="text" name="" value="" class="span200" data-label-inline="왼쪽 라벨">
					<input type="text" name="" value="" class="span200" data-label-inline-right="오른쪽 라벨">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label">INPUT 날짜</div>
				<div class="wr-list-con">					
					<input type="text" name="" value="" class="span130 datepicker" placeholder="날짜 선택">
					<input type="text" name="" value="" class="span130 datepicker">
					<input type="text" name="" value="" class="span130 datepicker" data-label="날짜">
					<input type="text" name="" value="" class="span110 datepicker" data-label-inline="날짜" placeholder=" ">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label flex-start">INPUT 금액</div>
				<div class="wr-list-con">					
					<input type="text" name="" value="" class="span130 price tright" data-label-right="원">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label flex-start">INPUT 전화번호</div>
				<div class="wr-list-con">					
					<input type="text" name="" value="" class="span160 phone">
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label flex-start">TEXTAREA</div>
				<div class="wr-list-con">
					<textarea name="" class="autoSize" placeholder="내용"></textarea>
				</div>
			</div>

			<div class="wr-list">
				<div class="wr-list-label flex-start">TEXTAREA (mini)</div>
				<div class="wr-list-con">
					<textarea name="" class="mini autoSize" placeholder="메모"></textarea>
				</div>
			</div>
			
		</div>
		
	</div>

	<div class="btnSet">
		<a href="#" class="btn blue popup-ajax">미리보기</a>
		<a href="#" class="btn submit">확인</a>
		<a href="#" class="btn gray">취소</a>
	</div>

</section>



<?php include_once('footer.php'); ?>