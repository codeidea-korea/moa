<?php
$sub_menu = '580120';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

$bn_id = preg_replace('/[^0-9]/', '', $bn_id);

$html_title = '배너';
$g5['title'] = $html_title.'관리';

if ($w=="u")
{
    $html_title .= ' 수정';
    $sql = " select * from {$g5['g5_shop_banner_table']} where bn_id = '$bn_id' ";
    $bn = sql_fetch($sql);
}
else
{
    $html_title .= ' 입력';
    $bn['bn_url']        = "http://";
    $bn['bn_begin_time'] = date("Y-m-d 00:00:00", time());
    $bn['bn_end_time']   = date("Y-m-d 00:00:00", time()+(60*60*24*31));
}

// 접속기기 필드 추가
if(!sql_query(" select bn_device from {$g5['g5_shop_banner_table']} limit 0, 1 ")) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_banner_table']}`
                    ADD `bn_device` varchar(10) not null default '' AFTER `bn_url` ", true);
    sql_query(" update {$g5['g5_shop_banner_table']} set bn_device = 'pc' ", true);
}

include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<div class="boxContainer padding40">

	<form name="fbanner" action="./bannerformupdate.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="w" value="<?php echo $w; ?>">
	<input type="hidden" name="bn_id" value="<?php echo $bn_id; ?>">

	<div class="tbl_frm01 tbl_wrap none">
		<table>
		<caption><?php echo $g5['title']; ?></caption>
		<colgroup>
			<col class="grid_4">
			<col>
		</colgroup>
		<tbody>
		<tr>
			<th scope="row">이미지</th>
			<td>
				<input type="file" name="bn_bimg">
				<?php
				$bimg_str = "";
				$bimg = G5_DATA_PATH."/banner/{$bn['bn_id']}";
				if (file_exists($bimg) && $bn['bn_id']) {
					$size = @getimagesize($bimg);
					if($size[0] && $size[0] > 750)
						$width = 750;
					else
						$width = $size[0];

					echo '<input type="checkbox" name="bn_bimg_del" value="1" id="bn_bimg_del"> <label for="bn_bimg_del">삭제</label>';
					$bimg_str = '<img src="'.$bn['bn_bimg'].'" width="'.$width.'">';
				}
				if ($bimg_str) {
					echo '<div class="banner_or_img">';
					echo $bimg_str;
					echo '</div>';
				}
				?>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="bn_alt">이미지 설명</label></th>
			<td>
				<?php echo help("img 태그의 alt, title 에 해당되는 내용입니다.\n배너에 마우스를 오버하면 이미지의 설명이 나옵니다."); ?>
				<input type="text" name="bn_alt" value="<?php echo get_text($bn['bn_alt']); ?>" id="bn_alt" class="frm_input" size="80">
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="bn_url">링크</label></th>
			<td>
				<?php echo help("배너클릭시 이동하는 주소입니다."); ?>
				<input type="text" name="bn_url" size="80" value="<?php echo $bn['bn_url']; ?>" id="bn_url" class="frm_input">
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="bn_device">접속기기</label></th>
			<td>
				<?php echo help('배너를 표시할 접속기기를 선택합니다.'); ?>
				<select name="bn_device" id="bn_device">
					<option value="both"<?php echo get_selected($bn['bn_device'], 'both', true); ?>>PC와 모바일</option>
					<option value="pc"<?php echo get_selected($bn['bn_device'], 'pc'); ?>>PC</option>
					<option value="mobile"<?php echo get_selected($bn['bn_device'], 'mobile'); ?>>모바일</option>
			</select>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="bn_position">출력위치</label></th>
			<td>
				<?php //echo help("왼쪽 : 쇼핑몰화면 왼쪽에 출력합니다.\n메인 : 쇼핑몰 메인화면(index.php)에만 출력합니다."); ?>
				<select name="bn_position" id="bn_position">
					<!-- <option value="왼쪽" <?php echo get_selected($bn['bn_position'], '왼쪽'); ?>>왼쪽</option> -->
					<option value="메인" <?php echo get_selected($bn['bn_position'], '메인'); ?>>메인</option>
			</select>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="bn_border">테두리</label></th>
			<td>
				 <?php echo help("배너이미지에 테두리를 넣을지를 설정합니다.", 50); ?>
				<select name="bn_border" id="bn_border">
					<option value="0" <?php echo get_selected($bn['bn_border'], 0); ?>>사용안함</option>
					<option value="1" <?php echo get_selected($bn['bn_border'], 1); ?>>사용</option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="bn_new_win">새창</label></th>
			<td>
				<?php echo help("배너클릭시 새창을 띄울지를 설정합니다.", 50); ?>
				<select name="bn_new_win" id="bn_new_win">
					<option value="0" <?php echo get_selected($bn['bn_new_win'], 0); ?>>사용안함</option>
					<option value="1" <?php echo get_selected($bn['bn_new_win'], 1); ?>>사용</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label for="bn_order">출력 순서</label></th>
			<td>
			   <?php echo help("배너를 출력할 때 순서를 정합니다. 숫자가 작을수록 먼저 출력됩니다."); ?>
			   <?php echo order_select("bn_order", $bn['bn_order']); ?>
			</td>
		</tr>
		</tbody>
		</table>
	</div>


	<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


	<div class="tbl_frm01 tbl_wrap">
		<table>
		<caption><?php echo $g5['title']; ?></caption>
		<colgroup>
			<col class="grid_4">
			<col>
		</colgroup>
		<tbody>
		<tr>
			<th scope="row"><label>배너 제목</label></th>
			<td>
				<input type="text" name="bn_alt" value="<?php echo get_text($bn['bn_alt']); ?>" id="bn_alt" required class="required frm_input" size="60">
			</td>
		</tr>
		 <tr>
			<th scope="row"><label for="bn_url">링크</label></th>
			<td>
				<?php echo help("배너클릭시 이동하는 주소입니다."); ?>
				<input type="text" name="bn_url" size="80" value="<?php echo $bn['bn_url']; ?>" id="bn_url" class="frm_input">
				<select name="bn_new_win" id="bn_new_win">
					<option value="0" <?php echo get_selected($bn['bn_new_win'], 0); ?>>바로가기</option>
					<option value="1" <?php echo get_selected($bn['bn_new_win'], 1); ?>>새창열기</option>
				</select>
			</td>
		</tr>

		<tr>
			<th scope="row">이미지</th>
			<td>
				 <div class="fileContainer">									
					<label class="upload-btn"><input type="file" name="bn_bimg" class="preview">이미지 업로드</label>
                     <input name="bn_bimg_url" value="<?php echo $bn['bn_bimg'] ?>" type="hidden" />
					<?php
					$bimg_str = "";
                    $bimg = $bn['bn_bimg'];
                    if ($bimg != '' && $bn['bn_id']) {
                        $size = @getimagesize($bimg);
                        if ($size[0] && $size[0] > 750) {
                            $width = 750;
                        } else {
                            $width = $size[0];
                        }
                        $bimg_str = '<img src="' . $bimg . '" width="' . $width . '">';
                        $bimg_str .= '<label class="checkbox-wrap"><input type="checkbox" name="ev_mimg_del" value="1" id="ev_mimg_del"><span></span></label>';
                    }
					?>
					<div class="upImg-preview"><?php echo $bimg_str?></div>
				</div>
			</td>
		</tr>

		<tr>
			<th scope="row">시작일시</th>
			<td>
                <input type="hidden" name="bn_begin_time" value="<?php echo $bn['bn_begin_time'] ?>" />
                <?php
                    $ex = explode(' ', $bn['bn_begin_time']);
                    $date = $ex[0];
                    $time = explode(':', $ex[1])[0];
                    $minute = explode(':', $ex[1])[1];
                ?>
				<label class="inp-wrap label-inline"><input id="begin_date" type="text" value="<?php echo $date; ?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<select id="begin_hour" title="몇시" class="ml5">
					<?php for($i=1; $i<=24; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
						echo '<option value="'.$i.'" '. ($time == $i ? 'selected' : '') .'>'.$i.'시</option>';
					} ?>
			   </select>
			   <select id="begin_minute" title="몇분" class="ml5">
					<?php for($i=0; $i<=59; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
						echo '<option value="'.$i.'" '. ($minute == $i ? 'selected' : '') .'>'.$i.'분</option>';
					} ?>
			   </select>
			</td>
		</tr>
		<tr>
			<th scope="row">종료일시</th>
			<td>
                <?php
                    $ex = explode(' ', $bn['bn_end_time']);
                    $date = $ex[0];
                    $time = explode(':', $ex[1])[0];
                    $minute = explode(':', $ex[1])[1];
                ?>
                <input type="hidden" name="bn_end_time" value="<?php echo $bn['bn_end_time'] ?>" />
				<label class="inp-wrap label-inline"><input type="text" id="end_date" name="" value="<?php echo $date; ?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<select name="" id="end_hour" title="몇시" class="ml5">
					<?php for($i=1; $i<=24; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
						echo '<option value="'.$i.'" '. ($time == $i ? 'selected' : '') .'>'.$i.'시</option>';
					} ?>
			   </select>
			   <select name="" id="end_minute" title="몇분" class="ml5">
					<?php for($i=0; $i<=59; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
						echo '<option value="'.$i.'" '. ($minute == $i ? 'selected' : '') .'>'.$i.'분</option>';
					} ?>
			   </select>
			</td>
		</tr>
		</tbody>
		</table>
	</div>



	<div class="btn_fixed_top">
		<a href="./bannerlist.php" class="btn_02 btn">목록</a>
		<input type="submit" value="확인" class="btn_submit btn" accesskey="s">
	</div>

	</form>

