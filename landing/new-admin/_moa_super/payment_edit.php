<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">결제 내역 상세 - 수정</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<div class="tbl-excel tleft">				
			<table>
				<colgroup>
					<col width="150">
					<col>
					<col width="150">
					<col>
				</colgroup>
				<tbody>
					<tr>
						<th>주문번호</th>
						<td><a href="#" class="color-blue underline">31231241</a></td>
						<th>결제번호</th>
						<td>CA1241214</td>
					</tr>
					<tr>
						<th>입금자명</th>
						<td><a href="#" class="color-blue underline">김모아</a></td>
						<th>사용자 ID</th>
						<td>21314412</td>
					</tr>
					<tr>
						<th>결제금액</th>
						<td>50,000원</td>
						<th>결제수단</th>
						<td>삼성카드 1111-****-****-1111</td>
					</tr>
					<tr>
						<th>결제날짜</th>
						<td>2022.03.14   11:12:45</td>
						<th>환불처리</th>
						<td>-</td>
					</tr>
					<tr>
						<th>포인트</th>
						<td>-1000점 차감</td>
						<th>쿠폰</th>
						<td>-5000원</td>
					</tr>
					<tr>
						<th>포인트</th>
						<td>-1000</td>
						<th>최종 결제 금액</th>
						<td>49,000원</td>
					</tr>
					<tr>
						<th>쿠폰</th>
						<td>-5000</td>
						<th></th>
						<td></td>
					</tr>
				</tbody>			
			</table>
			
			<p class="mt20">
				<label class="checkbox-wrap"><input type="checkbox" name="" value="" checked><span class="mr10"></span>주문자님께 입금,주문내역을 메일로 발송합니다.</label>
			</p>
		</div>

		<div class="btnSet">
			<a href="#" class="btn submit span150">저장</a>
		</div>

	</div>

</section>

<?php include_once('footer.php'); ?>