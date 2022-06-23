
<div class="layer-popup" id="pop-cancel-class">
	<div class="popContainer">
		<div class="pop-inner" style="width:500px">
			<span class="pop-closer">팝업닫기</span>
			
			<div class="fs24 tcenter mb10">폐강 처리 하시겠습니까?</div>
			<p class="tcenter mb40">게스트에게 알림이 뜹니다.<br>문자/카카오/앱푸시알림</p>
			
			<form name="fregister" id="fregister" action="<?php echo G5_SHOP_URL; ?>/partner/write_update.php" method="post">
                <input type="hidden" name="w" value="u">
                <input type="hidden" name="bo_table" value="class">
                <input type="hidden" name="wr_id" value="">
                <input type="hidden" name="ap" value="<?php echo $_GET['ap'] ? $_GET['ap'] : 'list'; ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                <input type="hidden" name="stx" value="<?php echo $stx ?>">
                <input type="hidden" name="spt" value="<?php echo $spt ?>">
                <input type="hidden" name="sst" value="<?php echo $sst ?>">
                <input type="hidden" name="sod" value="<?php echo $sod ?>">
                <input type="hidden" name="page" value="<?php echo $page ?>">
                <div class="wr-wrap label200">
                    <div class="wr-list">
                        <div class="wr-list-con">
                            <input type="text" name="moa_close_time" value="<?php echo date('Y-m-d H:i'); ?>" class="span">
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-con">
                            <textarea name="moa_close_reason" class="span" placeholder="폐강 사유를 입력해주세요." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="btnSet">
                    <button type="button" class="btn reverse gray span150 popClose">취소</button>
                    <button type="submit" class="btn span150 submit" onclick="fregister_submit(this);">폐강 확정하기</button>
                </div>
            </form>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>

<script>
    function fregister_submit(f) {
        if (confirm("폐강 하시겠습니까?")) {
            f.action = "<?php echo $action_url;?>";
            return true;
        }

        return false;
    }
</script>