<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

$wset['header_skin'] = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
$wset['header_color'] = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
$wset['hcolor'] = (isset($wset['hcolor']) && $wset['hcolor']) ? $wset['hcolor'] : 'black';
$wset['btn1'] = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'navy';
$wset['btn2'] = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';
$wset['new'] = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red';
$wset['istar'] = (isset($wset['istar']) && $wset['istar']) ? $wset['istar'] : 'red';
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
		<td align="center">목록헤드</td>
		<td>
			<?php echo help('상품후기, 상품문의 목록헤드');?>
			<select name="wset[hskin]">
				<option value="">기본헤드</option>
			<?php
				$skinlist = apms_skin_file_list(G5_PATH.'/css/head', 'css');
				for ($k=0; $k<count($skinlist); $k++) {
					echo "<option value=\"".$skinlist[$k]."\"".get_selected($skinlist[$k], $wset['hskin']).">".$skinlist[$k]."</option>\n";
				} 
			?>
			</select>
			&nbsp;
			기본컬러	
			<select name="wset[hcolor]">
				<?php echo apms_color_options($wset['hcolor']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">버튼컬러</td>
		<td>
			<select name="wset[btn1]">
				<?php echo apms_color_options($wset['btn1']);?>
			</select>
			&nbsp;
			주버튼
			<select name="wset[btn2]">
				<?php echo apms_color_options($wset['btn2']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">큰이미지</td>
		<td>
			<?php echo help('기본 썸네일 800x800 - 미입력시 기본값 적용');?>
			<input type="text" name="wset[big_w]" value="<?php echo $wset['big_w']; ?>" class="frm_input" size="4">
			x
			<input type="text" name="wset[big_h]" value="<?php echo $wset['big_h']; ?>" class="frm_input" size="4">
			px 
			&nbsp;
			<select name="wset[ishadow]">
				<?php echo apms_shadow_options($wset['ishadow']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">별점컬러</td>
		<td>
			<select name="wset[istar]">
				<?php echo apms_color_options($wset['istar']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">댓글설정</td>
		<td>
			회원사진
			<select name="wset[cmt_photo]">
				<option value=""<?php echo get_selected('', $wset['cmt_photo']); ?>>모두</option>
				<option value="1"<?php echo get_selected('1', $wset['cmt_photo']); ?>>PC만</option>
				<option value="2"<?php echo get_selected('2', $wset['cmt_photo']); ?>>모바일만</option>
				<option value="3"<?php echo get_selected('3', $wset['cmt_photo']); ?>>출력안함</option>
			</select>
			&nbsp;
			대댓글 이름
			<select name="wset[cmt_re]">
				<option value=""<?php echo get_selected('', $wset['cmt_re']); ?>>출력안함</option>
				<option value="1"<?php echo get_selected('1', $wset['cmt_re']); ?>>모두</option>
				<option value="2"<?php echo get_selected('2', $wset['cmt_re']); ?>>PC만</option>
				<option value="3"<?php echo get_selected('3', $wset['cmt_re']); ?>>모바일만</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">판매자</td>
		<td>
			<label><input type="checkbox" name="wset[seller]" value="1"<?php echo ($wset['seller']) ? ' checked' : '';?>> 판매자 정보를 출력합니다.</label>
		</td>
	</tr>

	<tr>
		<td align="center" colspan="2" class="bg-navy"><b>관련상품 설정</b></td>
	</tr>

	<tr>
		<td align="center">썸네일</td>
		<td>
			<?php echo help('기본 400x500 - 미입력시 기본값 적용');?>
			<input type="text" name="wset[thumb_w]" value="<?php echo $wset['thumb_w']; ?>" class="frm_input" size="4">
			x
			<input type="text" name="wset[thumb_h]" value="<?php echo $wset['thumb_h']; ?>" class="frm_input" size="4">
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
			</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">자동실행</td>
		<td>
			<?php echo help('밀리초(ms)는 천분의 1초입니다. ex) 3초 = 3000ms');?>
			<input type="text" name="wset[auto]" value="<?php echo $wset['auto']; ?>" class="frm_input" size="4"> ms - PC 
			&nbsp;
			<input type="text" name="mwset[auto]" value="<?php echo $mwset['auto']; ?>" class="frm_input" size="4"> ms - 모바일 (기본 3000, 0 입력시 미실행) 

		</td>
	</tr>
	<tr>
		<td align="center">슬라이더</td>
		<td>
			<input type="text" name="wset[speed]" value="<?php echo $wset['speed']; ?>" class="frm_input" size="4"> ms 속도(기본 200)
			&nbsp;
			<label><input type="checkbox" name="wset[rdm]" value="1"<?php echo get_checked('1', $wset['rdm']); ?>> 랜덤</label>
			&nbsp;
			<label><input type="checkbox" name="wset[dot]" value="1"<?php echo get_checked('1', $wset['dot']); ?>> 페이징</label>
			&nbsp;
			<label><input type="checkbox" name="wset[lazy]" value="1"<?php echo get_checked('1', $wset['lazy']); ?>> Lazy</label>
			&nbsp;
			<label><input type="checkbox" name="wset[nav]" value="1"<?php echo get_checked('1', $wset['nav']); ?>> 화살표 숨김</label>
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
			<input type="text" name="wset[newtime]" value="<?php echo ($wset['newtime']);?>" size="4" class="frm_input"> 시간 이내 등록 아이템
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