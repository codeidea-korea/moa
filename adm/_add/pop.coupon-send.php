
<div class="layer-popup" id="pop-coupon-send">
	<div class="popContainer">
		<div class="pop-inner" style="width:1300px">
			<span class="pop-closer">팝업닫기</span>
			
			<form name="" action="" method="post">

			<div class="pop-header">수신자 설정</div>			
			<div class="wr-wrap label200 list-padding10">
				<div class="wr-list">
					<div class="wr-list-label">발송 플랫폼</div>
					<div class="wr-list-con">
						<label class="radio-wrap"><input type="radio" name="r1" checked /><span></span>전체</label>
						<label class="radio-wrap"><input type="radio" name="r1" /><span></span>안드로이드</label>
						<label class="radio-wrap"><input type="radio" name="r1" /><span></span>아이폰</label>
					</div>
				</div>
				<div class="wr-list">
					<div class="wr-list-label">수신자 설정</div>
					<div class="wr-list-con">
						<div class="mb5"><label class="checkbox-wrap"><input type="checkbox" name="" /><span></span>전체발송하기</label></div>
						<select class="" multiple data-actions-box="true" data-live-search="true" title="수신자 선택">
							<option data-content="영심이<small>(사용자)</small>">영심이 (사용자)</option>
							<option data-content="고길동<small>(사용자)</small>">고길동 (사용자)</option>
							<option data-content="희동이<small>(사용자)</small>">희동이 (사용자)</option>
							<option data-content="영심이<small>(사용자)</small>">영심이 (사용자)</option>
							<option data-content="고길동<small>(사용자)</small>">고길동 (사용자)</option>
							<option data-content="희동이<small>(사용자)</small>">희동이 (사용자)</option>
							<option data-content="영심이<small>(사용자)</small>">영심이 (사용자)</option>
							<option data-content="고길동<small>(사용자)</small>">고길동 (사용자)</option>
							<option data-content="희동이<small>(사용자)</small>">희동이 (사용자)</option>
							<option data-content="영심이<small>(사용자)</small>">영심이 (사용자)</option>
							<option data-content="고길동<small>(사용자)</small>">고길동 (사용자)</option>
							<option data-content="희동이<small>(사용자)</small>">희동이 (사용자)</option>
							<option data-content="영심이<small>(사용자)</small>">영심이 (사용자)</option>
							<option data-content="고길동<small>(사용자)</small>">고길동 (사용자)</option>
							<option data-content="희동이<small>(사용자)</small>">희동이 (사용자)</option>
							<option data-content="영심이<small>(사용자)</small>">영심이 (사용자)</option>
							<option data-content="고길동<small>(사용자)</small>">고길동 (사용자)</option>
							<option data-content="희동이<small>(사용자)</small>">희동이 (사용자)</option>
							<option data-content="영심이<small>(사용자)</small>">영심이 (사용자)</option>
							<option data-content="고길동<small>(사용자)</small>">고길동 (사용자)</option>
							<option data-content="희동이<small>(사용자)</small>">희동이 (사용자)</option>
						</select>
					</div>
				</div>
			</div>

			<div class="pop-header mt50">쿠폰 보내기</div>			
			<div class="wr-wrap label200 list-padding10">
				<div class="wr-list">
					<div class="wr-list-label">쿠폰명</div>
					<div class="wr-list-con">
						<input type="text" name="" value="" class="span400" placeholder="쿠폰명을 입력해주세요."><span class="color-gray ml10">30글자 이내로 작성하세요.</span>
						<p class="mt5 fs14">쿠폰유효기간 : 2022.03.14  13:00:00</p>
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
						<input type="text" name="" value="" class="span400" placeholder="쿠폰명을 입력해주세요."><span class="color-gray ml10">30글자 이내로 작성하세요.</span>
					</div>
				</div>
				<div class="wr-list">
					<div class="wr-list-label">푸시 메시지 내용</div>
					<div class="wr-list-con">
						<textarea name="" class="" placeholder="쿠폰설명을 입력해주세요"></textarea>
					</div>
				</div>
				<div class="wr-list">
					<div class="wr-list-label">이미지 등록</div>
					<div class="wr-list-con">
						<div class="fileContainer ">									
							<label class="upload-btn"><input type="file" name="cp_img" class="preview">푸시 이미지</label>
							<span class="fs14 mt5">(푸시 이미지는 1000px * 500px 사이즈를 권장합니다.)</span>
							<?php							
							//(김과장) 출력확인차 임시로 cz_id값 설정
							$sql = " select * from {$g5['g5_shop_coupon_zone_table']} where cz_id = '1' ";
							$cp = sql_fetch($sql);
				
							$cpimg_str = '';
							$cpimg = G5_DATA_PATH."/coupon/{$cp['cz_file']}";
							if (is_file($cpimg) && $cp['cz_id']) {
								$size = @getimagesize($cpimg);
								if($size[0] && $size[0] > 750)
									$width = 750;
								else
									$width = $size[0];					
								$cpimg_str = '<img src="'.G5_DATA_URL.'/coupon/'.$cp['cz_file'].'" width="'.$width.'">';
								$cpimg_str .= '<label class="checkbox-wrap"><input type="checkbox" name="cp_img_del" value="1" id="cp_img_del"><span></span></label>';
							}
							?>
							<div class="upImg-preview"><?=$cpimg_str?></div>
						</div>
					</div>
				</div>
			</div>

			</form>

			<div class="btnSet">
				<a href="#" class="btn reverse gray span150 popClose">취소</a>
				<a href="#" class="btn span150 submit">쿠폰 발송하기</a>
			</div>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>