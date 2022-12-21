<?php
$sub_menu = "500000";
include_once('./_common.php');

$g5['title'] .= '결제내역 수정';
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<div class="boxContainer padding40">

<form name="" id="" action="" onsubmit="" method="post">

<div class="tbl-excel tleft">
    <table>
    <colgroup>
        <col width="170">
        <col>
		<col width="170">
        <col>
    </colgroup>
    <tbody>
    <tr>
		<th>주문번호</th>
		<td>31231241</td>
		<th>결제번호</th>
		<td>CA1241214</td>
	</tr>
	<tr>
		<th>입금자명</th>
		<td>김모아</td>
		<th>사용자 ID</th>
		<td>21314412</td>
	</tr>
	<tr>
		<th>결제금액</th>
		<td>50,000원</td>
		<th>결제수단</th>
		<td>삼성카드 1111-****-****-1111</td>
	</tr>
	<tr>
		<th>결제날짜</th>
		<td>2022.03.14   11:12:45</td>
		<th>환불처리</th>
		<td>-</td>
	</tr>
	<tr>
		<th>포인트</th>
		<td>-1000점 차감</td>
		<th>쿠폰</th>
		<td>-5000원</td>
	</tr>
	<tr>
		<th>포인트</th>
		<td><input type="text" name="" value="1000" class="span160" placeholder="" data-label="차감"></td>
		<th rowspan="2">최종 결제 금액</th>
		<td rowspan="2">49,000원</td>
	</tr>
	<tr>
		<th>쿠폰</th>
		<td><input type="text" name="" value="5000" class="span160" placeholder="" data-label="할인" data-label-inline="원"></td>
	</tr>	
	</tbody>
	</table>

	<div class="mt10">
		<label class="checkbox-wrap"><input type="checkbox" name="" /><span></span>주문자님께 입금,주문내역을 메일로 발송합니다.</label>
	</div>
</div>



<div class="btn_fixed_top">
    <a href="./payment_list.php" class="btn btn_02">목록</a>
    <input type="submit" value="저장" class="btn_submit btn" accesskey='s'>
</div>
</form>

</div>


<?php
include_once('./admin.tail.php');
?>
