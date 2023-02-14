<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<section class="container background">
	<div class="page-title">정산 신청</div>
	<div class="boxContainer flex line gap60 flex-stretch noto500 padding40">
		<div class="flex span420">
			<div class="flex1">
				<div class="fs16 color-gray">정산 가능 금액</div>
				<div class="fs24"><?=number_format($tsum_sales)?> 원</div>
				<div class="mt25 fs16 color-gray">계좌정보</div>
				<?php if ($host_data['pt_bank_name'] != "" && $host_data['pt_bank_account'] != "" && $host_data['pt_bank_owner'] != "" && $host_data['pt_bank_limit'] == "0"){?>
					<div class="fs16"><?=$host_data['pt_bank_name']?> <?=$host_data['pt_bank_account']?></div>
				<?php }else{?>
					<div class="fs16">계좌정보가 등록되지 않았습니다.</div>
				<?php }?>
				
			</div>
			<?php if ($host_data['pt_bank_name'] != "" && $host_data['pt_bank_account'] != "" && $host_data['pt_bank_owner'] != "" && $host_data['pt_bank_limit'] == "0"){?>
				<a href="#" class="btn span100 pop-inline" data-href="#pop05" >정산신청</a>
			<?php }else{?>
				<a href="javascript:alert('계좌정보가 등록되지 않았습니다.');" class="btn span100">정산신청</a>
			<?php }?>
		</div>
		<div class="flex1">
			<div class="fs16 color-gray">매출 현황 안내</div>
			<p class="mt15 fs14 color-gray noto400">
				<!--
				1. 모임종료 5일 이후 정산가능 금액으로 변경되며, 정산 신청이 가능합니다.<br>
				2. 정산 신청 후 3~5일 이내 입금 처리됩니다.<br>
				3. 정산계좌등록되어 있어야 정산 신청이 가능합니다.<br>
				정산계좌등록은 정산 정보 관리에서 진행합니다.
				-->
				1. 월 1회 / 매 월 5日 진행 (공휴일/주말일 경우 5日 이전 영업일에 지급됩니다.)<br>
				2. 정산계좌가 등록 되어 있어야 정산이 가능합니다.<br>
				3. 정산계좌 등록은 호스트페이지내 '내정보' - '정산 정보 관리' 에서 가능합니다.
			</p>
		</div>
	</div>
</section>

