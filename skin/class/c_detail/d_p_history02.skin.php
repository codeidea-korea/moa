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
			<button class="inactive on" onclick="location.href='/';">완료</button>
		</div>
    </div>
</section>