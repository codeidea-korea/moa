<?php
if (!defined('_GNUBOARD_')) exit;
include_once(G5_LIB_PATH.'/apms.account.lib.php');

if($mode == "payment") {

	//goto_url($go_url.'&amp;'.$qstr);
}

//검색결과
$sql_common = " from {$g5['apms_payment']} ";

$sql_search = "";
if ($stx) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
}

$sql_common = " from {$g5['apms_payment']} a left join {$g5['member_table']} b on ( a.mb_id = b.mb_id ) where (1) $sql_search ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = (G5_IS_MOBILE) ? $config['cf_mobile_page_rows'] : $config['cf_page_rows'];

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$sql = " select a.*, b.mb_nick, b.mb_email, b.mb_homepage {$sql_common} order by a.pp_confirm, a.pp_id desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="?ap=payment" class="ov_listall">전체목록</a>';

//전체현황
$account = array();
$account = apms_balance_sheet("@all");

$marketer = array();
$marketer = apms_balance_sheet("@all", 1);

//세션등록
set_session('pp_inquiry_id', $member['mb_id']);

?>
<style>
	.pt-request { color:orangered; }
	.pt-complete,
	.pt-complete a,
	.pt-complete span { color:#888; }
</style>

<div class="boxContainer">

<form name="" action="" method="post">
<div class="data-search-wrap fx-wrap label120">
	<div class="fx-list">
		<div class="fx-list-label">조회 기간</div>
		<div class="fx-list-con">
			<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
			<span>~</span>
			<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
			<div class="datepickContainer small">
				<a href="#" class="dl active">오늘</a>
				<a href="#" class="dl">내일</a>
				<a href="#" class="dl">1주</a>	
				<a href="#" class="dl">6개월</a>
				<a href="#" class="dl">전체</a>
			</div>
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">검색어</div>
		<div class="fx-list-con">
			<input type="text" name="" value="" class="span320" placeholder="호스트  id /호스트 명 /호스트 전화번호">		
			<a href="#" class="btn span70">검색</a>
			<a href="#" class="btn reverse span80">초기화</a>
		</div>
	</div>
</div>
</form>


<div class="local_ov01 local_ov none">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">신청내역</span><span class="ov_num"> <?php echo number_format($total_count) ?>건</span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch none" method="get">
<input type="hidden" name="ap" value="payment">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="a.pp_id"<?php echo get_selected($sfl, "a.pp_id"); ?>>접수번호</option>
	<option value="b.mb_nick"<?php echo get_selected($sfl, "b.mb_nick"); ?>>닉네임</option>
	<option value="a.mb_id"<?php echo get_selected($sfl, "a.mb_id"); ?>>아이디</option>
	<option value="a.pp_staff"<?php echo get_selected($sfl, "a.pp_staff"); ?>>담당자ID</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>


<div class="tbl-basic outline th-h5 fs15 odd line-nth-2">
    <table>
		<thead>
			<tr>
				<th scope="col"><input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)"></th>
				<th scope="col">NO</th>
				<th scope="col">사용자 ID (호스트)</th>
				<th scope="col">일시</th>
				<th scope="col">금액</th>
				<th scope="col">호스트 계좌번호</th>
				<th scope="col">호스트명</th>
				<th scope="col">출금 내역</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input type="checkbox" name="chk[]" value="" id=""></td>
				<td>5</td>
				<td>Ad1235</td>
				<td>2022.03.14   21:30:12</td>
				<td>300,000원</td>
				<td>카카오뱅크<br>33331621313</td>
				<td>김모임</td>
				<td><a href="#" class="btn small">출금완료</a></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="chk[]" value="" id=""></td>
				<td>4</td>
				<td>Ad1235</td>
				<td>2022.03.14   21:30:12</td>
				<td>300,000원</td>
				<td>카카오뱅크<br>33331621313</td>
				<td>김모임</td>
				<td><a href="#" class="btn small">출금완료</a></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="chk[]" value="" id=""></td>
				<td>3</td>
				<td>Ad1235</td>
				<td>2022.03.14   21:30:12</td>
				<td>300,000원</td>
				<td>카카오뱅크<br>33331621313</td>
				<td>김모임</td>
				<td><a href="#" class="btn small">출금완료</a></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="chk[]" value="" id=""></td>
				<td>2</td>
				<td>Ad1235</td>
				<td>2022.03.14   21:30:12</td>
				<td>300,000원</td>
				<td>카카오뱅크<br>33331621313</td>
				<td>김모임</td>
				<td><a href="#" class="btn small">출금완료</a></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="chk[]" value="" id=""></td>
				<td>1</td>
				<td>Ad1235</td>
				<td>2022.03.14   21:30:12</td>
				<td>300,000원</td>
				<td>카카오뱅크<br>33331621313</td>
				<td>김모임</td>
				<td><a href="#" class="btn small">출금완료</a></td>
			</tr>
		</tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
	<input type="submit" name="act_button" value="선택 출금" onclick="document.pressed=this.value" class="btn btn_02">
	<input type="submit" name="act_button" value="전체 출금" onclick="document.pressed=this.value" class="btn btn_02">
