<?php
$sub_menu = "500000";
include_once('./_common.php');

$g5['title'] = '결제내역';
include_once(G5_ADMIN_PATH.'/admin.head.php');

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

$fr_date = preg_replace('/[^0-9]/i', '', $fr_date);
$to_date = preg_replace('/[^0-9]/i', '', $to_date);

$fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
$to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);

$g5['title'] = $fr_date.' ~ '.$to_date.' 일간 매출현황';
include_once (G5_ADMIN_PATH.'/admin.head.php');

function print_line($save)
{
    $date = preg_replace("/-/", "", $save['od_date']);

    ?>
    <tr>
        <td class="td_alignc"><a href="./sale1today.php?date=<?php echo $date; ?>"><?php echo $save['od_date']; ?></a></td>
        <td class="td_num"><?php echo number_format($save['ordercount']); ?></td>
        <td class="td_numsum"><?php echo number_format($save['orderprice']); ?></td>
        <td class="td_numcoupon"><?php echo number_format($save['ordercoupon']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptbank']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptvbank']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptiche']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptcard']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receipthp']); ?></td>
        <td class="td_numincome"><?php echo number_format($save['receiptpoint']); ?></td>
        <td class="td_numcancel1"><?php echo number_format($save['ordercancel']); ?></td>
        <td class="td_numrdy"><?php echo number_format($save['misu']); ?></td>
        <td class="td_numsum"><?php echo number_format($save['cash']); ?></td>
	</tr>
    <?php
}

$sql = " select od_id,
            SUBSTRING(od_time,1,10) as od_date,
            od_settle_case,
            od_receipt_price,
            od_receipt_point,
            od_cart_price,
            od_cancel_price,
            od_misu,
            (od_cart_price + od_send_cost + od_send_cost2) as orderprice,
            (od_cart_coupon + od_coupon + od_send_coupon) as couponprice
       from {$g5['g5_shop_order_table']}
      where SUBSTRING(od_time,1,10) between '$fr_date' and '$to_date'
      order by od_time desc ";
$result = sql_query($sql);

//html 팝업
include_once(G5_ADMIN_PATH.'/_add/pop.payment_view.php'); //내역서
?>

<div class="boxContainer">

	<form name="" action="" method="post">
	<div class="data-search-wrap fx-wrap label120">
		<div class="fx-list">
			<div class="fx-list-con">
				<select class="">
					<option>모든 결제</option>
					<option>사용자 ID</option>
					<option>사용자 이름</option>
				</select>
				<input type="text" name="" value="" class="span190" placeholder="검색"><!--<a href="#" class="btn reverse span70">조회</a>-->
			</div>
		</div>
		<div class="fx-list">
			<span class="sch_startdt" <?php echo $sfd == 'cp_end' || $sfd == 'cp_datetime' ? 'style="display:none"' : ''?> >
			    <label class="inp-wrap label-inline"><input type="text" id="sch_startdt"  name="sch_startdt" value="<?php echo $sch_startdt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
            </span>
            <span class="middel" <?php echo $sfd == 'cp_end' || $sfd == 'cp_datetime' || $sfd == 'cp_start' ? 'style="display:none"' : ''?> >~</span>
            <span class="sch_enddt" <?php echo $sfd == 'cp_start' ? 'style="display:none"' : ''?> >
                <label class="inp-wrap label-inline"><input type="text" id="sch_enddt" name="sch_enddt" value="<?php echo $sch_enddt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
            </span>
            <div class="datepickContainer small" <?php echo $sfd == 'cp_end' || $sfd == 'cp_datetime' || $sfd == 'cp_start' ? 'style="display:none"' : ''?>>
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
            </script>
			
		</div>
		<div class="btnSet ml0">
			<button type="submit" class="btnSearch">조회</button>
			<a href="#" class="btnReset">초기화</a>
		</div>
	</div>
	</form>
	<div>
        <form name="frm_sale_date" action="/adm/_add/payment_list.php"  method="post">
       
        <strong>일간 매출</strong>
        <input type="text" name="fr_date" value="<?php echo date("Ym01", G5_SERVER_TIME); ?>" id="fr_date" required class="required frm_input" size="8" maxlength="8">
        <label for="fr_date">일 ~</label>
        <input type="text" name="to_date" value="<?php echo date("Ymd", G5_SERVER_TIME); ?>" id="to_date" required class="required frm_input" size="8" maxlength="8">
        <label for="to_date">일</label>
        <input type="submit" value="확인" class="btn_submit">
        </form>
    </div>
	<div class="mt70"></div>

	<div class="box-header">
		<!-- <a href="#" class="btn span110 reverse gray">회원 삭제</a>
		<a href="#" class="btn span110 reverse gray">로그인 정보</a>
		<a href="#" class="btn span110 gray">회원등록</a> -->
		<div class="right">
			<a href="#" class="btn span150">엑셀 다운로드</a>
			<select class="" title="">
				<option>최신순 / 과거순</option>
				<option>OOO</option>
				<option>OOO</option>
				<option>...</option>
			</select>
		</div>
	</div>

	<form name="" id="" action="" onsubmit="" method="post">
	<div class="tbl-basic fs13 outline odd line-nth-1">
		<table>
		<thead>
		<tr>
			<th scope="col">번호</th>
			<th scope="col">주문번호</th>
			<th scope="col">class ID</th>
			<th scope="col">사용자 ID</th>
			<th scope="col">사용자 이름</th>
			<th scope="col">모임명</th>
			<th scope="col">결제금액</th>
			<th scope="col">쿠폰</th>  
			<th scope="col">포인트</th>
			<th scope="col">결제수단</th>
			<th scope="col">결제내역 출력</th>
			<th scope="col">결제상태</th>  
			<th scope="col">결제일</th>
			<th scope="col">관리</th>
		</tr>
		</thead>
		<tbody>

		<tr>
			<td>1</td>
			<td>1114214</td>
			<td>213114</td>
			<td>313133</td>
			<td>정모아</td>
			<td>함께해요 플라워 클래스</td>
			<td>50,000원</td>
			<td>0</td>
			<td>-10,000원</td>
			<td>카드결제</td>
			<td><span data-href="#pop-payment-view" class="pop-inline color-blue">내역서</span></td>
			<td>결제완료</td> <!-- [결제완료, 입금대기, 결제완료, 입금대기, 결제미완료 (미입금 자동 주문취소)] -->
			<td>2022-02.04</td>
			<td class="td_mng">
				<a href="./payment_form.php" class="btn btn_03">수정</a>
				<a href="#" class="btn btn_01">삭제</a>
				<a href="#" class="btn btn_02">환불</a>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>1114214</td>
			<td>213114</td>
			<td>313133</td>
			<td>정모아</td>
			<td>드레스 만들기</td>
			<td>24,000원</td>
			<td>-5,000원</td>
			<td>0</td>
			<td>입금대기</td>
			<td><span data-href="#pop-payment-view" class="pop-inline color-blue">내역서</span></td>
			<td>계좌이체</td>
			<td>2022-02.04</td>
			<td class="td_mng">
				<a href="./payment_form.php" class="btn btn_03">수정</a>
				<a href="#" class="btn btn_01">삭제</a>
				<a href="#" class="btn btn_02">환불</a>
			</td>
		</tr>
			
		</tbody>
		</table>
	</div>

	</form>

	<nav class="pg_wrap">
		<span class="pg">
			<a href="#" class="pg_page pg_start">처음</a>
			<a href="#" class="pg_page pg_prev">이전</a>
			<span class="sound_only">현재</span><strong class="pg_current">1</strong><span class="sound_only">페이지</span>
			<a href="#" class="pg_page">2<span class="sound_only">페이지</span></a>
			<a href="#" class="pg_page">3<span class="sound_only">페이지</span></a>
			<a href="#" class="pg_page">4<span class="sound_only">페이지</span></a>
			<a href="#" class="pg_page">5<span class="sound_only">페이지</span></a>
			<a href="#" class="pg_page pg_next">다음</a>
			<a href="#" class="pg_page pg_end">맨끝</a>
		</span>
	</nav>

