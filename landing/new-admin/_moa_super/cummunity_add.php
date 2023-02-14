<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">커뮤니티 추가</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<div class="box-header">커뮤니티 목록 입력 후 추가 버튼을 클릭 해 주세요.</div>

		<div class="tbl-basic border th-h6 td-h7 fs14 white odd line-nth-1">				
			<table>
				<colgroup>
					<col width="110">
					<col>
					<col>
					<col>
					<col>
					<col>
					<col width="130">
					<col width="130">
				</colgroup>
				<thead>
					<tr>
						<th>노출순위</th>
						<th>제목</th>
						<th>공개</th>
						<th>순위 조정</th>
						<th>게시물 수(개)</th>
						<th>호스트명</th>
						<th>수정</th>
						<th>삭제</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>전체</td>
						<td><span class="color-blue">공개</span></td>
						<td>
							<div class="flex flex-center">
								<button type="button" class="order-up">위로</button>
								<button type="button" class="order-down">아래로</button>
							</div>
						</td>
						<td>25</td>
						<td>2022.03.14</td>
						<td><a href="#" class="btn small">수정</a></td>
						<td><a href="#" class="btn small">삭제</a></td>
					</tr>
					<tr>
						<td>2</td>
						<td>인기글</td>
						<td><span class="color-blue">공개</span></td>
						<td>
							<div class="flex flex-center">
								<button type="button" class="order-up">위로</button>
								<button type="button" class="order-down">아래로</button>
							</div>
						</td>
						<td>25</td>
						<td>2022.03.14</td>
						<td><a href="#" class="btn small">수정</a></td>
						<td><a href="#" class="btn small">삭제</a></td>
					</tr>
					<tr>
						<td>3</td>
						<td>자유</td>
						<td><span class="color-blue">공개</span></td>
						<td>
							<div class="flex flex-center">
								<button type="button" class="order-up">위로</button>
								<button type="button" class="order-down">아래로</button>
							</div>
						</td>
						<td>25</td>
						<td>2022.03.14</td>
						<td><a href="#" class="btn small">수정</a></td>
						<td><a href="#" class="btn small">삭제</a></td>
					</tr>
					<tr>
						<td>4</td>
						<td>연애</td>
						<td><span class="color-blue">공개</span></td>
						<td>
							<div class="flex flex-center">
								<button type="button" class="order-up">위로</button>
								<button type="button" class="order-down">아래로</button>
							</div>
						</td>
						<td>25</td>
						<td>2022.03.14</td>
						<td><a href="#" class="btn small">수정</a></td>
						<td><a href="#" class="btn small">삭제</a></td>
					</tr>
					<tr>
						<td>5</td>
						<td>직장 고민 상담소</td>
						<td><span class="color-blue">공개</span></td>
						<td>
							<div class="flex flex-center">
								<button type="button" class="order-up">위로</button>
								<button type="button" class="order-down">아래로</button>
							</div>
						</td>
						<td>25</td>
						<td>2022.03.14</td>
						<td><a href="#" class="btn small">수정</a></td>
						<td><a href="#" class="btn small">삭제</a></td>
					</tr>
					<tr>
						<td>6</td>
						<td>취미생활</td>
						<td><span class="color-blue">공개</span></td>
						<td>
							<div class="flex flex-center">
								<button type="button" class="order-up">위로</button>
								<button type="button" class="order-down">아래로</button>
							</div>
						</td>
						<td>25</td>
						<td>2022.03.14</td>
						<td><a href="#" class="btn small">수정</a></td>
						<td><a href="#" class="btn small">삭제</a></td>
					</tr>
					<tr>
						<td class="cell-mainColor">7</td>
						<td class="cell-mainColor">모임 열어주세요</td>
						<td class="cell-mainColor"><span class="color-blue">공개</span></td>
						<td class="cell-mainColor">
							<div class="flex flex-center">
								<button type="button" class="order-up">위로</button>
								<button type="button" class="order-down">아래로</button>
							</div>
						</td>
						<td class="cell-mainColor">25</td>
						<td class="cell-mainColor">2022.03.14</td>
						<td class="cell-mainColor"><a href="#" class="btn small">수정</a></td>
						<td class="cell-mainColor"><a href="#" class="btn small">삭제</a></td>
					</tr>
				</tbody>
			</table>
			
			<div class="flex flex-middle mt30">
				<input type="text" name="" value="" class="span590" placeholder="모임 열어주세요  (10글자 내외)">
				<a href="#" class="btn span70">추가</a>
			</div>
		</div>		

	</div>

</section>

<?php include_once('footer.php'); ?>