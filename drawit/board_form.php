<?php // Header load
	include_once ("./_common.php");
	include_once (G5_PATH."/head.php");

?>

<!-- 컨텐츠 -->
<div class="contents container grid-lg">
        
	<div class="board-wrap">
    	
    	<form action="board_view.php">
        <fieldset class="board-form">
	        
	        <div class="columns col-gapless">
		        <div class="input-group col-6">
			        <label class="input-group-addon">이름 <span class="label">필수</span></label>
					<input class="form-input" type="text" placeholder="필수 입력">
            	</div>
		        <div class="input-group col-6">
			        <label class="input-group-addon">비밀번호 <span class="label">필수</span></label>
					<input class="form-input" type="password" placeholder="****">
            	</div>
	        </div>
	        
	        <div class="columns col-gapless">
		        <div class="input-group col-6">
			        <label class="input-group-addon">이메일</label>
					<input class="form-input" type="eamil" placeholder="sample@email.com">
            	</div>
		        <div class="input-group col-6">
			        <label class="input-group-addon">홈페이지</label>
					<input class="form-input" type="url" placeholder="https://uhdmusic.co.kr/">
            	</div>
	        </div>
	        <div class="input-group">
		        <span class="input-group-addon">옵션</span>
				<label class="form-checkbox">
                	<input type="checkbox"><i class="form-icon"></i>
                	HTML로 작성
				</label>
        	</div>
        	<div class="divider"></div>
	        <div class="input-group">
		        <label class="input-group-addon" for="wr_pass">제목</label>
				<input class="form-input" type="password" placeholder="****">
        	</div>
            <textarea class="form-input" placeholder="UHDmusic은 건강한 커뮤니티 문화를 응원합니다 :)" rows="10"></textarea>
        	<div class="divider"></div>
	        <div class="input-group">
		        <label class="input-group-addon">링크1</label>
				<input class="form-input" type="url" placeholder="https://uhdmusic.co.kr/">
        	</div>
	        <div class="input-group">
		        <label class="input-group-addon">링크2</label>
				<input class="form-input" type="url" placeholder="https://uhdmusic.co.kr/">
        	</div>
	        <div class="input-group">
		        <label class="input-group-addon">파일첨부1</label>
				<input class="form-input" type="file">
        	</div>
	        <div class="input-group">
		        <label class="input-group-addon">파일첨부1</label>
				<input class="form-input" type="file">
        	</div>

        	<div class="divider"></div>
		
			<div class="board-bottom columns col-gapless">
				<div class="col-6">
					<button class="btn btn-lg">목록으로</button>
				</div>
				<span class="col-6 text-right">
            		<button type="submit" class="btn btn-primary btn-lg">작성완료</button>
				</span> 
			</div>
        	
        </fieldset>
    	</form>
        	
	</div>

</div>


<?php // footer load
	include_once (G5_PATH."/tail.php");
?>
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/common.js"></script>
    
</body>
</html>