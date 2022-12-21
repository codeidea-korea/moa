<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">1:1 문의 > 문의사항 등록</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<form name="" action="" method="post">
		<div class="wr-wrap" style="width:1030px">
			<div class="wr-list">
				<div class="wr-list-con">
					<div class="tbl-excel tleft td-h5">
						<table>
							<colgroup>
								<col width="180">
								<col>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>이름</th>
									<td>
										홍길동
									</td>
									<th>연락처</th>
									<td>
										010-1234-5678
									</td>
								</tr>
								<tr>
									<th>이메일</th>
									<td>
										newmeon@naver.com
									</td>
									<th>구분</th>
									<td>
										공지사항
									</td>
								</tr>
								<tr>
									<th>등록일</th>
									<td>
										2022.03.14   11:00:00
									</td>
									<th>답변일</th>
									<td>
										2022.03.14   11:00:00
									</td>
								</tr>
							</tbody>			
						</table>
					</div>
				</div>
			</div>
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
									<th>내용</th>
									<td class="padding0">
										<textarea name="" class="span" style="height:190px;border:0" placeholder="">1:1 문의 1:1 문의 1:1 문의 1:1 문의 1:1 문의 1:1 문의 1:1 문의 1:1 문의 1:1 문의 1:1 문의</textarea>
									</td>
								</tr>
								<tr>
									<th>답변</th>
									<td class="padding0">
										<textarea name="" class="span" style="height:190px;border:0" placeholder="">답변 답변 답변 답변 답변 답변 답변 답변 답변 답변 답변 답변 답변 답변 답변 답변</textarea>										
									</td>									
								</tr>							
							</tbody>			
						</table>
					</div>
				</div>
			</div>
			
		</div>
		</form>

		<div class="btnSet">
			<a href="#" class="btn reverse gray span150">목록</a>
			<a href="#" class="btn reverse gray span150">취소</a>
			<a href="#" class="btn span150 submit">저장</a>
		</div>
	</div>

</section>

<?php include_once('footer.php'); ?>