<?php
$page_title = '모임 내역';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">모임 내역</div>

	<div class="boxContainer write">
		<div class="wr-wrap  label160">
			<div class="wr-list  flex-top">
				<div class="wr-list-label">검색</div>
				<div class="wr-list-con">
					<select class="" title="호스트명">
						<option>OOO</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
					<input type="text" name="" value="" class="span220" placeholder="모임명/호스트명">
					<a href="#" class="btn reverse span80">조회</a>
				</div>
			</div>
			<div class="wr-list flex-top">
				<div class="wr-list-label">모임 유형</div>
				<div class="wr-list-con">
					<select class="" title="온라인">
						<option>OOO</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
					<select class="" title="N회차">
						<option>OOO</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
					<select class="" title="고정형 모임">
						<option>OOO</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
					<a href="#" class="btn reverse span80">조회</a>
				</div>
			</div>
			<div class="wr-list flex-top">
				<div class="wr-list-label">모임 날짜</div>
				<div class="wr-list-con">
					<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
					<span class="ml5 mr5">~</span>
					<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
					<div class="datepickContainer ml5">
						<a href="#" class="dl active">오늘</a>
						<a href="#" class="dl">1개월</a>
						<a href="#" class="dl">6개월</a>
						<a href="#" class="dl">1년</a>
						<a href="#" class="dl">5년</a>
						<a href="#" class="dl">전체</a>
					</div>
					<p class="mt10">
						<label class="radio-wrap"><input type="radio" name="rrr" value="" ><span></span>승인된 모임만 보기</label>
						<label class="radio-wrap"><input type="radio" name="rrr" value="" checked><span></span>폐강된 모임만 보기</label>
					</p>
				</div>
			</div>			
		</div>

		<div class="mt80"></div>		
		
		<div class="box-header">
			<a href="#" class="btn span110">모임등록</a>
			<div class="right">				
				<select class="" title="">
					<option>5개</option>
					<option>OOO</option>
					<option>OOO</option>
					<option>...</option>
				</select>
			</div>
		</div>

		<div class="boxContainer padding15">
			<div class="tbl-basic white odd">				
				<table>
					<colgroup>
						<col width="90">
						<col width="115">
						<col width="160">
						<col width="90">
						<col width="170">
						<col width="100">
						<col width="180">
						<col>
						<col width="90">
						<col width="130">
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>모임ID</th>
							<th>썸네일</th>
							<th>모임명</th>
							<th>모임상태</th>
							<th>정가가격</th>
							<th>인원수</th>
							<th>모집마감일</th>
							<th>모임 일시</th>
							<th>검수상태</th>
							<th>폐강여부</th>
							<th>수정/삭제</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td><span class="color-blue">126493<span></td>
							<td><img src="../img/temp/temp04.png"></td>
							<td>동네한바퀴!</td>
							<td>종료</td>
							<td>30,000</td>
							<td><span class="color-blue">5/5<span></td>
							<td>2022-03-01</td>
							<td class="tleft"><span class="color-blue">고정형<br>2022-03-01 20:20<span></td>
							<td>승인</td>
							<td><a href="#" class="btn reverse red span100">폐강처리</a></td>
							<td><a href="#" class="btn reverse small gray">수정</a><a href="#" class="btn reverse small red">삭제</a></td>
						</tr>
						<tr>
							<td><span class="color-blue">126493<span></td>
							<td><img src="../img/temp/temp04.png"></td>
							<td>동네한바퀴!</td>
							<td>종료</td>
							<td>30,000</td>
							<td><span class="color-blue">5/5<span></td>
							<td>2022-03-01</td>
							<td class="tleft"><span class="color-blue">고정형<br>2022-03-01 20:20<span></td>
							<td>승인</td>
							<td><a href="#" class="btn reverse red span100">폐강처리</a></td>
							<td><a href="#" class="btn reverse small gray">수정</a><a href="#" class="btn reverse small red">삭제</a></td>
						</tr><tr>
							<td><span class="color-blue">126493<span></td>
							<td><img src="../img/temp/temp04.png"></td>
							<td>동네한바퀴!</td>
							<td>종료</td>
							<td>30,000</td>
							<td><span class="color-blue">5/5<span></td>
							<td>2022-03-01</td>
							<td class="tleft"><span class="color-blue">고정형<br>2022-03-01 20:20<span></td>
							<td>승인</td>
							<td><a href="#" class="btn reverse red span100">폐강처리</a></td>
							<td><a href="#" class="btn reverse small gray">수정</a><a href="#" class="btn reverse small red">삭제</a></td>
						</tr>
						<tr>
							<td><span class="color-blue">126493<span></td>
							<td><img src="../img/temp/temp04.png"></td>
							<td>동네한바퀴!</td>
							<td>종료</td>
							<td>30,000</td>
							<td><span class="color-blue">5/5<span></td>
							<td>2022-03-01</td>
							<td class="tleft"><span class="color-blue">고정형<br>2022-03-01 20:20<span></td>
							<td>승인</td>
							<td><a href="#" class="btn reverse red span100">폐강처리</a></td>
							<td><a href="#" class="btn reverse small gray">수정</a><a href="#" class="btn reverse small red">삭제</a></td>
						</tr>
						<tr>
							<td><span class="color-blue">126493<span></td>
							<td><img src="../img/temp/temp04.png"></td>
							<td>동네한바퀴!</td>
							<td>종료</td>
							<td>30,000</td>
							<td><span class="color-blue">5/5<span></td>
							<td>2022-03-01</td>
							<td class="tleft"><span class="color-blue">고정형<br>2022-03-01 20:20<span></td>
							<td>승인</td>
							<td><a href="#" class="btn reverse red span100">폐강처리</a></td>
							<td><a href="#" class="btn reverse small gray">수정</a><a href="#" class="btn reverse small red">삭제</a></td>
						</tr>
					</tbody>			
				</table>				
			</div>
			<div class="mt25"></div>
		</div>

		<div class="pagination">
			<a href="#" class="pg-btn first"></a>
			<a href="#" class="pg-btn prev"></a>
			<a href="#" class="pg-btn active">1</a>
			<a href="#" class="pg-btn">2</a>
			<a href="#" class="pg-btn">3</a>
			<a href="#" class="pg-btn">4</a>
			<a href="#" class="pg-btn">5</a>
			<a href="#" class="pg-btn">6</a>
			<a href="#" class="pg-btn">7</a>
			<a href="#" class="pg-btn">8</a>
			<a href="#" class="pg-btn">9</a>
			<a href="#" class="pg-btn">10</a>
			<a href="#" class="pg-btn next"></a>
			<a href="#" class="pg-btn last"></a>
		</div>




	</div>

</section>

<?php include_once('footer.php'); ?>