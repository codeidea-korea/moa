<?php
$sub_menu = '520110';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$cp_method = $_GET['cp_method'];

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

$sql_common = " from {$g5['g5_shop_coupon_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if($sfd) {
    $sql_search .= " and ( ";

    switch($sfd) {
        case 'cp_length' :
            $sql_search .= " (cp_start >= '{$sch_startdt}' and cp_end <= '{$sch_enddt}') ";
            break;
        case 'cp_start' :
            $sql_search .= " (cp_start >= '{$sch_startdt}')";
            break;
        case 'cp_end' :
            $sql_search .= " (cp_end <= '{$sch_enddt}')";
            break;
        case 'cp_datetime' :
            $sql_search .= " (cp_start = '{$sch_startdt}')";
            break;
    }
    $sql_search .= " ) ";
}

if(isset($cp_method)) {
    $sql_search .= ' and cp_method = ' . $cp_method;
}

if (!$sst) {
    $sst  = "cp_no";
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

$sqlA = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
echo $sqlA;

$g5['title'] = '쿠폰관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$result = sql_query($sqlA);
$colspan = 9;
?>

<div class="boxContainer">

<div class="local_ov">
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 개</span></span>
</div>
<form name="fsearch1" id="fsearch1" class="local_sch01 local_sch none" method="get">

<select name="sfl" title="검색대상">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="cp_subject"<?php echo get_selected($_GET['sfl'], "cp_subject"); ?>>쿠폰이름</option>
    <option value="cp_id"<?php echo get_selected($_GET['sfl'], "cp_id"); ?>>쿠폰코드</option>
</select>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>



<form name="fsearch" id="fsearch" method="get">
<div class="data-search-wrap fx-wrap label120">
	<div class="fx-list none">
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
			<select name="sfl" title="검색대상" class="span150">
                <!-- <option value="cp_subject"<?php echo get_selected($_GET['sfl'], "cp_subject"); ?>>쿠폰명</option> -->
                <option value="cp_subject" selected>쿠폰명</option>
                <option value="cp_id"<?php echo get_selected($_GET['sfl'], "cp_id"); ?>>쿠폰번호</option>
			</select>
			<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="span250" placeholder="검색할 이름을 입력해주세요.">
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">기간</div>
		<div class="fx-list-con">
			<select name="sfd" id="sfd" class="span150">
				<option value="cp_length" <?php echo $sfd == 'cp_length' ? 'selected' : ''?>>쿠폰기간</option>
				<option value="cp_datetime" <?php echo $sfd == 'cp_datetime' ? 'selected' : ''?>>쿠폰등록일</option>
				<option value="cp_start" <?php echo $sfd == 'cp_start' ? 'selected' : ''?>>발급시작일</option>
				<option value="cp_end" <?php echo $sfd == 'cp_end' ? 'selected' : ''?>>발급종료일</option>
			</select>
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
	</div>
	<div class="fx-list">
		<div class="fx-list-label">혜택구분</div>
		<div class="fx-list-con">
			<input type="radio" name="cp_method" <?php echo $cp_method == '' ? 'checked' : ''?>  value=""  data-label="전체">
			<input type="radio" <?php echo $cp_method == '0' ? 'checked' : ''?> name="cp_method" value="0" data-label="개별상품할인">
			<input type="radio" <?php echo $cp_method == '1' ? 'checked' : ''?> name="cp_method" value="1" data-label="카테고리할인">
			<input type="radio" <?php echo $cp_method == '2' ? 'checked' : ''?> name="cp_method" value="2" data-label="주문금액할인">
			
		</div>
	</div>
	<div class="fx-lis none">
		<div class="fx-list-label">발급유형</div>
		<div class="fx-list-con">
			<input type="radio" name="r2" value="" checked data-label="전체">
			<input type="radio" name="r2" value="" data-label="코드 발급(직접입력)">
			<input type="radio" name="r2" value="" data-label="코드 발급(자동생성)">
			<input type="radio" name="r2" value="" data-label="코드 발급(자동발급)">
			<input type="radio" name="r2" value="" data-label="다운로드">
		</div>
	</div>
	<div class="fx-list none">
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
		<button type="button" class="btnReset">초기화</button>
	</div>
</div>
</form>

<form name="fcouponlist" id="fcouponlist" method="post" action="./couponlist_delete.php" onsubmit="return fcouponlist_submit(this);">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="token" value="">


<div class="tbl-basic outline th-h5 fs14 odd line-nth-1">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">쿠폰 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">쿠폰종류</th>
        <th scope="col">쿠폰코드</th>
        <th scope="col">쿠폰이름</th>
        <th scope="col">적용대상</th>
        <th scope="col">할인금액</th>
        <th scope="col">최소주문금액</th>
        <th scope="col"><?php echo subject_sort_link('mb_id') ?>회원아이디</a></th>
        <th scope="col"><?php echo subject_sort_link('cp_end') ?>사용기한</a></th>
        <th scope="col">사용회수</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
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

        $link1 = '<a href="./orderform.php?od_id='.$row['od_id'].'">';
        $link2 = '</a>';

        // 쿠폰사용회수
        $sql = " select count(*) as cnt from {$g5['g5_shop_coupon_log_table']} where cp_id = '{$row['cp_id']}' ";
        $tmp = sql_fetch($sql);
        $used_count = $tmp['cnt'];

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" id="cp_id_<?php echo $i; ?>" name="cp_id[<?php echo $i; ?>]" value="<?php echo $row['cp_id']; ?>">
            <input type="checkbox" id="chk_<?php echo $i; ?>" name="chk[]" value="<?php echo $i; ?>" title="내역선택">
        </td>
        <td><?php echo $cp_method; ?></td>
        <td><?php echo $row['cp_id']; ?></td>
        <td class="td_left"><?php echo $row['cp_subject']; ?></td>
        <td><?php echo $cp_target; ?></td>
        <td><?php echo $row['cp_price']; ?></td>
        <td><?php echo $row['cp_minimum'] ; ?></td>
        <td class="td_name sv_use"><div><?php echo $row['mb_id']; ?></div></td>
        <td class="td_datetime"><?php echo substr($row['cp_start'], 2, 8); ?> ~ <?php echo substr($row['cp_end'], 2, 8); ?></td>
        <td class="td_cntsmall"><?php echo number_format($used_count); ?></td>
        <td class="td_mng td_mng_s">
            <a href="./couponform.php?w=u&amp;cp_id=<?php echo $row['cp_id']; ?>&amp;<?php echo $qstr; ?>" class="btn btn_03"><span class="sound_only"><?php echo $row['cp_id']; ?> </span>수정</a>
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
<div class="btn_fixed_top">
     <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
   <a href="./couponform.php" id="coupon_add" class="btn btn_01">쿠폰 추가</a> 
</div>

</form>

</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
function fcouponlist_submit(f)
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

$('.btnReset').click(function(){
    $("select").val('default');
    $("select").selectpicker("refresh");
    $('input[name="stx"]').val('');
    $('input[name="cp_method"]').prop('checked', false);
    $('input[name="sch_startdt"]').val('');
    $('input[name="sch_enddt"]').val('');
})

$("#sfd").change(function(){
    var value = $(this).val();

    if(value == 'cp_length') {
        $('.sch_startdt').show();
        $('.sch_enddt').show();
        $('.datepickContainer').show();
    } else if(value == 'cp_start' || value == 'cp_datetime') {
        $('.sch_startdt').show();
        $('.sch_enddt').hide();
        $('.datepickContainer').hide();
        $('.middel').hide();
    } else if(value == 'cp_end') {
        $('.sch_startdt').hide();
        $('.sch_enddt').show();
        $('.datepickContainer').hide();
        $('.middel').hide();
    }
})
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>