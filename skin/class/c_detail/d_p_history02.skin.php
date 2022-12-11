<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "SELECT * FROM g5_shop_order WHERE od_id = '{$od_id}'";
$result = sql_fetch($sql);

// 2022.10.01. dev, botbinoo. 모임 3일 전부터 모임 취소 불가
$target_date = date("Y-m-d H:i:s", strtotime("+3 days"));

$sql = "SELECT orders.*, cart.it_id, cart.it_name, class.as_thumb, item.it_time, item.it_4 
        FROM g5_shop_order as orders join g5_shop_cart as cart on orders.od_id = cart.od_id 
            JOIN g5_shop_item as item on cart.it_id = item.it_id  
            JOIN g5_write_class class ON item.it_2 = class.wr_id 
            JOIN (select it_id, min(day) as day from deb_class_item group by it_id) as deb on item.it_id = deb.it_id 
		where orders.mb_id = '{$member['mb_id']}' 
            AND orders.od_id = cart.od_id 
            AND cart.it_id = item.it_id 
            AND orders.od_id = '".$od_id."' 
            AND orders.od_status != '취소' 
            AND cart.ct_status != '주문취소' 
            AND (class.moa_form = '자율형' or (class.moa_form = '고정형' and deb.day >= '{$target_date}'))";
$payed_deb_class = sql_fetch($sql);
$allowedCancelOrder = true;

if(!isset($payed_deb_class)){
    $allowedCancelOrder = false;
}
// end 2022.10.01. dev, botbinoo. 모임 3일 전부터 모임 취소 불가
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
            <!--
			<div class="bothSides">
                <p>포인트 사용금액</p>
                <span><?php echo number_format($result['od_receipt_point']); ?>원</span>
            </div>
            <div class="bothSides">
                <p><?php echo $result['od_settle_case']; ?></p>
                <span><?php echo number_format($result['od_receipt_price']); ?>원</span>
            </div>
            -->
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
				<?php if ($cancel_price == 0 && $allowedCancelOrder === true){?>
					<button class="inactive btn_order_cancel" style="margin-top:10px;">주문 취소하기</button>
					<div id="sod_fin_cancelfrm">
						<form id="ocancelForm" method="post" action="./orderinquirycancel.php">
							<input type="text" name="od_id"  value="<?php echo $od['od_id']; ?>">
							<input type="text" name="token"  value="<?php echo $token; ?>">
                            <!--
							<label for="cancel_memo" class="sound_only">취소사유</label>
							<input type="text" name="cancel_memo" id="cancel_memo" required class="frm_input required" size="40" maxlength="100" placeholder="취소사유" value="주문취소사유입니다.">
                            -->
						</form>
					</div>
				<?php }else if($allowedCancelOrder == false){?>
                <!--
					<p>모임 3일 전부터 모임 취소가 불가합니다.</p>
                    -->
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