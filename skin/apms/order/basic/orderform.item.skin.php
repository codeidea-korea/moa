<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>



<div class="wrapper detail_wrap pb0 bg_gray">
	<div class="s_content detail_con">
		<!-- <div class="dt_con1"><h3>결제정보</h3></div> -->
		<?php for($i=0; $i < count($item); $i++) { ?>
			<div class="chat_infor">
				<div class="chat_img img_ct">
					<img src="<?php echo filter_var($item[$i]['as_thumb'], FILTER_VALIDATE_URL) != '' ? $item[$i]['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="">
				</div>
				<div class="infor_area">
					<p class="ellipsis1"><?php echo $item[$i]['hidden_it_name']; ?></p>
					<p class="ellipsis2"></p>
					<p><?php echo number_format($item[$i]['hidden_sell_price']); ?>원</p>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="s_content detail_con">
		<div class="dt_con1"><h3>결제수단</h3></div>
		<div class="lounchecL pay_radio mt25">
			<!-- <input type="radio" id="box_1" name="od_settle_case" value="무통장" checked>
			<label for="box_1">무통장</label> -->
			<input type="radio" id="box_settle_2" name="od_settle_case" value="신용카드" checked>
			<label for="box_settle_2">신용카드</label>
			<!-- <input type="radio" id="box_2" name="sequence">
			<label for="box_2">카카오페이</label>
			<input type="radio" id="box_3" name="sequence">
			<label for="box_3">네이버페이</label>
			<input type="radio" id="box_4" name="sequence">
			<label for="box_4">가상계좌</label> -->
			<script>
			$(function() {
				$("#box_settle_2").attr("checked", "true");
			});
			</script>
		</div>
	</div>

        <div class="s_content detail_con">
            <div class="dt_con1">
                <h3>
                    쿠폰/포인트
                </h3>
            </div>
            <ul class="a_layout mt25 coupon_area">
                <li>
                    <a href="javascript:">
                        <p>할인 쿠폰<span>
                        <input type="hidden" name="od_cp_id" value="">
                        <input type="hidden" name="sc_cp_id" value="">
						<button type="button" id="od_coupon_btn" class="cp_btn btn btn-black btn-sm">쿠폰적용</button>
						<!-- <button type="button" id="sc_coupon_btn" class="cp_apply btn btn-black btn-sm">쿠폰적용 ct</button> -->

                        <!-- <span><img src="../images/r_arrow_o.svg" alt=""></span> -->
                    </a>
                </li>
                <li>
                    <a href="javascript:" >
                        <p>포인트</p>
                        <span> <?php echo number_format($member['mb_point'])?>Point 보유, 1000점 이상 사용 가능</span>
                        <!-- <span><img src="../images/r_arrow_o.svg" alt=""></span> -->
                    </a>
                </li>
            </ul>
        </div>

        <div class="s_content detail_con">
            <div class="dt_con1 layout_f">
                <h3>
                    결제 금액
                </h3>
                <div class="pay">
					<?php for($i=0; $i < count($item); $i++) { ?>
						 <?php echo number_format($item[$i]['hidden_sell_price']); ?>원
					<?php } ?>
                </div>
            </div>
            <ul class="a_layout mt25">
                <li>
                    <a href="javascript:" >
                        <p>할인 쿠폰</p>
                        <span id="od_tot_coupon"><?php echo ($item[$i]['hidden_cp_price'])?$item[$i]['hidden_cp_price']:""; ?></span>원
                        <!-- <span><img src="../images/r_arrow_o.svg" alt=""></span> -->
                    </a>
                </li>
                <li>
                    <a href="javascript:" >
                        <p>포인트<span><input type="hidden" name="max_temp_point" value="<?php echo $temp_point;?>">

                        <input type="number" name="od_temp_point" value="" id="od_temp_point" class="frm_input form-control input-sm" size="10">
                        <span class="input-group-addon">점</span>

                        <!-- <span><img src="../images/r_arrow_o.svg" alt=""></span> -->
                    </a>
                </li>
            </ul>
        </div>

        <div class="s_content detail_con">
            <div class="dt_con1 layout_f">
                <h3>
                    최종 결제 금액
                </h3>
                <div class="pay02">
					<?php for($i=0; $i < count($item); $i++) { ?>
						 <span  id="od_tot_price"><?php echo number_format($item[$i]['hidden_sell_price']); ?></span>원
                        <input type="hidden" id="tot_price" value="<?php echo $item[$i]['hidden_sell_price']; ?>" />
					<?php } ?>
                </div>
            </div>
            <ul class="a_layout mt25">
                <li>
                    <a href="javascript:" >
                        <p>모임 환불 정책</p>
                        <span><img src="../images/r_arrow_o.svg" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:" >
                        <p>개인정보 제 3자 제공</p>
                        <span><img src="../images/r_arrow_o.svg" alt=""></span>
                    </a>
                </li>
            </ul>
			<?php if(!$is_mobile_order) {?>
				<button type="button" class="inactive on mt40"  onclick="forderform_check(this.form);">결제하기</button>
			<?php }?>
        </div>
    </div>



<div class="none">
	<div class="well well-sm">
		<i class="fa fa-shopping-cart fa-lg"></i> 주문하실 상품을 확인해 주세요.
	</div>
	<div class="table-responsive order-item">
		<table id="sod_list" class="div-table table bg-white bsk-tbl" style="width:100%">
			<tbody>
			<tr class="<?php echo $head_class;?>">
				<th scope="col"><span>이미지</span></th>
				<th scope="col"><span>모임명</span></th>
				<th scope="col"><span>총수량</span></th>
				<th scope="col"><span>판매가</span></th>
				<th scope="col"><span>쿠폰</span></th>
				<th scope="col"><span>소계</span></th>
				<th scope="col"><span>포인트</span></th>
			</tr>
			<?php for($i=0; $i < count($item); $i++) { ?>
				<tr<?php echo ($i == 0) ? ' class="tr-line"' : '';?>>
					<td class="text-center">
						<div class="item-img">
							<?php echo get_it_image($item[$i]['it_id'], 70, 70); ?>
							<div class="item-type"><?php echo $item[$i]['pt_it']; ?></div>
						</div>
					</td>
					<td>
						<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $item[$i]['hidden_it_id']; ?>">
						<input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $item[$i]['hidden_it_name']; ?>">
						<input type="hidden" name="it_price[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_sell_price']; ?>">
						<input type="hidden" name="cp_id[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_cp_id']; ?>">
						<input type="hidden" name="cp_price[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_cp_price']; ?>">
						<?php if($default['de_tax_flag_use']) { ?>
							<input type="hidden" name="it_notax[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_it_notax']; ?>">
						<?php } ?>
						<b><?php echo $item[$i]['it_name']; ?></b>
						<?php if($item[$i]['it_options']) { ?>
							<div class="well well-sm"><?php //echo $item[$i]['it_options'];?></div>
						<?php } ?>
					</td>
					<td class="text-center"><?php echo $item[$i]['qty']; ?></td>
					<td class="text-right"><?php echo $item[$i]['ct_price']; ?></td>
					<td class="text-center">
						<?php if($item[$i]['is_coupon']) { ?>
							<div class="btn-group">
								<button type="button" class="cp_btn btn btn-black btn-xs">적용</button>
							</div>
						<?php } ?>
					</td>
					<td class="text-right"><b><?php echo $item[$i]['total_price']; ?></b></td>
					<td class="text-right"><?php echo $item[$i]['point']; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>

	<?php if ($goods_count) $goods .= ' 외 '.$goods_count.'건'; ?>

	<!-- 주문상품 합계 시작 { -->
	<div class="well">
		<div class="row">
			<div class="col-xs-6">주문금액</div>
			<div class="col-xs-6 text-right">
				<strong><?php echo number_format($tot_sell_price); ?> 원</strong>
			</div>
			<?php if($it_cp_count > 0) { ?>
				<div class="col-xs-6">쿠폰할인</div>
				<div class="col-xs-6 text-right">
					<strong id="ct_tot_coupon">0 원</strong>
				</div>
			<?php } ?>
		</div>
		<div class="row">
			<?php $tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비 ?>
			<div class="col-xs-6 red"> <b>합계금액</b></div>
			<div class="col-xs-6 text-right red">
				<strong id="ct_tot_price"><?php echo number_format($tot_price); ?> 원</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6"> 포인트</div>
			<div class="col-xs-6 text-right">
				<strong><?php echo number_format($tot_point); ?> 점</strong>
			</div>
		</div>
	</div>
</div>



<script>
(function($){
	$(document).ready(function(){
		let price = parseInt($('#tot_price').val());
		$('#od_temp_point').keyup(function(){
			if($(this).val() != '')
			var point = parseInt($(this).val());
			else
				var point = 0;

			var total = price - parseInt(point);
			$('#od_tot_price').text(total);
		})
	})
})(jQuery)
</script>