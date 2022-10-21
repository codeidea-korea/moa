<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">포인트 관리</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<div class="wr-wrap label200">
			<div class="wr-list flex-top">
				<div class="wr-list-label">발송 포인트 기본 설정</div>
				<div class="wr-list-con">
					<div class="tbl-excel td-h4 span700">
						<table>
							<colgroup>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>포인트 유효기간</th>
									<td class="tleft">
										1.제한없음<br>
										2.지급일 기준 <input type="text" name="" value="" class="span60 simple ml5">까지 사용가능 (ex. 총 12 개월)
									</td>
								</tr>
								<tr>
									<th class="line-height120">포인트 만료기간<p class="fs11">(만료기간이후 정산 출금 불가능)</p></th>
									<td class="tleft">
										설정함  / 설정 안 함<br>
										알림시점  만료일 기준
									</td>
								</tr>
							</tbody>			
						</table>
					</div>
				</div>
			</div>
			<div class="wr-list flex-top">
				<div class="wr-list-label">포인트 유형 설정</div>
				<div class="wr-list-con">
					<div class="tbl-excel td-h4 span700">
						<table>
							<colgroup>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>회원가입 포인트</th>
									<td class="tleft">
										<div class="flex mb10">
											<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>사용함</label>
											<label class="radio-wrap ml30"><input type="radio" name="r1" value=""><span></span>사용안함</label>
										</div>
										<input type="text" name="" value="" class="span160 ml5" placeholder="포인트 금액"> point
									</td>
								</tr>
								<tr>
									<th>추천인 포인트</th>
									<td class="tleft">
										<div class="flex mb10">
											<label class="radio-wrap"><input type="radio" name="r2" value="" checked><span></span>사용함</label>
											<label class="radio-wrap ml30"><input type="radio" name="r2" value=""><span></span>사용안함</label>
										</div>
										<input type="text" name="" value="" class="span160 ml5" placeholder="포인트 금액"> point
									</td>
								</tr>
							</tbody>			
						</table>
					</div>
				</div>
			</div>
		</div>


	</div>

</section>

<?php include_once('footer.php'); ?>