</div>



<div class="tbl_head01 tbl_wrap none">
    <table>
    <thead>
    <tr>
		<th scope="col">구 분</th>
		<th scope="col">총판매액(원)</th>
		<th scope="col">총수수료(원)</th>
		<th scope="col">총포인트(점)</th>
		<th scope="col">총순매출/순적립액(원)</th>
		<th scope="col">총인센티브(원)</th>
		<th scope="col">총배송비(원)</th>
		<th scope="col">총적립액(원)</th>
		<th scope="col">총지급액(원)</th>
		<th scope="col">지급요청(원)</th>
		<th scope="col">현재잔액(원)</th>
    </tr>
    </thead>
    <tbody>
	<tr>
		<td align="center">호스트(셀러)</td>
		<td class="td_num_right"><?php echo number_format($account['sale']);?></td>
		<td class="td_num_right"><b><?php echo number_format($account['commission']);?></b></td>
		<td class="td_num_right"><?php echo number_format($account['point']);?></td>
		<td class="td_num_right"><?php echo number_format($account['netsale']);?></td>
		<td class="td_num_right"><?php echo number_format($account['intensive']);?></td>
		<td class="td_num_right"><?php echo number_format($account['sendcost']);?></td>
		<td class="td_num_right"><b><?php echo number_format($account['netgross']);?></b></td>
		<td class="td_num_right"><?php echo number_format($account['payment']);?></td>
		<td class="td_num_right"><b><?php echo number_format($account['request']);?></b></td>
		<td class="td_num_right"><b><?php echo number_format($account['balance']);?></b></td>
	</tr>
	<!-- <tr>
		<td align="center">마케터(추천인)</td>
		<td class="td_num_right"><?php echo number_format($marketer['sale']);?></td>
		<td class="td_num_right">-</td>
		<td class="td_num_right">-</td>
		<td class="td_num_right"><?php echo number_format($marketer['profit']);?></td>
		<td class="td_num_right"><?php echo number_format($marketer['benefit']);?></td>
		<td class="td_num_right">-</td>
		<td class="td_num_right"><b><?php echo number_format($marketer['netgross']);?></b></td>
		<td class="td_num_right"><?php echo number_format($marketer['payment']);?></td>
		<td class="td_num_right"><b><?php echo number_format($marketer['request']);?></b></td>
		<td class="td_num_right"><b><?php echo number_format($marketer['balance']);?></b></td>
	</tr> -->
	<tr class="bg-light">
		<td align="center"><b>합 &nbsp; 계</b></td>
		<td class="td_num_right">-</td>
		<td class="td_num_right"><b><?php echo number_format($account['commission']);?></b></td>
		<td class="td_num_right"><?php echo number_format($account['point']);?></td>
		<td class="td_num_right"><?php echo number_format($account['netsale'] + $marketer['profit']);?></td>
		<td class="td_num_right"><?php echo number_format($account['intensive'] + $marketer['benefit']);?></td>
		<td class="td_num_right"><?php echo number_format($account['sendcost']);?></td>
		<td class="td_num_right"><b><?php echo number_format($account['netgross'] + $marketer['netgross']);?></b></td>
		<td class="td_num_right"><?php echo number_format($account['payment'] + $marketer['payment']);?></td>
		<td class="td_num_right"><b><?php echo number_format($account['request'] + $marketer['request']);?></b></td>
		<td class="td_num_right"><b><?php echo number_format($account['balance'] + $marketer['balance']);?></b></td>
	</tr>
	</tbody>
	</table>
</div>

<div class="local_desc01 local_desc none">
	출금신청 목록은 신청/완료/취소 순으로 출력되며, 계정현황에는 회사 판매분과 츨금현황 제외회원의 내역은 포함되어 있지 않습니다.
	&nbsp;
	<b>[<a href="<?php echo G5_ADMIN_URL;?>/apms_admin/apms.tax.php" target="_blank" style="text-decoration:none;">개인 호스트 원천징수내역</a>]</b>
</div>

