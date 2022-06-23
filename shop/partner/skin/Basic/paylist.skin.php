<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>


<div class="section-title">정산내역 </div>

<div class="mt30"></div>
<div class="boxContainer padding40">
	

	<div class="data-search-wrap fx-wrap label120">		
	<form name="frm_search" action="/shop/partner/" method="get">
		<input type="hidden" name="ap" value="<?php echo $ap;?>">
	<div class="data-search-wrap fx-wrap label120">
		
		
		<div class="fx-list flex-top">
			<div class="fx-list-label">정산 신청 일자</div>
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
					setdate(0);
					<?php } ?>
				});
				</script>
				
			</div>
		</div>
		<div class="btnSet">
			<button type="submit" class="btnSearch active btn btn-danger btn-sm btn-block">조회</button>
			<a href="./?ap=<?php echo $ap;?>" class="btnReset">초기화</a>
		</div>
	</div>
	</form>
			
		<div class="tbl-basic outline odd th-h5 fs15">
			<div class="tbl-header">
				<div class="right">
					<a href="<?php echo $exceldownlink?>" class="btn">엑셀다운로드</a>
				</div>
			</div>
				
			<table >
			<tbody>
			<tr >
				<th  scope="col">번호</th>
				<th  scope="col">상태</th>
				<th  scope="col">접수번호</th>
				<th  scope="col">신청일</th>
				<th  scope="col">출금방법</th>
				<th  scope="col">정산유형</th>
				<th  scope="col">신청금액</th>
				<th  scope="col">공급가</th>
				<th  scope="col">부가세</th>
				<th  scope="col">제세공과</th>
				<th  scope="col">실지급액</th>
				<th  scope="col">메모</th>
				<th  scope="col">비고</th>
			</tr>
			<?php for ($i=0; $i < count($list); $i++) { ?>
				<tr>
					<td ><?php echo $list[$i]['pp_num'];?></td>
					<td ><?php echo $list[$i]['pp_confirm'];?></td>
					<td ><?php echo $list[$i]['pp_no'];?></td>
					<td ><?php echo $list[$i]['pp_date'];?></td>
					<td ><?php echo $list[$i]['pp_means'];?></td>
					<td ><?php echo $list[$i]['pp_company'];?></td>
					<td class="text-right"><?php echo number_format($list[$i]['pp_amount']);?></td>
					<td class="text-right"><?php echo number_format($list[$i]['pp_net']);?></td>
					<td class="text-right"><?php echo number_format($list[$i]['pp_vat']);?></td>
					<td class="text-right"><?php echo number_format($list[$i]['pp_tax']);?></td>
					<td class="text-right"><?php echo number_format($list[$i]['pp_pay']);?></td>
					<td >
						<?php if($list[$i]['pp_memo']) { ?>
							<a class="cursor" role="button" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="<span class='font-12'><?php echo $list[$i]['pp_memo'];?></span>">
							<i class="fa fa-volume-up fa-lg"></i>
							</a>
						<?php } ?>
					</td>
					<td >
						<?php if($list[$i]['pp_ans']) { ?>
							<a class="cursor" role="button" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="<span class='font-12'><?php echo $list[$i]['pp_ans'];?></span>">
							<i class="fa fa-bell fa-lg"></i>
							</a>
						<?php } ?>			
					</td>
				</tr>
			<?php } ?>
			<?php if ($i == 0) { ?>
				<tr><td colspan="13" >등록된 자료가 없습니다.</td></tr>
			<?php } ?>
			</tbody>
			</table>
		</div>


	</div>
	
</div>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
 </script>


