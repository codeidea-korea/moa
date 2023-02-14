<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>



<div class="section-title">매출 현황</div>

<div class="boxContainer flex line flex-stretch noto500 padding40">
	<div class="flex flex-middle flex-center span360">
		<div class="fs16 color-gray">기간내 총 매출액<p class="fs12">(1일 전 영업일 기준)</p></div>
		<div class="ml40 fs24"><?php echo number_format($sum_sales); ?>원</div>
	</div>
	<div class="flex flex-middle flex-center span360">
		<div class="fs16 color-gray">전체 매출액</div>
		<div class="ml40 fs24"><?php echo number_format($tsum_sales);?> 원</div>
	</div>
	<div class="flex flex-middle flex-center flex1">
		<div class="fs16 color-gray">매출 현황 안내</div>
		<div class="ml40 fs14 color-gray noto400">* ‘<?php echo $partner['pt_name']?> ’님의 매출현황입니다. 모임완료/종료된 건 기준으로 집계합니다.</div>
	</div>
</div>

<div class="mt30"></div>

<div class="boxContainer padding40">
	
	<form name="frmSaleList" action="/shop/partner/?ap=salelist" method="post">
		<input type="hidden" name="ap" value="salelist">
		<input type="hidden" name="page" value="<?php echo $page;?>">
	<div class="data-search-wrap fx-wrap label120">	
		<div class="fx-list flex-top">
			<div class="fx-list-label ">조회 기간</div>
			<div class="fx-list-con">
			<label class="inp-wrap label-inline"><input type="text" id="sch_startdt"  name="sch_startdt" value="<?php echo $sch_startdt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<span>~</span>
				<label class="inp-wrap label-inline"><input type="text" id="sch_enddt" name="sch_enddt" value="<?php echo $sch_enddt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<div class="datepickContainer small">
					<a href="javascript:" onclick="setdate(1);"  class="dl todays">오늘</a>
					<a href="javascript:" onclick="setdate(2);"  class="dl month1">1개월</a>
					<a href="javascript:" onclick="setdate(3);"  class="dl month6">6개월</a>	
					<a href="javascript:" onclick="setdate(4);"  class="dl year1 ">1년</a>	
					<a href="javascript:" onclick="setdate(5);"  class="dl year5">5년</a>
					<a href="javascript:" onclick="setdate(0);"  class="dl allday">전체</a>
				</div>
				<script>
				var today = "<?php echo $rday['today'];?>";
				var month1ago = "<?php echo $rday['month1ago'];?>";
				var month6ago = "<?php echo $rday['month6ago'];?>";
				var year1ago = "<?php echo $rday['year1ago'];?>";
				var year5ago = "<?php echo $rday['year5ago'];?>";
				
				function setdate(type) {
					var sdt = today;
					var edt = today;
					$(".dl").removeClass("active");
					switch(type) {
						case 1 :
							sdt = today; 
							$(".todays").addClass("active"); 
							break;
						case 2 : 
							sdt = month1ago;  
							$(".month1").addClass("active"); 
							break;
						case 3 : 
							sdt = month6ago;  
							$(".month6").addClass("active"); 
							break;
						case 4 : 
							sdt = year1ago;  
							$(".year1").addClass("active"); 
							break;
						case 5 : 
							sdt = year5ago;  
							$(".year5").addClass("active"); 
							break;
						default : 
							sdt = '2022-01-01';
							edt = today; 
							$(".allday").addClass("active"); 
							break;
					}
					$("#sch_startdt").val(sdt);
					$("#sch_enddt").val(edt);
					
				}
				$(function() {
					<?php if(!$sch_startdt) { ?>
					setdate(4);
					<?php } ?>
				});
				</script>
			</div>
		</div>
		<div class="btnSet">
			<button type="submit" class="btnSearch">조회</button>
			<a href="#" class="btnReset">초기화</a>
		</div>
	</div>
	</form>

	<div class="tbl-basic outline odd th-h5 fs15">
		<div class="tbl-header">
			<div class="right">
				<a href="<?php echo $exceldownlink?>" class="btn">엑셀다운로드</a>
			</div>
		</div>
		<table>
			<colgroup>
				<col width="60">
				<col width="80">
				<col><col><col><col>
				<col><col><col><col>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">NO</th>
					<th scope="col">결제상태</th>
					<th scope="col">일자</th>
					<th scope="col">구매자</th>
					<th scope="col">주문 번호</th>
					<th scope="col">호스트매출</th>
					<th scope="col">상품명</th>
					<th scope="col">결제금액</th>
					<th scope="col">쿠폰 사용</th>
<!--					<th scope="col">포인트사용</th>-->
					<!-- <th scope="col">취소수수료</th>
					<th scope="col">세금계산서<br>발행수수료</th> -->
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i < count($list);$i++) { 
					$num = (($page-1)*$rows) + $i+1;?>
				<tr>
					<td><?php echo $num;?></td>
					<td><?php echo $list[$i]['od_status'];?></td>
					<td><?php echo $list[$i]['od_date'];?></td>
					<td><?php echo $list[$i]['od_name'];?></td>
					<td><?php echo $list[$i]['od_id'];?></td>
					<td><?php echo number_format($list[$i]['host_price']);?>원</td>
					<td><?php echo $list[$i]['it_name'];?></td>
					<td><?php echo number_format($list[$i]['ct_price']);?>원</td>
					<td><?php echo number_format($list[$i]['od_coupon']);?></td>
<!--					<td><?php echo number_format($list[$i]['od_receipt_point']);?>P</td> -->
					<!-- <td><?php echo $list[$i]['od_status'];?></td>
					<td><?php echo $list[$i]['od_status'];?></td> -->
				</tr>
				<?php } ?>
				
			</tbody>
		</table>
	</div>
	
	<div class="mt20">
			<?php if($total_count > 0) { ?>
			<ul class="pagination pagination-sm en" style="margin-top:0; padding-top:0;">
				<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
			<?php } ?>
		</div>

</div>