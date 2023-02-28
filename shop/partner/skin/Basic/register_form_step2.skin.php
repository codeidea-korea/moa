<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div class="section-title">추가 정보 관리</div>

<div class="boxContainer padding40">
    <form class="form" role="form" name="fregister" id="fregister" action="<?php echo $action_url ?>" onsubmit="return fregister_submit(this);" method="POST" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="ap" value="<?php echo $_GET['ap']; ?>" />
	<div class="wr-wrap label140" style="max-width:580px">
		<div class="wr-list">
			<div class="wr-list-label required">직군</div>
			<div class="wr-list-con">
                <select name="job_group">
                    <option value="">선택</option>
                    <?php foreach($jobgroup as $group) { ?>
                        <option value="<?php echo $group; ?>" <?php echo $group == $member['job_group'] ? 'selected' : ''; ?>><?php echo $group; ?></option>
                    <?php } ?>
                </select>
			</div>
		</div>
		<!-- <div class="wr-list">
			<div class="wr-list-label required">직무</div>
			<div class="wr-list-con">
				<input type="text" value="<?php echo $member['job_kind'] ?>" required name="job_kind" />
			</div>
		</div> -->
		<div class="wr-list">
			<div class="wr-list-label required">직장</div>
			<div class="wr-list-con">
				<input type="text" name="company_name" value="<?php echo $member['company_name'] ?>" required class="span" placeholder="회사명을 입력해주세요."><span class="inline-label search"></span>
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">경력</div>
			<div class="wr-list-con">
				<!--<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>경력</label>-->
				<div class="rangeContainer mt15">
					<input type="range" min="1" max="10" required name="career" value="<?php echo $member['career']; ?>">
					<span class="range-track"></span>
					<span class="range-track-fill"></span>
					<div class="range-label">
						<span>1년</span><span>2년</span><span>3년</span><span>4년</span><span>5년</span><span>6년</span><span>7년</span><span>8년</span><span>9년</span><span>10년~</span>
					</div>
				</div>
			</div>
		</div>
		<div class="wr-list flex-top">
			<div class="wr-list-label required">초대코드</div>
			<div class="wr-list-con">
				<input type="text" name="invite_code" value="" class="span" placeholder="초대코드를 입력해주세요.">
			</div>
		</div>		
	</div>

	<div class="btn_fixed_top">
		<a href="#" class="btn_02 btn">취소</a>
		<button class="btn_submit btn" type="submit">완료</button>
	</div>

</form>
</div>

<script>
    function fregister_submit(f) {
        if (confirm("프로필을 수정하시겠습니까?")) {
            f.action = "<?php echo $action_url;?>";
            return true;
        }

        return false;
    }
</script>