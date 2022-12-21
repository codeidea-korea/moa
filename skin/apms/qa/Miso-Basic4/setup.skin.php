<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

$wset['header_skin'] = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
$wset['header_color'] = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
$wset['hcolor'] = (isset($wset['hcolor']) && $wset['hcolor']) ? $wset['hcolor'] : 'black';
$wset['sbtn'] = (isset($wset['sbtn']) && $wset['sbtn']) ? $wset['sbtn'] : 'navy';
$wset['btn1'] = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'navy';
$wset['btn2'] = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';
$wset['bline'] = (isset($wset['bline']) && $wset['bline']) ? $wset['bline'] : 'navy';
$wset['star'] = (isset($wset['star']) && $wset['star']) ? $wset['star'] : 'red';

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
		<td align="center">헤더제목</td>
		<td>
			<input type="text" name="wset[title]" value="<?php echo ($wset['title']);?>" size="30" class="frm_input">
			&nbsp;
			미등록시 "상품문의"라고 출력됨
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
		<td align="center">목록헤드</td>
		<td>
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
		<td align="center">검색버튼</td>
		<td>
			<select name="wset[sbtn]">
				<?php echo apms_color_options($wset['sbtn']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">박스라인</td>
		<td>
			<select name="wset[bline]">
				<?php echo apms_color_options($wset['bline']);?>
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
		<td align="center">별점컬러</td>
		<td>
			<select name="wset[star]">
				<?php echo apms_color_options($wset['star']);?>
			</select>
		</td>
	</tr>
	</tbody>
	</table>
</div>