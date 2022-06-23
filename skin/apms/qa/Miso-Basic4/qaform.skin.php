<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// Common Skin
if(!$move) $wset['header_skin'] = 'none';
@include_once($skin_path.'/common.skin.php');

// StyleSheet
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" type="text/css" media="screen">',0);

?>

<div class="form-box">
	<div class="form-header">
			<?php
				$caid = substr($it['ca_id'],0,2);
				$caid2 = substr($it['ca_id2'],0,2);
				$caid3 = substr($it['ca_id3'],0,2);
				 if ($it['pt_type'] == '2' || $caid=='10' || $caid2=='10' || $caid3=='10') {?>
				<h2>온라인 상담</h2>
			<?php } else { ?>
				<h2>Q & A</h2>
			<?php } ?>

	</div>
	<div class="form-body">

		<form name="fitemqa" class="form-light padding-15" role="form" method="post" action="./itemqaformupdate.php" onsubmit="return fitemqa_submit(this);" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $w; ?>">
			<input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
			<input type="hidden" name="iq_id" value="<?php echo $iq_id; ?>">
			<input type="hidden" name="ca_id" value="<?php echo $ca_id; ?>">
			<input type="hidden" name="qrows" value="<?php echo $qrows; ?>">
			<input type="hidden" name="page" value="<?php echo $page; ?>">
			<input type="hidden" name="move" value="<?php echo $move; ?>">

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="iq_email"><b class="en">이메일</b></label>
						<input type="text" name="iq_email" value="<?php echo $qa['iq_email']; ?>" class="form-control input-sm" size="30">
					</div>
				</div>
				<div class="col-sm-6">
					<label for="iq_hp"><b class="en">휴대폰</b></label>
					<input type="text" name="iq_hp" value="<?php echo $qa['iq_hp']; ?>" class="form-control input-sm" size="20">
				</div>
			</div>
			<div class="form-group">
				<label for="iq_subject"><b class="en">제목</b><strong class="sound_only"> 필수</strong></label>
				<input type="text" name="iq_subject" value="<?php echo get_text($qa['iq_subject']); ?>" id="iq_subject" required class="form-control input-sm minlength=2" minlength="2" maxlength="250" placeholder="">
			</div>
			<div class="form-group">
				<?php echo $editor_html; ?>
			</div>

			<label class="text-muted"><input type="checkbox" name="iq_secret" value="1" <?php echo $chk_secret; ?>> 비밀글로 등록합니다.</label>

			<div class="text-center">
				<button type="submit" class="btn btn-<?php echo $btn2;?> btn-sm">작성완료</button>
				<?php if($move) { ?>
					<button type="button" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="history.go(-1);">취소</button>
				<?php } else { ?>
					<button type="button" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="window.close();">닫기</button>
				<?php } ?>
			</div>
		</form>
	</div>
</div>

<script>
	function fitemqa_submit(f) {
		<?php echo $editor_js; ?>
		return true;
	}

	// BS3
	$(function(){
		$("#iq_question").addClass("form-control input-sm form-iq-size");
		$("#iq_answer").addClass("form-control input-sm form-iq-size");
	});
</script>