<div class="layer-popup" id="pop05">
	<div class="popContainer">
		<div class="pop-inner fs16" style="width:660px;padding-left:70px;padding-right:70px;">
		<form id="theForm" method="post" action="./payupdate.php">
		<input type="hidden" name="ap" value="payrequest">
		<input type="hidden" name="pp_field" value="0">
		<input type="hidden" name="pp_means" value="0"><!--통장입금-->
		<input type="hidden" name="pp_amount" id="pp_amount" value="<?=$tsum_sales?>">
		<textarea name="od_id_list" style="display:none;"><?=$od_id_list['od_id_list']?></textarea>
		
			<span class="pop-closer">팝업닫기</span>
			<div class="pop-header">정산 신청</div>
			<div class="tbl-excel">
				<div class="tbl-header fs16 noto500 mb20">
					<span class="color-gray">정산 가능 금액</span>
					<div class="right fs24"><?=number_format($tsum_sales)?>원</div>
				</div>
				<table>
					<colgroup>
						<col width="180">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th class="tleft">예금주</td>
							<td class="tleft"><?=$host_data['pt_bank_owner']?></td>
						</tr>
						<tr>
							<th class="tleft">은행</td>
							<td class="tleft"><?=$host_data['pt_bank_name']?></td>
						</tr>
						<tr>
							<th class="tleft">계좌번호</td>
							<td class="tleft"><?=$host_data['pt_bank_account']?></td>
						</tr>
					</tbody>			
				</table>				
			</div>

			<div class="flex mt20">
				<label class="radio-wrap noto500"><input type="radio" name="pp_type" value="1" checked><span></span>개인사업자(법인)</label>
				<label class="radio-wrap noto500"><input type="radio" name="pp_type" value="2"><span></span>개인</label>
			</div>

			<p class="mt25 noto500 color-gray" id="pp_type_name">사업자등록번호</p>
			<div class="flex flex-middle mt10" id="pp_type1">
				<input type="text" name="co_num1" id="co_num1" value="" class="span100" placeholder="">
				<span class="color-light">-</span>
				<input type="text" name="co_num2" id="co_num2" value="" class="span65" placeholder="">
				<span class="color-light">-</span>
				<input type="text" name="co_num3" id="co_num3" value="" class="span160" placeholder="">
			</div>
			<div class="flex flex-middle mt10" id="pp_type2" style="display:none">
				<input type="text" name="jumin1" id="jumin1" value="" class="span100" placeholder="주민번호 앞자리를 입력해주세요">
				<span class="color-light">-</span>
				<input type="password" name="jumin2" id="jumin2" value="" class="span160" placeholder="주민번호 뒷자리를 입력해주세요">
			</div>

			<p class="mt25 noto500 color-gray">성함/사업자명</p>
			<div class="mt10">
				<input type="text" name="pp_name" id="pp_name" value="" class="span" placeholder="성함/사업자명을 입력해주세요.">
			</div>
			<p class="fs14 color-gray mt15">
				* 최소 1회 정산 요청시 증빙서류 제출이 필요하며, 확인시 정산이 정상적으로 진행됩니다. 회사이메일 (tax@moa.co.kr)<br>
				- 사업자 : 사업자 등록증 사본, 사업자 통장 사본<br>
				- 개인 : 주민등록증 사본, 본인 명의 통장 사본
			</p>
			
			<div class="pop-header mt40">수익 상세</div>
			<div class="tbl-excel">				
				<table>
					<colgroup>
						<col width="180">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th class="tleft">총 매출금액</td>
							<td class="tleft"><?=number_format($sales['sum_sales'], 0)?>원</td>
						</tr>
						<tr>
							<th class="tleft">수수료율</td>
							<td class="tleft"><?=$host_data['pt_commission_2']?>%</td>
						</tr>
						<tr>
							<th class="tleft">차감금액</td>
							<td class="tleft"><?=($sales['sum_sales'] * $host_data['pt_commission_2']) / 100?>원</td>
						</tr>
					</tbody>			
				</table>				
			</div>

			<div class="pop-header mt40">정산 가이드</div>
			<p class="noto500 color-gray">필수서류</p>
			<p class="mt10 noto500">
				사업자 정산 신청 시 : 사업자 등록증 사본, 사업자 통장사본<br>
				개인 정산 신청 시 : 신분증 사본, 신분증과 동일한 명의 통장 사본
			</p>
			<p class="mt10 fs14 color-gray">
				* 필수서류는 최초 1회 정산시에만 제출이 필요하며, 이후 정산에는 서류 제출없이 정산 신청할 수 있습니다.
			</p>
			
			<div class="btnSet mt50">
				<a href="#" class="btn gray span90 popClose">닫기</a>
				<a href="#" class="btn submit span90 btn_submit">정산신청</a>		
			</div>
		</form>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>

<script>
$(document).ready(function(){
	<?
		$strSql = "select * from g5_member where mb_id = '{$member['mb_id']}' "; 
		$hostInfo = sql_fetch($strSql);
	?>
	$('#jumin1').val('<?= substr(str_replace( '-', '', $hostInfo['mb_birth']), 2) ?>');
	$('#jumin2').val('');

	$('input[name=pp_type]').change(function(){
		$('#pp_type1, #pp_type2').hide();
		$('#pp_type'+$('input[name=pp_type]:checked').val()).show();
		$('#pp_type_name').text(($('input[name=pp_type]:checked').val()=='1')?'개인사업자(법인)':'개인');
	});

	$('.btn_submit').click(function(){
		if (parseInt($('#pp_amount').val()) <= 0){
			alert('정산 가능 금액이 없습니다.'); return false;
		}
		if ($('input[name=pp_type]:checked').val()=='1'){
			if ($('#co_num1').val() == "" || $('#co_num2').val() == "" || $('#co_num3').val() == ""){
				alert('사업자등록번호를 입력해주세요.'); return false;
			}
		}else{
			if ($('#jumin1').val() == "" || $('#jumin2').val() == ""){
				alert('주민번호를 입력해주세요.'); return false;
			}
		}
		if ($('#pp_name').val() == ""){
			alert('성함/사업자명를 입력해주세요.'); return false;
		}
		$('#theForm').submit();
	});
});
</script>












