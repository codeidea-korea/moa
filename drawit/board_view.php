<?php // Header load
	include_once ("./_common.php");
	include_once (G5_PATH."/head.php");

?>


<!-- 컨텐츠 -->
<div class="contents container grid-lg">
        
	<div class="board-wrap">
    	
    	<article class="board-view">
        	<header class="columns col-gapless">
	        	<h4 class="col-12">글 내용 제목은 이렇게 됩니다.</h4>
	        	<dl class="col-6">
		        	<dt>작성자</dt>
		        	<dd><span class="user-name">최고관리자</span></dd>
		        	<dt>작성일</dt>
		        	<dd>19-07-21 04:59</dd>
	        	</dl>
	        	<dl class="col-6 text-right">
			        <dt>댓글</dt>
			        <dd><a href="#bo_vc"><strong>1</strong>개</a></dd>
			        <dt>조회</dt>
			        <dd>109회</dd>
	        	</dl>
        	</header>
        	<div class="board-view-body">
	        	여기가 글 내용 들어가는 자리 로렘 입섬 달러 싵 어멧 히얼.
        	</div>
    	</article>

    	<section class="comments">
        	<button type="button" class="btn btn-link">댓글목록 <span class="label label-secondary">3</span> <i class="icon icon-caret"></i></button>
        	<ul>
	        	<li>
	        		<div class="comment-item">
		        		<div class="comment-author">
			        		<span class="user-name">댓글쓴영철이</span>
							<em class="comment-date">19-07-22 09:49</em>
							<span class="comment-util">
								<button type="button" class="btn btn-link btn-sm">답변</button>
								<button type="button" class="btn btn-link btn-sm">삭제</button>
							</span>
		        		</div>
		        		<div class="cmt-body">
			        		얄롤리 트롤리 롤로노와 조로라고 댓글을 달아보지요.
		        		</div>
	        		</div>
	        		<ul>
			        	<li>
			        		<div class="comment-item">
				        		<div class="comment-author">
					        		<span class="user-name">댓글쓴영철이</span>
									<em class="comment-date">19-07-22 09:49</em>
									<span class="comment-util">
										<button type="button" class="btn btn-link btn-sm">답변</button>
										<button type="button" class="btn btn-link btn-sm">삭제</button>
									</span>
				        		</div>
				        		<div class="cmt-body">
					        		얄롤리 트롤리 롤로노와 조로라고 댓글을 달아보지요.
				        		</div>
			        		</div>
			        	</li>
	        		</ul>
	        	</li>
	        	<li>
	        		<div class="comment-item">
		        		<div class="comment-author">
			        		<span class="user-name">댓글쓴영철이</span>
							<em class="comment-date">19-07-22 09:49</em>
							<span class="comment-util">
								<button type="button" class="btn btn-link btn-sm">답변</button>
								<button type="button" class="btn btn-link btn-sm">삭제</button>
							</span>
		        		</div>
		        		<div class="cmt-body">
			        		얄롤리 트롤리 롤로노와 조로라고 댓글을 달아보지요.
		        		</div>
	        		</div>
	        	</li>
        	</ul>
    	</section>
    	
    	<form action="#">
        <fieldset class="comment-form">
	        <div class="columns col-gapless">
		        <div class="input-group col-5">
			        <label class="input-group-addon" for="cmt-name">이름</label>
					<input class="form-input" id="cmt-name" type="name" placeholder="필수" />
		        </div>
		        <div class="input-group col-5">
			        <label class="input-group-addon" for="cmt-pass">비밀번호</label>
					<input class="form-input" id="cmt-pass" type="password" placeholder="****" />
		        </div>
			    <span class="input-group col-2">
			        <label class="form-checkbox">
                    	<input type="checkbox" checked><i class="form-icon"></i> 비밀글사용
                    </label>
			    </span>
	        </div>
            <textarea class="form-input" placeholder="UHDmusic은 건강한 댓글문화를 응원합니다 :)" rows="3"></textarea>
			<button type="submit" class="btn btn-primary btn-lg btn-block">댓글등록</button>
        </fieldset>
    	</form>
		
		<div class="board-bottom columns col-gapless">
			<div class="col-6">
				<button type="button" class="btn">목록으로</button>
			</div>
			<div class="col-6 text-right">
				<div class="btn-group">
					<button type="button" class="btn">답변달기</button>
					<button type="button" class="btn">수정하기</button>
					<button type="button" class="btn">삭제하기</button>
				</div>
			</div> 
		</div>
    	
		<div class="board-top columns col-gapless">
			<span class="board-info col-6">총 <strong>7</strong>개의 <strong>공지사항</strong> 글이 있습니다.</span>
			<span class="col-6 text-right">
				<button type="button" class="btn btn-primary"><i class="icon icon-edit"></i> 글쓰기</button>
			</span> 
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
				<td class="td-num">6</td>
				<td><a href="board_view.php">여섯째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">5</td>
				<td><a href="board_view.php">다섯번째'ㅁ' 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">4</td>
				<td><a href="board_view.php">넷째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">3</td>
				<td><a href="board_view.php">세번째 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">2</td>
				<td><a href="board_view.php">두우번째~ 공지사항은 이렇게 됩니다.</a></td>
				<td><span class="user-name">최고관리자</span></td>
				<td class="td-num">10</td>
				<td class="td-date">07.19</td>
			</tr>
			<tr>
				<td class="td-num">1</td>
				<td><a href="board_view.php">첫번째! 공지사항은 이렇게 됩니다.</a></td>
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
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/common.js"></script>
    
</body>
</html>