<?php // Header load
	include_once ("./_common.php");
	include_once (G5_PATH."/head.php");

?>

<!-- 컨텐츠 -->
<div class="contents container grid-lg">
        
	<div class="board-wrap">

		<div class="board-top columns col-gapless">
			<span class="board-info col-6">총 <strong>12</strong>개의 <strong>커뮤니티</strong> 글이 있습니다.</span>
		</div>
		
		<div class="filter">
			<input class="filter-tag" id="tag-0" type="radio" name="filter-radio" hidden="" checked="">
			<input class="filter-tag" id="tag-1" type="radio" name="filter-radio" hidden="">
			<input class="filter-tag" id="tag-2" type="radio" name="filter-radio" hidden="">
			<input class="filter-tag" id="tag-3" type="radio" name="filter-radio" hidden="">
			<input class="filter-tag" id="tag-4" type="radio" name="filter-radio" hidden="">
			<div class="filter-nav">
				<label class="chip" for="tag-0">전체</label>
				<label class="chip" for="tag-1">공지사항</label>
				<label class="chip" for="tag-2">잡담</label>
				<label class="chip" for="tag-3">수업후기</label>
				<label class="chip" for="tag-4">질문</label>
			</div>
		</div>
		
		<table class="table table-hover">
		<thead>
			<tr>
				<th>번호</th>
				<th>제목</th>
				<th>글쓴이</th>
				<th>조회</th>
				<th>날짜</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="td-num">12</td>
				<td><a href="/drawit/board_view.php">여섯째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">11</td>
				<td><a href="/drawit/board_view.php">다섯번째'ㅁ' 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">10</td>
				<td><a href="/drawit/board_view.php">넷째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">9</td>
				<td><a href="/drawit/board_view.php">세번째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">8</td>
				<td><a href="/drawit/board_view.php">두우번째~ 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">7</td>
				<td><a href="/drawit/board_view.php">첫번째! 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">6</td>
				<td><a href="/drawit/board_view.php">여섯째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">5</td>
				<td><a href="/drawit/board_view.php">다섯번째'ㅁ' 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">4</td>
				<td><a href="/drawit/board_view.php">넷째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">3</td>
				<td><a href="/drawit/board_view.php">세번째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">2</td>
				<td><a href="/drawit/board_view.php">두우번째~ 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">1</td>
				<td><a href="/drawit/board_view.php">첫번째! 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
		</tbody>
		</table>
		
		<div class="board-bottom columns col-gapless">
			<div class="board-search input-group col-6">
				<select class="form-select">
					<option>제목</option>
					<option>내용</option>
					<option>제목+내용</option>
				</select>
				<input class="form-input" type="search" placeholder="검색어를 입력하세요." />
				<button class="btn input-group-btn">검색하기</button>
			</div>
			<span class="col-6 text-right">
				<button type="button" class="btn btn-primary"><i class="icon icon-edit"></i> 글쓰기</button>
			</span> 
		</div>

		<ul class="pagination">
			<li class="page-item disabled">
				<a href="#" tabindex="-1">Prev</a>
			</li>
			<li class="page-item active">
				<a href="#">1</a>
			</li>
			<li class="page-item">
				<a href="#">2</a>
			</li>
			<li class="page-item">
				<a href="#">3</a>
			</li>
			<li class="page-item">
				<a href="#">4</a>
			</li>
			<li class="page-item">
				<a href="#">5</a>
			</li>
			<li class="page-item">
				<a href="#">6</a>
			</li>
			<li class="page-item">
				<a href="#">7</a>
			</li>
			<li class="page-item">
				<a href="#">8</a>
			</li>
			<li class="page-item">
				<a href="#">Next</a>
			</li>
		</ul>
    	
	</div>

</div>

<?php // footer load
	include_once (G5_PATH."/tail.php");
?>
    
</body>
</html>