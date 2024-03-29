<?php
$sub_menu = "530120";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['point_table']} ";

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

if (!$sst) {
    $sst  = "po_id";
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

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$mb = array();
if ($sfl == 'mb_id' && $stx)
    $mb = get_member($stx);

$g5['title'] = '포인트관리';
include_once ('./admin.head.php');

$colspan = 9;

$po_expire_term = '';
if($config['cf_point_term'] > 0) {
    $po_expire_term = $config['cf_point_term'];
}

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>

<div class="boxContainer padding40">

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
    <?php
    if (isset($mb['mb_id']) && $mb['mb_id']) {
        echo '&nbsp;<span class="btn_ov01"><span class="ov_txt">' . $mb['mb_id'] .' 님 포인트 합계 </span><span class="ov_num"> ' . number_format($mb['mb_point']) . '점</span></span>';
    } else {
        $row2 = sql_fetch(" select sum(po_point) as sum_point from {$g5['point_table']} ");
        echo '&nbsp;<span class="btn_ov01"><span class="ov_txt">전체 합계</span><span class="ov_num">'.number_format($row2['sum_point']).'점 </span></span>';
    }
    ?>
</div>

<form name="fsearch" id="fsearch" class="local_sch012 local_sch2" method="get">
<!--
<div class="none">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="po_content"<?php echo get_selected($_GET['sfl'], "po_content"); ?>>내용</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</div>
-->

<div class="data-search-wrap fx-wrap label120">
	<div class="fx-list">
		<div class="fx-list-con">
			<select name="sfl" id="sfl">
				<option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
				<option value="po_content"<?php echo get_selected($_GET['sfl'], "po_content"); ?>>내용</option>
			</select>
			<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
			<button type="submit" class="btnSearch">검색</button>
			<a href="#" class="btnReset">초기화</a>
		</div>
	</div>
</div>
<script>
$('.btnReset').off().on('click', function(){
    $('#sfl').val('mb_id');
    $('#sfl').selectpicker('refresh');
    $('#stx').val('');
});
</script>
</form>

<form name="fpointlist" id="fpointlist" method="post" action="./point_list_delete.php" onsubmit="return fpointlist_submit(this);">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl-basic outline th-h5 td-h4 odd line-nth-1">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">포인트 내역 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col"><?php echo subject_sort_link('mb_id') ?>회원아이디</a></th>
        <th scope="col">이름</th>
        <th scope="col">닉네임</th>
        <th scope="col"><?php echo subject_sort_link('po_content') ?>포인트 내용</a></th>
        <th scope="col"><?php echo subject_sort_link('po_point') ?>포인트</a></th>
        <th scope="col"><?php echo subject_sort_link('po_datetime') ?>일시</a></th>
        <th scope="col">만료일</th>
        <th scope="col">포인트합</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
            $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
            $row2 = sql_fetch($sql2);
        }

        $mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);

        $link1 = $link2 = '';
        if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table']) {
            $link1 = '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$row['po_rel_table'].'&amp;wr_id='.$row['po_rel_id'].'" target="_blank">';
            $link2 = '</a>';
        }

        $expr = '';
        if($row['po_expired'] == 1)
            $expr = ' txt_expired';

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="hidden" name="po_id[<?php echo $i ?>]" value="<?php echo $row['po_id'] ?>" id="po_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['po_content'] ?> 내역</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class=""><a href="?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo $row['mb_id'] ?></a></td>
        <td class=""><?php echo get_text($row2['mb_name']); ?></td>
        <td class="sv_use"><div><?php echo $mb_nick ?></div></td>
        <td class=""><?php echo $link1 ?><?php echo $row['po_content'] ?><?php echo $link2 ?></td>
        <td class="td_num td_pt"><?php echo number_format($row['po_point']) ?></td>
        <td class="td_datetime"><?php echo $row['po_datetime'] ?></td>
        <td class="td_datetime2<?php echo $expr; ?>">
            <?php if ($row['po_expired'] == 1) { ?>
            만료<?php echo substr(str_replace('-', '', $row['po_expire_date']), 2); ?>
            <?php } else echo $row['po_expire_date'] == '9999-12-31' ? '&nbsp;' : $row['po_expire_date']; ?>
        </td>
        <td class="td_num td_pt"><?php echo number_format($row['po_mb_point']) ?></td>
    </tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
