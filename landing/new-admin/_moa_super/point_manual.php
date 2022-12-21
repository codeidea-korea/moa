<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">포인트 수동지급 및 차감 설정</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<div class="wr-wrap label250">
			<div class="wr-list flex-top">
				<div class="wr-list-label">포인트 수동지급 및 차감 관리</div>
				<div class="wr-list-con">
					<div class="tbl-excel td-h5">
						<table>
							<colgroup>
								<col width="180">
								<col>
							</colgroup>
							<tbody>
								<tr>
									<th>포인트 적용 유저</th>
									<td class="tleft">
										<select class="span120" title="">
											<option>이름</option>
											<option>전화번호</option>
										</select>
										<input type="text" name="" value="" class="ml10 span220" placeholder=""><a href="#" class="ml10 btn reverse span100">조회<i class="arrow-right ml10"></i></a>
									</td>
								</tr>
								<tr>
									<th>적용 포인트</th>
									<td class="tleft">
										<input type="text" name="" value="" class="span160" placeholder="포인트 금액"> point
										<input type="text" name="" value="담당자 아이디" class="span160" readOnly placeholder="입력">
										<input type="text" name="" value="" class="span220" placeholder="메모">
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