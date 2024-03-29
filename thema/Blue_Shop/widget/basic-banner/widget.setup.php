<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
	<colgroup>
		<col class="grid_1">
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col" colspan="2">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center" rowspan="6">공통</td>
		<td align="center">PC 스타일</td>
		<td>
			<?php echo help('기본 3000ms, 밀리초(ms)는 천분의 1초. ex) 5초 = 5000ms');?>
			<select name="wset[effect]">
				<?php echo apms_carousel_options($wset['effect']);?>
			</select>
			<input type="text" name="wset[auto]" value="<?php echo $wset['auto']; ?>" class="frm_input" size="4"> ms 간격(0 입력시 자동실행 안함)
		</td>
	</tr>
	<tr>
		<td align="center">모바일 스타일</td>
		<td>
			<select name="wmset[effect]">
				<?php echo apms_carousel_options($wmset['effect']);?>
			</select>
			<input type="text" name="wmset[auto]" value="<?php echo $wmset['auto']; ?>" class="frm_input" size="4"> ms 간격(0 입력시 자동실행 안함)
		</td>
	</tr>
	<tr>
		<td align="center">네비설정</td>
		<td>
			<?php echo help('도트위치는 기본 10px, 입력시 단위(px 또는 %)까지 입력.');?>
			<select name="wset[nav]">
				<option value=""<?php echo get_selected('', $wset['nav']);?>>네비없음</option>
				<option value="1"<?php echo get_selected('1', $wset['nav']);?>>도트네비</option>
			</select>
			&nbsp;
			도트위치
			<input type="text" name="wset[dot]" value="<?php echo ($wset['dot']) ? $wset['dot'] : '10px' ; ?>" class="frm_input" size="6"> (px or %)
		</td>
	</tr>
	<tr>
		<td align="center">출력설정</td>
		<td>
			<label><input type="checkbox" name="wset[rdm]" value="1"<?php echo get_checked('1', $wset['rdm']);?>> 랜덤출력</label>
		</td>
	</tr>
	<tr>
		<td align="center">높이설정</td>
		<td>
			<?php echo help('기본 200px, 입력시 단위(px 또는 %)까지 입력. ex) 400px or 56.25%');?>
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
				<td align="center">높이(px,%)</td>
				<td align="center">
					<input type="text" name="wset[height]" value="<?php echo $wset['height']; ?>" class="frm_input" size="4">
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
			</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><b>슬라이더</b></td>
		<td>
			<input type="text" name="wset[slider]" value="<?php echo $wset['slider']; ?>" class="frm_input" size="4"> 개 - 입력후 저장하시면 슬라이더가 생성됩니다.
		</td>
	</tr>
	<?php for ($i=1; $i <= $wset['slider']; $i++) { ?>
		<tr>
			<td align="center" rowspan="3">#<?php echo $i;?></td>
			<td align="center" class="bg-light"><b>사용여부</b></td>
			<td class="bg-light">
				<label><input type="checkbox" name="wset[use<?php echo $i;?>]" value="1"<?php echo get_checked('1', $wset['use'.$i]); ?>> <b>출력하기</b></label>
			</td>
		</tr>
		<tr>
			<td align="center">이미지</td>
			<td>
				<select name="wset[cl<?php echo $i;?>]">
					<option value=""<?php echo get_selected('', $wset['cl'.$i]);?>>중앙</option>
					<option value="top"<?php echo get_selected('top', $wset['cl'.$i]);?>>상단</option>
					<option value="bottom"<?php echo get_selected('bottom', $wset['cl'.$i]);?>>하단</option>
				</select>
				<input type="text" name="wset[img<?php echo $i;?>]" value="<?php echo ($wset['img'.$i]);?>" id="img<?php echo $i;?>" size="36" class="frm_input"> 
				<a href="<?php echo G5_BBS_URL;?>/widget.image.php?fid=img<?php echo $i;?>" class="btn_frmline win_scrap">이미지선택</a>
			</td>
		</tr>
		<tr>
			<td align="center">링크</td>
			<td>
				<?php echo help('URL(http://...)을 입력해야 하며, 미입력시 링크가 걸리지 않습니다.');?>
				<input type="text" name="wset[link<?php echo $i;?>]" value="<?php echo $wset['link'.$i]; ?>" size="40" class="frm_input" placeholder="http://...">
				&nbsp;
				타켓
				<input type="text" name="wset[target<?php echo $i;?>]" value="<?php echo $wset['target'.$i]; ?>" size="8" class="frm_input">
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
</div>