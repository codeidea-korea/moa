<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="section-title">후기 관리</div>

<div class="boxContainer padding40">

<form class="form" role="form" name="flist">
<input type="hidden" name="ap" value="<?php echo $ap;?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="save_opt" value="<?php echo $opt; ?>">
<div class="data-search-wrap fx-wrap label120">
	<div class="fx-list">
		<div class="fx-list-label">평점</div>
		<div class="fx-list-con">
			<input type="radio" value="1" <?php echo $opt == '1' ? 'checked = "checked"' : '' ?> name="opt" data-label="1">
			<input type="radio" value="2" <?php echo $opt == '2' ? 'checked = "checked"' : '' ?> name="opt" data-label="2">
			<input type="radio" value="3" <?php echo $opt == '3' ? 'checked = "checked"' : '' ?> name="opt" data-label="3">
			<input type="radio" value="4" <?php echo $opt == '4' ? 'checked = "checked"' : '' ?> name="opt" data-label="4">
			<input type="radio" value="5" <?php echo $opt == '5' ? 'checked = "checked"' : '' ?> name="opt" data-label="5">
			<input type="radio" value="" <?php echo $opt == '' ? 'checked = "checked"' : '' ?> name="opt" data-label="전체">
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">검색어</div>
		<div class="fx-list-con">
			<select name="sca" id="sca">
				<option value="">전체</option>
				<option value="is_name" <?php echo $sca == 'iq_name' ? 'selected' : ''; ?>>작성한 사용자</option>
				<option value="it_name" <?php echo $sca == 'it_name' ? 'selected' : ''; ?>>모임제목</option>
			</select>
			<input type="text" name="stx" value="<?php echo $stx; ?>" placeholder="ID를 입력해주세요.">
		</div>
	</div>
	<div class="btnSet">
		<button type="submit" class="btnSearch">조회</button>
		<a href="./?ap=<?php echo $ap;?>" class="btnReset">초기화</a>
	</div>
</div>

<div class="row none">
	<div class="col-sm-3">
		<div class="form-group">
			<label for="sca" class="sound_only">분류선택</label>
			<select name="" id="" class="form-control input-sm">
				<option value="">카테고리</option>
				<?php echo $category_options;?>
			</select>
			<script>document.getElementById("sca").value = "<?php echo $sca; ?>";</script>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<div class="form-group">
				<label for="opt" class="sound_only">별점선택</label>
				<select name="" class="form-control input-sm">
					<option value="">전체보기</option>
					<option value="5">별 5개</option>
					<option value="4">별 4개</option>
					<option value="3">별 3개</option>
					<option value="2">별 2개</option>
					<option value="1">별 1개</option>
				</select>
				<script>document.getElementById("opt").value = "<?php echo $opt; ?>";</script>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-search"></i> 보기</button>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<a href="./?ap=<?php echo $ap;?>" class="btn btn-danger btn-sm btn-block"><i class="fa fa-power-off"></i> 초기화</a>
		</div>
	</div>
</div>
</form>


<div class="tbl-basic outline odd th-h5 ">
	<table>
		<colgroup>
			<col width="150">
			<col width="150">
			<col>
			<col>
			<col>
			<col>
			<col width="150">
		</colgroup>
		<thead>
			<tr>
				<th scope="col">No.</th>
				<th scope="col">평점</th>
				<th scope="col">작성날짜</th>
				<th scope="col">작성시간</th>
				<th scope="col">작성한 사용자</th>
				<th scope="col">모임제목</th>
				<th scope="col">좋아요 수</th>
				<th scope="col">신고</th>
			</tr>
		</thead>
		<tbody>
			<?php  for ($i=0; $i < count($list); $i++) { ?>
			<tr>
				<td><?php echo $list[$i]['is_num']; ?></td>
				<td><?php echo $list[$i]['is_score'];?></td>
				<td><?php echo apms_datetime($list[$i]['is_time'], 'Y.m.d');?></td>
				<td><?php echo apms_datetime($list[$i]['is_time'], 'H:i');?></td>
				<td><?php echo $list[$i]['is_name']; ?></td>
				<td><?php echo gettext($list[$i]['it_name']); ?></td>
				<td><?php echo getCountLike($list[$i]['it_id']); ?></td>
				<td><a href="#" class="btn small reverse red">신고</a></td>
			</tr>
			<?php } ?>
			<?php  if ($i == 0) echo '<tr><td colspan="8" class="text-center">등록된 후기가 없습니다.</td></tr>'; ?>
		</tbody>
	</table>
