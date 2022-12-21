<?php
define('_INDEX_', true);
include_once('header.php');
?>


<section id="main" class="container background">
	
	<div class="section-title">내 정보</div>

	<div class="flex gap15 flex-stretch" style="">
		<div class="boxContainer flex flex-top padding30 span650">			
			<div class="main-profile-thumb" style="background-image:url(<?=$common_path?>/img/temp/temp_user.png);"></div>
			<div class="main-profile-con">
				<div class="header">
					<span class="name">모아모아 님</span>
					<span class="tag super-host">슈퍼 관리자</span>
					<p class="fs12 color-gray mt5">초대코드 : djkfsjeoisl2132</p>
				</div>				
				<div class="con">
					마음을 녹이는 도자기 모아모아 입니다<br>
					따스한 파스텔 빛 색소지로 나만의 특별한 도자기를 만들 수 있어요 ~ <br>
					말랑거리는 흙에서 부터 음식을 담는 그릇 모양까지 직접 할 수 있어요. <br>
					저는 옆에서 방법을 알려드릴게요!
				</div>
				<div class="btnSet tleft">
					<a href="#" class="btn gray span150">내 정보 수정</a>
					<a href="#" class="btn span160">모임 등록하기</a>
				</div>
			</div>
		</div>
		<div class="flex1 flex gap15 column">
			<div class="flex flex1 gap15 flex-stretch">
				<div class="boxContainer flex1 flexCenter column">
					<span class="fs25 mont500 mainColor mb15">3</span>
					<span class="fs16 color-gray noto500">이번 달 진행모임</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="fs25 mont500 mainColor mb15">120</span>
					<span class="fs16 color-gray noto500">내 모임 후기</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="fs25 mont500 mainColor mb15">4.5</span>
					<span class="fs16 color-gray noto500">평균 모임 별점</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="fs25 mont500 mainColor mb15">85%</span>
					<span class="fs16 color-gray noto500">QnA 응답률</span>
				</div>
			</div>
			<div class="flex flex1 gap15 flex-stretch">
				<div class="boxContainer flex1">
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">평균 모임 별점</span>
						<span class="right fs22 noto500">45,000 P</span>
					</div>
					<hr>
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">내 쿠폰</span>
						<span class="right fs22 noto500">4장</span>
					</div>
				</div>
				<div class="boxContainer flex1">
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">이번 달 매출액</span>
						<span class="right fs22 noto500">522,000원</span>
					</div>
					<hr>
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">전체 매출액</span>
						<span class="right fs22 noto500">1,309,345원</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="mt60"></div>

	<div class="section-title">대시보드</div>

	<div class="flex gap15 flex-stretch">
		<div class="boxContainer flex1 padding25">
			<div class="fs13">총 회원수</div>
			<div class="fs16 bold mt10">00개</div>
			<hr>
			<div class="box-bottom">
				회원관리<a href="#" class="more">More</a>
			</div>
		</div>
		<div class="boxContainer flex1 padding25">
			<div class="flex">
				<div class="flex1">
					<div class="fs13">총합</div>
					<div class="fs16 bold mt10">00개</div>
				</div>
				<div class="flex1">
					<div class="fs13">진행 중인 프로젝트</div>
					<div class="fs16 bold mt10">00개</div>
				</div>
			</div>
			<hr>
			<div class="box-bottom">
				프로젝트관리<a href="#" class="more">More</a>
			</div>
		</div>
		<div class="boxContainer flex1 padding25">
			<div class="fs13">총 회원수</div>
			<div class="fs16 bold mt10">00개</div>
			<hr>
			<div class="box-bottom">
				바이어관리<a href="#" class="more">More</a>
			</div>
		</div>
		<div class="boxContainer flex1 padding25">
			<div class="fs13">총 문의수</div>
			<div class="fs16 bold mt10">00개</div>
			<hr>
			<div class="box-bottom">
				문의관리<a href="#" class="more">More</a>
			</div>
		</div>
	</div>
	
	<div class="flex gap15 mt15">
		<div class="boxContainer flex1 padding25">
			<div class="tbl-basic td-h3">
				<div class="tbl-header">
					<div class="title">최근 게시물</div>
					<div class="rightSet"><a href="#" class="list-more">더보기</a></div>
				</div>
				<table class="mainColor">
					<colgroup>
						<col width="160">
						<col>
						<col width="150">
						<col width="150">
					</colgroup>
					<thead class="bar">
						<tr>
							<th>게시판</th>
							<th>제목</th>
							<th>이름</th>
							<th>일시</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="#" class="table_name">현대트랜시스 협력사 B2B</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">현대트랜시스 협력사 B2B</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">현대트랜시스 협력사 B2B</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
					</tbody>					
				</table>				
			</div>
		</div>
		<div class="boxContainer flex1 padding25">
			<div class="tbl-basic td-h3">
				<div class="tbl-header">
					<div class="title">견적요청</div>
					<div class="rightSet"><a href="#" class="list-more">더보기</a></div>
				</div>
				<table class="mainColor">
					<colgroup>
						<col width="150">
						<col>
						<col width="150">
						<col width="150">
					</colgroup>
					<thead class="bar">
						<tr>
							<th>게시판</th>
							<th>제목</th>
							<th>이름</th>
							<th>일시</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="#" class="table_name">견적요청 _ Business</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">견적요청 _ Business</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">견적요청 _ Business</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
					</tbody>					
				</table>				
			</div>
		</div>
	</div>

	<div class="flex gap15 mt15">
		<div class="boxContainer flex1 padding25">
			<div class="tbl-basic td-h3">
				<div class="tbl-header">
					<div class="title">최근 게시물</div>
					<div class="rightSet"><a href="#" class="list-more">더보기</a></div>
				</div>
				<table class="mainColor">
					<colgroup>
						<col width="160">
						<col>
						<col width="150">
						<col width="150">
					</colgroup>
					<thead class="bar">
						<tr>
							<th>게시판</th>
							<th>제목</th>
							<th>이름</th>
							<th>일시</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="#" class="table_name">현대트랜시스 협력사 B2B</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">현대트랜시스 협력사 B2B</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">현대트랜시스 협력사 B2B</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
					</tbody>					
				</table>				
			</div>
		</div>
		<div class="boxContainer flex1 padding25">
			<div class="tbl-basic td-h3">
				<div class="tbl-header">
					<div class="title">견적요청</div>
					<div class="rightSet"><a href="#" class="list-more">더보기</a></div>
				</div>
				<table class="mainColor">
					<colgroup>
						<col width="150">
						<col>
						<col width="150">
						<col width="150">
					</colgroup>
					<thead class="bar">
						<tr>
							<th>게시판</th>
							<th>제목</th>
							<th>이름</th>
							<th>일시</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="#" class="table_name">견적요청 _ Business</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">견적요청 _ Business</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
						<tr>
							<td><a href="#" class="table_name">견적요청 _ Business</a></td>
							<td><a href="#" class="subject">협력사 정보등록 공고</a></td>
							<td>현대트랜시스</td>
							<td class="date">2021. 03. 12</td>
						</tr>
					</tbody>					
				</table>				
			</div>
		</div>
	</div>

	<div class="mt80"></div>

	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-style@latest/dist/chartjs-plugin-style.min.js"></script>
	
	<div class="section-title">통계자료</div>

	<div class="flex gap15">
		<div class="flex column gap15" style="width:570px;">
			<div class="boxContainer">				
				<div class="result-box">
					<span class="label">실시간 일일 인증 횟수</span>
					<div class="value color-red">513,457</div>
				</div>
				<div class="result-box">
					<span class="label">누적 이용자수</span>
					<div class="value color-blue">1,235,678</div>
				</div>
				<div class="chartContainer mt20">
					<div class="chart-label">일일 인증 현황</div>
					<div style="height:280px;margin-bottom:-10px;margin-left:-10px;"><canvas id="chart-line1"></canvas></div>
				</div>
			</div>
			<div class="boxContainer">
				<div class="chartContainer">
					<div class="chart-label">월별 인증 현황</div>
					<div style="height:280px;margin-bottom:-10px;margin-left:-10px;"><canvas id="chart-line2"></canvas></div>
				</div>
			</div>
			<div class="boxContainer">
				<div class="flex gap15">
					<div class="chartContainer flex1">
						<div class="chart-label">월별 인증 현황</div>
						<div style="height:220px;"><canvas id="chart-doughnut1"></canvas></div>
					</div>
					<div class="chartContainer flex1">
						<div class="chart-label">인증 방식 현황</div>
						<div style="height:220px;"><canvas id="chart-doughnut2"></canvas></div>
					</div>
				</div>
			</div>
		</div>

		<div class="flex gap15 column flex1">
			<div class="boxContainer">
				<div class="box-header">
					<span>인증 지도</span>
					<div class="right">
						<select>
							<option>서울시</option>
							<option>...</option>
							<option>...</option>
							<option>...</option>
							<option>...</option>
						</select>
						<select>
							<option>중구</option>
							<option>...</option>
							<option>...</option>
							<option>...</option>
							<option>...</option>
						</select>
					</div>
				</div>

				<div class="map" style="height:460px;background:rgba(0,0,0,0.02);">					
					<div class="map-marker" style="position:absolute;top:50px;left:50px;">
						<span></span>
						<div class="mapConOveray">							
							<div class="inner">
								<span class="close" onclick="closeOverlay()" title="닫기"></span>
								<p class="suj">맥도날드 신대방점</p>
								<p>일 인증 횟수: <b class="color-blue">1,293</b></p>
							</div>
						</div>
					</div>
					<div class="map-marker" style="position:absolute;top:150px;left:250px;">
						<span></span>
						<div class="mapConOveray">							
							<div class="inner">
								<span class="close" onclick="closeOverlay()" title="닫기"></span>
								<p class="suj">맥도날드 신대방점</p>
								<p>일 인증 횟수: <b class="color-blue">1,293</b></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="flex gap15 flex-stretch">
				<div class="boxContainer flex1">
					<div class="chartContainer">
						<div class="chart-label">이용자 연령</div>
						<div style="height:210px;"><canvas id="chart-bar1"></canvas></div>
					</div>
					<div class="chartContainer mt30">
						<div class="chart-label">이용자별 인증 횟수 분포</div>
						<div style="height:210px;"><canvas id="chart-bar2"></canvas></div>
					</div>
				</div>
				<div class="boxContainer flex1">
					<div class="box-header">실시간 인증 현황</div>
					<div class="tbl-basic td-h3">
						<table class="tcenter blue">
							<colgroup>
								<col width="130">
								<col width="130">
								<col>
							</colgroup>
							<thead>
								<tr>
									<th>휴대폰번호</th>
									<th>인증방식</th>
									<th>인증일시</th>
								</th>
							</thead>
							<tbody>
								<tr>
									<td>010****0000</td>
									<td>GPS</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>비콘</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>NFC</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>GPS</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>NFC</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>GPS</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>비콘</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>NFC</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>GPS</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
								<tr>
									<td>010****0000</td>
									<td>NFC</td>
									<td><span class="date">2021-10-10 00:00</span></td>
								</th>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>

	</div>

	<?php include('chartScript.php'); ?>





</section>

<?php include_once('footer.php'); ?>