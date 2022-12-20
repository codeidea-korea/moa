<?php
$page_title = 'Table';
include_once('header.php');
?>

<section class="container">
	<div class="page-title"><?=$page_title?></div>
	
	<form name="" action="" method="post">
	<div class="data-search-wrap">
		<div class="data-sel">
			<select data-style="selectColor-black">
				<option data-subtext="(Sub)">옵션A</option>
				<option>옵션B</option>
				<option>옵션C</option>
			</select>
			<select data-style="selectColor-gray">
				<option data-subtext="(Sub)">옵션A</option>
				<option>옵션B</option>
				<option>옵션C</option>
			</select>
			<select data-live-search="true">
				<option>옵션 검색</option>
				<option>옵션A</option>
				<option>옵션B</option>
				<option>옵션C</option>
				<option>옵션D</option>
				<option>옵션E</option>
				<option>옵션F</option>
				<option>옵션G</option>
				<option>옵션H</option>
				<option>옵션I</option>
			</select>
			<select id="search-cate">
				<option>검색항목</option>
				<option>아이디</option>
				<option>이름</option>
				<option>연락처</option>
			</select>
			<input type="text" name="" value="" class="span250" placeholder="검색어">
			<a href="#" class="btn gray">검색</a>
			<div class="datepickContainer">
				<a href="#" class="dl active">오늘</a>
				<a href="#" class="dl">1개월</a>
				<a href="#" class="dl">6개월</a>
				<a href="#" class="dl">1년</a>
				<a href="#" class="dl">5년</a>
				<a href="#" class="dl">전체</a>
			</div>
		</div>		
	</div>
	</form>

	<div class="tbl-basic cell td-h4">
		<div class="tbl-header">
			<div class="caption">총 <b>123</b>개 글이 있습니다</div>
			<div class="rightSet"><a href="#" class="btn green small icon-excel">엑셀 다운로드</a></div>
		</div>
		<table>
			<colgroup>
				<col width="50">
				<col width="90">
				<col width="60">
				<col>
				<col width="140">
				<col width="160">
				<col>
			</colgroup>
			<thead>
				<tr>
					<th><a href="#" class="sort">번호</a></th>
					<th>라벨</th>
					<th>이미지</th>
					<th><a href="#" class="sort asc">제목</a></th>
					<th><a href="#" class="sort desc">이름</a></th>
					<th><a href="#" class="sort desc">등록일</a></th>
					<th>편집</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>1</td>
					<td><span class="tag-red">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>2</td>
					<td><span class="tag-blue">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#"><span class="tag mini">RE</span>죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>3</td>
					<td><span class="tag-yellow">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round20"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>4</td>
					<td><span class="tag-orange">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#"><span class="tag mini">RE</span>죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>5</td>
					<td><span class="tag-green">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>6</td>
					<td><span class="tag">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>7</td>
					<td><span class="tag">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>8</td>
					<td><span class="tag">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>9</td>
					<td><span class="tag">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>
				<tr>
					<td>10</td>
					<td><span class="tag">라벨</span></td>
					<td><img src="./img/temp/user_man_40_40.jpg" class="round"></td>
					<td class="subject"><a href="#">죽는 날까지 하늘을 우러러 한 점 부끄럼이 없기를, 잎새에 이는 바람에도 나는 괴로워했다. 별을 노래하는 마음으로 모든 죽어가는 것을 사랑해야지.</a></td>
					<td>홍길동</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" class="btnEdit">수정</a></td>
				</tr>	
			</tbody>			
		</table>	

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

		<div class="btnSet">
			<a href="#" class="btn large">등록하기</a>
		</div>
	</div>	
	
	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">테이블 (게시물없음)</span>
