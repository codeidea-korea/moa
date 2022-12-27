<div class="layer-popup" id="pop-moim-info">
	<div class="popContainer">
		<div class="pop-inner" style="width:1300px">
			<span class="pop-closer">팝업닫기</span>
			<input type="hidden" name="it_id" />
			<div class="pop-header">모임 신청 현황 - 1회차 고정형</div>
			<div class="boxContainer padding15">
				<div class="tbl-basic white odd">				
					<table>
						<colgroup>
							<col width="180">
							<col width="200">							
							<col>
							<col>
							<col width="240">
						</colgroup>
						<thead>
							<tr>
								<th>모임명</th>
								<th>모집기간</th>
								<th>모임ID</th>
								<th>모임일시</th>
								<th>모집인원(최소/최대)</th>
							</tr>
						</thead>

						<tbody id="applyInfo">
							<!-- //모임스케쥴 회자가 여러개일때 -->
<!--							<tr>-->
<!--								<td rowspan="3">213132</td>-->
<!--								<td rowspan="3">동네한바퀴!</td>-->
<!--								<td>202-03-01 ~ 2022-03-04 (1차)</td>-->
<!--								<td>2022-03-05-14:00 PM</td>-->
<!--								<td>3/5</td>								-->
<!--							</tr>-->
<!--							<tr>-->
<!--								<td>202-03-01 ~ 2022-03-04 (1차)</td>-->
<!--								<td>2022-03-05-14:00 PM</td>-->
<!--								<td>3/5</td>								-->
<!--							</tr>-->
<!--							<tr>-->
<!--								<td>202-03-01 ~ 2022-03-04 (1차)</td>-->
<!--								<td>2022-03-05-14:00 PM</td>-->
<!--								<td>3/5</td>								-->
<!--							</tr>-->
							<!-- //모임스케쥴 회차가 1개일때
							<td>213132</td>
								<td>동네한바퀴!</td>
								<td>202-03-01 ~ 2022-03-04</td>
								<td>2022-03-05-14:00</td> //모임유형이 자율형일때 -> <td>호스트아 게스트의 협의필요</td>
								<td>3/5</td>
							</td> -->
						</tbody>			
					</table>				
				</div>
			</div>
			
			<div class="pop-header mt50">모임 신청 인원 정보</div>
			<div class="boxContainer padding15">
				<div class="tbl-basic white odd">				
					<table>
						<colgroup>
							<col width="240">
							<col width="170">
							<col width="160">
							<col>
							<col>
						</colgroup>
						<thead>
							<tr>
								<th>모임진행일자</th>
								<th>진행시간</th>
								<th>신청상태</th>
								<th>이름</th>
								<th>휴대폰번호</th>
							</tr>
						</thead>

						<tbody id="applyPeople">

						</tbody>			
					</table>				
				</div>
			</div>

			<div class="btnSet">
				<a href="#" class="btn large gray span90 popClose">닫기</a>
			</div>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>
