<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<input type="hidden" name="good_mny"          value="<?php echo $tot_price ?>" >
<input type="hidden" name="res_cd"            value="">                                     <!-- 결과 코드          -->

<input type="hidden" name="P_HASH"            value="">
<input type="hidden" name="P_TYPE"            value="">
<input type="hidden" name="P_UNAME"           value="">
<input type="hidden" name="P_AUTH_DT"         value="">
<input type="hidden" name="P_AUTH_NO"         value="">
<input type="hidden" name="P_HPP_CORP"        value="">
<input type="hidden" name="P_APPL_NUM"        value="">
<input type="hidden" name="P_VACT_NUM"        value="">
<input type="hidden" name="P_VACT_NAME"       value="">
<input type="hidden" name="P_VACT_BANK"       value="">
<input type="hidden" name="P_CARD_ISSUER"     value="">

<?php if($default['de_tax_flag_use']) { ?>
	<input type="hidden" name="comm_tax_mny"      value="<?php echo $comm_tax_mny; ?>">         <!-- 과세금액    -->
	<input type="hidden" name="comm_vat_mny"      value="<?php echo $comm_vat_mny; ?>">         <!-- 부가세     -->
	<input type="hidden" name="comm_free_mny"     value="<?php echo $comm_free_mny; ?>">        <!-- 비과세 금액 -->
<?php } ?>

<div id="display_pay_button" class="btn_confirm">
	<div class="s_content detail_con">
		<?if ($is_guest){?>
			<button type="button" class="inactive on" onclick="alert('로그인 후 결제 가능합니다.');">결제하기</button>
		<?}else{?>
			<button type="button" class="inactive on" onclick="pay_approval();">결제하기</button>
		<?}?>
	</div>
</div>