&lt;div class="<span class="color-yellow">tbl-basic</span>"&gt;
	&lt;table&gt;
		...
			&lt;tr&gt;
				&lt;td colspan="5" class="<span class="color-yellow">td_empty</span>"&gt;
					&lt;div class="<span class="color-yellow">empty_list</span>" <span class="color-red">data-text="등록된 게시물이 없습니다.</span>"&gt;&lt;/div&gt;
				&lt;/td&gt;
			&lt;/tr&gt;
		...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>

	<!-- 게시물이 없을때 -->
	<div class="tbl-basic">
		<div class="tbl-header">
			<div class="caption">총 <b>0</b>개 글이 있습니다</div>
		</div>
		<table>
			<colgroup>
				<col width="50">
				<col>
				<col width="140">
				<col width="160">
				<col width="90">
			</colgroup>
			<thead>
				<tr>
					<th><a href="#" class="sort">번호</a></th>
					<th><a href="#" class="sort asc">제목</a></th>
					<th><a href="#" class="sort desc">이름</a></th>
					<th><a href="#" class="sort desc">등록일</a></th>
					<th>편집</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="5" class="td_empty"><div class="empty_list" data-text="등록된 게시물이 없습니다."></div></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<div class="mt60"></div>

	
	<div class="flex">
		<div class="flex1">

<pre class="html-help">
<span class="help-title">기본 테이블</span>
&lt;div class="<span class="color-yellow">tbl-basic</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
	
			<div class="tbl-basic">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>

		</div>
		<div class="flex1 ml70">

<pre class="html-help">
<span class="help-title">기본 테이블 (외곽선)</span>
&lt;div class="<span class="color-yellow">tbl-basic border</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
	
			<div class="tbl-basic border">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>

		</div>
	</div>
	
	<div class="mt60"></div>

	<div class="flex">

		<div class="">
<pre class="html-help">
<span class="help-title">기본 테이블 (data구분선)</span>
&lt;div class="<span class="color-yellow">tbl-basic cell span500</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
	
			<div class="tbl-basic cell span500">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>
		<div class="">
<pre class="html-help">
<span class="help-title">엑셀타입 테이블</span>
&lt;div class="<span class="color-yellow">tbl-excel auto</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
	
			<div class="tbl-excel auto">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>

	</div>


	<div class="mt80"></div>

<pre class="html-help">
<span class="help-title">테이블 데이터 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic td-h1</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 데이터 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic td-h2</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 데이터 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic td-h3</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 데이터 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic td-h4</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 데이터 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic td-h5</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 데이터 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic td-h6</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 데이터 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic td-h7</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre><br>

	<div class="flex">
		
		<!-- td-h1, td-h2, td-h3, td-h4, td-h5, td-h6, td-h7 -->
		<div class="tbl-basic cell td-h1 auto">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>높이 조절 클래스명</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bold">td-h1</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell td-h2 auto">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>높이 조절 클래스명</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bold">td-h2</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell td-h3 auto">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>높이 조절 클래스명</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bold">td-h3</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell td-h4 auto">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>높이 조절 클래스명</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bold">td-h4</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell td-h5 auto">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>높이 조절 클래스명</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bold">td-h5</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell td-h6 auto">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>높이 조절 클래스명</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bold">td-h6</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell td-h7 auto">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>높이 조절 클래스명</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="bold">td-h7</td>
					</tr>	
				</tbody>			
			</table>
		</div>

	</div>

	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">테이블 제목 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic th-h1</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 제목 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic th-h2</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 제목 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic th-h3</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 제목 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic th-h4</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 제목 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic th-h5</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 제목 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic th-h6</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre>
<pre class="html-help">
<span class="help-title">테이블 제목 칸 높이</span>
&lt;div class="<span class="color-yellow">tbl-basic th-h7</span>"&gt;
	&lt;table&gt;...&lt;/table&gt;
