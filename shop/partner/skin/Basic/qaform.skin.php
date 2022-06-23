<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="section-title">문의 관리</div>

<div class="boxContainer padding40">

<form class="form" role="form" name="fitemqaform" method="post" action="./qaformupdate.php" onsubmit="return fitemqaform_submit(this);">
<input type="hidden" name="iq_id" value="<?php echo $iq_id; ?>">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="opt" value="<?php echo $opt; ?>">
<input type="hidden" name="save_opt" value="<?php echo $save_opt; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div class="tbl_frm01 tbl_wrap gap20">
    <table>    
		<colgroup>
			<col width="150">
			<col>
		</colgroup>
		<tbody>
			<tr>
				<th scope="row">문의 작성자</th>
				<td>
					<div class="flex gap40">
						<?php
						echo '<span>'.$name.'</span>';
						if($iq['iq_email']) echo '<span><span class="gray">이메일</span> : '.get_text($iq['iq_email']).'</span>';
						if($iq['iq_hp']) echo '<span><span class="gray">연락처</span> : '.hyphen_hp_number($iq['iq_hp']).'</span>';
						?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row">문의 제목</th>
				<td><b><?php echo conv_subject($iq['iq_subject'],120); ?></b></td>
			</tr>			
			<tr>
				<th scope="row">문의 내용</th>
				<td><?php echo $iq['iq_question']; ?></td>
			</tr>
			<tr>
				<th scope="row" class="vertical-top">답변 달기</th>
				<td><?php echo editor_html('iq_answer', $iq['iq_answer']); ?></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="btn_fixed_top">
    <a href="<?php echo $list_href; ?>" class="btn_02 btn">목록</a>
	<button type="submit" accesskey='s' class="btn_submit btn">확인</button>
</div>


<div class="none">
	<div class="panel panel-default none" style="margin-top:10px;">
		<div class="panel-heading"><h4><i class="fa fa-comment fa-lg"></i> <?php echo conv_subject($iq['iq_subject'],120); ?></h4></div>
		<div class="panel-body">
			<p class="text-muted">
				<i class="fa fa-user"></i> <?php echo $name; ?>
				<?php if($iq['iq_email']) { ?>
					&nbsp; &nbsp;
					<i class="fa fa-envelope"></i> <?php echo get_text($iq['iq_email']); ?>
				<?php } ?>
				<?php if($iq['iq_hp']) { ?>
					&nbsp; &nbsp;
					<i class="fa fa-phone"></i> <?php echo hyphen_hp_number($iq['iq_hp']); ?>
				<?php } ?>
			</p>

			<?php echo $iq['iq_question']; ?>
		</div>
		<div class="list-group">
			<a href="./item.php?it_id=<?php echo $it['it_id'];?>" target="_blank" class="list-group-item">
				<?php $img = apms_it_thumbnail($it, 40, 40, false, true); ?>
				<?php if($img['src']) { ?>
					<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
				<?php } ?>
				<?php echo $it['it_name'];?>
			</a>
		</div>
	</div>
	<h3>
		<i class="fa fa-comments"></i> Answer
	</h3>
	<div>
		<?php //echo editor_html('iq_answer', $iq['iq_answer']); ?>
	</div>
	<br>
	<p class="text-center">
		<button type="submit" accesskey='s' class="btn btn-danger">확인</button>
		<a href="<?php echo $list_href; ?>" class="btn btn-primary">목록</a>
	</p>
</div>


</form>
</div>

<script>
	function fitemqaform_submit(f) {
		<?php echo get_editor_js('iq_answer'); ?>
		return true;
	}
	// BS3
	$(function(){
		$("#iq_answer").addClass("form-control input-sm form-iq-size");
	});
</script>
