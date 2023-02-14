<?php
$page_title = '';
include_once('header.php');
?>

<section class="container background">
	
	<div class="section-title">공지사항 관리</div>

	<div class="boxContainer padding40" style="max-width:1300px;">
		
		<div class="tbl-basic border th-h6 td-h7 fs14 white odd line-nth-1">
			<div class="tbl-header flex-middle">
				<div class="flex fs18">
					<span class="mr20">구분:</span>
					<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>전체</label>
					<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>안드로이드</label>
					<label class="radio-wrap"><input type="radio" name="r1" value=""><span></span>아이폰</label>
				</div>
				<div class="right">
					<input type="text" name="" value="" class="span280" placeholder="제목 / 내용">
					<button type="button" class="btn reverse">검색</button>
				</div>
			</div>

			<table>
				<colgroup>
					<col width="100">
					<col width="170">
					<col>
					<col width="210">
				</colgroup>
				<thead>
					<tr>
						<th>NO</th>
						<th>구분</th>
						<th>제목</th>
						<th>작성일</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>5</td>
						<td>공지사항</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">공지사항 공지사항 공지사항 공지사항 공지사항 공지사항 공지사항 공지사항</a>
						</td>
						<td>2022.03.14  13:22:40</td>
					</tr>
					<tr>
						<td>4</td>
						<td>공지사항</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">공지사항 공지사항 공지사항 공지사항 공지사항 공지사항 공지사항 공지사항</a>
						</td>
						<td>2022.03.14  13:22:40</td>
					</tr>
					<tr>
						<td>3</td>
						<td>공지사항</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">2교시 소식 2교시 소식 2교시 소식 2교시 소식 2교시 소식</a>
						</td>
						<td>2022.03.14  13:22:40</td>
					</tr>
					<tr>
						<td>2</td>
						<td>2교시 소식</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">2교시 소식 2교시 소식 2교시 소식 2교시 소식 2교시 소식</a>
						</td>
						<td>2022.03.14  13:22:40</td>
					</tr>
					<tr>
						<td>1</td>
						<td>2교시 소식</td>
						<td class="tleft">
							<a href="#" class="color-blue underline">2교시 소식 2교시 소식 2교시 소식 2교시 소식 2교시 소식</a>
						</td>
						<td>2022.03.14  13:22:40</td>
					</tr>					
				</tbody>
			</table>
		</div>

		<div class="btnSet">
			<a href="#" class="btn span150 submit">글쓰기</a>
		</div>
	</div>

</section>

<?php include_once('footer.php'); ?>