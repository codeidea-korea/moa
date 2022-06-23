<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

$wset['header_skin'] = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
$wset['header_color'] = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
$wset['icolor'] = (isset($wset['icolor']) && $wset['icolor']) ? $wset['icolor'] : 'navy';

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
			미등록시 "이벤트"이라고 출력됨
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
		<td align="center">아이콘</td>
		<td>
			<select name="wset[icolor]">
				<?php echo apms_color_options($wset['icolor']);?>
			</select>
		</td>
	</tr>
	</tbody>
	</table>
</div>