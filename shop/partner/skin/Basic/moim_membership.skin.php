<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<?php
//html 팝업
include_once($skin_path.'/pop.confirm-reservation.php'); //예약확정
include_once($skin_path.'/pop.cancel-reservation.php'); //예약취소
?>

<div class="section-title">모임 신청자 관리</div>

<div class="boxContainer padding40">

	<form name="" action="" method="post">
	<div class="data-search-wrap fx-wrap label120">
		<div class="fx-list">
			<div class="fx-list-label">모임 명</div>
			<div class="fx-list-con">
                <select class="moim_select" id="moim_select">
                    <option value="">전체</option>
                    <?php while($row1 = sql_fetch_array($result2)) { ?>
                        <option value="<?php echo $row1['wr_id']; ?>" <?php echo $row1['wr_id'] == $_GET['wr_id'] ? 'selected="selected"' : ''; ?>><?php echo $row1['wr_subject']; ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
	</div>
	</form>

	<form class="" name="" method="post" action="">
	<div class="tbl-basic outline odd th-h5 ">
		<table>
			<colgroup>
				<col width="100">
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">모임명</th>
					<th scope="col">모임 날짜</th>
					<th scope="col">신청자</th>

					<th scope="col">성별</th>
					<th scope="col">나이</th>
					<th scope="col">직업</th>
					<th scope="col">전화번호</th>

					<th scope="col">모임금액</th>
					<th scope="col">모임 신청일</th>
					<th scope="col">정산 상태</th>
					<th scope="col">예약확정</th>
				</tr>
			</thead>
			<tbody>
                <?php $i = 1; ?>
                <?php while($row = sql_fetch_array($result)) { ?>
					<?php 
					// 영카트와 커스텀으로 들어간 테이블과 관계가 떨어져있음. 
					// 첫 쿼리에서 조인을 할 수 있으나 비효율이라고 판단 따로 여기서 구함
					// 결제시 모임? 상품? (알 수 없음 영카트만 사용하지 못하고 커스텀으로 들어간 테이블들이 난무함 그러면서 잘 연계되지도 않음)
					// 의 it_id값을 업데이트하면 되지만 애초에 영카트에는 order테이블에 it_id 컬럼이 없음. 
					// 영카트 특히 결제쪽은 가능하면 건들지 않는쪽으로 함. 
					// 현재 모아는 장바구니 개념이 없음. (상품 여러개를 한번에 결제하지 않음) (22.07.07 박경호)
//					$aSql = "select od_status, a.od_id FROM g5_shop_order a, g5_shop_cart b WHERE a.od_id=b.od_id AND b.it_id='".$row['it_id']."' AND a.mb_id='".$row['uid']."'";

                    // 새로운 문제로 it_id == g5_shop_item 의 식별자와 구매자 mb_id == g5_member 의 식별자로 찾기는 하나, 
					// 동일한 구매자가 동일한 상품을 결제 취소하고 재구매할 경우에는 오류가 발생합니다.
					// 주문별로 상태 확인할 수 있도록 모임신청자 테이블에 구분자를 추가하여 join 으로 해결하도록 합니다.
					// 각 주문별 환불/부분 환불이 동작하려면 어차피 매번 주문 테이블을 확인하여야 하기 때문입니다. (22.12.13. botbinoo)
//					$aRow = sql_fetch_array(sql_query($aSql));
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row['it_name'] ?></td>
						<td><?php echo $row['aplydate'] . " " . $row['aplytime'].':00'; ?></td>
						<td><?php echo $row['mb_name']; ?></td>
						
						<td><?php echo $row['mb_sex']; ?></td>
						<td><?php echo date('Y') - substr($row['mb_birth'], 0, 4); ?></td>
						<td><?php echo $row['company_name']; ?></td>
						<td><?php echo $row['mb_hp']; ?></td>

						<td><?php echo number_format($row['pay']); ?></td>
						<td><?php echo date('Y-m-d', strtotime($row['regdate'])); ?></td>
						<td>
							<?php
							// 상태값 참고 ~/shop.config.php
//							switch ($aRow['od_status']){
							switch ($row['od_status']){
								case '입금': echo '결제완료'; break;
								case '배송': echo '결제완료'; break;
								case '완료': echo '결제완료'; break;
//								case '취소': echo '결제완료'; break;
								case '취소': echo '결제취소'; break;
								case '반품': echo '결제완료'; break;
								case '품절': echo '결제완료'; break;
								default : echo '결제완료'; break;
							}
							?>
						</td>
						<td>
							<?php // 기획에 예약확정후의 내용도 없고 확정이외의 루트에 대한 내용도 없음. (22.07.07 박경호)?>
							<?php 
//							echo $row['status'];
//							echo $aRow['od_status'];
							
							if ($row['status'] == '예약확정'){?>
								예약확정
							<?php } else if ($row['od_status'] == '취소'){?>
								취소
							<?php }else if (empty($row['od_id']) || $row['od_id'] == ''){?>
								데이터 오류 (주문번호 누락)
							<?php }else{?>
								<span data-href="#pop-confirm-reservation" class="pop-inline btn small" data-idx="<?php echo $row['idx']; ?>">예약확정</span>
								
								<? if(strtotime($row['aplydate']) > strtotime(date("Y-m-d") . " +1 days")) { ?>
								<span data-href="#pop-cancel-reservation" class="pop-inline btn small" onclick="setCancelPup('<?php echo $row['od_id']; ?>', '<?php echo $row['uid']; ?>')" data-orderid="<?php echo $row['od_id']; ?>" data-userid="<?php echo $row['uid']; ?>">취소</span>
								<? } ?>
							<?php }?>
							
						</td>
					</tr>
                <?php $i++;
                } ?>
			</tbody>
		</table>
		<script>
		function setCancelPup(od_id, uid) {
			$('input[name=odid]').val(od_id);
			$('input[name=uid]').val(uid);
		}
		</script>
	</div>
        <?php
            $total_count = $row['cnt'];
            $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
            if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
        ?>
        <div class="mt20">
            <?php if($total_count > 0) { ?>
                <ul class="pagination pagination-sm en" style="margin-top:0; padding-top:0;">
                    <?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
                </ul>
            <?php } ?>
        </div>

	</form>

</div>
<script>
    $('#moim_select').change(function(){
        location.search = '?ap=moim_membership&wr_id=' + $(this).val();
    })

    $('.pop-inline').click(function(){
        var idx = $(this).data('idx');

        $('#fregister').children('input[name="idx"]').val(idx);
    })
</script>