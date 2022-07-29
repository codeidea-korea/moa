<?php
if (!defined('_GNUBOARD_')) exit;
include_once(G5_LIB_PATH.'/apms.account.lib.php');

$rday = getSearchDays();

//$parter = get_partner($member['mb_id']);

if ($sch_startdt =="") 
	$sch_startdt = $rday['year1ago'];
if ($sch_enddt =="") 
	$sch_enddt = $rday['today'];

$sch_startdt = ($sch_startdt) ? $sch_startdt : $rday['year1ago'];
$sch_enddt = ($sch_enddt) ? $sch_enddt : $rday['today'];
$sch_startdt = str_replace(".","-",$sch_startdt);
$sch_enddt = str_replace(".","-",$sch_enddt);



//검색결과
$sql_common = " from {$g5['apms_payment']} ";

$sql_search = "";
if ($stx) {
    $sql_search .= " and (  instr(b.mb_id, '$stx') or instr(b.mb_nick ,'$stx'))  ";
}
if ($sch_startdt) {
	$sql_search .=" and date(pp_datetime) between '{$sch_startdt}' and '{$sch_enddt}' ";
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
//echo nl2br($sql)."<BR>";
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

	<form name="frmSearch" action="/adm/apms_admin/apms.admin.php?ap=payment" method="post">
		<input type="hidden" name="ap" value="payment">
		<div class="data-search-wrap fx-wrap label120">
			<div class="fx-list">
				<div class="fx-list-label">조회 기간</div>
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
						setdate(4);
					});
					</script>
				</div>
			</div>
			<div class="fx-list">
				<div class="fx-list-label">검색어</div>
				<div class="fx-list-con">
					<input type="text" name="stx" value="<?php echo $stx;?>" class="span320" placeholder="호스트  id /호스트 명">		
					<button type="submit" class="btn span70">검색</button>
					<button type="button" class="btn reverse span80" onclick="location.href='/adm/apms_admin/apms.admin.php?ap=payment';">초기화</button>
				</div>
			</div>
		</div>
	</form>

	<div class="btn_list01 btn_list" style="margin-bottom:10px;">
		<input type="button" name="act_button" value="선택 출금" class="btn btn_02 btnSelWithdrawal">
		<input type="button" name="act_button" value="전체 출금" class="btn btn_02 btnAllWithdrawal">
	</div> 

	<div class="tbl-basic outline th-h5 fs15 odd line-nth-2">
		<form name="theForm" id="theForm" method="post" action="./apms.payment_save.php">
		<input type="hidden" name="withdrawal_type" id="withdrawal_type" value="">
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
					<th scope="col">출금 상태</th>
				</tr>
			</thead>
			<tbody>
			<?php
			for ($i=0; $row=sql_fetch_array($result); $i++) {

				$pp_num = $total_count - ($page - 1) * $rows - $i;

				$pp_no = $row['pp_id'];
				$pp_date = date("Y.m.d H:i", strtotime($row['pp_datetime']));

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

				$partner = get_partner($row['mb_id']);
				$pp_bankinfo = $partner['pt_bank_name']."<BR>".$partner['pt_bank_account'];

				//유형
				$pp_type = ($row['pp_type'] == "2") ? '개인' : '사업자';
				$pp_company = $row['pp_company'];

				$pp_name = '탈퇴('.$row['mb_id'].')';
				if($row['mb_nick']) {
					$pp_name = $row['mb_id'];//apms_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['wr_homepage']);
					$pp_name2 = $row['mb_nick'];//apms_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['wr_homepage']);
				}
				
				$pp_staff = '';
				if($row['pp_staff']) {
					$sinfo = get_member($row['pp_staff'], 'mb_nick, mb_email, mb_homepage');
					if($sinfo['mb_nick']) {
						$pp_staff = get_sideview($row['pp_staff'], get_text($sinfo['mb_nick']), $sinfo['mb_email'], $sinfo['mb_homepage']);
					}
				}

				//수정
				$pp_mod = '<a href="./apms.inquiry.php?no='.$row['pp_id'].'" class="mod-inquiry btn ">수정</a>';

				//$bg = 'bg'.($i%2);
				?>
				<tr>
					<td><input type="checkbox" name="chk[]" value="<?=$row['pp_id']?>" id="chk_<?php echo $i ?>"></td>
					<td><?php echo $pp_num;?></td>
					<td><?php echo $pp_name;?></td>
					<td><?php echo $pp_date;?></td>
					<td><?php echo number_format($pp_amount);?>원</td>
					<td><?php echo $pp_bankinfo;?></td>
					<td><?php echo $pp_name2;?></td>
					<td>
						<?php if ($row['pp_confirm'] == "0"){ ?>
							출금신청
						<?php }else if ($row['pp_confirm'] == "1"){?>
							출금완료
						<?php }else if ($row['pp_confirm'] == "2"){?>
							출금취소
						<?php }?>
					</td>
				</tr>
				<?php
				}
				if ($i == 0){ echo "<tr><td colspan=\"18\" class=\"empty_table\">자료가 없습니다.</td></tr>"; }
				?>
			</tbody>
		</table>
		</form>
	</div>

	<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;ap='.$ap.'&amp;page='); ?>

</div>

<script>
$(function() {
	$('.btnSelWithdrawal').click(function(){
		if (!is_checked("chk[]")) {
			alert("출금처리하실 항목을 하나 이상 선택하세요.");
			return false;
		}
		if (confirm('선택하신 항목을 출금처리하시겠습니까?')){
			$('#withdrawal_type').val('sel');
			$('#theForm').submit();
		}else{
			return false; 
		}
	});
	
	$('.btnAllWithdrawal').click(function(){
		if (confirm('모든 출금신청건을 출금처리하시겠습니까?')){
			$('#withdrawal_type').val('all');
			$('#theForm').submit();
		}else{
			return false; 
		}
	});
});
</script>
