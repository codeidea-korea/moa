<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

?>
<table>
<caption>목록스킨설정</caption>
<colgroup>
	<col class="grid_2">
	<col>
</colgroup>
<thead>
<tr>
	<th scope="col">구분</th>
	<th scope="col">설정</th>
</tr>
</thead>
<tbody>
<tr>
	<td align="center">목록모드</td>
	<td>
		<?php echo help('무한스크롤은 페이지하단 자동감지로 모바일에서 사이드 출력시 페이지가 길어져 작동하지 않을 수 있으며, 상단 페이징과 버튼이 자동출력 됩니다.');?>
		<select name="boset[mode]">
			<option value="">일반 모드</option>
			<option value="1"<?php echo get_selected('1', $boset['mode']);?>>더보기 모드</option>
			<option value="2"<?php echo get_selected('2', $boset['mode']);?>>무한스크롤 모드</option>
		</select>
		&nbsp;
		더보기색	
		<select name="boset[moreb]">
			<?php echo apms_color_options($boset['moreb']);?>
		</select>
	</td>
</tr>
<tr>
	<td align="center">스타일</td>
	<td>
		<select name="boset[lbody]">
			<option value=""<?php echo get_selected('', $boset['lbody']);?>>기본 스타일</option>
			<option value="box"<?php echo get_selected('box', $boset['lbody']);?>>박스 스타일</option>
			<option value="round"<?php echo get_selected('round', $boset['lbody']);?>>라운드 스타일</option>
			<option value="line"<?php echo get_selected('line', $boset['lbody']);?>>라인 스타일</option>
			<option value="line-round"<?php echo get_selected('line-round', $boset['lbody']);?>>라인 라운드 스타일</option>

		</select>
		&nbsp;
		<select name="boset[lborder]">
			<?php echo apms_color_options($boset['lborder']);?>
		</select>
		&nbsp;
		상단여백 <input type="text" name="boset[tgap]" value="<?php echo $boset['tgap'];?>" size="4" class="frm_input"> px (기본 0)
	</td>
</tr>

<tr>
	<td align="center">썸네일</td>
	<td>
		<?php echo help('기본 400x300(4:3) - 미입력시 기본값이 적용됩니다.');?>
		<input type="text" name="boset[thumb_w]" value="<?php echo $boset['thumb_w'];?>" size="4" class="frm_input">
		x
		<input type="text" name="boset[thumb_h]" value="<?php echo $boset['thumb_h'];?>" size="4" class="frm_input"> px
		-
		확대
		<input type="text" name="boset[thumb_s]" value="<?php echo $boset['thumb_s'];?>" size="4" class="frm_input"> 배 - ex) 유튜브 전용 : 1.35
	</td>
</tr>
<tr>
	<td align="center">이미지</td>
	<td>
		<input type="text" name="boset[gap]" value="<?php echo $boset['gap'];?>" size="4" class="frm_input"> px 간격
		(기본 15px)
		&nbsp;
		<label><input type="checkbox" name="boset[vicon]" value="1"<?php echo get_checked('1', $boset['vicon']);?>> 동영상 표시 아이콘 출력안함</label>
	</td>
</tr>
<tr>
	<td align="center">텍스트</td>
	<td>
		<input type="text" name="boset[lcont]" value="<?php echo $boset['lcont'];?>" size="4" class="frm_input"> 자 내용
		(기본 200자, 0 미출력)
		-
		제목/내용
		<input type="text" name="boset[cline]" value="<?php echo $boset['cline'];?>" size="4" class="frm_input"> 줄 출력
		(기본 4줄)
	</td>
</tr>
<tr>
	<td align="center">목록수</td>
	<td>
		<input type="text" name="bo_page_rows" value="<?php echo $board['bo_page_rows'];?>" size="4" class="frm_input" > 개 - PC
		&nbsp;
		<input type="text" name="bo_mobile_page_rows" value="<?php echo $board['bo_mobile_page_rows'];?>" size="4" class="frm_input" > 개 - 모바일
	</td>
</tr>
<tr>
	<td align="center">썸너비</td>
	<td>
		<input type="text" name="boset[item]" value="<?php echo $boset['item']; ?>" class="frm_input" size="4"> %
		(가로대비 기본 27%, 반응형 기본 lg 35%, md 40%, sm 45%)
		<div class="h10"></div>
		<table>
		<thead>
		<tr>
			<th scope="col">구분</th>
			<th scope="col">lg(1199px~)</th>
			<th scope="col">md(991px~)</th>
			<th scope="col">sm(767px~)</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td align="center">너비(%)</td>
			<td align="center">
				<input type="text" name="boset[lg]" value="<?php echo $boset['lg']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[md]" value="<?php echo $boset['md']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[sm]" value="<?php echo $boset['sm']; ?>" class="frm_input" size="4">
			</td>
		</tr>
		<tr>
			<td align="center">BP</td>
			<td align="center">
				<input type="text" name="boset[lgbp]" value="<?php echo $boset['lgbp']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[mdbp]" value="<?php echo $boset['mdbp']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[smbp]" value="<?php echo $boset['smbp']; ?>" class="frm_input" size="4">
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
<tr>
	<td align="center">보임설정</td>
	<td>
		<label><input type="checkbox" name="boset[ldown]" value="1"<?php echo get_checked('1', $boset['ldown']);?>> 다운</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lvisit]" value="1"<?php echo get_checked('1', $boset['lvisit']);?>> 방문</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lgood]" value="1"<?php echo get_checked('1', $boset['lgood']);?>> 추천</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lnogood]" value="1"<?php echo get_checked('1', $boset['lnogood']);?>> 비추</label>
		&nbsp;
		<label><input type="checkbox" name="boset[ldpoint]" value="1"<?php echo get_checked('1', $boset['ldpoint']);?>> 다운점수</label>
	</td>
</tr>
<tr>
	<td align="center">숨김설정</td>
	<td>
		<label><input type="checkbox" name="boset[lcate]" value="1"<?php echo get_checked('1', $boset['lcate']);?>> 분류</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lname]" value="1"<?php echo get_checked('1', $boset['lname']);?>> 이름</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lhit]" value="1"<?php echo get_checked('1', $boset['lhit']);?>> 조회</label>
		&nbsp;
		<label><input type="checkbox" name="boset[ldate]" value="1"<?php echo get_checked('1', $boset['ldate']);?>> 날짜</label>
	</td>
</tr>
<tr>
	<td align="center">날짜모양</td>
	<td>
		<input type="text" name="boset[dtype]" value="<?php echo $boset['dtype'];?>" size="8" class="frm_input" >
		(Y.m.d, Y/m/d 등 날짜타입)
	</td>
</tr>
</tbody>
</table>