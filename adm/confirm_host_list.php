<?php
$sub_menu = "450300";
include_once('./_common.php');

	if($_POST['act_button'] == "선택승인") {

		if (!count($_POST['chk'])) {
			alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
		}

		$pt_register = date("Ymd"); //등록일
		for ($i=0; $i<count($_POST['chk']); $i++) {
			$k = $_POST['chk'][$i]; // 실제 번호를 넘김
			$partner = get_partner($_POST['pt_id'][$k]);
			$add_sql = "";
			if ($partner['pt_commission_2'] ==0 || $partner['pt_commission_2']=='')
				$add_sql .= ", pt_commission_2 = '{$apms['apms_commission_2']}' ";
			if ($partner['pt_commission_1'] ==0 || $partner['pt_commission_1']=='')
				$add_sql .= ", pt_commission_1 = '{$apms['apms_commission_1']}' ";
			if ($partner['pt_level'] < '3')
				$_POST['pt_level'][$k] = '3';
//			sql_query(" update {$g5['apms_partner']} set pt_register = '{$pt_register}', pt_partner = '{$_POST['ptr'][$k]}', pt_marketer = '{$_POST['pmkt'][$k]}', pt_level = '{$_POST['pt_level'][$k]}'  {$add_sql} where pt_id = '{$_POST['pt_id'][$k]}' ");
			sql_query(" update {$g5['apms_partner']} set pt_register = '{$pt_register}', pt_partner = '1', pt_marketer = '{$_POST['pmkt'][$k]}', pt_level = '2'  {$add_sql} where pt_id = '{$_POST['pt_id'][$k]}' ");
			//회원정보변경
			$mb = get_member($pt_id);
			$add_sql = "";
			if ($mb['mb_level'] < '3')
				$add_sql = ", mb_level = '3'";
			sql_query(" update {$g5['member_table']} set as_partner = '1', as_marketer = '{$_POST['pmkt'][$k]}' {$add_sql} where mb_id = '{$_POST['pt_id'][$k]}' ", false);

			// 2022-08-11. botbinoo, 호스트 승인시 포인트 지급
			if($config['cf_use_host_reg'] == 1) {
				$config = sql_fetch("select * from {$g5['config_table']} ");
				$cf_host_reg_point = isset($config['cf_host_reg_point']) && $config['cf_host_reg_point'] > 0 ? $config['cf_host_reg_point'] : 0;
				$sql = "update g5_member set mb_point = mb_point + {$cf_host_reg_point} where mb_id = '{$_POST['pt_id'][$k]}' ";
				$user = sql_fetch($sql);
			}
		}

	} else if($_POST['act_button'] == "일괄수정") {

		for ($i=0; $i<count($_POST['pt_id']); $i++) {
			$partner = get_partner($_POST['pt_id'][$i]);
			$add_sql = "";
			if ($partner['pt_commission_2'] ==0 || $partner['pt_commission_2']=='')
				$add_sql .= ", pt_commission_2 = '{$apms['apms_commission_2']}' ";
			if ($partner['pt_commission_1'] ==0 || $partner['pt_commission_1']=='')
				$add_sql .= ", pt_commission_1 = '{$apms['apms_commission_1']}' ";
			if ($partner['pt_level'] < '3')
				$_POST['pt_level'][$i] = '3';
			sql_query(" update {$g5['apms_partner']} set pt_partner = '{$_POST['ptr'][$i]}', pt_marketer = '{$_POST['pmkt'][$i]}', pt_level = '{$_POST['pt_level'][$i]}' {$add_sql} where pt_id = '{$_POST['pt_id'][$i]}' ", false);

			//회원정보변경
			$mb = get_member($pt_id);
			$add_sql = "";
			if ($mb['mb_level'] < '3')
				$add_sql = ", mb_level = '3'";
			sql_query(" update {$g5['member_table']} set as_partner = '{$_POST['ptr'][$i]}', as_marketer = '{$_POST['pmkt'][$i]}' {$add_sql} where mb_id = '{$_POST['pt_id'][$i]}' ", false);

			// 2022-08-11. botbinoo, 호스트 승인시 포인트 지급
			if($config['cf_use_host_reg'] == 1) {
				$config = sql_fetch("select * from {$g5['config_table']} ");
				$cf_host_reg_point = isset($config['cf_host_reg_point']) && $config['cf_host_reg_point'] > 0 ? $config['cf_host_reg_point'] : 0;
				$sql = "update g5_member set mb_point = mb_point + {$cf_host_reg_point} where mb_id = '{$_POST['pt_id'][$k]}' ";
				$user = sql_fetch($sql);
			}
		}

	}


// 탈퇴 호스트수
$row = sql_fetch(" select count(*) as cnt from {$g5['apms_partner']} where pt_leave <> '' ");
$leave_count = $row['cnt'];

// 검색
$sql_search = "";
if ($stx) {
	$sql_search .= " and {$sfl} like '%{$stx}%' ";
}