</div>

<?php if($total_count > 0) { ?>
<ul class="pagination">
	<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
</ul>
<?php } ?>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="at-media none">
<?php 
	for ($i=0; $i < count($list); $i++) { 
		// 이미지
		if($list[$i]['is_photo']) {
			$img['src'] = $list[$i]['is_photo'];
		} else {
			$img = apms_it_write_thumbnail($list[$i]['it_id'], $list[$i]['is_content'], 80, 80);
		}
?>
	<div class="media">
		<div class="img-thumbnail photo pull-left">
			<a href="#" onclick="more_is('more_is_<?php echo $i; ?>'); return false;">
				<?php echo ($img['src']) ? '<img src="'.$img['src'].'" alt="'.$img['src'].'">' : '<i class="fa fa-user"></i>'; ?>
			</a>
		</div>
		<div class="media-body">
			<h5 class="media-heading">
				<a href="#" onclick="more_is('more_is_<?php echo $i; ?>'); return false;">
					<span class="pull-right text-muted font-11 en">no.<?php echo $list[$i]['is_num']; ?></span>
					<?php echo $list[$i]['is_subject']; ?>
				</a>
			</h5>
			<div class="media-item">
				<a href="<?php echo $list[$i]['it_href'];?>" target="_blank"><span class="text-muted"><?php echo $list[$i]['it_name']; ?></span></a>
			</div>
			<div class="media-info en text-muted">
				<span class="is-star red font-12">
					<?php echo $list[$i]['is_star'];?>
				</span>
				
				<i></i> 
				<?php if($list[$i]['is_reply']) { ?>
					<span class="blue">답변완료</span>
				<?php } else { ?>
					답변대기
				<?php } ?>

				<i class="fa fa-user"></i>
				<?php echo $list[$i]['is_name']; ?>

				<i class="fa fa-clock-o"></i>
				<time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', $list[$i]['is_time']) ?>"><?php echo apms_datetime($list[$i]['is_time'], 'Y.m.d H:i');?></time>

			</div>
			<div class="media-content media-resize" id="more_is_<?php echo $i; ?>" style="display:none;">
				<?php echo get_view_thumbnail($list[$i]['is_content'], $default['pt_img_width']); // 문의 내용 ?>
				<?php if ($list[$i]['is_reply']) { 
					//답글제목 : $list[$i]['is_reply_subject']
					//답글작성 : $list[$i]['is_reply_name']
				?>
					<div class="well well-sm">
						<?php echo get_view_thumbnail($list[$i]['is_reply_content'], $default['pt_img_width']); ?>
					</div>
				<?php } ?>
				<p>
					<a href="<?php echo $list[$i]['is_reply_href'];?>" class="btn btn-default btn-sm"><i class="fa fa-comment"></i> 답변하기</a>
				</p>
			</div>
		</div>
	</div>
<?php } ?>
</div>

<?php if ($i == 0) echo '<p class="text-center text-muted none" style="padding:50px 0px;">등록된 후기가 없습니다.</p>'; ?>

<?php if($total_count > 0) { ?>
	<div class="text-center none">
		<ul class="pagination pagination-sm en">
			<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
		</ul>
	</div>
<?php } ?>

</div>


<script>
	function more_is(id) {
		$("#" + id).toggle();
	}
</script>
