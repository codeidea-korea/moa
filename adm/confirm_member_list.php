<?php
$sub_menu = "450100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

// $days = date("Y-m");
// if (!$stx1) 
//     $stx1 = $days;
// if (!$stx2)
//     $stx2 = $days;



$sql_common = " from g5_member where (1) ";
$sql_search = " AND mb_status <> '승인'";
if($mb_name) {
    $sql_search .= " AND mb_name like '%{$mb_name}%'";
}

if($mb_level) {
    $sql_search .= " AND mb_level = '{$mb_level}'";
}

if($mb_id) {
    $sql_search .= " AND mb_id like '%{$mb_id}%'";
}

if ($sch_startdt && $sch_enddt) {
    $sql_search .= " $where AND mb_datetime between '{$sch_startdt}' and '{$sch_enddt}' ";
}
else if ($sch_startdt && !$sch_enddt) {
    $sql_search .= " $where AND mb_datetime between '{$sch_startdt}' ";
}

$sql_order = " order by mb_no desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";


//echo nl2br($sql)."<BR>";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 멤버쉽 확인 ------------------------

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '승인 회원 관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
//echo $sql."<BR><BR><BR>";
$colspan = ($is_membership) ? 17 : 16;
?>

<div class="boxContainer">

	<form action="/adm/confirm_member_list.php" method="get" method="post">
	<div class="data-search-wrap fx-wrap label120">
		<div class="fx-list">
			<div class="fx-list-label">회원가입일</div>
			<div class="fx-list-con">
				<label class="inp-wrap label-inline"><input type="text" name="sch_startdt" value="<?php echo $sch_startdt; ?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<span>~</span>
				<label class="inp-wrap label-inline"><input type="text" name="sch_enddt" value="<?php echo $sch_enddt; ?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
			</div>
		</div>

		<div class="fx-list">
			<div class="fx-list-label">회원구분</div>
			<div class="fx-list-con">
				<select name="mb_level">
					<option value="">전체</option>
					<option value="3" <?php echo $mb_level == '3' ? 'selected' : ''; ?>>호스트</option>
					<option value="2" <?php echo $mb_level == '2' ? 'selected' : ''; ?>>게스트</option>
				</select>
			</div>
		</div>
		<div class="fx-list">
			<div class="fx-list-label">회원 이름</div>
			<div class="fx-list-con" style="max-width:200px">	
				<input type="text" name="mb_name" value="<?php echo $mb_name; ?>" class="span160" placeholder="">
			</div>
			<div class="fx-list-label">회원 아이디</div>
			<div class="fx-list-con">	
				<input type="text" name="mb_id" value="<?php echo $mb_id; ?>" class="span160" placeholder="">
				<!--<a href="#" class="btn reverse span70">조회</a>-->
			</div>
		</div>
		<div class="btnSet">
			<button type="submit" class="btnSearch">조회</button>
			<button type="button" class="btnReset">초기화</button>
		</div>
	</div>
	</form>

	<form name="" action="" method="post">

	<div class="tbl-basic outline th-h5 td-h6 odd line-nth-2">				
		<table>
			<colgroup>
				<col width="60">
				<col width="80">
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
				<col width="140">
				<col width="130">
			</colgroup>
			<thead>
				<tr>
					<th>선택</th>
					<th>NO</th>
					<th>이름</th>
					<th>이메일</th>
					<th>회원 구분</th>
					<th>직장인/프리랜서</th>					
					<th>핸드폰</th>
					<th>가입 신청 일시</th>
					<th>완료 일시</th>
					<th>상태</th>
				</tr>
			</thead>
			<tbody>
            <?php $i = 1; ?>
            <?php while($row = sql_fetch_array($result)) { ?>
				<tr>
					<td><input type="checkbox" name="chk[]" class="chk_btn" value="<?php echo $row['mb_id'] ?>" id="chk_<?php echo $i ?>"></td>
					<td><?php echo $i; ?></td>
					<td><a href="/adm/member_form.php?w=u&mb_id=<?php echo $row['mb_id']; ?>" class="color-blue underline"><?php echo $row['mb_name']; ?></a></td>
					<td><?php echo $row['mb_id']; ?></td>
					<td><?php echo $row['mb_level'] > 2 ? '호스트' : '게스트'; ?></td>
					<td><?php echo $row['job_kind']; ?></td>
					<td><?php echo $row['mb_hp']; ?></td>
					<td><?php echo date('Y-m-d', strtotime($row['mb_datetime'])); ?></td>
					<td><?php echo $row['mb_open_date']; ?></td>
					<td><?php echo $row['mb_status']; ?></td>
				</tr>
            <?php $i++;
            } ?>
			</tbody>
		</table>
	</div>

	<div class="btn_list01 btn_list">
		<input type="button" name="act_button" id="approval_btn" value="선택 승인" onclick="document.pressed=this.value" class="btn btn_02">
		<input type="button" name="act_button" id="refuse_btn" value="선택 거절" onclick="document.pressed=this.value" class="btn btn_02">
		<input type="button" name="act_button" id="all_approval_btn" value="모두 일괄 승인" onclick="document.pressed=this.value" class="btn btn_01">
	</div>

	<div class="btn_fixed_top none">
		<a href="#" class="btn btn_02">닫기</a>
		<a href="#" class="btn btn_01">저장</a>
	</div>

	</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

</div>

<script>
$(function() {
    $('#all_approval_btn').click(function(){
        if(confirm('상태를 바꾸시겠습니까?')) {
            $.ajax({
                type: "POST",
                url: '/ajax/changeMemberStatus.php',
                data: {'status': '승인'},
                cache: false,
                async: false,
                dataType: "json",
                success: function (data) {
                    alert('상태가 변경되었습니다.');
                    location.reload();
                }
            })
        } else {
            return false;
        }
    })

    $('#refuse_btn').click(function(){
        if(confirm('상태를 바꾸시겠습니까?')) {
            var chk = $('.chk_btn:checked').length;
            var arr = [];
            for (var i = 0; i < chk; i++) {
                arr.push($('.chk_btn:checked').eq(i).val());
            }
            $.ajax({
                type: "POST",
                url: '/ajax/changeMemberStatus.php',
                data: {'status': '반려', 'mb_id': arr},
                cache: false,
                async: false,
                dataType: "json",
                success: function (data) {
                    alert('상태가 변경되었습니다.');
                    location.reload();
                }
            })
        } else {
            return false;
        }
    })

    $('#approval_btn').click(function(){
        if(confirm('상태를 바꾸시겠습니까?')) {
            var chk = $('.chk_btn:checked').length;
            var arr = [];
            for (var i = 0; i < chk; i++) {
                arr.push($('.chk_btn:checked').eq(i).val());
            }
            $.ajax({
                type: "POST",
                url: '/ajax/changeMemberStatus.php',
                data: {'status': '승인', 'mb_id': arr},
                cache: false,
                async: false,
                dataType: "json",
                success: function (data) {
                    alert('상태가 변경되었습니다.');
                    location.reload();
                }
            })
        } else {
            return false;
        }
    })

    $('.btnReset').click(function(){
        $('select').val(' ');
        $('input[name="mb_name"]').val('');
        $('input[name="mb_id"]').val('');
        $('input[name="sch_startdt"]').val('');
        $('input[name="sch_enddt"]').val('');
    })
});
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택회원의 기본정보만 삭제되며 아이디, 닉네임 기록은 남습니다.\n\n선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    if(document.pressed == "완전삭제") {
        if(!confirm("선택회원의 회원정보 자체를 DB에서 완전히 삭제합니다.\n\n선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