if (!$sst) {
    $sst = "a.pt_datetime";
    $sod = "desc";
}

// 2022-09-04. botbinoo, 호스트 승인을 하기 위한 목록이므로 호스트는 제외 (개인 고객은 0/1) - 아직 불필요 대기
// $sql_search = $sql_search . " and a.pt_leave = '' and a.pt_register = '' ";

$sql_order = " order by {$sst} {$sod} ";

$sql_common = " from {$g5['apms_partner']} a left join {$g5['member_table']} b on ( a.pt_id = b.mb_id ) ";

$sql = " select count(*) as cnt $sql_common where (1) $sql_search ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = (G5_IS_MOBILE) ? $config['cf_mobile_page_rows'] : $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select a.*, b.mb_nick, b.mb_email, b.mb_homepage {$sql_common} where (1) {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="/adm/confirm_host_list.php" class="ov_listall">전체목록</a>';
$g5['title'] = '호스트 승인 관리';
include_once('./admin.head.php');
?>
<style>
	.tbl_head02 td { text-align:center; }
	.pt-request { color:orangered; }
	.pg_wrap { padding-top:0px; padding-right:20px; }
</style>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">등록</span><span class="ov_num"> <?php echo number_format($total_count) ?>명</span></span>
    <span class="btn_ov01"><span class="ov_txt">탈퇴</span><span class="ov_num"> <?php echo number_format($leave_count) ?>명</span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
<input type="hidden" name="ap" value="plist">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="b.mb_nick"<?php echo get_selected($sfl, "b.mb_nick"); ?>>닉네임</option>
    <option value="a.pt_name"<?php echo get_selected($sfl, "a.pt_name"); ?>>이름</option>
	<option value="a.pt_id"<?php echo get_selected($sfl, "a.pt_id"); ?>>아이디</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<form name="fmemberlist" id="fmemberlist" action="./confirm_host_list.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="ap" value="plist">
<input type="hidden" name="mode" value="plist">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">

<div class="tbl_head01 tbl_wrap">
    <table>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">번호</th>
        <th scope="col">구분</th>
		<th scope="col"><?php echo apms_sort_link('a.pt_register') ?>승인일</a> / <?php echo apms_sort_link('a.pt_leave') ?>탈퇴일</a></th>
		<!--
		<th scope="col"><?php echo apms_sort_link('a.pt_partner') ?>호스트</a></th>
-->
        <th scope="col" col span="2">
			<!-- <?php echo apms_sort_link('a.pt_marketer') ?>추천인</a>
			/	 -->
			<?php echo apms_sort_link('a.pt_level') ?>레벨</a>
		</th>
		<th scope="col"><?php echo apms_sort_link('a.pt_type') ?>유형</a></th>
		<th scope="col"><?php echo apms_sort_link('b.mb_id') ?>닉네임</a></th>
        <th scope="col"><?php echo apms_sort_link('a.pt_name') ?>이름</a></th>
        <th scope="col"><?php echo apms_sort_link('a.pt_hp') ?>연락처</a></th>
        <th scope="col"><?php echo apms_sort_link('a.pt_email') ?>이메일</a></th>
        <th scope="col"><?php echo apms_sort_link('a.pt_company') ?>정산</a></th>
        <th scope="col"><?php echo apms_sort_link('a.pt_bank_limit') ?>출금</a></th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
	$list_num = $total_count - ($page - 1) * $rows;
    for ($i=0; $row=sql_fetch_array($result); $i++) {

		//구분
		$is_check = false;
		if($row['pt_leave']) { //탈퇴
			$p_active = '<span class="mb_leave_msg">탈퇴</span>';
			$p_status = '<span class="mb_leave_msg"><strike>'.preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $row['pt_leave']).'</strike></span>';
		} else if(($row['pt_level'] == '1' && $row['pt_register']) || ($row['pt_level'] != '1' && $row['pt_register'])) { //등록
			$p_active = '활동';
			$p_status = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $row['pt_register']);
		} else { //신청
			if($row['pt_host_status'] != '반려') {
				$p_active = '<span class="pt-request">대기</span>';
			} else {			
				$p_active = '<span class="pt-request">반려</span>';
			}
			if($row['pt_host_status'] != '반려') {
				$p_status = '<span class="pt-request">신청</span>';
			} else {			
				$p_status = '<span class="pt-request">반려</span>';
			}
			$is_check = true;
		}

		//유형
		$p_type = ($row['pt_type'] == "2") ? '개인' : '기업';

		$p_name = '탈퇴('.$row['pt_id'].')';
		if($row['mb_nick']) {
			$p_name = get_text($row['mb_nick']);
//			$p_name = apms_sideview($row['pt_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);
		}

		//수정
		$p_mod = '<a href="'. G5_ADMIN_URL.'/confirm_host_form.php?'.$qstr.'&amp;pt_id='.$row['pt_id'].'" class="btn btn_03">수정</a>';

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk" align="center">
            <input type="hidden" name="pt_id[<?php echo $i ?>]" class="pt_id" value="<?php echo $row['pt_id'] ?>" id="pt_id_<?php echo $i ?>">
			<?php if($is_check) { ?>
	            <input type="checkbox" name="chk[]" class="chk_btn" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<?php } else { ?>
				*
			<?php } ?>
        </td>
        <td align="center"><?php echo $list_num;?></td>
		<td align="center"><?php echo $p_active;?></td>
		<td align="center"><?php echo $p_status;?></td>
		<!--
        <td align="center">
            <input type="checkbox" name="ptr[<?php echo $i ?>]" value="1" id="ptr_<?php echo $i ?>"<?php echo ($row['pt_partner']) ? ' checked' : '';?>>
		</td>
			-->
        <td align="center" class="none">
		<!-- <?echo $row['pt_level']; ?>  -->
            <input type="checkbox" name="pmkt[<?php echo $i ?>]" value="1" id="pmkt_<?php echo $i ?>"<?php echo ($row['pt_marketer']) ? ' checked' : '';?>>
		</td>
        <td  align="center" style="width:50px;">
