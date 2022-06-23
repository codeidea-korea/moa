<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="none">

<div class="well" style="padding-bottom:5px;">
	<form class="form" role="form" name="frm_salelist" method="get">
		<input type="hidden" name="ap" value="<?php echo $ap;?>">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label for="type" class="sr-only">매출타입</label>
					<select name="type" id="type" class="form-control input-sm">
						<option value="day">일간매출</option>
						<option value="month">월간매출</option>
						<option value="year">연간매출</option>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<label for="fr_date" class="sr-only">시작일</label>
				<div class="form-group input-group input-group-sm">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			        <input type="text" name="fr_date" value="<?php echo $fr_date; ?>" id="fr_date" required class="form-control input-sm" size="8" maxlength="8" readonly>
				</div>
			</div>
			<div class="col-sm-3">
				<label for="to_date" class="sr-only">종료일</label>
				<div class="form-group input-group input-group-sm">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			        <input type="text" name="to_date" value="<?php echo $to_date; ?>" id="to_date" required class="form-control input-sm" size="8" maxlength="8" readonly>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<button type="submit" class="btn btn-danger btn-sm btn-block"><i class="fa fa-shopping-cart"></i> 매출확인</button>
				</div>
			</div>
		</div>
	</form>

	<script>
	/*$(function() {
		$("#fr_date, #to_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yymmdd",
			showButtonPanel: true,
			yearRange: "c-99:c+99",
			maxDate: "+0d"
		});
	});*/

	document.getElementById("type").value = "<?php echo $type; ?>";
	</script>
</div>

<div class="table-responsive">
	<table class="table tbl bg-white">
	<tbody>
	<tr class="bg-black">
		<th class="text-center" scope="col">년/월/일</th>
		<th class="text-center" scope="col">판매량</th>
		<th class="text-center" scope="col">판매액</th>
		<th class="text-center" scope="col">수수료</th>
		<th class="text-center" scope="col">포인트</th>
		<th class="text-center" scope="col">인센티브</th>
		<th class="text-center" scope="col">매출액</th>
		<th class="text-center" scope="col">공급가</th>
		<th class="text-center" scope="col">부가세</th>
	</tr>
	<?php for ($i=0; $i < count($list); $i++) { ?>
		<tr<?php echo ($list[$i]['yoil'] == '일') ? ' style="background:#f5f5f5; font-weight:bold;"' : '';?>>
			<td class="text-center"><?php echo str_replace("-", "/", $list[$i]['date']);?></td>
			<td class="text-center"><?php echo number_format($list[$i]['qty']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['sale']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['commission']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['point']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['incentive']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['netsale']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['net']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['vat']);?></td>
		</tr>
	<?php } ?>
	<?php if ($i == 0) { ?>
		<tr><td colspan="9" class="text-center">등록된 자료가 없습니다.</td></tr>
	<?php } else { ?>
		<tr style="background:#f5f5f5; font-weight:bold;">
			<td class="text-center"><b>합계</b></td>
			<td class="text-center"><b><?php echo number_format($tot['qty']);?></b></td>
			<td class="text-right"><b><?php echo number_format($tot['sale']);?></b></td>
			<td class="text-right"><b><?php echo number_format($tot['commission']);?></b></td>
			<td class="text-right"><b><?php echo number_format($tot['point']);?></b></td>
			<td class="text-right"><b><?php echo number_format($tot['incentive']);?></b></td>
			<td class="text-right"><b><?php echo number_format($tot['netsale']);?></b></td>
			<td class="text-right"><b><?php echo number_format($tot['net']);?></b></td>
			<td class="text-right"><b><?php echo number_format($tot['vat']);?></b></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
</div>

</div>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->



<div class="section-title">매출 현황</div>

<div class="boxContainer flex line flex-stretch noto500 padding40">
	<div class="flex flex-middle flex-center span360">
		<div class="fs16 color-gray">기간내 총 매출액<p class="fs12">(1일 전 영업일 기준)</p></div>
		<div class="ml40 fs24"><?php echo number_format($sum['ct_price']); ?>원</div>
	</div>
	<div class="flex flex-middle flex-center span360">
		<div class="fs16 color-gray">전체 매출액</div>
		<div class="ml40 fs24"><?php echo number_format($totsum);?> 원</div>
	</div>
	<div class="flex flex-middle flex-center flex1">
		<div class="fs16 color-gray">매출 현황 안내</div>
		<div class="ml40 fs14 color-gray noto400">* ‘<?php echo $partner['pt_name']?> ’님의 매출현황입니다. 모임완료/종료된 건 기준으로 집계합니다.</div>
	</div>
</div>

<div class="mt30"></div>

<div class="boxContainer padding40">
	
	<form name="frmSaleList" action="/shop/partner/?ap=salelist">
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
				<a href="#" class="btn">엑셀다운로드</a>
			</div>
		</div>
		<table>
			<colgroup>
				<col width="100">
				<col width="150">
				<col>
				<col>
				<col>
				<col>
				<col>
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
					<th scope="col">포인트사용</th>
					<th scope="col">취소수수료</th>
					<th scope="col">세금계산서<br>발행수수료</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>결제완료</td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>21112</td>
					<td>20,000원</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>25,000원</td>
					<td>2,000</td>
					<td>3,000P</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr>
					<td>2</td>
					<td>결제완료</td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>21112</td>
					<td>20,000원</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>25,000원</td>
					<td>2,000</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr>
					<td>3</td>
					<td>결제완료</td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>21112</td>
					<td>20,000원</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>25,000원</td>
					<td>2,000</td>
					<td>3,000P</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr>
					<td>4</td>
					<td>결제완료</td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>21112</td>
					<td>20,000원</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>25,000원</td>
					<td>2,000</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr>
					<td>5</td>
					<td>결제완료</td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>21112</td>
					<td>20,000원</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>25,000원</td>
					<td>2,000</td>
					<td>3,000P</td>
					<td>0</td>
					<td>0</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<ul class="pagination">
		<li class="disabled"><a><i class="fa fa-angle-double-left"></i></a></li>
		<li class="disabled"><a><i class="fa fa-angle-left"></i></a></li>
		<li class="active"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
		<li class="disabled"><a><i class="fa fa-angle-double-right"></i></a></li>
	</ul>

</div>