<div class="tbl_head01 tbl_wrap none">
    <table>
    <thead>
    <tr>
		<th scope="col">번호</th>
		<th scope="col">상태</th>
		<th scope="col">접수번호</th>
        <th scope="col">담당자</th>
		<th scope="col">신청일</th>
		<th scope="col">호스트</th>
		<th scope="col">신청인</th>
		<th scope="col">출금방법</th>
		<th scope="col">정산유형</th>
		<th scope="col">신청금액(원)</th>
		<th scope="col">공급가액(원)</th>
		<th scope="col">부가세(원)</th>
		<th scope="col">제세공과(원)</th>
		<th scope="col">실지급액(원)</th>
		<th scope="col">신고금액(원)</th>
		<th scope="col">메모</th>
		<th scope="col">비고</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {

		$pp_num = $total_count - ($page - 1) * $rows - $i;

		$pp_no = $row['pp_id'];
		$pp_date = date("Y/m/d H:i", strtotime($row['pp_datetime']));

		switch($row['pp_means']) {
			case '1'	: $pp_means = AS_MP.'전환'; break;
			default		: $pp_means = '통장입금'; break;
		}

		switch($row['pp_confirm']) {
			case '1'	: $pp_confirm = '<span class="gray">완료</span>'; break;
			case '2'	: $pp_confirm = '<span class="crimson">취소</span>'; break;
			default		: $pp_confirm = '<span class="orangered">신청</span>'; break;
		}

		$pp_partner = ($row['pp_field']) ? '마케터' : '호스트';
		$pp_memo = (trim($row['pp_memo'])) ? '■' : '';
		$pp_ans = (trim($row['pp_ans'])) ? '◎' : '';

		$pp_amount = $row['pp_amount'];
		$pp_net = ceil($row['pp_amount'] / 1.1);
		$pp_vat = $row['pp_amount'] - $pp_net;
		$pp_tax = $row['pp_tax'];
		$pp_pay = $row['pp_pay'];
		$pp_shingo = $row['pp_shingo'];

		//유형
		$pp_type = ($row['pp_type'] == "2") ? '개인' : '기업';
		$pp_company = $row['pp_company'];

		$pp_name = '탈퇴('.$row['mb_id'].')';
		if($row['mb_nick']) {
			$pp_name = apms_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['wr_homepage']);
		}
		
		$pp_staff = '';
		if($row['pp_staff']) {
			$sinfo = get_member($row['pp_staff'], 'mb_nick, mb_email, mb_homepage');
			if($sinfo['mb_nick']) {
				$pp_staff = get_sideview($row['pp_staff'], get_text($sinfo['mb_nick']), $sinfo['mb_email'], $sinfo['mb_homepage']);
			}
		}

		//수정
		$pp_mod = '<a href="./apms.inquiry.php?no='.$row['pp_id'].'" class="mod-inquiry btn btn_03">수정</a>';

        //$bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo ($row['pp_confirm'] == "1") ? 'bg1 pt-complete' : 'bg0';?>">
        <td align="center"><?php echo $pp_num;?></td>
        <td align="center"><?php echo $pp_confirm;?></td>
		<td align="center"><?php echo $pp_no;?></td>
        <td align="center"><?php echo ($pp_staff) ? $pp_staff : '-';?></td>
		<td align="center"><?php echo $pp_date;?></td>
        <td align="center"><?php echo $pp_partner;?></td>
		<td align="center"><b><?php echo $pp_name;?></b></td>
		<td align="center"><?php echo $pp_means;?></td>
		<td align="center"><?php echo $pp_company;?></td>
		<td class="td_num_right"><?php echo number_format($pp_amount);?></td>
        <td class="td_num_right"><?php echo number_format($pp_net);?></td>
        <td class="td_num_right"><?php echo number_format($pp_vat);?></td>
		<td class="td_num_right"><?php echo number_format($pp_tax);?></td>
        <td class="td_num_right"><?php echo number_format($pp_pay);?></td>
        <td class="td_num_right"><?php echo number_format($pp_shingo);?></td>
		<td align="center"><?php echo $pp_memo;?></td>
        <td align="center"><?php echo $pp_ans;?></td>
        <td class="td_mng td_mng_m"><?php echo $pp_mod;?></td>
	</tr>

	<?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"18\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;ap='.$ap.'&amp;page='); ?>

</div>

<script>
$(function() {
    $(".mod-inquiry").click(function() {
        var opt = "left=50,top=50,width=520,height=600,scrollbars=1";
        var url = this.href;
        window.open(url, "win_inquiry", opt);
		return false;
	});
});
</script>
