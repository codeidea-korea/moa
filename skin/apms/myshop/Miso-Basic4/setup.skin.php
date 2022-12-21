<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

$wset['header_skin'] = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
$wset['header_color'] = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
$wset['new'] = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red';
if(!$wset['pbg']) $wset['pbg'] = 'navy';

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>스킨설정</caption>
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
		<td align="center">썸네일</td>
		<td>
			<?php echo help('기본 400x500 - 미입력시 기본값 적용');?>
			<input type="text" name="wset[thumb_w]" value="<?php echo ($wset['thumb_w']);?>" size="4" class="frm_input">
			x
			<input type="text" name="wset[thumb_h]" value="<?php echo ($wset['thumb_h']);?>" size="4" class="frm_input">
			px
			&nbsp;
			<select name="wset[shadow]">
				<?php echo apms_shadow_options($wset['shadow']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">반응형</td>
		<td>
			<table>
			<thead>
			<tr>
				<th scope="col">구분</th>
				<th scope="col">기본</th>
				<th scope="col">lg(1199px~)</th>
				<th scope="col">md(991px~)</th>
				<th scope="col">sm(767px~)</th>
				<th scope="col">xs(480px~)</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td align="center">가로갯수(개)</td>
				<td align="center">
					<input type="text" name="wset[item]" value="<?php echo $wset['item']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[lg]" value="<?php echo $wset['lg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[md]" value="<?php echo $wset['md']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[sm]" value="<?php echo $wset['sm']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[xs]" value="<?php echo $wset['xs']; ?>" class="frm_input" size="4">
				</td>
			</tr>
			<tr>
				<td align="center">좌우간격(px)</td>
				<td align="center">
					<input type="text" name="wset[gap]" value="<?php echo $wset['gap']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[lgg]" value="<?php echo $wset['lgg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[mdg]" value="<?php echo $wset['mdg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[smg]" value="<?php echo $wset['smg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[xsg]" value="<?php echo $wset['xsg']; ?>" class="frm_input" size="4">
				</td>
			</tr>
			<tr>
				<td align="center">상하간격(px)</td>
				<td align="center">
					<input type="text" name="wset[gapb]" value="<?php echo $wset['gapb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[lgb]" value="<?php echo $wset['lgb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[mdb]" value="<?php echo $wset['mdb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[smb]" value="<?php echo $wset['smb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[xsb]" value="<?php echo $wset['xsb']; ?>" class="frm_input" size="4">
				</td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">헤더제목</td>
		<td>
			<input type="text" name="wset[title]" value="<?php echo ($wset['title']);?>" size="30" class="frm_input">
			&nbsp;
			미등록시 "마이샵"이라고 출력됨
		</td>
	</tr>
	<tr>
		<td align="center">
			헤더출력
		</td>
		<td>
			<select name="wset[header_skin]">
				<option value="none">사용안함</option>
				<?php
					$skinlist = get_skin_dir('header');
					for ($k=0; $k<count($skinlist); $k++) {
						echo "<option value=\"".$skinlist[$k]."\"".get_selected($skinlist[$k], $wset['header_skin']).">".$skinlist[$k]."</option>\n";
					} 
				?>
			</select>
			&nbsp;
			<select name="wset[header_color]">
				<?php echo apms_color_options($wset['header_color']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">출력설정</td>
		<td>
			적립 <select name="wset[pbg]">
				<?php echo apms_color_options($wset['pbg']);?>
			</select>
			&nbsp;
			별점 <select name="wset[star]">
				<option value="1">출력안함</option>
				<?php echo apms_color_options($wset['star']);?>
			</select>
			&nbsp;
			컨텐츠 <input type="text" name="wset[line]" value="<?php echo $wset['line']; ?>" class="frm_input" size="4"> 줄 출력(기본 3)
		</td>
	</tr>
	<tr>
		<td align="center">숨김항목</td>
		<td>
			<label><input type="checkbox" name="wset[buy]" value="1"<?php echo ($wset['buy']) ? ' checked' : '';?>> 구매수</label>
			&nbsp;
			<label><input type="checkbox" name="wset[cmt]" value="1"<?php echo ($wset['cmt']) ? ' checked' : '';?>> 댓글수</label>
			&nbsp;
			<label><input type="checkbox" name="wset[good]" value="1"<?php echo ($wset['good']) ? ' checked' : '';?>> 추천수</label>
		</td>
	</tr>
	<tr>
		<td align="center">보임항목</td>
		<td>
			<label><input type="checkbox" name="wset[use]" value="1"<?php echo ($wset['use']) ? ' checked' : '';?>> 후기수</label>
			&nbsp;
			<label><input type="checkbox" name="wset[qa]" value="1"<?php echo ($wset['qa']) ? ' checked' : '';?>> 문의수</label>
			&nbsp;
			<label><input type="checkbox" name="wset[hit]" value="1"<?php echo ($wset['hit']) ? ' checked' : '';?>> 조회수</label>
		</td>
	</tr>
	<tr>
		<td align="center">새아이템</td>
		<td>
			<input type="text" name="wset[newtime]" value="<?php echo ($wset['newtime']);?>" size="3" class="frm_input"> 시간 이내 등록 아이템
			&nbsp;
			색상
			<select name="wset[new]">
				<?php echo apms_color_options($wset['new']);?>
			</select>
		</td>
	</tr>
	</tbody>
	</table>
</div>