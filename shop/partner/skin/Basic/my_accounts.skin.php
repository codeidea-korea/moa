<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="section-title">정산 정보 관리</div>

<div class="boxContainer padding40">

	<form class="" name="" method="post" action="/shop/partner/?ap=my_accounts">
	<input type="hidden" name="act" value="proc">
	<input type="hidden" name="pt_id" value="<?php echo $partner['pt_id'];?>">
	
	<div class="tbl_frm01 tbl_wrap gap15" style="max-width:600px">
        <table>        
			<colgroup>
				<col width="150">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<th scope="row"><label class="required">상품종류</label></th>
					<td>
						<select name="pt_commission_2" class="span" readonly>
							<option value="<?php echo $apms['apms_commission_2'];?>"><?php echo $apms['apms_commission_2'];?></option>
							
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label class="required">은행명</label></th>
					<td>
						<select name="pt_bank_name" class="span">
							<?php foreach($banklist as $k => $v) {?>
							<option value="<?php echo $v;?>" <?php if ($partner['pt_bank_name']==$v) { echo " selected ";} ?>><?php echo $v;?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label class="required">예금주</label></th>
					<td>
						<div class="flex">
							<input type="text" name="pt_bank_owner" class="span140" value="<?php echo $partner['pt_bank_owner'];?>" placeholder="예금주 성함">
							<input type="text" name="pt_bank_account" class="flex1"  value="<?php echo $partner['pt_bank_account'];?>" placeholder="계좌번호를 입력해주세요.">
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row" class="vertical-top" style=""><label class="required">세금계산서 발급*</label></th>
					<td>
						<label class="radio-wrap"><input type="radio" name="pt_company" value="개인(원천징수)" 
						<?php if ($partner['pt_company']=="개인(원천징수)") { echo ' checked ';} ?>><span></span>개인(원천징수)</label>
						<label class="radio-wrap"><input type="radio" name="pt_company" value="사업자"  <?php if ($partner['pt_company']=="사업자") { echo ' checked ';} ?>><span></span>사업자</label>						
						<div class="mt10">
							<div class="frm_individual">
								<input type="text" name="pt_company_name" class="span" value="<?php echo $partner['pt_company_name'];?>" placeholder="성함/사업자명을 입력해주세요.">
								<p class="fs13 mt10">
									세금 계산서 발급 대상을 입력해주세요.<br>
									사업자 등륵증 내 상호명(법인명)과 동일하게 입력해주세요.
								</p>
							</div>
							<!-- <div class="frm_business">
								<input type="text" name="pt_company_name" class="span" placeholder="사업자명을 입력해주세요.">
							</div> -->
						</div>
						
					</td>
				</tr>
				<tr>
					<th scope="row"><label class="required">식별번호*</label></th>
					<td>
						<input type="text" name="pt_company_saupja" class="span" value="<?php echo $partner['pt_company_saupja'];?>" placeholder="원천징수/세금계산을 위한 주민번호/사업자번호를 입력해주세요.">
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="btn_fixed_top">
		<input type="submit" value="저장" class="btn_submit btn" accesskey="s">
	</div>
	</form>

</div>

<script>
function radioChange(val) {
	if(val == 'business') {
		$('.frm_individual').hide();
		$('.frm_business').show();
	} else {
		$('.frm_individual').show();
		$('.frm_business').hide();
	}
}
radioChange('');
$('input[name="r1"]').change(function (){
	let val = $(this).val();
	radioChange(val)
});
</script>