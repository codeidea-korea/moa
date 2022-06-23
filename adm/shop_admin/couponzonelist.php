<?php
$sub_menu = '520100';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$sql_common = " from {$g5['g5_shop_coupon_zone_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and cz_subject like '%$stx%' ";
}

if (!$sst) {
    $sst  = "cz_id";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '쿠폰존관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$colspan = 9;
?>

<?php
//html 팝업
include_once(G5_ADMIN_PATH.'/_add/pop.coupon-use-state.php'); //쿠폰사용현황
include_once(G5_ADMIN_PATH.'/_add/pop.coupon-send.php'); //쿠폰발송
?>

<div class="boxContainer">

<form name="" action="" method="post">
<div class="data-search-wrap fx-wrap label120">
	<div class="fx-list">
		<div class="fx-list-label">적용대상</div>
		<div class="fx-list-con">
			<input type="checkbox" name="" value="" checked data-label="전체" />
			<input type="checkbox" name="" value="" data-label="온라인" />
			<input type="checkbox" name="" value="" data-label="오프라인" />
			<input type="checkbox" name="" value="" data-label="게스트" />
			<input type="checkbox" name="" value="" data-label="호스트" />
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">적용대상</div>
		<div class="fx-list-con">
			<select class="span150">
				<option>쿠폰명</option>
				<option>쿠폰번호</option>
			</select>
			<input type="text" name="" value="" class="span250" placeholder="검색할 이름을 입력해주세요.">			
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">기간</div>
		<div class="fx-list-con">
			<select class="span150">
				<option>쿠폰기간</option>
				<option>쿠폰등록일</option>
				<option>발급시작일</option>
				<option>발급종료일</option>
			</select>
			<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
			<span>~</span>
			<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
			<div class="datepickContainer small">
				<a href="#" class="dl active">오늘</a>
				<a href="#" class="dl">내일</a>
				<a href="#" class="dl">6개월</a>	
				<a href="#" class="dl">1년</a>	
				<a href="#" class="dl">5년</a>
				<a href="#" class="dl">전체</a>
			</div>
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">혜택구분</div>
		<div class="fx-list-con">
			<input type="radio" name="r1" value="" checked data-label="전체">
			<input type="radio" name="r1" value="" data-label="주문 적용 쿠폰">
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">발급유형</div>
		<div class="fx-list-con">
			<input type="radio" name="r2" value="" checked data-label="전체">
			<input type="radio" name="r2" value="" data-label="코드 발급(직접입력)">
			<input type="radio" name="r2" value="" data-label="코드 발급(자동생성)">
			<input type="radio" name="r2" value="" data-label="코드 발급(자동발급)">
			<input type="radio" name="r2" value="" data-label="다운로드">
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">발급상태</div>
		<div class="fx-list-con">
			<input type="checkbox" name="" value="" checked data-label="전체" />
			<input type="checkbox" name="" value="" data-label="발급 대기" />
			<input type="checkbox" name="" value="" data-label="발급 중" />
			<input type="checkbox" name="" value="" data-label="발급 중지" />
			<input type="checkbox" name="" value="" data-label="발급 종료" />
		</div>
	</div>
	<div class="btnSet flex-center">
		<button type="submit" class="btnSearch">조회</button>
		<a href="#" class="btnReset">초기화</a>
	</div>
</div>
</form>

<div class="local_ov none">
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 개</span></span>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch none" method="get">
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>


<form name="fcouponlist" id="fcouponzonelist" method="post" action="./couponzonelist_delete.php" onsubmit="return fcouponzonelist_submit(this);">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="token" value="">

<div class="tbl-basic outline th-h5 fs14 odd line-nth-1">
	<div class="tbl-header">검색결과 총 <?php echo number_format($total_count) ?>건</div>
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
	<tr class="none">
        <th scope="col">
            <label for="chkall" class="sound_only">쿠폰 전체</label>
            <!--<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">-->
        </th>
        <th scope="col">쿠폰이름</th>
        <th scope="col">쿠폰종류</th>
        <th scope="col">적용대상</th>
        <th scope="col">쿠폰금액</th>
        <th scope="col">쿠폰사용기한</th>
        <th scope="col">다운로드</th>
        <th scope="col">사용기한</th>
        <th scope="col">관리</th>
    </tr>

    <tr>
		<th scope="col">
			<label for="chkall" class="sound_only">쿠폰 전체</label>
			<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
		</th>
		<th scope="col">쿠폰번호</th>
		<th scope="col">적용대상</th>
		<th scope="col">발급상태</th>
		<th scope="col">쿠폰명</th>
		<th scope="col">발급유형</th>
		<th scope="col">혜택구분</th>
		<th scope="col">할인금액</th>
		<th scope="col">최소기준금액</th>
		<th scope="col">발급현황</th>
		<th scope="col">운영자발급현황</th>
		<th scope="col">사용현황</th>
		<th scope="col">발급시작일</th>
		<th scope="col">발급종료일</th>
		<th scope="col">등록일</th>
		<th scope="col">쿠폰발송</th>
		<th scope="col">관리</th>
    </tr>	
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        switch($row['cz_type']) {
            case '1':
                $cz_type = '포인트쿠폰';
                break;
            default:
                $cz_type = '다운로드쿠폰';
                break;
        }

        switch($row['cp_method']) {
            case '0':
                $sql3 = " select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['cp_target']}' ";
                $row3 = sql_fetch($sql3);
                $cp_method = '개별상품할인';
                $cp_target = get_text($row3['it_name']);
                break;
            case '1':
                $sql3 = " select ca_name from {$g5['g5_shop_category_table']} where ca_id = '{$row['cp_target']}' ";
                $row3 = sql_fetch($sql3);
                $cp_method = '카테고리할인';
                $cp_target = get_text($row3['ca_name']);
                break;
            case '2':
                $cp_method = '주문금액할인';
                $cp_target = '주문금액';
                break;
            case '3':
                $cp_method = '배송비할인';
                $cp_target = '배송비';
                break;
        }

        if($row['cp_type'])
            $cp_price = $row['cp_price'].'%';
        else
            $cp_price = number_format($row['cp_price']).'원';

        $bg = 'bg'.($i%2);
    ?>

	<tr>
		<td class="td_chk">
			<input type="hidden" id="cz_id_<?php echo $i; ?>" name="cz_id[<?php echo $i; ?>]" value="<?php echo $row['cz_id']; ?>">
			<input type="checkbox" id="chk_<?php echo $i; ?>" name="chk[]" value="<?php echo $i; ?>" title="내역선택">
		</td>
		<td>8245</td>
		<td><?php echo $cp_method; ?></td>
		<td>발급완료</td>
		<td><?php echo get_text($row['cz_subject']); ?></td>
		<td>상품적용 구분</td>
		<td><?php echo $cz_type; ?></td>
		<td><?php echo $cp_price; ?></td>
		<td><?=$row['cp_minimum']?>원 이상</td>
		<td>23/100</td>
		<td>12</td>
		<td>2<span data-href="#pop-coupone-use-state" class="pop-inline btn gray mini fs11 ml10" style="font-size:12px !important;">상세보기</span></td>
		<td><?php echo substr($row['cz_start'], 2, 8); ?></td>
		<td><?php echo substr($row['cz_end'], 2, 8); ?></td>
		<td>2022.03.14 05:12:22</td>
		<td><span data-href="#pop-coupon-send" id="pop_<?=$i?>" class="pop-inline btn green mini fs11 ml10" style="font-size:12px !important;">쿠폰발송</span></td>

		<td class="td_left none"><?php echo get_text($row['cz_subject']); ?></td>
        <td class="td_type none"><?php echo $cz_type; ?></td>
        <td class="td_type none"><?php echo $cp_method; ?></td>
        <td class="td_odrnum2 none"><?php echo $cp_price; ?></td>
        <td  class="td_type none">다운로드 후 <?php echo $row['cz_period']; ?>일</td>
        <td class="td_num none"><?php echo number_format($row['cz_download']); ?></td>
        <td class="td_datetime none"><?php echo substr($row['cz_start'], 2, 8); ?> ~ <?php echo substr($row['cz_end'], 2, 8); ?></td>

		<td class="td_mng td_mng_s">
			<a href="./couponzoneform.php?w=u&amp;cz_id=<?php echo $row['cz_id']; ?>&amp;<?php echo $qstr; ?>" class="btn btn_03"><span class="sound_only"><?php echo get_text($row['cz_subject']); ?> </span>수정</a>
		</td>
	</tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<script>
$(document).ready(function(){
	//$('#pop_1').click();
});
</script>


<div class="btn_list01 btn_list">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
</div>

<div class="btn_fixed_top">
   <a href="./couponzoneform.php" id="coupon_add" class="btn btn_01">쿠폰 등록</a>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

</div>

<script>
function fcouponzonelist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>