<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="none">
<div class="row">
	<div class="col-md-6">

		<table class="table bg-white">
		<tbody>
		<tr class="bg-black">
			<th class="text-center">구분</th>
			<th class="text-center">금액(원)</th>
			<th class="text-center">비고</th>
		</tr>
		<tr>
			<td>① 총판매액</td>
			<td class="text-right"><nobr><?php echo number_format($account['sale']);?></nobr></td>
			<td></td>
		</tr>
		<tr>
			<td>② 총수수료</td>
			<td class="text-right"><?php echo number_format($account['commission']);?></td>
			<td></td>
		</tr>
		<tr>
			<td>③ 총포인트</td>
			<td class="text-right"><?php echo number_format($account['point']);?></td>
			<td></td>
		</tr>
		<tr>
			<td><nobr>④ 총인센티브</nobr></td>
			<td class="text-right"><?php echo number_format($account['intensive']);?></td>
			<td></td>
		</tr>
		<tr>
			<td>⑤ 총매출액</td>
			<td class="text-right"><?php echo number_format($account['netsale']);?></td>
			<td>①-②-③+④</td>
		</tr>
		<tr>
			<td>⑥ 총배송비</td>
			<td class="text-right"><?php echo number_format($account['sendcost']);?></td>
			<td></td>
		</tr>
		<tr class="active">
			<td><b>⑦ 총적립액</b></td>
			<td class="text-right"><b><?php echo number_format($account['netgross']);?></b></td>
			<td>⑤+⑥</td>
		</tr>
		<tr>
			<td>⑧ 총지급액</td>
			<td class="text-right"><?php echo number_format($account['payment']);?></td>
			<td>신청금액 기준</td>
		</tr>
		<tr>
			<td>⑨ 지급요청</td>
			<td class="text-right"><?php echo number_format($account['request']);?></td>
			<td>신청금액 기준</td>
		</tr>
		<tr class="success">
			<td><b>⑩ 현재잔액</b></td>
			<td class="text-right"><b><?php echo number_format($account['balance']);?></b></td>
			<td>⑦-⑧-⑨</td>
		</tr>
		<tr>
			<td>⑪ 출금기준</td>
			<td class="text-right"><b><?php echo number_format($account['deposit']);?></b></td>
			<td>이상 잔액</td>
		</tr>
		<tr class="warning">
			<td><b>⑫ 출금가능</b></td>
			<td class="text-right"><b><?php echo number_format($account['possible']);?></b></td>
			<td>⑩-⑪</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="col-md-6">

		<table class="table bg-white">
		<tbody>
		<tr class="bg-black">
			<th class="text-center">정산/입금안내</th>
		</tr>
		<tr>
			<td>정산유형 : <?php echo ($partner['pt_company']) ? $partner['pt_company'] : '미등록'; ?></td>
		</tr>
		<tr>
			<td>입금계좌 :
				<?php if($partner['pt_bank_name']) { ?>
					<?php echo $partner['pt_bank_name'];?>
					<?php echo $partner['pt_bank_account'];?>
					<?php echo $partner['pt_bank_holder'];?>
				<?php } else { ?>
					미등록
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php if($partner['pt_type'] == "1") { ?>
				간이과세사업자는 세금계산서 교부 불가로 부가세를 제한 금액만 입금됩니다.
			<?php } else { ?>
				개인 파트너는 부가세를 제한 금액에 대해 원천징수 후 입금됩니다.
			<?php } ?>
			</td>
		</tr>
		</tbody>
		</table>
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				최대 <strong><?php echo number_format($account['max']);?></strong>원까지 신청할 수 있습니다.
			</div>
			<div class="panel-body">
				<form class="form" role="form" name="frm_amount" action="<?php echo $action_url;?>" onsubmit="return frm_submit(this);" method="post">
				<input type="hidden" name="ap" value="<?php echo $ap;?>">
				<input type="hidden" name="pp_field" value="0">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="pp_means" class="sr-only">출금방법</label>
								<select name="pp_means" id="pp_means" class="form-control input-sm">
									<option value="0">통장입금</option>
									<option value="1"><?php echo AS_MP;?>전환</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<label for="pp_amount" class="sr-only">출금액</label>
							<div class="form-group input-group input-group-sm">
								<input type="text" name="pp_amount" value="" id="pp_amount" required class="form-control input-sm" placeholder="<?php echo number_format($account['unit']);?>원 단위 양수">
								<span class="input-group-addon">원</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<textarea name="pp_memo" id="pp_memo" rows="4" class="form-control input-sm" placeholder="메모<?php echo ($pp_limit) ? ' : '.$pp_limit : '';?>"></textarea>
					</div>

					<button type="submit" id="btn_submit" class="btn btn-danger btn-block"><b>출금신청하기</b></button>

				</form>
			    <script>
				function frm_right(str, n){
					if (n <= 0)
					   return "";
					else if (n > String(str).length)
					   return str;
					else {
					   var iLen = String(str).length;
					   return String(str).substring(iLen, iLen - n);
					}
				}

				function frm_submit(f) {
					var pp_possible = "<?php echo $account['possible'];?>";
					var pp_amount = f.pp_amount.value;
					var pp_unit = String(frm_right(pp_amount, <?php echo $account['num'];?>));

					if (pp_possible > 0) {
						;
					} else {
						alert("출금가능한 잔액이 없습니다.");
						f.pp_amount.focus();
						return false;
					}

					if (pp_amount > 0) {
						;
					} else {
						alert("신청금액은 0보다 큰 양수로 입력하셔야 합니다.");
						f.pp_amount.focus();
						return false;
					}

					if (pp_amount > parseInt(pp_possible)) {
						alert("출금가능한 잔액보다 큰 금액을 신청하셨습니다.");
						f.pp_amount.focus();
						return false;
					}

					if(pp_unit == "<?php echo $account['txt'];?>") {
						;
					} else {
						alert("신청금액을 <?php echo number_format($account['unit']);?>원 단위로 입력해 주세요.");
						f.pp_amount.focus();
						return false;
					}

					newWin = window.open("about:blank", "_frm", "width=500,height=600,scrollbars=yes,resizable=yes");

					f.target = "_frm";
					f.submit();

					return false;
				}
				</script>
			</div>
			<div class="panel-footer text-center">
				신청금액은 <b><?php echo number_format($account['unit']);?></b>원 단위로 입력할 수 있습니다.
			</div>
		</div>
	</div>
</div>

<div class="table-responsive">
	<table class="table bg-white">
	<tbody>
	<tr class="bg-black">
		<th class="text-center" scope="col">번호</th>
		<th class="text-center" scope="col">상태</th>
		<th class="text-center" scope="col">접수번호</th>
		<th class="text-center" scope="col">신청일</th>
		<th class="text-center" scope="col">출금방법</th>
		<th class="text-center" scope="col">정산유형</th>
		<th class="text-center" scope="col">신청금액</th>
		<th class="text-center" scope="col">공급가</th>
		<th class="text-center" scope="col">부가세</th>
		<th class="text-center" scope="col">제세공과</th>
		<th class="text-center" scope="col">실지급액</th>
		<th class="text-center" scope="col">메모</th>
		<th class="text-center" scope="col">비고</th>
	</tr>
	<?php for ($i=0; $i < count($list); $i++) { ?>
		<tr>
			<td class="text-center"><?php echo $list[$i]['pp_num'];?></td>
			<td class="text-center"><?php echo $list[$i]['pp_confirm'];?></td>
			<td class="text-center"><?php echo $list[$i]['pp_no'];?></td>
			<td class="text-center"><?php echo $list[$i]['pp_date'];?></td>
			<td class="text-center"><?php echo $list[$i]['pp_means'];?></td>
			<td class="text-center"><?php echo $list[$i]['pp_company'];?></td>
			<td class="text-right"><?php echo number_format($list[$i]['pp_amount']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['pp_net']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['pp_vat']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['pp_tax']);?></td>
			<td class="text-right"><?php echo number_format($list[$i]['pp_pay']);?></td>
			<td class="text-center">
				<?php if($list[$i]['pp_memo']) { ?>
					<a class="cursor" role="button" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="<span class='font-12'><?php echo $list[$i]['pp_memo'];?></span>">
					  <i class="fa fa-volume-up fa-lg"></i>
					</a>
				<?php } ?>
			</td>
			<td class="text-center">
				<?php if($list[$i]['pp_ans']) { ?>
					<a class="cursor" role="button" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="<span class='font-12'><?php echo $list[$i]['pp_ans'];?></span>">
					  <i class="fa fa-bell fa-lg"></i>
					</a>
				<?php } ?>			
			</td>
		</tr>
	<?php } ?>
	<?php if ($i == 0) { ?>
		<tr><td colspan="13" class="text-center">등록된 자료가 없습니다.</td></tr>
	<?php } ?>
	</tbody>
	</table>
</div>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
 </script>
</div>


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<?php
//html 팝업
include_once($skin_path.'/pop.pay-view.php'); //정산신청
?>

<div class="section-title">정산내역 </div>

<div class="boxContainer padding40">
	
	<form name="">
	<div class="data-search-wrap fx-wrap label120">				
		<div class="fx-list">
			<div class="fx-list-label">조회 기간</div>
			<div class="fx-list-con">
				<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<span>~</span>
				<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<div class="datepickContainer small">
					<a href="#" class="dl active">오늘</a>
					<a href="#" class="dl">1개월</a>
					<a href="#" class="dl">6개월</a>	
					<a href="#" class="dl">1년</a>	
					<a href="#" class="dl">5년</a>
					<a href="#" class="dl">전체</a>
				</div>
			</div>
		</div>
		<div class="fx-list">
			<div class="fx-list-label">검색어</div>
			<div class="fx-list-con">
				<input type="text" name="" value="" class="span450" placeholder="유저 ID/ 호스트 명을 입력해주세요.">
			</div>
		</div>
		<div class="btnSet">
			<button type="submit" class="btnSearch">조회</button>
			<a href="./?ap=<?php echo $ap;?>" class="btnReset">초기화</a>
		</div>
	</div>
	</form>

	<div class="tbl-basic outline line odd th-h1 fs15">
		<div class="tbl-header">
			<div class="right">
				<a href="#" class="btn">엑셀다운로드</a>
			</div>
		</div>
		<table>
			<colgroup>
				<col width="80">
				<col width="90">
				<col>
				<col>
				<col>
				<col>
				<col>
			</colgroup>
			<thead class="">
				<tr>
					<th scope="col" rowspan="2">NO</th>
					<th scope="col" rowspan="2">정산상태</th>
					<th scope="col" rowspan="2">정산번호</th>
					<th scope="col" rowspan="2">정산신청일</th>
					<th scope="col" rowspan="2">호스트명</th>
					<th scope="col" rowspan="2">모임명</th>
					<th scope="col" colspan="8">상세내역</th>
				</tr>
				<tr>
					<th scope="col">참여인원</th>
					<th scope="col">모임 결제금액</th>
					<th scope="col">모임 수익금액</th>
					<th scope="col">쿠폰사용</th>
					<th scope="col">포인트사용</th>
					<th scope="col">취소금액</th>
					<th scope="col">취소수수료</th>
					<th scope="col">정산수수료<br><sub>(플랫폼수수료)</sub></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>결제완료</td>
					<td>25314<br><span data-href="#pop-pay-view" class="pop-inline btn mini reverse" style="font-size:12px !important;">상세보기</span></td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>5</td>
					<td>371,347원</td>					
					<td>2,371,347원</td>
					<td>5,000*3</td>
					<td>3,000P</td>
					<td>0</td>
					<td>0</td>
					<td>371,347원</td>
				</tr>
				<tr>
					<td>2</td>
					<td>결제완료</td>
					<td>25315<br><span data-href="#pop-pay-view" class="pop-inline btn mini reverse" style="font-size:12px !important;">상세보기</span></td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>5</td>
					<td>371,347원</td>					
					<td>2,371,347원</td>
					<td>5,000*3</td>
					<td>3,000P</td>
					<td>0</td>
					<td>0</td>
					<td>371,347원</td>
				</tr>
				<tr>
					<td>3</td>
					<td>결제완료</td>
					<td>25316<br><span data-href="#pop-pay-view" class="pop-inline btn mini reverse" style="font-size:12px !important;">상세보기</span></td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>5</td>
					<td>371,347원</td>					
					<td>2,371,347원</td>
					<td>5,000*3</td>
					<td>3,000P</td>
					<td>0</td>
					<td>0</td>
					<td>371,347원</td>
				</tr>
				<tr>
					<td>4</td>
					<td>결제완료</td>
					<td>25317<br><span data-href="#pop-pay-view" class="pop-inline btn mini reverse" style="font-size:12px !important;">상세보기</span></td>
					<td>2022-08-11</td>
					<td>장모아</td>
					<td>서울 국립 민속박물관 같이 투어해요!</td>
					<td>5</td>
					<td>371,347원</td>					
					<td>2,371,347원</td>
					<td>5,000*3</td>
					<td>3,000P</td>
					<td>0</td>
					<td>0</td>
					<td>371,347원</td>
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