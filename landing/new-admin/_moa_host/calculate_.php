<?php
$page_title = '정산 신청';
include_once('header.php');
?>

<section class="container background">
	<div class="page-title">정산 신청</div>


	<div class="boxContainer flex line gap60 flex-stretch noto500 padding40">
		<div class="flex span420">
			<div class="flex1">
				<div class="fs16 color-gray">정산 가능 금액</div>
				<div class="fs24">522,000 원</div>
				<div class="mt25 fs16 color-gray">계좌정보</div>
				<div class="fs16">카카오뱅크 23213318738</div>
			</div>
			<a href="#" class="btn span100">정산신청</a>
		</div>
		<div class="flex1">
			<div class="fs16 color-gray">매출 현황 안내</div>
			<p class="mt15 fs14 color-gray noto400">
				1. 모임종료 5일 이후 정산가능 금액으로 변경되며, 정산 신청이 가능합니다.<br>
				2. 정산 신청 후 3~5일 이내 입금 처리됩니다.<br>
				3. 정산계좌등록되어 있어야 정산 신청이 가능합니다.<br>
				정산계좌등록은 정산 정보 관리에서 진행합니다.
			</p>
		</div>
	</div>
	
	<div class="mt30"></div>

	<div class="boxContainer padding30">
		<div class="box-header">타이틀</div>
		내용
		<hr class="mt50 mb50">
		내용
	</div>	
	
</section>


<?php include_once('footer.php'); ?>