&lt;/div&gt;
</pre><br>

	<div class="flex">
		
		<!-- th-h1, th-h2, th-h3, th-h4, th-h5, th-h6, th-h7 -->
		<div class="tbl-basic cell th-h1 span120">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>td-h1</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>내용</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell th-h2 span120">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>td-h2</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>내용</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell th-h3 span120">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>td-h3</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>내용</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell th-h4 span120">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>td-h4</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>내용</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell th-h5 span120">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>td-h5</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>내용</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell th-h6 span120">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>td-h6</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>내용</td>
					</tr>	
				</tbody>			
			</table>
		</div>

		<div class="tbl-basic cell th-h7 span120">
			<table>
				<colgroup>
					<col>
				</colgroup>
				<thead>
					<tr>
						<th>td-h7</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>내용</td>
					</tr>
				</tbody>			
			</table>
		</div>

	</div>
	
	
	<div class="mt80"></div>
		
	<div class="flex">
		<div class="flex1">
<pre class="html-help">
<span class="help-title">테이블 헤드 컬러</span>
&lt;div class="<span class="color-yellow">tbl-basic mainColor</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
			<div class="tbl-basic auto mainColor">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>
		<div class="flex1">
<pre class="html-help">
<span class="help-title">테이블 헤드 컬러</span>
&lt;div class="<span class="color-yellow">tbl-basic red</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
			<div class="tbl-basic auto red">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>
		<div class="flex1">
<pre class="html-help">
<span class="help-title">테이블 헤드 컬러</span>
&lt;div class="<span class="color-yellow">tbl-basic blue</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
			<div class="tbl-basic auto blue">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>
		<div class="flex1">
<pre class="html-help">
<span class="help-title">테이블 헤드 컬러</span>
&lt;div class="<span class="color-yellow">tbl-basic green</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
			<div class="tbl-basic auto green">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>
	</div>


	<div class="flex mt30">
		<div class="">
<pre class="html-help">
<span class="help-title">테이블 헤드 컬러</span>
&lt;div class="<span class="color-yellow">tbl-basic black</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
			<div class="tbl-basic auto black">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>
		<div class="">
<pre class="html-help">
<span class="help-title">테이블 헤드 컬러</span>
&lt;div class="<span class="color-yellow">tbl-basic orange</span>"&gt;
	&lt;table&gt;
	...
	&lt;/table&gt;
&lt;/div&gt;
</pre><br>
			<div class="tbl-basic auto orange">
				<table>
					<colgroup>
						<col width="70">
						<col>
						<col width="120">
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
						<tr>
							<td>1</td>
							<td class="subject">OOO OOOOOOO OO OOO</td>
							<td class="date">2022.03.21</td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>		
	</div>


	<div class="mt70"></div>
<div>
<pre class="html-help">
<span class="help-title">테이블 테이터 칸 색넣기</span>
&lt;div class="<span class="color-yellow">tbl-basic cell td-h4 span700</span>"&gt;
	&lt;table&gt;
		...
		&lt;tr&gt;
			&lt;td class="<span class="color-yellow">cell-red</span>"&gt;...&lt;/td&gt;
		&lt;/tr&gt;
		...
	&lt;/table&gt;
&lt;/div&gt;

