<?php
define('_INDEX_', true);
include_once('./header.php');
?>


<section id="main" class="container background">
	
	<div class="section-title">내 정보</div>

	<div class="flex gap20 flex-stretch" style="max-width:1500px;">
		<div class="boxContainer flex flex-top span650">			
			<div class="main-profile-thumb" style="background-image:url(<?=$common_path?>/img/temp/temp_user.png);"></div>
			<div class="main-profile-con">
				<div class="header">
					<span class="name">모아모아 님</span>
					<span class="mb-tag super-host">슈퍼 호스트</span>
					<!--
					<span class="mb-tag super-host">슈퍼 호스트</span>
					<span class="mb-tag super-guest">슈퍼 게스트</span>
					<span class="mb-tag guest">일반 게스트</span>
					<span class="mb-tag host">일반 호스트</span>
					-->
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
		<div class="flex1 flex gap20 column">
			<div class="flex flex1 gap20 flex-stretch">
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15">3</span>
					<span class="fs16 color-gray noto500">이번 달 진행모임</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15">120</span>
					<span class="fs16 color-gray noto500">내 모임 후기</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15">4.5</span>
					<span class="fs16 color-gray noto500">평균 모임 별점</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15">85%</span>
					<span class="fs16 color-gray noto500">QnA 응답률</span>
				</div>
			</div>
			<div class="flex flex1 gap20 flex-stretch">
				<div class="boxContainer flex1">
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">평균 모임 별점</span>
						<span class="right fs22 bold">45,000 P</span>
					</div>
					<hr>
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">내 쿠폰</span>
						<span class="right fs22 bold">4장</span>
					</div>
				</div>
				<div class="boxContainer flex1">
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">이번 달 매출액</span>
						<span class="right fs22 bold">522,000원</span>
					</div>
					<hr>
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">전체 매출액</span>
						<span class="right fs22 bold">1,309,345원</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="mt60"></div>

	

	<div class="flex gap25 flex-stretch" style="max-width:1500px;">
		<div class="flex1">
			<div class="section-title">
				공지사항
				<div class="rightSet"><a href="#" class="more">더보기</a></div>
			</div>
			<div class="boxContainer">
				
				<div class="tbl-basic white td-h6">
					<table>
						<colgroup>
							<col width="220">
							<col>
						</colgroup>
						<thead>
							<tr>
								<th class="tleft">등록일</th>
								<th class="tleft">게시글 제목</th>
							</th>
						</thead>
						<tbody>
							<tr>
								<td class="tleft"><span class="date">2021-10-10 00:00</span></td>
								<td class="subject"><a href="#">[운영시간] 고객센터 서버 점검 안내 10/12(금) 오후 10시~10/12(금) 오후 12시</a></td>								
							</th>
							<tr>
								<td class="tleft"><span class="date">2021-10-10 00:00</span></td>
								<td class="subject"><a href="#">[운영시간] 고객센터 서버 점검 안내 10/12(금) 오후 10시~10/12(금) 오후 12시</a></td>								
							</th>
							<tr>
								<td class="tleft"><span class="date">2021-10-10 00:00</span></td>
								<td class="subject"><a href="#">[운영시간] 고객센터 서버 점검 안내 10/12(금) 오후 10시~10/12(금) 오후 12시</a></td>								
							</th>
							<tr>
								<td class="tleft"><span class="date">2021-10-10 00:00</span></td>
								<td class="subject"><a href="#">[운영시간] 고객센터 서버 점검 안내 10/12(금) 오후 10시~10/12(금) 오후 12시</a></td>								
							</th>
							<tr>
								<td class="tleft"><span class="date">2021-10-10 00:00</span></td>
								<td class="subject"><a href="#">[운영시간] 고객센터 서버 점검 안내 10/12(금) 오후 10시~10/12(금) 오후 12시</a></td>								
							</th>							
						</tbody>
					</table>
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
		</div>
		<div class="span320 flex gap5 column">
			<div class="section-title">고객센터</div>
			<div class="boxContainer flex1">
				<a href="#" class="btn reverse gray span">1:1 실시간 상담</a>
				<a href="#" class="btn reverse gray span mt10">문의 상담</a>
				<div class="span tcenter" style="position:absolute;bottom:30px;left:0;">
					<p class="fs18">고객센터 010-6686-1133</p>
					<p class="mt15 color-gray">
						평일오전 10시 - 오후6시<br>
						(점심시간 12: 30 ~ 13:30)
					</p>
				</div>
			</div>
		</div>
	</div>


</section>

<?php include_once('./footer.php'); ?>