<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

if(!$wset['new']) $wset['new'] = 'red';

?>
<link rel="stylesheet" href="<?php echo THEMA_URL;?>/assets/css/spectrum.css">
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/spectrum.js"></script>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
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
		<td align="center">이동사용(삼각형)</td>
		<td>
			<select name="wset[tuse]" >
				<option value=""<?php echo get_selected('', $wset['tuse']);?>>사용안함</option>
				<option value="1"<?php echo get_selected('1', $wset['tuse']);?>>사용함</option>
			</select>
			링크
			<input type="text" name="wset[link_1]" value="<?php echo $wset['link_1'];?>" size="20" class="frm_input">
			name 의 이름
		</td>
	</tr>
	<tr>
		<td align="center">색상</td>
		<td>
			배경 색상
			<input type="text" class="color_t body-bgcolor" name="wset[color_t]" value="<?php echo $wset['color_t'];?>" style="display: none;">
			화살표 색상
			<input type="text" class="color_tb frm_input" name="wset[color_tb]" value="<?php echo $wset['color_tb'];?>" size="10">
		</td>
	</tr>
	<tr>
		<td align="center">배경 이미지</td>
		<td>
			<input type="text" name="wset[background-img]" value="<?php echo $wset['background-img'];?>" id="img1" size="50" class="frm_input">
			<a href="<?php echo G5_BBS_URL;?>/widget.image.php?fid=img1" class="btn_frmline win_scrap">이미지선택</a>
		</td>
	</tr>
	<tr>
		<td align="center">타이틀</td>
		<td>
			<input type="text" name="wset[title]" value="<?php echo $wset['title'];?>" size="40" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">타이틀 설명</td>
		<td>
			<textarea type="text" name="wset[content]" style="height:130px;"><?php echo $wset['content'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="center">상세 링크</td>
		<td>
			<input type="text" name="wset[dlink]" value="<?php echo $wset['dlink'];?>" size="50" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">youtube 링크</td>
		<td>
			<input type="text" name="wset[youtube]" value="<?php echo $wset['youtube'];?>" size="50" class="frm_input">
		</td>
	</tr>

	</tbody>
	</table>
</div>

<script>
$(document).ready(function($) {
	//Background Color Change
	$(".color_t").spectrum({
		<?php if($wset['color_t']) { ?>
			color: "<?php echo $wset['color_t'];?>",
		<?php } ?>
		allowEmpty: true,
		clickoutFiresChange: true,
		showButtons: false,
		preferredFormat: "hex6",
		showInput: true,
		move: switcher_bgcolor
	});
});

function switcher_bgcolor(color) {
	$(".sp-preview-inner").css("background-color", color.toHexString());
	return false;
}
</script>