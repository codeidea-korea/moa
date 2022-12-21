<?php
define('_INDEX_', true);
include_once('./header.php');
?>


<section id="main" class="container background">
	
	<div style="max-width:1350px;">

		<div class="h3 mb40">김모아님, 반갑습니다.</div>

		<div class="boxContainer">			
			<ul class="flex">
				<li class="flex1 tcenter"><span>2022.03.14(월)</span><b class="ml15 mainColor">방문 80명</b></li>
				<li class="flex1 tcenter"><span>2022.03.15(화)</span><b class="ml15 mainColor">방문 64명</b></li>
				<li class="flex1 tcenter"><span>2022.03.16(수)</span><b class="ml15 mainColor">방문 120명</b></li>
				<li class="flex1 tcenter"><span>2022.03.17(목)</span><b class="ml15 mainColor">방문 107명</b></li>
				<li class="flex1 tcenter"><span>2022.03.18(금)</span><b class="ml15 mainColor">방문 78명</b></li>
			</ul>
		</div>

		<div class="mt30"></div>
		
		<div class="h6 mb10">승인 요청 [처리해야할 요청 사항 입니다]</div>
		<div class="flex gap20 flex-stretch">
			<div class="boxContainer flex1 flexCenter column">
				<span class="fs18 color-gray noto500">게스트 승인 요청</span>
				<span class="new-num">12</span>
				<a href="#" class="more">더보기<i class="ml5 arrow-right"></i></a>
			</div>
			<div class="boxContainer flex1 flexCenter column">
				<span class="fs18 color-gray noto500">호스트 승인 요청</span>
				<span class="new-num">20</span>
				<a href="#" class="more">더보기<i class="ml5 arrow-right"></i></a>
			</div>
			<div class="boxContainer flex1 flexCenter column">
				<span class="fs18 color-gray noto500">모임 승인 요청</span>
				<span class="new-num">10</span>
				<a href="#" class="more">더보기<i class="ml5 arrow-right"></i></a>
			</div>
			<div class="boxContainer flex1 flexCenter column">
				<span class="fs18 color-gray noto500">프로필 수정 승인 요청</span>
				<span class="new-num">12</span>
				<a href="#" class="more">더보기<i class="ml5 arrow-right"></i></a>
			</div>
		</div>

		<div class="mt60"></div>

		<div class="slide-toggle-wraper">
			<div class="slide-toggle-list open">
				<div class="slide-opener">최근 등록 모임 <span class="noto600">3건</span></div>
				<div class="slideCon">
					<div class="tbl-basic white odd border">
						<table>
							<colgroup>
								<col width="70">
								<col>
								<col>
								<col>
								<col>
								<col>
								<col>
								<col>
							</colgroup>
							<thead>
								<tr>
									<th>번호</th>
									<th>모임 유형1</th>
									<th>모임 유형2</th>
									<th>모임 유형3</th>
									<th>모임 제목</th>
									<th>호스트명</th>
									<th>호스트 번호</th>
									<th>등록 날짜</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>오프라인</td>
									<td>N회자</td>
									<td>고정형</td>
									<td>런닝모임</td>
									<td>김스트</td>
									<td>010-1234-5678</td>
									<td class="date">2022.03.21</td>
								</tr>
								<tr>
									<td>2</td>
									<td>오프라인</td>
									<td>1회자</td>
									<td>자율형</td>
									<td>사진동호회</td>
									<td>김스트</td>
									<td>010-1234-5678</td>
									<td class="date">2022.03.21</td>
								</tr>
								<tr>
									<td>3</td>
									<td>온라인</td>
									<td>1회자</td>
									<td>고정형</td>
									<td>런닝모임</td>
									<td>김스트</td>
									<td>010-1234-5678</td>
									<td class="date">2022.03.21</td>
								</tr>
							</tbody>			
						</table>
					</div>
					<div class="btnSet mt20">
						<a href="#" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div class="mt60"></div>

		<div class="flex gap30">
			<div class="slide-toggle-wraper flex1">
				<div class="slide-toggle-list open">
					<div class="slide-opener">최근 가입한 호스트 <span class="noto600">10건</span></div>
					<div class="slideCon">
						<div class="flex fs13 line-height120 color-gray">
							<div class="flex1 tcenter">
								<span class="profile-thumb"></span>
								<p class="mt10">
									NAME<br>
									<span class="fs12">abcd@abcd.com</span>
								</p>
							</div>
							<div class="flex1 tcenter">
								<span class="profile-thumb" style="background-image:url('../img/temp/temp_user.png');"></span>
								<p class="mt10">
									NAME<br>
									<span class="fs12">abcd@abcd.com</span>
								</p>
							</div>
							<div class="flex1 tcenter">
								<span class="profile-thumb" style="background-image:url('../img/temp/temp06.jpg');"></span>
								<p class="mt10">
									NAME<br>
									<span class="fs12">abcd@abcd.com</span>
								</p>
							</div>
						</div>
						<div class="btnSet mt20">
							<a href="#" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="slide-toggle-wraper flex1">
				<div class="slide-toggle-list open">
					<div class="slide-opener">최근 가입한 게스트 <span class="noto600">10건</span></div>
					<div class="slideCon">
						<div class="flex fs13 line-height120 color-gray">
							<div class="flex1 tcenter">
								<span class="profile-thumb"></span>
								<p class="mt10">
									NAME<br>
									<span class="fs12">abcd@abcd.com</span>
								</p>
							</div>
							<div class="flex1 tcenter">
								<span class="profile-thumb" style="background-image:url('../img/temp/temp_user.png');"></span>
								<p class="mt10">
									NAME<br>
									<span class="fs12">abcd@abcd.com</span>
								</p>
							</div>
							<div class="flex1 tcenter">
								<span class="profile-thumb" style="background-image:url('../img/temp/temp06.jpg');"></span>
								<p class="mt10">
									NAME<br>
									<span class="fs12">abcd@abcd.com</span>
								</p>
							</div>
						</div>
						<div class="btnSet mt20">
							<a href="#" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="slide-toggle-wraper flex1">
				<div class="slide-toggle-list open">
					<div class="slide-opener">최근 문의사항 <span class="noto600">3건</span></div>
					<div class="slideCon">
						<ul class="ul_basic fs13 color-gray">
							<li><a href="#">문의 사항 1</a></li>
							<li><a href="#">문의 사항 1</a></li>
							<li><a href="#">문의 사항 1</a></li>
						</ul>
						<div class="btnSet mt25">
							<a href="#" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>

	

	



</section>

<?php include_once('./footer.php'); ?>