<span class="color-yellow">cell-red, cell-green, cell-blue, cell-yellow, cell-black, cell-gray, cell-orange, cell-mainColor</span>
</pre>
</div>

	<!-- cell에 색넣기 -->
	<div class="tbl-basic cell td-h4 span700">
		<table>
			<thead>
				<tr>
					<th>색넣기</th>
					<th>색넣기</th>
					<th>색넣기</th>
					<th>색넣기</th>
					<th>색넣기</th>
					<th>색넣기</th>
					<th>색넣기</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>OOO</td>
					<td>OOO</td>
					<td class="cell-red">cell-red</td>
					<td>OOO</td>
					<td>OOO</td>
					<td>OOO</td>
					<td class="cell-black">cell-black</td>
				</tr>
				<tr>
					<td class="cell-green">cell-green</td>
					<td>OOO</td>
					<td>OOO</td>
					<td class="cell-gray">cell-gray</td>
					<td>OOO</td>
					<td>OOO</td>
					<td>OOO</td>
				</tr>
				<tr>
					<td>OOO</td>
					<td class="cell-blue">cell-blue</td>
					<td>OOO</td>
					<td>OOO</td>
					<td>OOO</td>
					<td class="cell-orange">cell-orange</td>
					<td>OOO</td>
				</tr>
				<tr>
					<td>OOO</td>
					<td>OOO</td>
					<td>OOO</td>
					<td class="cell-yellow">cell-yellow</td>
					<td>OOO</td>
					<td>OOO</td>
					<td>OOO</td>
				</tr>
				<tr>
					<td>OOO</td>
					<td>OOO</td>
					<td>OOO</td>
					<td>OOO</td>
					<td class="cell-mainColor">cell-mainColor</td>
					<td>OOO</td>
					<td>OOO</td>
				</tr>
			</tbody>			
		</table>
	</div>
	

	<div class="mt70"></div>

	<div class="bold mb10 fs16">추가&삭제 테이블 (javascript)</div>
	<!-- 추가삭제 테이블 -->
	<div class="tbl-basic cell td-h1" style="max-width:1080px;">
		<div class="tbl-header">
			<div class="caption">총 000건</div>
			<div class="rightSet"><span class="btn small blue add-list">+ 추가하기</span></div>
		</div>
		<table id="resident_list">
			<colgroup>
				<col width="60">
				<col width="160">
				<col width="140">
				<col width="150">
				<col>
				<col width="140">
				<col width="150">
				<col width="70">
			</colgroup>
			<thead>
				<tr>
					<th>선택</th>
					<th>분류</th>
					<th>이름</th>
					<th>휴대폰 번호</th>
					<th>가입여부</th>
					<th>등록자</th>
					<th>등록일</th>
					<th>관리</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name="" /></td>
					<td>
						<select class="span" data-style="selectColor-green">
							<option>분류A</option>
							<option>분류B</option>
							<option selected>분류C</option>
							<option>분류D</option>
						</select>
					</td>
					<td><input type="text" name="" value="홍길동" class="span" placeholder=""></td>
					<td><input type="text" name="" value="010-1234-5678" class="phone span" placeholder=""></td>
					<td>자동승인</td>
					<td>SuperID</td>
					<td class="date">2020. 10. 23</td>
					<td><span class="btn small black del-list">삭제</span></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="" /></td>
					<td>
						<select class="span">
							<option>분류A</option>
							<option>분류B</option>
							<option selected>분류C</option>
							<option>분류D</option>
						</select>
					</td>
					<td><input type="text" name="" value="홍길동" class="span" placeholder=""></td>
					<td><input type="text" name="" value="010-1234-5678" class="phone span" placeholder=""></td>
					<td>자동승인</td>
					<td>SuperID</td>
					<td class="date">2020. 10. 23</td>
					<td><span class="btn small black del-list">삭제</span></td>
				</tr>				
			</tbody>
		</table>
		<div class="tbl-footer">
			<a href="#" class="btn black mini">선택 삭제</a>
		</div>

		<div class="btnSet">
			<a href="#" class="btn large span80">저장</a>
			<a href="resident_view.php" class="btn large gray">취소</a>
		</div>
	</div>
	

	<script>
	$(function() {
		$(document).on("click", ".add-list", function() {
			add_list();
		});

		$(document).on("click", ".del-list", function() {
			if(!confirm("선택하신 OOO이 삭제됩니다. 계속하시겠습니까?"))
				return false;
			var $tr = $(this).closest("tr");
			$tr.remove();        
		});
	});	

	function add_list() {
		var $resident_list = $("#resident_list");
		var list = '<tr>';
		list += '<td><label class="checkbox-wrap"><input type="checkbox" name="" /><span></span></label></td>';
		list += '<td>';
		list += '<select class="span">';
		list += '<option>분류A</option>';
		list += '<option>분류B</option>';
		list += '<option>분류C</option>';
		list += '<option>분류D</option>';
		list += '</select>';
		list += '</td>';
		list += '<td><input type="text" name="" value="" class="span" placeholder=""></td>';
		list += '<td><input type="text" name="" value="" class="phone span" placeholder=""></td>';
		list += '<td class="cell-red">미가입</td>';
		list += '<td>-</td>';
		list += '<td class="date">-</td>';
		list += '<td><span class="btn small gray del-list">삭제</span></td>';
		list += '</tr>';
		var $tr_last = null;
		var $tr_last = $resident_list.find("tr:last");
		$tr_last.after(list);
		$('select').selectpicker('refresh');
	}
	</script>
	

	<div class="mt70"></div>

	<div class="bold mb30 fs16">전체선택(javascript) & 마우스오버시 팁정보 출력</div>
	<!-- 전체 선택 테이블 -->
	<form name="" action="" method="post">
	<div class="tbl-basic cell td-h1" style="max-width:1080px;">
		<div class="tbl-header">
			<div class="caption">총 000건</div>
		</div>
		<table id="resident_list">
			<colgroup>
				<col width="60">
				<col width="160">
				<col width="140">
				<col width="150">
				<col>
				<col width="140">
				<col width="150">
				<col width="70">
			</colgroup>
			<thead>
				<tr>
					<th><label class="checkbox-wrap"><input type="checkbox" class="chkall" data-group="bo_chk" /><span></span></label></th>
					<th>분류</th>
					<th>이름</th>
					<th>휴대폰 번호</th>
					<th>가입여부</th>
					<th>등록자</th>
					<th>등록일</th>
					<th>관리</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><label class="checkbox-wrap"><input type="checkbox" name="" class="bo_chk" /><span></span></label></td>
					<td>
						<div class="tipContainer">
							<span class="el">설명글</span>
							<div class="hidden-box">
								담당자 : 정진일<br>
								연락처 : +83-22-555<br>
								E-mail : abcdefg@abcd.com
							</div>
						</div>
					</td>
					<td>홍길동</td>
					<td>010-1234-5678</td>
					<td>자동승인</td>
					<td>SuperID</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" target="_blank" class="btn small black">보기</a></td>
				</tr>
				<tr>
					<td><label class="checkbox-wrap"><input type="checkbox" name="" class="bo_chk" /><span></span></label></td>
					<td>
						<div class="tipContainer">
							<span class="el icon">설명글</span>
							<div class="hidden-box">
								<b>담당자</b> : 정진일<br>
								<b>연락처</b> : +83-22-555<br>
								<b>E-mail</b> : abcdefg@abcd.com
								<div class="mt10">
									<a href="#" class="btn small green">바로가기</a>
								</div>
							</div>
						</div>
					</td>
					<td>홍길동</td>
					<td>010-1234-5678</td>
					<td>자동승인</td>
					<td>SuperID</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" target="_blank" class="btn small black">보기</a></td>
				</tr>
				<tr>
					<td><label class="checkbox-wrap"><input type="checkbox" name="" class="bo_chk" /><span></span></label></td>
					<td>
						<div class="tipContainer">
							<span class="el icon">설명글</span>
							<div class="hidden-box">
								<b>담당자</b> : 정진일<br>
								<b>연락처</b> : +83-22-555<br>
								<b>E-mail </b>: abcdefg@abcd.com
								<div class="mt10">
									<a href="#" class="btn small green">바로가기</a>
								</div>
							</div>
						</div>
					</td>
					<td>홍길동</td>
					<td>010-1234-5678</td>
					<td>자동승인</td>
					<td>SuperID</td>
					<td class="date">2020. 10. 23</td>
					<td><a href="#" target="_blank" class="btn small black">보기</a></td>
				</tr>
			</tbody>			
		</table>
		<div class="btnSet">
			<div class="leftSet"><a href="#" class="btn black mini">선택 삭제</a><span class="help-block ml5"></span></div>
			<a href="#" class="btn large span80">저장</a>
			<a href="resident_view.php" class="btn large gray">취소</a>
		</div>
	</div>
	</form>
	
</section>


<?php include_once('footer.php'); ?>