<?php
$noheader = true;
$page_title = '호스트 관리자 - 회원가입';
include_once('./header.php');
?>


<section class="container" style="max-width:860px;">
	
	<div class="join-step-container">
		<ul>
			<li class="active">약관동의</li>
			<li class="">호스트 정보</li>
			<li class="">호스트 인증</li>
			<li class="">회원가입 완료</li>
		</ul>
	</div>

	<div class="h2 tcenter mb20">이용약관</div>
	
	<p class="tcenter color-light">
		*모아 서비스 이용 계약을 포함하는 약관(이용약관, 개인정보 처리방침)이니 꼭 확인해주세요.<br>
		 (모아 이용 수수료율은 [중개 수수료(13%)+PG수수료 (5%) / VAT 10% 별도]이며, 자세한 사항은 이용약관을 확인해주시기 바랍니다.)
	</p>
	
	<p class="tcenter color-gray mt50" style="line-height:1.8em;">
		<span class="noto500">제 1조</span><br>
		제 2조  ‘서비스’라 함은 회사가 회원에게 접근기기(PC,TV, 휴대형단말기 등 디지털 콘텐츠를 다운로드 받아 설치하여 이용하거나 네트워크를 통해 이용할 수 있는 유형물을 의미)를 통해 ‘호스트 회원’과 ‘게스트회원’의 거래를 연결하기 위하여 주고받은 모든 서비스를 의미합니다. (호스트 신청, 등록, 모임신청, 매칭, 정산 등)<br><br>
		‘호스트’라 함은 회사가 제공하는 플랫폼을 통해 모임을 공급하고 판매를 통해 정산받은 사용자를 말합니다. <br><br>
		‘회원’은 약관에 따라 회사와 이용계약을 체결하고 회사가 제공하는 서비스를 이용하는 고객을 말합니다. <br><br>
		개별 이용약관, 서비스 가이드, 관계법령, 기타 일반 상관례에 의합니다.
	<p>

	<div class="mt80"></div>

	<div class="btnSet">
		<a href="#" class="btn submit span150">동의합니다.</a>		
	</div>

</section>

<?php include_once('./footer.php'); ?>