</div>

<div class="tbl-basic fs13 outline odd line-nth-1">

    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th scope="col">주문일</th>
        <th scope="col">주문수</th>
        <th scope="col">주문합계</th>
        <th scope="col">쿠폰</th>
        <th scope="col">무통장</th>
        <th scope="col">가상계좌</th>
        <th scope="col">계좌이체</th>
        <th scope="col">카드입금</th>
        <th scope="col">휴대폰</th>
        <th scope="col">포인트입금</th>
        <th scope="col">주문취소</th>
        <th scope="col">미수금</th>
        <th scope="col">현금</th>
	</tr>
    </thead>
    <tbody>
    <?php
    unset($save);
    unset($tot);
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        if ($i == 0)
            $save['od_date'] = $row['od_date'];

        if ($save['od_date'] != $row['od_date']) {
            print_line($save);
            unset($save);
            $save['od_date'] = $row['od_date'];
        }

        $save['ordercount']++;
        $save['orderprice']    += $row['orderprice'];
        $save['ordercancel']   += $row['od_cancel_price'];
        $save['ordercoupon']   += $row['couponprice'];
        if($row['od_settle_case'] == '무통장')
            $save['receiptbank']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $save['receiptvbank']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $save['receiptiche']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $save['receipthp']   += $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $save['receiptcard']   += $row['od_receipt_price'];
        $save['receiptpoint']  += $row['od_receipt_point'];
        $save['misu']          += $row['od_misu'];

		$cash = $row['od_receipt_price'] - $row['od_cancel_price'];
		$cash = ($cash > 0) ? $cash : 0;
		$save['cash']          += $cash;

        $tot['ordercount']++;
        $tot['orderprice']     += $row['orderprice'];
        $tot['ordercancel']    += $row['od_cancel_price'];
        $tot['ordercoupon']    += $row['couponprice'];
        if($row['od_settle_case'] == '무통장')
            $tot['receiptbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '가상계좌')
            $tot['receiptvbank']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '계좌이체')
            $tot['receiptiche']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '휴대폰')
            $tot['receipthp']    += $row['od_receipt_price'];
        if($row['od_settle_case'] == '신용카드')
            $tot['receiptcard']    += $row['od_receipt_price'];
        $tot['receiptpoint']  += $row['od_receipt_point'];
        $tot['misu']           += $row['od_misu'];
        $tot['cash']           += $cash;
	}

    if ($i == 0) {
        echo '<tr><td colspan="13" class="empty_table">자료가 없습니다.</td></tr>';
    } else {
        print_line($save);
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td>합계</td>
        <td class="td_num_right"><?php echo number_format($tot['ordercount']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['orderprice']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['ordercoupon']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptbank']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptvbank']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptiche']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptcard']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receipthp']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['receiptpoint']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['ordercancel']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['misu']); ?></td>
        <td class="td_num_right"><?php echo number_format($tot['cash']); ?></td>
	</tr>
    </tfoot>
    </table>
</div>

<?php
include_once ('./admin.tail.php');
?>
