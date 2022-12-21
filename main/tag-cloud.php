<div class="tag-cloud">
	<div class="background-embed">
		<div class="container grid-xl">
		    <fieldset id="bo_sch">
		        <legend>게시물 검색</legend>
		
		        <form name="fsearch" method="get">
		        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		        <input type="hidden" name="sca" value="<?php echo $sca ?>">
		        <input type="hidden" name="sop" value="and">
		        <label for="sfl" class="sound_only">검색대상</label>
		        <select name="sfl" id="sfl">
		            <option value="wr_subject||wr_name,1"<?php echo get_selected($sfl, 'wr_subject||wr_name,1'), true; ?>></option>
		        </select>
		        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="DISCOVER YOUR KEYWORDS.">
		        <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
		        </form>
		    </fieldset> 
		</div>
	</div>
	<div class="container grid-xl">
		<span class="label">
			<?php 
			// 해당 게시판 전체 태그 노출 영역. 향후 태그와 카테고리를 공통 헤더 영역에 추가 예정.
			for ($i=0; $i < $list_cnt; $i++)  {
				$tag_list = apms_get_tag($list[$i]['as_tag']);
				?>
					<?php echo $tag_list;?>
			<?php } ?>
		</span>
		<?php include_once 'board-category.php'; ?>
	</div>
</div>