</div>

<div class="btn_fixed_top none">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

</div>

<div class="boxContainer padding40">
<!-- 
<section id="point_mng">
    <h2 class="mb15">포인트 수동지급 및 차감 관리</h2> -->

    
        <div class="wr-list flex-top">
			<div class="wr-list-label">포인트 수동지급 및 차감 관리</div>
			<div class="wr-list-con">
				<div class="tbl-excel td-h5">
                <form name="fpointlist2" method="post" id="fpointlist2" action="./point_update.php" autocomplete="off">
                <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                <input type="hidden" name="stx" value="<?php echo $stx ?>">
                <input type="hidden" name="sst" value="<?php echo $sst ?>">
                <input type="hidden" name="sod" value="<?php echo $sod ?>">
                <input type="hidden" name="page" value="<?php echo $page ?>">
                <input type="hidden" name="token" value="<?php echo $token ?>">
					<table>
						<colgroup>
							<col width="180">
							<col>
						</colgroup>
						<tbody>
							<tr>
								<th>포인트 적용 유저</th>
								<td class="tleft">
                                    <input type="text" name="mb_id" value="<?php echo $mb_id ?>" id="mb_id" class="required frm_input" required >
									<!-- <select class="span120" title="">
										<option>이름</option>
										<option>전화번호</option>
									</select>
									<input type="text" name="" value="" class="ml10 span220" placeholder=""><a href="#" class="ml10 btn reverse span100">조회<i class="arrow-right ml10"></i></a> -->
								</td>
                                <script>
                                $("#mb_id").click(function() {
                                    if($("#chk_all_mb").is(":checked")) {
                                        alert("전체회원 체크를 해제 후 이용해 주십시오.");
                                        return false;
                                    }

                                    var opt = "left=50,top=50,width=520,height=600,scrollbars=1";
                                    var url = "/adm/shop_admin/pointmember.php";
                                    window.open(url, "win_member", opt);
                                });
                                </script>
							</tr>
							<tr>
								<th>적용 포인트</th>
								<td class="tleft">
									<input type="text" name="po_point" id="po_point" required class="required frm_input" class="span160" placeholder="포인트 금액" data-label-right="point">
									
								</td>
							</tr>
                            <tr>
								<th>담당자ID</th>
								<td class="tleft">
									
									<input type="text" name="reg_mb_id" value="<?php echo $member['mb_id'];?>" class="ml10 span160" readOnly placeholder="담당자 아이디">
									
								</td>
							</tr>
                            <tr>
								<th>적용사유</th>
								<td class="tleft">
									
									
									<input type="text" name="po_content" id="po_content" required class="required frm_input" class="span500" placeholder="메모">
								</td>
							</tr>
                            <?php if($config['cf_point_term'] > 0) { ?>
                            <tr>
								<th>포인트 유효기간</th>
								<td class="tleft">
									
                                <input type="text" name="po_expire_term" value="<?php echo $po_expire_term; ?>" id="po_expire_term" class="frm_input" size="5"> 일
								</td>
							</tr>
                            <?php } ?>

                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div cla ss="btn_confirm01 btn_confirm">
                                        <input type="submit" value="확인" class="btn span60">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            </table>
						</tbody>			
					</table>
                   

                    </form>
				</div>
			</div>
		</div>
    <div class="tbl_frm01 tbl_wrap">
        <!-- <table>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="mb_id">회원아이디<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="mb_id" value="<?php echo $mb_id ?>" id="mb_id" class="required frm_input" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="po_content">포인트 내용<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="po_content" id="po_content" required class="required frm_input" size="80"></td>
        </tr>
        <tr>
            <th scope="row"><label for="po_point">포인트<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="po_point" id="po_point" required class="required frm_input">
				&nbsp;
				<input type="checkbox" name="po_exp" id="po_exp" value="1" data-label="경험치 반영">
			</td>
        </tr> -->
        
    </div>

   
   
<!-- </section> -->

</div>

<script>
function fpointlist_submit(f)
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
include_once ('./admin.tail.php');
?>