</div>
<script>
    $('document').ready(function(){
        $('#begin_date').change(function(){
            var date = $(this).val() + ' ' + $('#begin_hour').val() + ':' + $('#begin_minute').val();
            $('input[name="bn_begin_time"]').val(date);
        })
        $('#begin_hour').change(function(){
            var date = $('#begin_date').val() + ' ' + $(this).val() + ':' + $('#begin_minute').val();
            $('input[name="bn_begin_time"]').val(date);
        })
        $('#begin_minute').change(function(){
            var date = $('#begin_date').val() + ' ' + $('#begin_hour').val() + ':' + $(this).val();
            $('input[name="bn_begin_time"]').val(date);
        })

        $('#end_date').change(function(){
            var date = $(this).val() + ' ' + $('#end_hour').val() + ':' + $('#end_minute').val();
            $('input[name="bn_end_time"]').val(date);
        })
        $('#end_hour').change(function(){
            var date = $('#end_date').val() + ' ' + $(this).val() + ':' + $('#end_minute').val();
            $('input[name="bn_end_time"]').val(date);
        })
        $('#end_minute').change(function(){
            var date = $('#end_date').val() + ' ' + $('#end_hour').val() + ':' + $(this).val();
            $('input[name="bn_end_time"]').val(date);
        })
    });
</script>
<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
