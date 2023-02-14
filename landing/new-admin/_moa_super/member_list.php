<?php
$page_title = '전체 회원 목록';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">전체 회원 목록</div>

	<div class="boxContainer padding40" style="max-width:1500px;">
		<form name="" action="" method="post">
		<div class="data-search-wrap">
			<div class="flex flex-middle mb15">
				<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<span>~</span>
				<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<input type="text" name="" value="" class="span280 ml10" placeholder="전화번호/이름">
				<a href="#" class="btn span80">검색</a>
			</div>
			<div class="data-sel">
				<div class="wr-wrap label80">
					<div class="wr-list">
						<div class="wr-list-label">검색</div>
						<div class="wr-list-con" style="flex:0.8">
							<label class="radio-wrap"><input type="radio" name="member_s" value="" checked><span></span>여</label>
							<label class="radio-wrap"><input type="radio" name="member_s" value=""><span></span>남</label>
						</div>
						<div class="wr-list-label auto">직군</div>
						<div class="wr-list-con">
							<select class="span">
								<option>디자이너</option>
								<option>OOO</option>
								<option>OOO</option>
								<option>...</option>
							</select>
						</div>
						<div class="wr-list-label auto">직무</div>
						<div class="wr-list-con">
							<select class="span">
								<option>UXUI 디자이너</option>
								<option>OOO</option>
								<option>OOO</option>
								<option>...</option>
							</select>
						</div>
						<div class="wr-list-label auto">등급</div>
						<div class="wr-list-con">
							<select class="span">
								<option>일반게스트</option>
								<option>OOO</option>
								<option>OOO</option>
								<option>...</option>
							</select>
						</div>
					</div>
					<div class="wr-list  flex-top">
						<div class="wr-list-label">관심분야</div>
						<div class="wr-list-con">
							<p>
								<label class="checkbox-wrap"><input type="checkbox" name="" value="" /><span></span>액티비티</label>
								<label class="checkbox-wrap"><input type="checkbox" name="" value="" checked /><span></span>자기계발</label>
								<label class="checkbox-wrap"><input type="checkbox" name="" value="" /><span></span>커리어</label>
								<label class="checkbox-wrap"><input type="checkbox" name="" value="" /><span></span>소셜링</label>
							</p>
							<p>
								<label class="checkbox-wrap"><input type="checkbox" name="" value="" /><span></span>쿠킹베이킹</label>
								<label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span>문화예술</label>
								<label class="checkbox-wrap"><input type="checkbox" name="" value="" /><span></span>뷰티</label>
								<label class="checkbox-wrap"><input type="checkbox" name="" value="" checked /><span></span>힐링</label>
							</p>
						</div>
					</div>
					<div class="wr-list">
						<div class="wr-list-label">가입일</div>
						<div class="wr-list-con">
							<div class="datepickContainer">
								<a href="#" class="dl active">전체</a>
								<a href="#" class="dl">1개월</a>
								<a href="#" class="dl">3개월</a>
								<a href="#" class="dl">6개월</a>								
							</div>
						</div>
						<div class="wr-list-label auto">신입/경력</div>
						<div class="wr-list-con">
							<label class="radio-wrap"><input type="radio" name="career" value="" checked><span></span>신입</label>
							<label class="radio-wrap"><input type="radio" name="career" value=""><span></span>경력</label>
						</div>
						<div class="wr-list-label auto">나이</div>
						<div class="wr-list-con">
							<select class="span">
								<option>20대</option>
								<option>OOO</option>
								<option>OOO</option>
								<option>...</option>
							</select>
						</div>
						<div class="wr-list-label auto">구분</div>
						<div class="wr-list-con">
							<select class="span">
								<option>직장인</option>
								<option>OOO</option>
								<option>OOO</option>
								<option>...</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</form>

		<div class="mt80"></div>		
		
		<div class="box-header">
			<a href="#" class="btn span110 reverse gray">회원 삭제</a>
			<a href="#" class="btn span110 reverse gray">로그인 정보</a>
			<a href="#" class="btn span110 gray">회원등록</a>
			<div class="right">
				<a href="#" class="btn span150">엑셀 다운로드</a>
				<select class="" title="">
					<option>최신순 / 과거순</option>
					<option>OOO</option>
					<option>OOO</option>
					<option>...</option>
				</select>
			</div>
		</div>

		<div class="tbl-basic white odd border fs13 line-nth-2">				
			<table>
				<thead>
					<tr>
						<th>선택</th>
						<th>NO</th>
						<th>승인</th>
						<th>호스트 /<br>게스트</th>
						<th>직장인 /<br>프리랜서</th>
						<th>회원코드</th>
						<th>아이디</th>
						<th>닉네임</th>
						<th>이름</th>
						<th>휴대폰 번호</th>
						<th>이메일</th>
						<th>성별</th>
						<th>생년월일</th>
						<th>가입일</th>
						<th>직장</th>
						<th>신입/경력</th>
						<th>직군</th>
						<th>직무</th>
						<th>관심분야<br>(2개이상)</th>
						<th>접속수</th>
						<th>관리</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td><label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span></label></td>
						<td>1</td>
						<td>승인</td>
						<td>호스트</td>
						<td>직장인</td>
						<td>UserNum1</td>
						<td>Test1</td>
						<td>닉네임1</td>
						<td>김모임</td>
						<td>010-1234-5678</td>
						<td>newmeon@naver.com</td>
						<td>남</td>
						<td>1998.08.01</td>
						<td>2022.03.14</td>
						<td>뉴미온</td>
						<td>신입</td>
						<td>디자이너</td>
						<td>UXUI 디자이너</td>
						<td>액티비티,뷰티</td>
						<td>2</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">비번변경</a><br>
							<a href="#" class="color-blue underline">수정</a><br>
							<a href="#" class="color-blue underline">삭제</a><br>
							<a href="#" class="color-blue underline">1:1문의</a><br>
							<a href="#" class="color-blue underline">관리</a>
						</td>
					</tr>
					<tr>
						<td><label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span></label></td>
						<td>2</td>
						<td>-</td>
						<td>게시트</td>
						<td>직장인</td>
						<td>UserNum2</td>
						<td>Test2</td>
						<td>닉네임2</td>
						<td>김모임</td>
						<td>010-1234-5678</td>
						<td>newmeon@naver.com</td>
						<td>남</td>
						<td>1998.08.01</td>
						<td>2022.03.14</td>
						<td>뉴미온</td>
						<td>신입</td>
						<td>디자이너</td>
						<td>UXUI 디자이너</td>
						<td>액티비티,뷰티</td>
						<td>5</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">비번변경</a><br>
							<a href="#" class="color-blue underline">수정</a><br>
							<a href="#" class="color-blue underline">삭제</a><br>
							<a href="#" class="color-blue underline">1:1문의</a><br>
							<a href="#" class="color-blue underline">관리</a>
						</td>
					</tr>
					<tr>
						<td><label class="checkbox-wrap"><input type="checkbox" name="" value=""  /><span></span></label></td>
						<td>3</td>
						<td>승인</td>
						<td>호스트</td>
						<td>프리랜서</td>
						<td>UserNum3</td>
						<td>Test3</td>
						<td>닉네임3</td>
						<td>김모임</td>
						<td>010-1234-5678</td>
						<td>newmeon@naver.com</td>
						<td>남</td>
						<td>1998.08.01</td>
						<td>2022.03.14</td>
						<td>뉴미온</td>
						<td>신입</td>
						<td>디자이너</td>
						<td>UXUI 디자이너</td>
						<td>액티비티,뷰티</td>
						<td>4</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">비번변경</a><br>
							<a href="#" class="color-blue underline">수정</a><br>
							<a href="#" class="color-blue underline">삭제</a><br>
							<a href="#" class="color-blue underline">1:1문의</a><br>
							<a href="#" class="color-blue underline">관리</a>
						</td>
					</tr>
				</tbody>			
			</table>				
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