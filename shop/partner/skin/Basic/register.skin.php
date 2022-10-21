<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:300,200,100" type="text/css">


<div id="sub-wrapper" class="sub-container" style="height:60px;overflow:hidden;">
	<div class="box-register">
		<div class="box-block">
			<div class="header" id="moa-header">
				<button class="prev"></button>
				<h2 class="pageTit text-center">호스트 신청</h2>
			</div>

		</div>
	</div>
</div>

<div class="wrapper">
	<div class="s_content">
		<div class="tabs04 pr">

			<form class="form" role="form" name="fregister" id="fregister" action="<?php echo $action_url ?>" onsubmit="return fregister_submit(this);" method="POST" enctype="multipart/form-data" autocomplete="off">


				<?php if ($is_seller && $is_marketer) { ?>
					<div class="form-group text-center">
						<label><input type="checkbox" name="pt_partner" value="1"> 호스트 신청</label>
						&nbsp; &nbsp; &nbsp;
						<label><input type="checkbox" name="pt_marketer" value="1"> 추천인(마케터) 신청</label>
					</div>
				<?php } else if ($is_seller) { ?>
					<input type="hidden" name="pt_partner" value="1">
					<input type="hidden" name="pt_marketer" value="0">
				<?php } else if ($is_marketer) { ?>
					<input type="hidden" name="pt_partner" value="0">
					<input type="hidden" name="pt_marketer" value="1">
				<?php } ?>

				<select name="pt_type" required class="form-control input-sm" style="display:none;">
					<option value="2">개인 호스트</option>
				</select>

				<input id="host" type="radio" name="tab_item04" checked="">
				<label class="tab_item04" for="host" style="width: calc(100%/2);">1.약관동의</label>
				<input id="group" type="radio" name="tab_item04">
				<label class="tab_item04" for="group" style="width: calc(100%/2);">2.호스트정보</label>
				<hr class="hr02">


				<div class="tab_content p0 bt" id="host_content">
					<div class="h_termbox">
						<p class="h_terms">이용약관</p>
						<p class="h_thermstxt">Moa 서비스 이용 계약을 포한하는 약관(이용약관, 개인 정보 취급 방침)이니 꼭 확인해주세요. (Moa 이용 수수료율은 [중계수수료 (13%) + PG수수료(5%) / VAT 10%별도]이며, 자세한 사항은 이용약관을 확인해주시기 바랍니다.</p>
					</div>
					<div class="t_list_area">
						<input type="checkbox" id="box1">
						<label for="box1" class="terms_list">개인정보 처리 방침</label>
						<section id="con01">
							<div class="box_txt">
								<div class="" style="height:200px;overflow-x:scroll">
									<div>
										주식회사 모아프렌즈(이하 “회사”)는 회원님의 개인정보보호를 소중히 보호하기 위해 최선을 다해 노력하고 있습니다.
										회사는 개인정보의 보호와 관련하여 ‘정보통신망 이용촉진 및 정보보호 등에 관한 법률’, ‘개인정보 보호법’ 등 개인정보와 관련된 법령을 준수하고 있습니다.
										<br /><br /><br />

										<strong>1.수집하는 개인정보 항목</strong>
										<br /><br />
										회사는 회원가입시 또는 서비스 이용 과정에서 홈페이지 또는 개별 어플리케이션이나 프로그램 등을 통해 아래와 같은 개인정보를 수집하고 있습니다.
										<br /><br />
										ꞏ 필수정보란? : 해당 서비스의 본질적 기능을 수행하기 위한 정보
										ꞏ 선택정보란? : 보다 특화된 서비스를 제공하기 위해 추가 수집하는 정보 (선택 정보를 입력하지 않은 경우에도 서비스 이용 제한은 없습니다.)
										<br /><br />
										(1)게스트 회원 가입 시<br />
										- (필수) 아이디, E-MAIL, 비밀번호, 휴대폰번호, 닉네임, 직장정보, 생년월일, 성별 등
										<br /><br />
										(2)호스트 회원 가입 시<br />
										- (필수) 호스트명, 이름, 아이디, E-MAIL, 비밀번호, 휴대폰번호, 직장정보, 주민등록증 등 신분확인 가능한 증명서,계좌번호, 계좌은행, 예금주명 등
										- (선택) 사업자등록번호
										<br /><br />
										(3) 법정대리인 동의 시<br />
										법정대리인 정보(이름, 성별, 생년월일, 휴대폰번호, 통신사업자, 내/외국인 여부, 암호화된 이용자 확인값(CI), 중복가입확인정보(DI))
										<br /><br />
										(4)결제 시<br />
										-(필수)<br />
										신용카드 결제 시: 카드번호(일부), 카드사명 등<br />
										휴대전화번호 결제 시: 휴대전화번호, 결제승인번호 등<br />
										계좌이체 시: 예금주명, 계좌번호, 계좌은행 등
										<br /><br />
										(5)환불처리 시<br />
										계좌은행, 계좌번호, 예금주명, 이메일
										<br /><br />
										(6)현금영수증 발행 시<br />
										휴대폰번호, 현금영수증 카드번호
										<br /><br />
										(7)모바일 애플리케이션 (moa 앱 버전, OS버전(ios, 안드로이드)) 이용 시- 위치정보
										<br /><br />
										(8) 고객상담 시<br />
										고객상담 서비스 신청 시, 상기 수집 정보 이외에 이용자에게 동의를 받고 추가적인 개인정보를 수집할 수 있으며, 문의/신고 유형에 따라 휴대폰 번호 등 회원님께서 추가로 입력하시는 개인정보가 있을 수 있습니다.
										<br /><br />
										&lt;문의하기/신고하기&gt;<br />
										- 전화고객센터 : 발신전화번호<br />
										- 웹고객센터 : 이메일, 휴대폰번호
										<br /><br />

										&lt;명예훼손/개인정보침해/저작권침해 신고&gt;<br />
										- 게시물 차단 신청서 : 신청인정보(이름, 생년월일, 전화번호, 이메일 또는 팩스번호, 닉네임, 마스킹된 신분증 사본)<br />
										- (대리인 신고 시) 위임장 : 위임인/수임인정보(이름, 생년월일, 전화번호, 마스킹된 신분증 사본)
										<br /><br />

										&lt;명예훼손/개인정보침해에 대한 소명 요청&gt;<br />
										- 게시물 복원 신청서 : 이름, 생년월일, 전화번호 또는 팩스번호, 이메일, 닉네임
										<br /><br />

										&lt;저작권침해에 대한 소명 요청&gt;<br />
										- 복제,전송 재개 요청서 : 요청자/대리인 정보(이름, 생년월일, 전화번호, 이메일, 마스킹된 신분증 사본)
										<br /><br />

										&lt;자기게시물 접근배제 요청 시&gt;<br />
										- (본인 신청 시) 자기게시물 접근배제 요청서 : 요청인 정보(이름, 전화번호, 이메일 또는 팩스번호, 마스킹된 신분증 사본), 자기게시물 입증자료에 포함된 개인정보<br />
										- 요청인 정보(이름, 전화번호, 이메일 또는 팩스번호, 마스킹 된 신분증 사본), 지정인 정보(이름, 전화번호, 이메일 또는 팩스번호, 신청인과의 관계, 마스킹 된 신분증 사본, 관계증빙서류(가족관계 증명서, 사망사실 증명서 등))
										<br /><br />

										&lt;문의하기/신고하기 시 증빙서류&gt;<br />
										- 관계 증명 시 : 마스킹된 증빙 서류(가족관계 증명서, 사망사실 증명서 등)<br />
										- 사업자/단체회원 정보 확인・변경 시 : 마스킹된 증빙서류(재직 증명서), 개인(사업자 등록증), 개인사업자 폐업 사실 증명서, 법인 인감증명서<br />
										- 본인 확인・정보 변경 시 : 마스킹된 증빙 서류(신분증 사본, 통신사 증빙서류, 인감증명서, 본인서명 사실 확인서)<br />
										- 주민등록번호변경 또는 실명정보 변경 시 : 마스킹된 증빙 서류(주민등록초본 사본, 기본 증명서, 국적 취득 / 상실 사실 증명서 등)<br />
										- 미성년자 확인 시 : 마스킹된 증빙 서류(학생증, 주민등록등본, 건강보험증 등)<br />
										- 권한 위임 시 : 위임장
										<br /><br /><br />

										<strong>2.개인정보의 수집 및 이용 목적</strong>
										<br /><br />
										- 회원 관리: 회원제 서비스 이용에 따른 회원 식별/가입의사 확인, 본인/연령 확인, 부정이용 방지,<br />
										- 서비스: 신규 서비스 개발, 다양한 서비스 제공, 문의사항 또는 불만처리, 공지사항 전달, 회원 구매 성향 분석, 서비스 개선, 문의사항 처리, 부정이용에 대한 조사 및 대응, 청구서 등의 발송, 각종 이벤트, 개인 맞춤형 서비스 제공, 새로운 상품 기타 행사 관련 정보 안내 및 마케팅 활동, 회사 및 제휴사 상품, 서비스 안내 및 권유의 목적으로 이용<br />
										- 인구통계학적 특성과 이용자의 관심, 기호, 성향의 추정을 통한 맞춤형 컨텐츠 추천 및 마케팅에 활용<br />
										- 서비스 이용 기록, 접속 빈도 및 서비스 이용에 대한 통계, 프라이버시 보호 측면의 서비스 환경 구축, 서비스 개선에 활용<br />
										유료서비스 이용 시 컨텐츠 등의 전송이나 배송·요금 정산
										<br /><br /><br />

										<strong>3.개인정보 수집 방법</strong><br /><br />
										- 이용자는 회사가 마련한 개인정보 처리 동의서에 대해 “동의” 버튼을 클릭함으로써 개인정보 처리에 대하여 동의 여부를 표시할 수 있습니다.<br />
										- 모바일 애플리케이션, 웹페이지, 서면양식, 팩스, E-mail, 고객센터를 통한 전화와 온라인 상담, 이벤트 응모<br />
										- 생성정보 수집 툴을 통한 수집하고
										<br /><br /><br />

										<strong>4.개인정보의 보유 및 이용기간</strong>
										<br /><br />
										회사가 회원의 개인정보를 수집하는 경우 그 보유기간은 원칙적으로 회원가입 후 약관 제10조에 의한 ‘계약기간 및 이용계약의 종료시’까지며, 이용계약 종료의 경우 회사는 회원의 개인정보를 즉시 파기하며 제3자에게 기 제공된 정보에 대해서도 지체 없이 파기하도록 조치합니다. (단, 재가입유예기간 동안의 재가입 방지 등을 위해 이용계약이 종료한 날로부터 2개월 경과 후에 파기하도록 합니다.)<br />
										(1)계약 또는 청약철회 등에 관한 기록 (보존기간 : 5년) : 전자상거래 등에서의 소비자 보호에 관한 법률<br />
										(2)대금결제 및 재화 등의 공급에 관한 기록 (보존기간 : 5년) : 전자상거래 등에서의 소비자 보호에 관한 법률<br />
										(3)소비자의 불만 또는 분쟁처리에 관한 기록 (보존기간 : 3년) : 전자상거래 등에서의 소비자 보호에 관한 법률<br />
										(4)홈페이지 방문에 관한 기록 (보존 기간: 3개월) : 통신비밀보호법
										<br /><br /><br />

										&lt;관계법령에 따른 개인정보 보관&gt;
										<br /><br />

										<div style="width:100%;overflow:scroll;white-space:nowrap">
											<table class="terms_Table">
												<thead>
													<tr>
														<th>보존항복</th>
														<th>근거법령</th>
														<th>보존기간</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>계약 또는 청약철회 등에 관한 기록</td>
														<td rowspan="4">전자상거래 등에서의 소비자 보호에 관한 법률</td>
														<td>5년</td>
													</tr>
													<tr>
														<td>대금결제 및 재화 등의 공급에 관한 기록</td>
														<td>5년</td>
													</tr>
													<tr>
														<td>소비자의 불만 또는 분쟁처리에 관한 기록</td>
														<td>3년</td>
													</tr>
													<tr>
														<td>표시/광고에 관한 기록</td>
														<td>6개월</td>
													</tr>
													<tr>
														<td>세법이 규정하는 모든 거래에 관한 장부 및 증빙서류</td>
														<td>국세기본법</td>
														<td>5년</td>
													</tr>
													<tr>
														<td>전자금융 거래에 관한 기록</td>
														<td>전자금융거래법</td>
														<td>5년</td>
													</tr>
													<tr>
														<td>서비스 방문 기록</td>
														<td>통신비밀보호법</td>
														<td>3개월</td>
													</tr>
													<tr>
														<td>위치정보</td>
														<td>위치 정보의 보호 및 이용 등에 관한 법률</td>
														<td>서비스 제공기간 (단, 서비스 해지하는 경우 즉시 삭제)</td>
													</tr>
												</tbody>
											</table>
										</div>
										<br /><br /><br />
										<strong>5.개인정보의 파기절차 및 방법</strong>
										<br /><br />
										고객님의 개인정보는 원칙적으로 서비스탈퇴 시 또는 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다.<br /><br />
										정보통신망법에 의한 개인정보 보유 회원이 1년간 서비스 이용기록이 없는 경우 [정보통신망 이용촉진 및 정보보호 등에 관한 법률] 제 29조 '개인정보 유효기간제'에 따라 회원에게 사전 통지하고 휴면계정의 회원개인정보를 즉시 파기합니다.<br /><br />
										회사는 고객의 개인정보를 보호하여 개인정보 유출로 인한 피해가 발생하지 않도록 하기 위하여 다음과 같은 방법을 통하여 개인정보를 파기합니다.<br /><br />
										(1)회원이 회원가입 등을 위해 입력한 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조)일정 기간 저장된 후 파기됩니다.<br />
										(2)종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.<br />
										(3)전자적 파일 형태로 저장된 개인정보는 재생할 수 없도록 로우레벨포멧(Low Level Format) 또는 파쇄 등의 방법을 이용하여 파기합니다.(4)회원이 스마트폰 등에서 앱을 삭제하더라도 개인정보 동의 철회(회원탈퇴) 요청을 하지 않을 경우 해당 개인정보는 여전히 서비스에 남아있을 수 있으므로, 개인정보 파기를 원하시면 반드시 동의 철회(회원 탈퇴) 요청을 하여야 합니다.
										<br /><br /><br />

										<strong>6.개인정보의 제3자 제공</strong>
										<br /><br />
										회사는 계약의 이행을 위하여 최소한의 개인정보만 제공하고 있으며, 개인정보를 제3자에게 제공해야 하는 경우 사전에 이용자에게 해당 사실을 알리고 동의를 구합니다. 제 3자 제공과 관련하여 제공받은 제3자가 임의로 개인정보를 타인이나 타 기관에 재제공한 사실이 확인된 경우에는 정보제공을 중단합니다.
										다만 아래의 경우는 예외로 합니다.<br /><br />
										(1)서비스 제공에 따른 요금정산을 위해 필요한 경우<br />
										(2)법령의 규정에 의한 경우<br />
										(3)수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우<br />
										회사가 제공하는 서비스를 통하여 주문 및 결제가 이루어진 경우 상담 등 거래 당사자간 원활한 의사소통 및 발송 등 거래이행을 위하여 관련된 정보를 필요한 범위 내에서 거래 당사자에게 제공합니다.
										<br /><br />

										제공받는 자 : 호스트<br />
										제공하는 항목 : 이름, 성별, 나이, 연락처, 등 개별 프로그램별로 필요하여 회원이 입력한 정보<br />
										제공받는 자의 이용목적 : 본인 확인, 프로그램 준비 및 이행, 민원처리, 서비스, 환불, 고객상담 등 정보통신서비스제공계약 및 전자상거래(통신판매) 계약의 이행을 위해 필요한 업무<br />
										보유 및 이용기간 : 서비스 제공 완료 후 6개월
										<br /><br />

										제공받는 자 : 게스트 회원<br />
										제공하는 항목 : 호스트명, 이름, 연락처, 주소, 장소 등 호스트가 입력한 정보<br />
										제공받는 자의 이용목적 : 본인 확인, 프로그램 준비 및 이행, 민원처리, 서비스, 반품, 환불, 고객상담 등 정보통신서비스제공계약 및 전자상거래(통신판매) 계약의 이행을 위해 필요한 업무<br />
										보유 및 이용기간 : 상품 제공 완료 후 6개월
										<br /><br /><br />


										7. 개인정보의 처리 위탁<br /><br />
										회사는 서비스 향상을 위해서 아래와 같이 개인정보를 위탁하고 있으며, 관계 법령에 따라 위탁계약 시 개인정보가 안전하게 관리될 수 있도록 필요한 사항을 규정하고 있습니다. 수탁자 및 수탁업무 내용은 아래와 같습니다.
										<br /><br />

										<div style="width:100%;overflow:scroll;white-space:nowrap">
											<table class="terms_Table">
												<thead>
													<tr>
														<th>업체명</th>
														<th>수탁업무</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>예시: (주)NICE평가정보<br />(주)드림시큐리티<br />(주)에스씨아이평가정보<br />(주)다날<br />(주)코리아크레딧뷰로</td>
														<td>본인확인 및 성인인증</td>
													</tr>
													<tr>
														<td>예시: 토스페이먼츠 주식회사<br />(주)카카오페이<br />(주)케이지이니시스<br />(주)KG모빌리언스<br />(주)다날</td>
														<td>결제처리(휴대폰, 무통장 입금, 계좌이체, 신용카드, 지류상품권 및 기타 결제수단)</td>
													</tr>
													<tr>
														<td>예시: (주)LG유플러스<br />인포뱅크<br />슈어엠<br />인포빕<br />보니지<br />시니버스테크놀로지스<br />타타 커뮤니케이션즈</td>
														<td>문자메시지 발송</td>
													</tr>
													<tr>
														<td>예시: 토스페이먼츠 주식회사</td>
														<td>현금영수증 발행 및 계좌 유효성체크</td>
													</tr>
													<tr>
														<td>예시: (주)코스콤</td>
														<td>개인신용정보 전송요구에 따른 (거점)중계기관 서비스 이용</td>
													</tr>
													<tr>
														<td>예시: dk techin</td>
														<td>서비스 개발 및 운영</td>
													</tr>
												</tbody>
											</table>
										</div>

										<br /><br /><br />

										<strong>8.이용자의 권리</strong><br /><br />
										회사는 이용자(만 14세 미만자인 경우에는 법정대리인)의 권리를 다음과 같이 보호하고 있습니다.<br />
										(1)언제든지 자신의 개인정보 또는 법정대리인의 경우 만 14세 미만자의 개인정보 열람 요구, 정정 요구, 삭제 요구, 처리정지 요구 등 법령이 정한 권리를 서식 1을 회사에 제출하여 행사할 수 있습니다.<br />
										(2)언제든지 개인정보 제공에 관한 동의철회/회원가입해지를 요청할 수 있습니다.<br />
										(3) 정보주체가 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 회사는 정확한 개인정보의 이용 및 제공을 위해 정정 또는 삭제가 완료될 때까지 이용자의 개인정보는 이용하거나 제공하지 않습니다.
										<br /><br /><br />

										<strong>9.개인정보 자동 수집 장치의 설치/운영 및 거부에 관한 사항</strong><br /><br />
										회사는 개인화되고 맞춤화된 서비스를 제공하기 위해서 이용자의 정보를 저장하고 수시로 불러오는 '쿠키(cookie)'를 사용합니다. 쿠키는 웹사이트를 운영하는데 이용되는 서버가 이용자의 브라우저에게 보내는 아주 작은 텍스트 파일로 이용자 컴퓨터의 하드디스크에 저장됩니다. 이후 이용자가 웹 사이트에 방문할 경우 웹 사이트 서버는 이용자의 하드 디스크에 저장되어 있는 쿠키의 내용을 읽어 이용자의 환경설정을 유지하고 맞춤화된 서비스를 제공하기 위해 이용됩니다.
										쿠키는 개인을 식별하는 정보를 자동적/능동적으로 수집하지 않으며, 이용자는 언제든지 이러한 쿠키의 저장을 거부하거나 삭제할 수 있습니다. (참고로, 쿠키정보는 컴퓨터를 식별할 수는 있지만 고객 개개인을 식별하지 않습니다.)<br /><br />
										(1)회사의 쿠키 사용 목적<br />
										-이용자들이 방문한 각 서비스의 접속여부, 클래스확인여부, 문의하기 등에 사용합니다.<br /><br />
										(2)회사의 쿠키 거부 방법<br />
										-이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서 이용자는 어플리케이션에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다<br /><br /><br />

										<strong>10.홈페이지 개인정보 보호책임자</strong><br /><br />
										회사는 이용자의 개인정보에 대한 개인정보 보호책임자를 지정하여 개인정보보호를 위해 최선을 다하겠습니다. 현재 회사의 개인정보 보호책임자는 아래와 같습니다.<br /><br /><br />

										이름 : 송정화<br />
										소속 : 모아프렌즈<br />
										직위 : 대표<br />
										E-mail : moafriendsinfo@gmail.com<br />
										연락처 : 01095708831<br /><br /><br />

										현 개인정보처리방침은 2022년 10월 04 일에 제정되었으며, 정부 및 회사의 정책 또는 보안기술의 변경에 따라 내용의 추가, 삭제 및 수정이 있을 경우에는 개정 최소 7일 전부터 서비스의 ’공지사항’란을 통해 고지하며, 본 정책은 시행일자에 시행됩니다.<br /><br /><br />

										- 공고일자 : 2022년 10월 04일<br />
										- 시행일자 : 2022년 10월 04일<br />
										<br /><br /><br />

										기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.<br />
										- 개인정보침해신고센터 (privacy.kisa.or.kr / 국번없이 118)<br />
										- 대검찰청 사이버수사과 (www.spo.go.kr / 국번없이 1301)<br />
										- 경찰청 사이버안전국 (www.ctrc.go.kr / 국번없이 182)<br />


									</div>
								</div>
							</div>
						</section>

						<input type="checkbox" id="box2">
						<label for="box2" class="terms_list">이용약관</label>
						<section id="con02">
							<div class="box_txt">
								<div class="" style="height:200px;overflow-x:scroll">
									<div>
										<strong>제1조 (목적)</strong><br />
										이 약관은 주식회사 모아프렌즈(이하 회사)가 운영하는 모임 서비스 (이하 서비스)등 제반 서비스의 이용과 관련하여 회사와 회원과의 권리, 의무 및 책임사항, 기타 필요한 사항을 규정함을 목적으로 합니다.<br /><br /><br />

										<strong>제2조 (정의)</strong><br />
										1. 본 약관에서 사용하는 용어의 정의는 다음과 같으며, 본조에서 정의되지 않은 용어는 일반적인 용례에 따릅니다.<br /><br />
										2. 서비스: 회원이 온라인 홈페이지 및 어플리케이션을 통하여 본 약관에 따라 이용할 수 있는 회사가 제공하는 모든 서비스를 의미합니다.<br /><br />
										3. 사이트: 본 약관에 따라 회사가 제공하는 서비스가 구현되는 온라인기반 유무선 홈페이지(https://www.moa-friends.com)을 말합니다. 향후 추가되거나 변경될 수 있으며, 위 홈페이지 외 회사에서 공지하고 서비스를 제공하는 매체로서 기타 웹사이트 및 모바일 어플리케이션 및 모바일 웹 등을 포함합니다.<br /><br />
										4. 이용자: 회사 사이트에 접속하여 이 약관에 따라 회사가 제공하는 서비스를 받는 회원 및 비회원을 말합니다.<br /><br />
										5. 회원: 회사의 사이트에 접속하여 본 약관에 동의하고, 개인정보를 제공하여 회원 등록을 한 자로서, 회사의 정보를 지속적으로 제공받으며, 이 약관에 따라 회사와 서비스 이용계약을 체결한 자를 말하며 이하에서 정의되는 호스트와 게스트를 총칭합니다.<br /><br />
										6. 호스트: 영리의 목적 여부를 불문하고 서비스 내에서 모임을 주최하여 게스트를 초대하는 회원을 의미합니다.<br /><br />
										7. 게스트: 사이트에서 호스트가 주최한 모임에 이용료를 지불하고 참석하는 회원을 말합니다.<br /><br />
										8. 이용료: 게스트가 회사 서비스 참석을 위해 회사에 지불하는 금전을 말합니다.<br /><br />
										9. 유료서비스: 회사가 유료로 제공하는 각종 온·오프라인 콘텐츠 및 제반 서비스를 의미합니다.<br /><br />
										10. 게시물: 회원이 서비스를 이용함에 있어 서비스상에 게재한 부호, 문자, 음성, 음향, 화상, 동영상 등의 정보 형태의 글, 사진, 동영상 및 각종 파일과 링크 등을 의미합니다.<br /><br />
										11. 모임 등 : 회원 간에 거래되는 상품 또는 용역(교육, 활동, 강습, 행사) 또는 회사가 제공하는 상품 등을 총칭합니다.<br /><br />
										120 접근기기 : 휴대전화, PC, 태블릿, 기타 디지털 콘텐츠를 다운로드 받아 설치하여 이용하거나 네트워크를 통해 이용할 수 있는 유형물을 의미합니다.<br /><br /><br />

										<strong>제3조 (약관의 명시와 설명 및 개정)</strong><br />
										1. 회사는 이 약관의 내용과 상호 및 전화번호 등을 회원이 쉽게 알 수 있도록 서비스 초기 화면 또는 별도의 연결화면에 게시합니다. 다만, 이 약관의 구체적 내용은 연결화면을 통하여 볼 수 있습니다.<br /><br />
										2. 회사는「약관의 규제에 관한 법률」, 「전자상거래등에서의 소비자보호에 관한 법률」, 「콘텐츠산업진흥법」, 「전자금융거래법」, 「전자서명법」, 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」, 「방문판매 등에 관한 법률」, 「소비자기본법」등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.<br /><br />
										3. 회사가 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여, 현행 약관과 함께 서비스 내 적절한 장소에 개정약관의 적용일자 7일 이전부터 적용일자 전일까지 공지합니다. 다만, 이용자에게 불리하게 약관의 내용을 변경하는 경우에는 적용일자 30일 전부터 공지합니다. 이 경우 회사는 개정 전 내용과 개정 후 내용을 명확하게 비교하여 회원이 알기 쉽도록 표시합니다.<br /><br />
										4. 제3항에 따라 공지된 적용일자 이후에 회원이 회사의 서비스를 계속 이용하는 경우에는 개정된 약관에 동의하는 것으로 봅니다. 개정된 약관에 동의하지 아니하는 회원은 언제든지 자유롭게 서비스 이용계약을 해지할 수 있습니다.<br /><br />
										5. 이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 정부가 제정한 전자거래소비자보호지침 및 관계법령 또는 일반 상 관례에 따릅니다.<br /><br /><br />

										<strong>제4조 (이용계약의 성립)</strong><br />
										1. 이용계약은 회원이 되고자 하는 자(이하 가입신청자)가 약관의 내용에 대하여 동의를 한 다음 회원가입 신청을 하고, 회사가 가입신청자의 신청에 대하여 승낙함으로써 체결됩니다.<br /><br />
										2. 이용계약은 관련법령에 의거 만14세 미만의 회원 가입이 제한됩니다.<br /><br />
										3. 회사는 가입신청자의 신청에 대하여 서비스 이용을 승낙함을 원칙으로 합니다. 다만, 회사는 다음 각 호에 해당하는 신청에 대하여는 승낙을 하지 않거나 사후에 이용계약을 해지할 수 있습니다.<br /><br />
										&nbsp;&nbsp;- 가입신청자가 이 약관에 의하여 이전에 회원자격을 상실한 적이 있는 경우, 단 "회사"의 회원 재가입 승낙을 얻은 경우에는 예외로 함.<br /><br />
										&nbsp;&nbsp;- 회사가 정한 가입양식을 기재함에 있어 허위의 정보를 기재하거나, 누락한 경우<br /><br />
										&nbsp;&nbsp;- 이용자의 귀책사유로 인하여 승인이 불가능하거나 기타 규정한 제반 사항을 위반하며 신청하는 경우<br /><br />
										&nbsp;&nbsp;- 회사의 서비스 운영에 필요한 관련 설비의 여유가 없거나, 업무상 또는 기술상 지장이 있는 경우<br /><br />
										&nbsp;&nbsp;- 회사가 제공하는 약관 내지 관련 법령에 위배되거나 위배될 가능성이 있는 부당한 이용신청의 경우<br /><br />
										&nbsp;&nbsp;- 기타 회원과의 계속적 거래관계를 지속하기 어렵다고 합리적으로 판단되는 경우<br /><br />
										&nbsp;&nbsp;- 14세 미만 아동이 법정대리인(부모 등)의 동의를 얻지 아니한 경우<br /><br />
										&nbsp;&nbsp;- 회원이 회사나 다른 회원, 기타 타인의 권리나 명예, 신용, 기타 정당한 이익을 침해하는 행위를 한 경우<br /><br />
										&nbsp;&nbsp;- 회사가 제공하는 각 약관 내지 관련 법령에 위배되거나 위배될 가능성이 있는 부당한 이용신청임이 확인된 경우<br /><br />
										&nbsp;&nbsp;- 기타 회원과의 계속적 거래관계를 지속하기 어렵다고 합리적으로 판단되는 경우<br /><br />
										4. 제1항에 따른 신청에 있어 회사는 전문기관을 통한 실명확인 및 본인인증을 요청할 수 있습니다.<br /><br />
										5. 이용계약의 성립 시기는 "회사"가 가입완료를 신청절차 상에서 표시한 시점으로 합니다.<br /><br />
										6. 회사는 회원에 대해 회사정책에 따라 등급별로 구분하여 이용시간, 이용횟수, 서비스 메뉴 등을 세분하여 이용에 차등을 둘 수 있습니다.<br /><br />
										7. 회사는 회원에 대하여 "영화및비디오물의진흥에관한법률" 및 "청소년보호법"등에 따른 등급 및 연령 준수를 위해 이용제한이나 등급별 제한을 할 수 있습니다.<br /><br /><br />

										<strong>제5조 (개별 서비스에 대한 약관 및 이용조건)</strong><br />
										1. 회사가 제공하는 유료서비스 중 서비스의 구체적인 내용에 따라 개별 서비스에 대한 약관 및 이용조건(이하 개별 서비스 이용 조건)을 둘 수 있으며, 이를 회사의 사이트에 별도 공지할 수 있습니다.<br /><br />
										2. 회원은 회사의 사이트에서 유료서비스를 신청하고 대금을 지급함으로써 개별 서비스 이용 조건에 동의한 것으로 간주합니다.<br /><br />
										3. 개별 서비스 이용 조건이 본 약관과 상충할 경우에는 개별 서비스 이용 조건이 우선하여 적용됩니다.<br /><br />
										4. 이 약관에서 정하지 아니한 사항이나 해석에 대해서는 유료서비스 약관 등 및 관계법령 또는 상관례에 따릅니다.<br /><br /><br />

										<strong>제6조 (회원정보의 수정)</strong><br />
										1. 회원은 개인정보관리화면을 통하여 언제든지 본인의 개인정보를 열람하고 수정할 수 있습니다. 다만, 서비스 관리를 위해 필요한 실명, 아이디(이메일주소) 등은 수정이 불가능합니다.<br /><br />
										2. 회원은 회원가입신청 시 기재한 사항이 변경되었을 경우 온라인으로 수정을 하거나 전자우편 기타 방법으로 회사에 대하여 그 변경사항을 알려야 합니다.<br /><br />
										3. 제2항의 변경사항을 "회사"에 알리지 않아 발생한 불이익에 대하여 "회사"는 책임지지 않습니다.<br /><br />

										<strong>제7조 (회원정보의 수집과 보호)</strong><br />
										1. 회사는 회원의 개인정보를 보호하기 위해 “정보통신망법” 등 관계 법령이 정하는 바에 따라 회원의 개인정보를 보호하기 위해 노력합니다.<br /><br />
										2. 회사는 서비스 제공을 위하여 이용계약의 체결 시 필요한 정보(이하 회원정보)를 수집할 수 있으며, 그 외에도 수집목적 또는 이용목적을 밝혀 회원으로부터 정보를 수집할 수 있습니다. 이 경우 회사는 회원으로부터 정보수집에 대한 동의를 받으며, 회원은 정보제공에 동의를 한 이후에도 회사가 제공하는 양식에 따라 그 동의를 철회할 수 있습니다.<br /><br />
										3. 개인정보의 보호 및 사용에 대해서는 관련법 및 회사의 개인정보취급방침이 적용됩니다. 다만, 회사의 공식 사이트 이외의 링크된 사이트에서는 회사의 개인정보취급방침이 적용되지 않습니다.<br /><br />
										4. 회사는 회원에게 적합하고 유용한 서비스를 제공하기 위해서 회원의 정보를 저장하고 수시로 불러오는 쿠키(cookie)를 이용할 수 있습니다. 회원은 쿠키이용에 대한 선택권을 가지며 쿠키의 수신을 거부하거나 쿠키의 수신에 대하여 경고하도록 이용하는 컴퓨터 브라우저의 설정을 변경할 수 있습니다. 다만, 쿠키의 저장을 거부할 경우, 로그인이 필요한 서비스를 이용할 수 없게 됨으로써 발생되는 문제에 대한 책임은 회원에게 있습니다.<br /><br />
										5. 관례 법령에 따라 회원정보의 이용과 제3자에 대한 정보제공을 허용하고 있는 경우를 제외하고 회사는 제2항에 따라 회원으로부터 동의를 받은 목적 외에 회원의 동의 없이 다른 제3자에게 회원정보를 제공하지 않습니다. 다만, 회사의 개인정보처리방침에서 정하고 있는 제3자에 대한 정보제공 및 제3자 정보 위탁과 관련하여서는 회원이 모두 동의하였고, 이에 대하여 회사를 상대로 이의를 제기하지 않습니다.<br /><br />
										6. 회사는 개인정보 처리방침에 따라 회원의 개인정보를 최대한 보호하기 위하여 노력합니다.<br /><br /><br />

										<strong>제8조 (회원의 회원정보 관리에 대한 의무)</strong><br />
										1. 회원의 아이디와 비밀번호에 관한 관리책임은 회원에게 있으며, 이를 제3자가 이용하도록 하여서는 안 됩니다.<br /><br />
										2. 회사는 회원의 아이디가 개인정보 유출 우려가 있거나, 반사회적 또는 미풍양속에 어긋나거나 회사 및 회사의 운영자로 오인한 우려가 있는 경우, 해당 아이디의 이용을 제한할 수 있습니다.<br /><br />
										3. 회원은 아이디 및 비밀번호가 도용되거나 제3자가 사용하고 있음을 인지한 경우에는 이를 즉시 회사에 통지하고 회사의 안내에 따라야 합니다.<br /><br />
										4. 제3항의 경우에 해당 회원이 회사에 그 사실을 통지하지 않거나, 통지한 경우에도 회사의 안내에 따르지 않아 발생한 불이익에 대하여 회사는 책임지지 않습니다.<br /><br /><br />

										<strong>제9조 (회원에 대한 통지)</strong><br />
										1. 회사가 회원에 대한 통지를 하는 경우 이 약관에 별도 규정이 없는 한 서비스 내 전자우편주소, 전자쪽지, 문자메시지 등으로 할 수 있습니다.<br /><br />
										2. 회사는 회원 전체에 대한 통지의 경우 7일 이상 회사의 게시판에 게시함으로써 제1항의 통지에 갈음할 수 있습니다. 다만, 회원 본인의 거래와 관련하여 중대한 영향을 미치는 사항에 대하여는 제1항의 통지를 합니다.<br /><br />
										3. 회사는 회원의 연락처 미기재, 변경 후 미수정 등으로 인하여 개별 통지가 어려운 경우에 한하여 전항의 공지를 함으로써 개별 통지를 한 것으로 간주합니다.<br /><br /><br />

										<strong>제10조 (회사의 의무)</strong><br />
										1. 회사는 관련법과 이 약관이 금지하거나 미풍양속에 반하는 행위를 하지 않으며, 계속적이고 안정적으로 서비스를 제공하기 위하여 최선을 다하여 노력합니다.<br /><br />
										2. 회사는 회원이 안전하게 서비스를 이용할 수 있도록 개인정보(신용정보 포함) 보호를 위해 보안시스템을 갖추어야 하며 개인정보취급방침을 공시하고 준수합니다.<br /><br />
										3. 회사는 서비스이용과 관련하여 발생하는 이용자의 불만 또는 피해구제요청을 적절하게 처리할 수 있도록 필요한 인력 및 시스템을 구비합니다.<br /><br />
										4. 회사는 서비스이용과 관련하여 회원으로부터 제기된 의견이나 불만이 정당하다고 인정할 경우에는 이를 처리하여야 합니다.<br /><br />
										5. 회원이 제기한 의견이나 불만사항에 대해서는 게시판을 활용하거나 전자우편 등을 통하여 회원에게 처리과정 및 결과를 전달합니다.<br /><br />
										6. 회사는 관련법령이 정한 의무사항을 준수합니다.<br /><br /><br />

										<strong>제11조 (회원의 의무)</strong><br />
										1. 회원은 서비스 이용 시 본 약관에서 규정하는 사항, 운영정책 및 이용제한 규정, 기타 회사가 정한 제반 규정, 회사가 사전에 공지하는 사항, 「청소년보호법」 등 관계법령을 준수하여야 하며, 기타 타인의 권익을 침해하거나, 회사 업무에 방해되는 행위를 하여서는 안됩니다.<br /><br />
										2. 회원은 서비스 이용과 관련하여 다음 각 호의 행위를 하여서는 안됩니다.<br /><br />
										&nbsp;&nbsp;- 정보를 허위로 등록하거나 타인의 정보를 도용하는 행위<br /><br />
										&nbsp;&nbsp;- 회사로부터 특별한 권리를 부여받지 않고 프로그램 또는 웹사이트를 변경하거나 다른 프로그램 등을 추가 또는 삽입하는 행위<br /><br />
										&nbsp;&nbsp;- 회사가 제공하는 서비스를 이용하여 서비스 내 이용료 지불 외의 방법으로 금전을 수수하는 행위<br /><br />
										&nbsp;&nbsp;- 회사의 서비스에 게시된 정보 또는 회원이 서비스를 이용하여 얻은 정보를 회사의 사전 승낙 없이 영리 또는 비영리 목적으로 복제, 출판, 광고성 정보 등에서 사용하거나 제3자에게 제공하는 행위<br /><br />
										&nbsp;&nbsp;- 정보통신망법 등 관련 법령에 의하여 그 전송 또는 게시가 금지되는 정보(컴퓨터 프로그램 등)을 전송하거나 게시 및 관련 사이트를 링크하는 행위<br /><br />
										&nbsp;&nbsp;- 회사 및 기타 제3자의 명예를 손상시키거나, 신용을 훼손하는 행위 또는 업무를 방해하는 행위<br /><br />
										&nbsp;&nbsp;- 회사 및 기타 제3자의 지식재산권을 침해하는 행위<br /><br />
										&nbsp;&nbsp;- 정크메일, 스팸메일, 행운의 편지, 폭력적인 메시지, 동영상, 음성 등이 담긴 메일을 보내는 행위<br /><br />
										&nbsp;&nbsp;- 다른 회원이 개인정보를 동의 없이 수집, 저장, 공개, 유포하는 행위<br /><br />
										&nbsp;&nbsp;- 불특정 다수의 회원을 대상으로 하여 광고 또는 선전물을 게시하거나 관련 사이트를 링크하는 행위<br /><br />
										&nbsp;&nbsp;- 성희롱, 인권 침해, 스토킹, 욕설, 채팅글 도배 등 다른 회원의 서비스 이용을 방해하는 행위<br /><br />
										&nbsp;&nbsp;- 현행법령, 회사가 제공하는 서비스에 대한 약관 기타 서비스 이용에 관한 규정 및 회사 방침(사이트 공지사항 포함)에 위반하는 행위<br /><br />
										&nbsp;&nbsp;- 기타 공공질서 및 미풍약속을 위반하거나 불법적, 부당한 행위<br /><br />
										&nbsp;&nbsp;- 회원의 의무 불이행<br /><br /><br />

										<strong>제12조 (서비스 제공)</strong><br />
										1. 회사는 회원에게 아래와 같은 서비스를 제공합니다.<br /><br />
										&nbsp;&nbsp;- 회원 본인의 자기계발, 네트워크 등을 위한 1회성 혹은 중장기의 온·오프라인 소셜 서비스<br /><br />
										&nbsp;&nbsp;- 회원들의 네트워크를 위한 이벤트 서비스<br /><br />
										&nbsp;&nbsp;- 기타 회사가 추가 개발하거나 다양한 제휴계약 등을 통해 회원에게 제공하는 서비스<br /><br />
										&nbsp;&nbsp;- 모임이 이루어질 수 있도록 온라인으로 제공하는 중개 서비스 및 관련 부가서비스 일체<br /><br />
										&nbsp;&nbsp;- 서비스의 결제가 안전하고 편리하게 이루어질 수 있는 결제대금 보호서비스<br /><br />
										2. 본 약관에 따라 회원으로 승인된 자는 호스트로 모임을 주최하거나 게스트로 모임에 방문하여 회사의 서비스를 이용할 수 있습니다.<br /><br />
										3. 서비스는 연중무휴, 1일 24시간 제공함을 원칙으로 합니다. 다만, 회사는 서비스를 일정범위로 분할하여 각 범위 별로 이용가능시간을 별도로 지정할 수 있으며 이러한 경우에는 그 내용을 사전에 공지합니다.<br /><br />
										4. 회사는 자기계발, 재테크, 스포츠 등 취미생활 등 관련 모임 서비스를 제공함에 있어 설, 추석을 제외한 법정공휴일에도 서비스를 제공합니다. 다만 법정공휴일 등 일정 변경에 상당한 사유가 발생할 경우 회사는 해당 서비스 제공 일정을 변경할 수 있으며, 이 경우에 회사는 회원에게 이 내용을 사전 통보 후 서비스를 제공합니다.<br /><br />
										5. 회사는 컴퓨터 등 정보통신설비의 보수점검, 교체 및 고장, 통신두절 또는 운영상 상당한 이유가 있는 경우 서비스의 제공을 일시적으로 중단할 수 있습니다. 이 경우 회사는 회원에게 통지합니다. 다만, 회사가 사전에 통지할 수 없는 부득이한 사유가 있는 경우 사후에 통지할 수 있습니다.<br /><br />
										6. 회사는 서비스의 제공에 필요한 경우 정기점검을 실시할 수 있으며, 정기점검시간은 서비스제공화면에 공지한 바에 따릅니다.<br /><br />
										7. 회사는 모임 서비스를 제공함에 있어 모임 정족수 미달, 주요 관계인의 신변상의 문제 등으로 해당 서비스 제공을 중단할 수 있습니다. 이런 경우 해당 시기에 따라 전액환불 혹은 일부 환불 조치를 취할 예정이며 상세 내용은 회사의 환불 규정을 따릅니다. 또한 회사는 해당 내용을 회원에게 사전 통보해야 합니다.<br /><br />
										8. 회사는 호스트가 게재하는 서비스설명 등의 제반 정보를 통제하거나 제한하지 않습니다. 다만, 회사는 회원이 게재한 정보의 내용이 타인의 명예, 권리를 침해하거나 법규정을 위반한다고 판단하는 경우에는 이를 삭제할 수 있고, 판매취소, 판매중지, 기타 필요한 조치를 취할 수 있으며, 호스트는 자신이 의도한 판매효과의 미흡 등을 이유로 회사에 어떠한 책임도 물을 수 없습니다.<br /><br />
										9. 회사는 중개서비스를 통하여 이루어지는 회원간의 판매 및 구매와 관련하여 판매의사 또는 구매의사의 존부 및 진정성, 등록물품의 품질, 완전성, 안전성, 적법성 및 타인의 권리에 대한 비침해성, 회원이 입력하는 정보 및 그 정보를 통하여 링크된 URL에 게재된 자료의 진실성 등 일체에 대하여 보증하지 아니하며, 이와 관련한 일체의 위험과 책임은 해당 회원이 부담해야 합니다.<br /><br />
										10. 회사는 통신판매중개자로서 회원 상호간의 거래를 위한 온라인 거래장소를 제공할 뿐이므로 물품을 판매하거나 구매하고자 하는 회원을 대리하지 않습니다. 또한, 회사의 어떠한 행위도 전문가 또는 의뢰인을 대리하는 행위로 간주되지 않습니다.<br /><br />

										<strong>제13조 (서비스의 변경)</strong><br />
										1. 회사는 상당한 이유가 있는 경우에 운영상, 기술상의 필요에 따라 제공하고 있는 전부 또는 일부 서비스를 변경할 수 있습니다.<br /><br />
										2. 서비스의 내용, 이용방법, 이용시간에 대하여 변경이 있는 경우에는 변경사유, 변경될 서비스의 내용 및 제공일자 등은 그 변경 전에 서비스 화면, 전자메일 등으로 통지해야 합니다.<br /><br />
										3. 회사는 서비스 제공의 중단 등 중대한 변화가 있을 경우 그 적용일자 30일 전부터 홈페이지에 해당 내용을 게시하고, E-mail, SMS, 서면 등을 통해 회원에게 개별 고지합니다. (연락처 미기재, 변경 등으로 인하여 개별 통지가 어려운 경우에 한하여 홈페이지에 변경 사항을 공지함으로써 개별통지를 한 것으로 간주합니다.<br /><br />
										4. 회사는 무료로 제공되는 서비스의 일부 또는 전부를 회사의 정책 및 운영의 필요상 수정, 중단, 변경할 수 있으며, 이에 대하여 관련법에 특별한 규정이 없는 한 회원에게 별도의 보상을 하지 않습니다.<br /><br /><br />

										<strong>제14조 (정보의 제공 및 광고의 게재)</strong><br />
										1. 회사는 회원이 서비스 이용 중 필요하다고 인정되는 다양한 정보를 공지사항이나 전자우편 등의 방법으로 회원에게 제공할 수 있습니다. 다만, 회원은 관련법에 따른 거래관련 정보 및 이용에 필수적으로 요구 되는 정보 등에 대한 답변 등을 제외하고는 언제든지 전자우편에 대해서 수신 거절을 할 수 있습니다.<br /><br />
										2. 제1항의 정보를 전화 및 모사전송기기에 의하여 전송하려고 하는 경우에는 회원의 사전 동의를 받아서 전송합니다. 다만, 회원의 거래관련 정보 및 고객문의 등에 대한 회신에 있어서는 제외됩니다.<br /><br />
										3. 회사는 서비스의 운영과 관련하여 서비스 화면, 홈페이지, 전자우편 등에 광고를 게재할 수 있습니다. 해당 광고에는 회원의 게시물 및 서비스 중 이루어지는 사진촬영의 결과물 등이 포함될 수 있습니다.<br /><br />
										4. 광고가 게재된 전자우편을 수신한 회원은 수신거절을 회사에게 할 수 있습니다.<br /><br />
										5. 이용자는 회사가 제공하는 서비스와 관련하여 게시물 또는 기타 정보를 변경, 수정, 제한하는 등의 조치를 취하지 않습니다.<br /><br />
										6. 회원은 언제든지 고객센터 등을 통해 광고에 게재된 자신의 게시물과 자신의 사진 등에 대해 삭제, 검색결과 제외, 비공개 등의 조치를 취할 수 있습니다.<br /><br /><br />

										<strong>제15조 (게시물의 저작권 및 관리)</strong><br />
										회사가 작성한 저작물에 대한 저작권, 특허권, 상표권, 기타 지식 재산권은 회사에 귀속됩니다.<br /><br />
										회원은 서비스를 이용함으로써 얻은 정보를 회사의 사전 승낙 없이 복제, 송신, 출판, 배포, 방송 등 기타 방법에 의하여 이용하거나 제3자에게 이용하게 하여서는 안됩니다.<br /><br />
										회원이 서비스 내에 게시한 게시물의 저작권은 해당 게시물의 저작자에게 귀속됩니다.<br /><br />
										회원이 서비스 내에 게시하는 게시물은 검색결과 내지 서비스 및 관련 프로모션과 광고 등에 노출될 수 있으며, 해당 노출을 위해 필요한 범위 내에서는 일부 수정, 복제, 편집되어 게시될 수 있습니다. 이 경우, 회사는 저작권법 규정을 준수하며, 회원은 언제든지 고객센터 등을 통해 해당 게시물에 대해 삭제, 검색결과 제외, 비공개 등의 조치를 취할 수 있습니다.<br /><br />
										회원의 게시물이 정보통신망법 및 저작권법 등 관련법에 위반되는 내용을 포함하는 경우, 권리자는 관련법이 정한 절차에 따라 해당 게시물의 게시중단 및 삭제 등을 요청할 수 있으며, 회사는 관련법에 따라 조치를 취하여야 합니다.<br /><br />
										회사는 전항에 따른 권리자의 요청이 없는 경우라도 권리침해가 인정될 만한 사유가 있거나 기타 회사 정책 및 관련법에 위반되는 경우에는 관련법에 따라 해당 게시물에 대해 임시조치 등을 취할 수 있고, 이에 대하여 회사는 어떠한 책임도 지지 않습니다.<br /><br />

										<strong>제16조 (권리의 귀속)</strong><br />
										서비스에 대한 저작권 및 지적재산권은 회사에 귀속됩니다. 단, 회원의 게시물 및 제휴계약에 따라 제공된 저작물 등은 제외합니다.<br /><br /><br />

										<strong>제17조 (이용계약의 해지)</strong><br />
										1. 회원은 언제든지 서비스초기화면의 고객센터 또는 내 정보 관리 메뉴 등을 통하여 이용계약 해지 신청을 할 수 있으며, 회사는 관련법 등이 정하는 바에 따라 이를 즉시 처리하여야 합니다.<br /><br />
										2. 회원이 계약을 해지할 경우, 관련법 및 개인정보취급방침에 따라 회사가 회원정보를 보유하는 경우를 제외하고는 해지 72시간 내로 회원의 데이터는 소멸됩니다.<br /><br />
										3. 회원이 유료서비스 계약을 해지하는 경우, 회사가 정한 환불 규정에 따라 환불 처리됩니다.<br /><br />
										4. 회원이 작성한 게시물 등은 삭제되지 않으니 사전에 삭제 후 탈퇴하시기 바랍니다.<br /><br />
										5. 회사는 모임 시작 전에 회원을 모집합니다. 다만 회사는 각 그룹 모임의 모집 참여자 수가 그룹 모임 시작 시까지 회사가 정한 적절한 수의 참가자 미만일 경우 그룹 모임을 폐지합니다. 이 경우에, 회사는 폐지되는 모임의 기 등록 회원에게 해당 사실을 통지하여야 합니다.<br /><br />
										6. 이용계약이 종료되는 경우 회원의 적립금 및 쿠폰은 소멸되며, 환불 등의 처리에 관하여는 회사의 환불규정에 의합니다.<br /><br />
										7. 이용계약의 종료와 관련하여 발생한 손해는 이용계약이 종료된 해당 회원이 책임을 부담하고 회사는 일체의 책임을 지지 않습니다.<br /><br /><br />

										<strong>제18조 (이용제한)</strong><br />
										1. 회사는 회원이 이 약관의 의무를 위반하거나 서비스의 정상적인 운영을 방해한 경우, 경고, 일시정지, 영구이용정지 등으로 서비스 이용을 단계적으로 제한할 수 있습니다.<br /><br />
										2. 회사는 전항에도 불구하고, 주민등록법을 위반한 명의도용 및 결제도용, 저작권법 및 컴퓨터프로그램보호법을 위반한 불법프로그램의 제공 및 운영방해, 정보통신망법을 위반한 불법통신 및 해킹, 악성프로그램의 배포, 접속권한 초과행위, 모임 등과 관련이 없는 불쾌한 언어의 사용, 비정상적인 행위을 한것에 대한 신고가 접수된 경우 등과 같이 관련법을 위반한 경우에는 즉시 영구이용정지를 할 수 있습니다. 본 항에 따른 영구이용정지 시 서비스 이용을 통해 획득한 혜택(적립금, 쿠폰) 등도 모두 소멸되며, 회사는 이에 대해 별도로 보상하지 않습니다.<br /><br />
										3. 본 조에 따라 서비스 이용을 제한하거나 계약을 해지하는 경우에는 회사는 제9조[회원에 대한 통지]에 따라 통지합니다. 회원은 본 조에 따른 이용제한 등에 대해 회사가 정한 절차에 따라 이의신청을 할 수 있습니다. 이 때 이의가 정당하다고 회사가 인정하는 경우 회사는 즉시 서비스의 이용을 재개합니다.<br /><br />
										4. 회사는 1년 이상 서비스를 이용하지 않은 회원의 개인정보를 별도로 분리 보관하여 관리하며, 구체적인 파기 등 절차에 대하여는 개인정보 보호법 등 해당 시점에 유효하게 적용되는 법령의 절차에 따릅니다.<br /><br /><br />

										<strong>제19조 (취소/환불)</strong><br />
										1. 회사와 서비스 구매에 대한 계약을 체결한 회원은 구매 체결 의사 변경에 따라 환불을 요청할 수 있습니다. 회사는 환불 규정에 따라 회원에게 환불 처리합니다.<br /><br />
										2. 이용자가 환불, 취소 요청을 하는 경우 관련 법령 및 회사에서 제공하는 분쟁해결 기준에 부합하는 한 호스트는 이를 승인하여야 합니다. 단, 이용자는 호스트의 반품, 환불, 취소의 요청에 대한 승인이 있기 전까지 그 의사를 철회할 수 있습니다.<br /><br />
										3. 환불 규정이 사이트에 기재된 개별 서비스 이용 조건과 충돌할 경우 개별 서비스 이용 조건에 따른 환불 조건을 우선하여 적용합니다.<br /><br />
										4. 호스트의 사정으로 인한 모임일 취소, 최소인원 미달 등 회사의 과실로 회원이 서비스를 정상적으로 제공받을 수 없는 경우, 회사는 모임을 제공받지 못한 회당 전체 금액을 회원에게 환불 처리합니다.<br /><br />
										5. 취소 요청은 즉시 접수가 되나, 환불의 경우 카드사 사정에 따라 7-10영업일 정도의 취소기간이 소요될 수 있습니다. 카드대금 결제일에 따라 청구작업기간이 다를 수 있으며, 자세한 내용은 해당 카드사에서 확인해야 합니다. (단, 주말, 공휴일은 제외)<br /><br />

										<strong>제20조 (면책 조항)</strong><br />
										1. 회사는 통신망의 사용불가 및 장애, 천재지변 또는 국가비상사태, 정전 및 이에 준하는 불가항력 상황이 발생함으로 인하여 서비스를 제공할 수 없는 경우에는 서비스 제공에 관한 책임이 면제됩니다.<br /><br />
										2. 회사는 회원의 귀책사유로 인한 서비스 이용의 중지, 사용제한, 데이터 삭제, 장애에 대하여는 책임을 지지 않습니다.<br /><br />
										3. 회사는 회사의 고의 또는 중대한 과실이 없는 정보통신망 이용 환경으로 인하여 발생하는 문제 또는 회원의 모바일기기, PC 등의 각종 유무선 장치의 사용 환경으로 인하여 발생하는 제반 문제에 대해서는 책임을 지지 않습니다.<br /><br />
										4. 회사는 회원이 서비스와 관련하여 게재한 정보, 자료, 사실의 신뢰도, 정확성 등의 내용에 관하여는 책임을 지지 않습니다.<br /><br />
										5. 회사는 회원이 본인의 개인정보 등(계정 포함)을 변경하여 얻는 불이익 및 정보 상실에 대해서는 책임을 지지 않습니다.<br /><br />
										6. 회사는 회원 간 또는 회원과 제3자 상호간에 서비스를 매개로 하여 거래 등을 한 경우에는 이에 관하여 책임을 지지 않습니다.<br /><br />
										7. 회사는 회원 간 참여 모임에서 발생하는 일체의 사건 및 손해와 관련하여 회사를 면책시켜야 합니다.<br /><br />
										8. 회원이 본 약관의 규정에 위반한 행위 및 회원의 귀책 사유에 의해 회사 및/또는 제3자에게 손해를 입힌 경우 회원은 그 손해를 배상하여야 하고, 회원은 회사를 면책시켜야 합니다.<br /><br />
										9. 회사는 무료로 제공되는 서비스의 이용 및 변경, 중단과 관련하여 관련법에 특별한 규정이 없는 한 책임을 지지 않습니다.<br /><br />
										10. 회원이 발송한 메일 내용에 대한 법적인 책임은 회원에게 있습니다.<br /><br />
										11. 회사가 통신판매중개업자로서 회원들에게 제공하는 서비스는 온라인 거래장소를 제공하거나 안전한 결제 수단을 제공하고 기타 부가정보를 제공함에 그치는 것이므로 중개서비스를 통하여 이루어지는 회원 상호간의 거래와 관련된 서비스 판매진행의 관리, 의뢰인에 대한 거래이행 등으로 인한 분쟁해결 등 필요한 사후처리는 거래당사자인 회원들이 직접 수행하여야 합니다. 회사는 회사의 고의 또는 중과실이 없는 한 이에 대하여 관여하지 않으며 어떠한 책임도 부담하지 않습니다.<br /><br />
										단, 회사는 회원 간 또는 회원과 제3자 간 분쟁이 발발했음을 양 당사자 중 한 명 이상으로부터 통보를 받을 경우 전자상거래법에 의거 원만한 분쟁해결 지원을 위해 거래 및 양자의 사이트상 계정에 개입 혹은 기타 분쟁해결에 필요하다고 판단되는 모든 조치(거래금액 동결, 계정정지 등)를 취할 수 있으며, 이 조치는 분쟁이 해결되는 시점까지 지속될 수 있습니다. 단, 회사에서 회원 간 또는 회원과 제3자 간 자체적으로 분쟁 해결이 어렵다고 판단되는 경우 회사는 하기의 외부기관들에 분쟁건을 이관할 수 있으며, 이관된 시점 이후부터는 분쟁조정권고 등 이관된 기관의 의견을 신뢰하며 이를 기준으로 분쟁관련 업무를 처리합니다.<br /><br /><br />

										<strong>제21조 (준거법 및 재판관할)</strong><br />
										1. 회사와 회원 간 제기된 소송은 대한민국법을 준거법으로 합니다.<br /><br />
										2. 회사와 회원 간 발생한 분쟁에 관한 소송은 제소 당시의 회사의 주소지를 관할하는 지방법원의 관할로 합니다.<br /><br />
										3. 회사와 회원간 발생한 분쟁에 관한 재판 관할은 「민사소송법」 상의 관할 규정에 따릅니다.<br /><br /><br />

										<strong>제 22조 (분쟁 해결 및 통지)</strong><br />
										1. 회사는 이용자가 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리 하기 위해서 피해보상처리 기구를 설치, 운영합니다.<br /><br />
										2. 회사는 이용자로부터 제출되는 불만사항 및 의견을 지체 없이 처리하고자 최선을 다하여야 합니다. 다만 신속한 처리가 곤란한 경우에는 이용자에게 그 사유와 처리 일정을 통보합니다.<br /><br />
										3. 회사는 불특정다수 회원에 대한 통지의 경우, 7일 이상 사이트에 게시함으로써 개별 통지에 갈음할 수 있습니다. 다만, 제17조를 포함하여 회원 본인의 거래에 관하여 중대한 영향을 미치는 사항에 대하여는 개별 통지함을 원칙으로 합니다.<br /><br /><br />

										<strong>제23조 (계약의 해제, 해지 손해배상 등 각종 책임)</strong><br />
										1. 회원 또는 회사 중 일방이 본 약관에 명시된 사항을 위반하는 경우 상대방은 상당한 기간을 정하여 상대방에게 위반사항을 시정할 것을 요구할 수 있으며, 시정 요구에도 불구하고 위반사항을 시정하지 아니하면 서면(전자문서, 이메일을 포함하며, 이하 같다)으로 계약을 해지할 수 있습니다.<br /><br />
										2. 회사와 회원은 상대방이 주요 자산에 대한 압류 등 강제집행, 거래정지 또는 회생 및 파산신청 등으로 인해 정상적으로 계약 이행을 할 수 없을 경우 계약을 즉시 해지할 수 있습니다.<br /><br />
										3. 일방의 귀책사유로 본 계약을 위반하여 발생한 손해에 대하여 상대방은 배상 책임을 부담합니다.<br /><br />
										4. 회원이 본 약관 등의 위반 행위와 관련하여 각종 관련 법규(행정, 형사, 공정거래 관련 법률 등)를 위반함이 밝혀진 경우, 본 조에 따른 손해배상 외의 형사절차(고발, 고소 등)를 진행할 수 있으며, 회원은 위반 행위로 인한 제3자의 손해(예: 참가자의 개인정보 유출, 명예훼손 등)에 대해서도 책임을 집니다.<br /><br /><br />

										<strong>부칙</strong><br />
										1. 이 약관은 2022년 10월 04일부터 적용됩니다.<br /><br /><br />
									</div>
								</div>
							</div>
						</section>

						<!-- <input type="checkbox" id="box3">
					<label for="box3" class="terms_list">커뮤니티 이용약관</label>
					<section id="con03">
						<div class="box_txt">
							제 1조 (목적)<br/>
							이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
						</div>
					</section>

					<input type="checkbox" id="box4">
					<label for="box4" class="terms_list">이용약관 (구매자)</label>
					<section id="con04">
						<div class="box_txt">
							제 1조 (목적)<br/>
							이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
						</div>
					</section> -->

						<div style="height:30px"></div>
					</div>

					<div class="expected_cost">
						<button type="button" style="width:100%;margin:10px;margin-top:0;" onclick="nextStep()">다음</button>
					</div>
				</div>

				<div class="tab_content p0" id="group_content">
					<div class="mt20">
						<p class="m_title">프로필</p>
						<!-- <div class="citation_photo02">
						<img class="w28" src="../images/Photo_default.svg" alt="">
					</div> -->
						<div class="common_input">
							<div class="mt15">
								<div class="input_flex">

									<input type="file" name="pf_file[]" class="form-control input-sm" title="사업자등록증 또는 신분증 사본 : 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능">

									<!-- <input type="text" name="pf_file[]" placeholder="파일없음" disabled> -->
								</div>
								<span class="inform02 ">
									·용량 2MB 이하 jpg,png
								</span>
							</div>
						</div>
						<!-- <div class="btw_btn p10">
						<input type="file" name="file" id="file" style="display:none">
						<button onclick="onclick=document.all.file.click()">이미지 업로드</button>
						<button>촬영</button>
					</div> -->
					</div>

					<div class="common_input">
						<div class="mt20">
							<p class="m_title">이메일</p>
							<div class="input_flex">
								<input type="email" name="pt_email" id="pt_email" value="<?= $member['mb_id'] ?>" placeholder="이메일을 입력해주세요.">
							</div>
							<span class="inform02 ">
								·실제 사용하시는 이메일 주소를 입력해주세요.<br />
								해당 이메일로 공지사항 및 상품 수정 요청 등 중요 알람이 발송됩니다.
							</span>
						</div>

						<div class="mt20" style="display:none;">
							<p class="m_title">휴대폰 번호</p>
							<div class="input_flex">
								<input type="number" pattern="\d*" name="pt_hp" id="pt_hp" placeholder="휴대폰 번호 (-없이 입력)" placeholder="휴대폰 번호 (-없이 입력)">
								<div class="cominput_btn02">
									<button type="button" class="smsSend on">전송</button>
								</div>
							</div>
							<div class="input_flex mt10" style="display:none;">
								<input type="number" placeholder="인증번호 입력">
								<div class="cominput_btn02">
									<button class="on">인증하기</button>
								</div>
							</div>
							<span class="inform02 ">
								·실제 사용하시는 휴대폰 번호를 입력해주세요.<br />
								해당 휴대폰 번호로 공지사항 및 상품 수정 요청 등 중요 알람이 발송됩니다.
							</span>
						</div>

						<div class="mt20">
							<p class="m_title">호스트 명</p>
							<div class="input_flex">
								<input class="pr40" type="text" oninvalid="this.setCustomValidity('호스트 명을 입력해주십시오.')" oninput="setCustomValidity('')" name="pt_name" id="pt_name" required placeholder="호스트 명 입력">
								<span class="limit">0/20</span>
							</div>
							<span class="inform02 ">
								·게스트들에게 보여지는 닉네임 입니다.
							</span>
						</div>

						<div class="mt20" style="display:none;">
							<p class="m_title">공개연락처 <span class="tre">(선택)</span></p>
							<div class="input_flex">
								<input type="number" placeholder="공개 연락처 입력">
							</div>
							<span class="inform02 ">
								·Moa 대원(회원)에게 노출되는 공개 연락처입니다.
								·미입력 시 인증한 연락처가 노출됩니다.
							</span>
						</div>

						<div class="mt20" style="display:none;">
							<p class="m_title">소개 <span class="tre">(선택)</span></p>
							<div class="brief_history">
								<textarea name="" id="" cols="30" rows="10" placeholder="간단한 소개와 약력을 입력해주세요."></textarea>
								<span class="limit02">0/20</span>
							</div>
							<span class="inform02 ">
								·Moa 대원(회원)에게 호스트님을 소개해 주세요.<br />
								·호스트님만의 개성을 담거나, 신뢰감을 줄 수 있는 전문적인 사항들을
								입력하시면 좋습니다.
							</span>
						</div>

						<div class="form-group checkbox" style="display:none;height:50px">
							<label>
								<input type="checkbox" name="agree" value="1" id="agree11" style="border:1px solid #333;width:25px;height:25px" checked> 호스트가입약관과 상기 정보제공에 동의합니다.
							</label>
						</div>

						<div class="two_btn mt40">
							<button class="inactive" type="button" onclick="location.href='/'">취소</button>
							<button class="inactive on" type="submit">완료</button>
						</div>
					</div>
				</div>


			</form>


		</div>
	</div>
</div>

<script>
	function nextStep() {
		$('input[name="tab_item04"]').click();
	}

	function fregister_submit(f) {
		if (!f.agree.checked) {
			alert("호스트가입약관과 정보제공에 동의하셔야 가입하실 수 있습니다.");
			f.agree.focus();
			return false;
		}
		var email = $('input[name="pt_email"]').val();
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (!re.test(email)) {
			alert("올바른 이메일 주소를 입력하세요");
			return false;
		}
		if (confirm("호스트 등록을 신청하시겠습니까?")) {
			f.action = "<?php echo $action_url; ?>";
			return true;
		}
		return false;
	}
</script>
<script type="text/javascript" src="<?php echo $skin_url; ?>/assets/js/bootstrap.min.js"></script>