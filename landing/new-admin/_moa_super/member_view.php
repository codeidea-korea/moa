<?php
$page_title = '전체 회원 목록';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">회원 기본 정보</div>

	<div class="boxContainer padding40" style="max-width:1500px;">
		
		<div class="tbl-excel tleft">				
			<table>
				<colgroup>
					<col width="200">
					<col>
				</colgroup>
				<tbody>
					<tr>
						<th>아이디</th>
						<td>newmeon</td>
					</tr>
					<tr>
						<th>이름</th>
						<td>김게스트</td>
					</tr>
					<tr>
						<th>이메일</th>
						<td>newmeon@moa.com</td>
					</tr>
					<tr>
						<th>이메일 수신</th>
						<td>
							<label class="radio-wrap"><input type="radio" name="r1" value="" checked disabled><span></span>예</label>
							<label class="radio-wrap"><input type="radio" name="r1" value="" disabled><span></span>아니오</label>
						</td>
					</tr>
					<tr>
						<th>SNS 수신</th>
						<td>
							<label class="radio-wrap"><input type="radio" name="r2" value="" checked disabled><span></span>예</label>
							<label class="radio-wrap"><input type="radio" name="r2" value="" disabled><span></span>아니오</label>
						</td>
					</tr>
					<tr>
						<th>포인트</th>
						<td>0원 <a href="#" class="color-blue underline ml15">상세보기</a></td>
					</tr>
					<tr>
						<th>쿠폰</th>
						<td>3개 <a href="#" class="color-blue underline ml15">상세보기</a></td>
					</tr>
					<tr>
						<th>회원등급</th>
						<td>
							<select class="small">
								<option>일반게스트</option>
								<option>OOO</option>
								<option>OOO</option>
								<option>...</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>가입/접속</th>
						<td>2022.03.14   10:20</td>
					</tr>
					<tr>
						<th>로그인</th>
						<td>총 로그인 1회 (마지막 로그인 기록 : 카카오톡으로 13:23:34)로 로그인</td>
					</tr>
					<tr>
						<th>회원코드</th>
						<td>
							<span>ABCDEFG(자동생성)</span>
							<span class="ml30">-5000포인트 지급</span>
						</td>
					</tr>
				</tbody>			
			</table>				
		</div>
		
		<div class="mt50"></div>

		<div class="tbl-excel tleft">				
			<table>
				<colgroup>
					<col width="200">
					<col>
				</colgroup>
				<tbody>
					<tr>
						<td>직장인/프리랜서</td>
						<td>직장인 <a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
					<tr>
						<td>닉네임</td>
						<td>뀨몽<a href="#" class="color-blue underline ml15">수정</a><a href="#" class="color-blue underline ml15">중복체크</a></td>
					</tr>
					<tr>
						<td>휴대전화</td>
						<td>010-1234-5678<a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
					<tr>
						<td>성별</td>
						<td>남<a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
					<tr>
						<td>생년월일</td>
						<td>1990.02.08<a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
					<tr>
						<td>직장</td>
						<td>뉴미온<a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
					<tr>
						<td>신입/경력</td>
						<td>신입<a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
					<tr>
						<td>직군</td>
						<td>디자이너<a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
					<tr>
						<td>직무</td>
						<td>UXUI 디자이너<a href="#" class="color-blue underline ml15">수정</a></td>
					</tr>
				</tbody>			
			</table>				
		</div>

		<div class="mt50"></div>
		
		<div class="box-header">접속이력 - 회원 로그</div>
		<div class="tbl-excel th-h1 td-h4 color-gray">				
			<table>
				<thead>
					<tr>
						<th style="height:32px;">일시</th>
						<th style="height:32px;">접속IP</th>
						<th style="height:32px;">접속 위치</th>
						<th style="height:32px;">매체</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>2022.03.14   12:40:12</td>
						<td>112.123.45.789</td>
						<td>한국, 서울</td>
						<td>Windows, Chrome</td>
					</tr>
					<tr>
						<td>2022.03.14   12:40:12</td>
						<td>112.123.45.789</td>
						<td>한국, 서울</td>
						<td>Windows, Chrome</td>
					</tr>
					<tr>
						<td>2022.03.14   12:40:12</td>
						<td>112.123.45.789</td>
						<td>한국, 서울</td>
						<td>Windows, Chrome</td>
					</tr>
				</tbody>			
			</table>				
		</div>

		<div class="mt50"></div>

		<div class="flex">
			<div class="tbl-excel td-h4 tleft flex1">				
				<table>
					<tbody>
						<tr>
							<th width="150">추천인코드</th>
							<td>newmeon</td>
						</tr>
					</tbody>			
				</table>				
			</div>
			<div class="tbl-excel td-h4 tleft flex1">				
				<table>
					<tbody>
						<tr>
							<th width="150">추천한 회원 수</th>
							<td>9명<a href="#" class="btn mini span80 fright">목록보기</a></td>
						</tr>
					</tbody>			
				</table>				
			</div>
		</div>


		<div class="mt25"></div>

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