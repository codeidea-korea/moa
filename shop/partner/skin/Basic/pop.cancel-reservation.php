
<div class="layer-popup" id="pop-cancel-reservation">
	<div class="popContainer">
		<div class="pop-inner" style="width:500px">
			<span class="pop-closer">팝업닫기</span>
			
			<div class="fs24 tcenter mb10">예약취소 하시겠습니까?</div>
			<p class="tcenter mb40">게스트에게 알림이 뜹니다.<br>문자/카카오/앱푸시알림</p>

            <form role="form" id="ocancelForm" method="post" action="/shop/orderinquirycancel.php">
                <input type="hidden" name="odid" value="<?php echo $odid; ?>">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                <input type="hidden" name="stype" value="host">
                <input type="hidden" name="token"  value="<?php echo $token; ?>">

                <div class="wr-wrap label200">
                    <div class="wr-list">
                        <div class="wr-list-con tcenter">
                            <label for="cancel_memo" class="sound_only">취소사유</label>
                            <input type="text" name="cancel_memo" id="cancel_memo" required class="span300 required" size="40" maxlength="100" placeholder="취소사유" value="주문취소사유입니다.">
                        </div>
                    </div>
                </div>
                <div class="btnSet">
                    <button type="button" class="btn reverse gray span150 popClose">취소</button>
                    <button type="button" class="btn span150" onclick="fcancel_submit(this)">예약 취소하기</button>
                </div>
            </form>

		</div>
	</div>

	<div class="pop-bg"></div>
</div>

<script>
    function fcancel_submit(f) {
        if (!confirm("예약을 취소 하시겠습니까?")) {
            alert('취소되었습니다.');
            return false;
        }
        $('#ocancelForm').submit();
    }
</script>