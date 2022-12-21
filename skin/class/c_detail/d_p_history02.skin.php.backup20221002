<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "SELECT * FROM g5_shop_order WHERE od_id = '{$od_id}'";
$result = sql_fetch($sql);
?>

<!-- 결제 상세 내역 -->
<section class="detail_con bg_gray">
    <div class="s_con_bg">
        <div class="dt_h4">
            <h4>결제 정보</h4>
        </div>
        <div class="mt25">
            <div class="bothSides">
                <p>쿠폰 할인금액</p>
                <span><?php echo number_format($result['od_coupon']); ?>원</span>
            </div>
			<div class="bothSides">
                <p>포인트 사용금액</p>
                <span><?php echo number_format($result['od_receipt_point']); ?>원</span>
            </div>
            <div class="bothSides">
                <p><?php echo $result['od_settle_case']; ?></p>
                <span><?php echo number_format($result['od_receipt_price']); ?>원</span>
            </div>
        </div>
    </div>
</section>

<section class="detail_con last_cnt">
    <div class="s_con_bg">
        <div class="dt_h4 layout_f">
            <h4>총 결제금액</h4>
            <div class="pay02">
                <?php echo number_format($result['od_receipt_price']); ?>원
            </div>
        </div>
		<div class="lowbtn_layout mt25">
			<button class="inactive on" onclick="location.href='/c_detail/d_p_history01.php';">결제 목록</button>
			<?php if ($_REQUEST['p'] == "history"){?>
				<?php if ($cancel_price == 0){?>
					<button class="inactive btn_order_cancel" style="margin-top:10px;">주문 취소하기</button>
					<div id="sod_fin_cancelfrm">
						<form id="ocancelForm" method="post" action="./orderinquirycancel.php">
							<input type="text" name="od_id"  value="<?php echo $od['od_id']; ?>">
							<input type="text" name="token"  value="<?php echo $token; ?>">
							<label for="cancel_memo" class="sound_only">취소사유</label>
							<input type="text" name="cancel_memo" id="cancel_memo" required class="frm_input required" size="40" maxlength="100" placeholder="취소사유" value="주문취소사유입니다.">
						</form>
					</div>
				<?php }else{?>
					<p>주문 취소, 반품, 품절된 내역이 있습니다.</p>
				<?php }?>
			<?php }?>
		</div>
    </div>
</section>

<script>
$(document).ready(function(){
	$('.btn_order_cancel').click(function(){
		if ($('#cancel_memo').val() == ""){
			alert('취소사유를 입력해 주세요.'); return false; 
		}
		if(confirm("주문을 정말 취소하시겠습니까?")){
			$('#ocancelForm').submit();
		}else{
			return false; 
		}
	});
});
</script>