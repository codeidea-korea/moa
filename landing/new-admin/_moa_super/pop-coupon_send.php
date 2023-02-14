
<div class="layer-popup" id="pop-coupon_send">
	<div class="popContainer">
		<div class="pop-inner" style="width:1300px">
			<span class="pop-closer">팝업닫기</span>		

			<form name="" action="" method="post">
			<div class="pop-header">수신자 설정</div>
			<div class="wr-wrap line label200">
				<div class="wr-list">
					<div class="wr-list-label">발송 플랫폼</div>
					<div class="wr-list-con">
						<div class="flex">
							<label class="radio-wrap"><input type="radio" name="r1" value="" checked><span></span>전체</label>
							<label class="radio-wrap ml30"><input type="radio" name="r1" value=""><span></span>안드로이드</label>
							<label class="radio-wrap ml30"><input type="radio" name="r1" value=""><span></span>아이폰</label>
						</div>
					</div>
				</div>
				<div class="wr-list">
					<div class="wr-list-label">수신자 설정</div>
					<div class="wr-list-con">
						<p class="mb10"><label class="checkbox-wrap"><input type="checkbox" name="" value="" checked  /><span></span>무제한</label></p>
						<select multiple data-actions-box="true" title="수신대상자 선택" class="span">
							<option data-subtext="(사용자)">영심이</option>
							<option data-subtext="(사용자)">고길동</option>
							<option data-subtext="(사용자)">희동이</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="mt50"></div>

			<div class="pop-header">쿠폰 보내기</div>
			<div class="wr-wrap line label200">
				<div class="wr-list">
					<div class="wr-list-label">쿠폰명</div>
					<div class="wr-list-con">
						<input type="text" name="" value="" class="span300" placeholder="쿠폰명을 입력해주세요."><span class="color-light noto500 ml20">30글자 이내로 작성하세요.</span>
						<p class="mt10 fs14">쿠폰유효기간 : 2022.03.14  13:00:00</p>
					</div>
				</div>
				<div class="wr-list">
					<div class="wr-list-label">수신자 및 발송예약</div>
					<div class="wr-list-con">
						수신대상자 1명
					</div>
				</div>
				<div class="wr-list">
					<div class="wr-list-label">푸시 메시지 제목</div>
					<div class="wr-list-con">
						<input type="text" name="" value="" class="span300" placeholder="제목을 입력해주세요."><span class="color-light noto500 ml20">30글자 이내로 작성하세요.</span>
					</div>
				</div>
				<div class="wr-list flex-top">
					<div class="wr-list-label">푸시 메시지 내용</div>
					<div class="wr-list-con">
						<textarea name="" class="span730" placeholder="100글자 이내로 작성해주세요." maxlength="100">5000원 할인 쿠폰이 도착했습니다!</textarea>
					</div>
				</div>
				<div class="wr-list">
					<div class="wr-list-label">쿠폰 이미지</div>
					<div class="wr-list-con">
						<img src="./img/tmp-coupon.png">
						<p class="mt10 fs14">푸시 이미지는 1000px * 500px 사이즈를 권장합니다.</p>
					</div>
				</div>
			</div>

			<div class="btnSet">
				<a href="#" class="btn reverse gray span150 popClose">취소</a>
				<a href="#" class="btn span150 submit">쿠폰발송하기</a>
			</div>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>