<!--			--><?php //echo get_member_level_select("pt_level[$i]", 1, 3, $row['pt_level']); ?>
<!--
            <select name="pt_level[<?php echo $i; ?>">
                <option value="1" <?php echo $row['pt_level'] == '1' ? 'selected' : ''; ?>>게스트</option>
                <option value="2" <?php echo $row['pt_level'] == '2' ? 'selected' : ''; ?>>호스트</option>
                <option value="3" <?php echo $row['pt_level'] == '3' ? 'selected' : ''; ?>>슈퍼호스트</option>
			</select>
			-->
			<?php 
			$memberLevel = '-';
			if($row['pt_level'] == '1' || $row['pt_level'] == '0') {
				$memberLevel = '게스트';
			}
			if($row['pt_level'] == '2') {
				$memberLevel = '호스트';
			}
			if($row['pt_level'] == '3') {
				$memberLevel = '슈퍼호스트';
			}
			echo $memberLevel; 
			?>
        </td>
		<td align="center"><?php echo $p_type;?></td>
		<td align="center"><?php echo $p_name;?></td>
		<td align="center"><b><?php echo $row['pt_name'];?></b></td>
		<td align="center"><?php echo $row['pt_hp'];?></td>
		<td align="center"><?php echo $row['pt_email'];?></td>
		<td align="center"><?php echo $row['pt_company'];?></td>
		<td align="center"><?php echo ($row['pt_bank_limit']) ? '불가' : '가능';?></td>
		<td class="td_mng td_mng_m"><?php echo $p_mod;?></td>
    </tr>
	<?php $list_num--; } ?>
	<?php if ($i == 0) { ?>
        <tr><td colspan="15" class="empty_table">등록된 호스트가 없습니다.</td></tr>
    <?php } ?>
    </tbody>
    </table>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;ap=plist&amp;page='); ?>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택승인" onclick="document.pressed=this.value" class="btn btn_02">
	<!--기존 onclick document.pressed=this.value; -->
	<input class="pop-inline btn btn_02"  onclick="$('#popup01').addClass('open');" type="button" name="act_button" value="선택반려" />
	<!--
	<input type="submit" name="act_button" value="일괄수정" onclick="document.pressed=this.value" class="btn_submit btn">
	-->
</div>

<div class="layer-popup" id="popup01">
	<div class="popContainer">
		<div class="pop-inner">
			<span class="pop-closer">팝업닫기</span>
			
			<header class="pop-header">
				반려사유
			</header>

			<div class="text_area">
				<textarea id="refuse_msg" placeholder="반려 사유를 입력해 주세요."></textarea>
			</div>

			<div class="btn_choice">
				<button type="button" class="btnSubmit popClose">확인</button>
			</div>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>

</form>

<script>
    $('.btnSubmit').click(function(){
        var chk = $('.chk_btn:checked').length;
        var arr = [];
        for (var i = 0; i < chk; i++) {
            arr.push($('.chk_btn:checked').eq(i).parent().prev('.pt_id').val());
        }
        $.ajax({
            type: "POST",
            url: '/ajax/sendRefuseEmail.php',
            data: {'ids': arr, 'host': 1, 'msg': $('#refuse_msg').val()},
            cache: false,
            async: false,
            dataType: "json",
            success: function (data) {
                console.log(data);
                alert('반려 메일이 발송되었습니다.');
            }
        })
    });

function fmemberlist_submit(f)
{
    if(document.pressed == "선택승인") {

		if (!is_checked("chk[]")) {
			alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
			return false;
		}

        if(!confirm("선택한 호스트를 정말 등록승인하시겠습니까?")) {
            return false;
        }

    } else if(document.pressed == "일괄수정") {

        if(!confirm("호스트와 추천인을 일괄수정하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
function check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

</script>
