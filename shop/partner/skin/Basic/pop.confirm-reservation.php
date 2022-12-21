
<div class="layer-popup" id="pop-confirm-reservation">
	<div class="popContainer">
		<div class="pop-inner" style="width:500px">
			<span class="pop-closer">팝업닫기</span>
			
			<div class="fs24 tcenter mb10">예약확정 하시겠습니까?</div>
			<p class="tcenter mb40">게스트에게 알림이 뜹니다.<br>문자/카카오/앱푸시알림</p>
            <form role="form" name="fregister" id="fregister" action="<?php echo G5_SHOP_URL; ?>/partner/write_update.php" method="post">
                <input type="hidden" name="idx" value="<?php echo $idx; ?>" />
                <input type="hidden" name="ap" value="<?php echo $_GET['ap']; ?>" />
                <div class="wr-wrap label200">
                    <div class="wr-list">
                        <div class="wr-list-con tcenter">
                            <input type="text" name="" value="<?php echo date('Y-m-d H:i'); ?>" class="span300">
                        </div>
                    </div>
                </div>
                <div class="btnSet">
                    <button type="button" class="btn reverse gray span150 popClose">취소</button>
                    <button type="submit" class="btn span150 submit" onclick="fregister_submit(this)">예약 확정하기</button>
                </div>
            </form>

		</div>
	</div>

	<div class="pop-bg"></div>
</div>

<script>
    function fregister_submit(f) {
        if (confirm("예약을 확정 하시겠습니까?")) {
            f.action = "<?php echo $action_url;?>";
            return true;
        }

        return false;
    }
</script>