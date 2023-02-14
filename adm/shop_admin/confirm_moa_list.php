<?php
$sub_menu = '400420';
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

// $days = date("Y-m");
// if (!$stx1) 
//     $stx1 = $days;
// if (!$stx2)
//     $stx2 = $days;


$sql_common = " FROM deb_class_item a join g5_shop_item b on a.it_id = b.it_id join g5_write_class c on b.it_2 = c.wr_id 
               ";

$sql_order = " group by c.wr_id order by a.it_id desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 100;

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 멤버쉽 확인 ------------------------

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '신청한 모임 승인관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
?>



<div class="boxContainer">

	<form name="" action="" method="post">
	<div class="tbl-basic outline th-h2 td-h3 odd line-nth-2">
		<table>
			<colgroup>
				<col width="60">
				<col width="70">
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
				<col width="120">
				<col width="120">
			</colgroup>
			<thead>
				<tr>
					<th>선택</th>
					<th>NO</th>
					<th>썸네일</th>
					<th>Class ID</th>
					<th>모임명</th>
					<th>모임 형태 1</th>					
					<th>모임 형태 2</th>
					<th>모임 스케줄 등록일</th>
					<th>가격</th>
<!--					<th>진행 기간</th>-->
<!--					<th>모집 인원<br><sub>(최소/최대)</sub></th>-->
					<th>승인 여부</th>
				</tr>
			</thead>
			<tbody>
            <?php $i = 1; ?>
            <?php while($row = sql_fetch_array($result)) { ?>
				<tr>
					<td><input type="checkbox" class="chk_btn" name="chk[]" value="<?php echo $row['wr_id']; ?>" id="chk_<?php echo $i ?>"></td>
					<td><?php echo $i; ?></td>
					<td><img src="<?php echo $row['as_thumb']; ?>" alt="샘플이미지" width="30px" height="30px"></td>
					<td><a href="/shop/item.php?it_id=<?php echo $row['it_id']; ?>" class="color-blue underline"><?php echo $row['it_id']; ?></a>
					<td><a href="/adm/shop_admin/moa_write.php?bo_table=class&w=u&wr_id=<? echo $row['wr_id']; ?>" class="color-blue underline"><?php echo $row['wr_subject']; ?></a></td>
					<td><?php echo $row['moa_onoff']; ?></td>
					<td><?php echo $row['cls_no'] ? $row['cls_no'] : 1; ?>회차</td>
                    <!--
					<td><?php echo date('Y-m-d', strtotime($row['day'])) . ' confirm_moa_list.php' . date('H시', strtotime($row['time'])); ?></td>
                    -->
					<td><?php echo date('Y-m-d', strtotime($row['day'])) . ' ' . date('H시', strtotime($row['time'])); ?></td>
					<td><?php echo number_format($row['it_price']); ?>원</td>
<!--					<td>2022.03.14 ~ 2022.05.14</td>-->
<!--                    --><?php //$apply_info = countAplyerMoaClass($row['it_id']);
//                        echo print_r($apply_info);
//                        echo $row['it_id'];
//                    ?>
<!--					<td>--><?php //echo $apply_info['aplyer'] . '/' . $apply_info['tot']; ?><!--</td>-->
					<td>
                        <?
                        if($row['moa_status'] == 6) {
                            ?>정산됨<?
                        } else if($row['moa_status'] == 5 || $row['moa_status'] == '폐강') {
                            ?>폐강<?
                        } else {
                        ?>
						<select name="moa_status" class="moa_status" class="span90" data-wr_id="<?php echo $row['wr_id']; ?>">
							<option value="0" <?php echo $row['moa_status'] == '0' ? 'selected' : ''; ?>>준비</option>
							<option value="1" <?php echo $row['moa_status'] == '1' ? 'selected' : ''; ?>>승인</option>
							<option value="2" <?php echo $row['moa_status'] == '2' ? 'selected' : ''; ?>>반려</option>
						</select>
                        <? } ?>
					</td>
				</tr>
            <?php $i++;
            } ?>
			</tbody>
		</table>
	</div>

	<div class="btn_list01 btn_list">
		<input type="button" name="act_button" id="approval_btn" value="선택 승인" onclick="document.pressed=this.value" class="btn btn_02">
		<input type="button" name="act_button" id="refuse_btn" onclick="$('#popup01').addClass('open');" value="선택 거절" onclick="document.pressed=this.value" class="btn btn_02">
		<input type="button" name="act_button" id="all_approval_btn" value="모두 일괄 승인" onclick="document.pressed=this.value" class="btn btn_01">
	</div>

	<div class="btn_fixed_top none">
		<a href="#" class="btn btn_02">닫기</a>
		<a href="#" class="btn btn_01">저장</a>
	</div>

	</form>

	<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

</div>

<div class="layer-popup" id="popup01">
	<div class="popContainer">
		<div class="pop-inner">
			<span class="pop-closer">팝업닫기</span>
			
			<header class="pop-header">
				반려사유
			</header>

			<div class="text_area">
				<textarea id="refuse_msg" placeholder="반려 사유를 입력해 주세요." required></textarea>
			</div>

			<div class="btn_choice">
				<button type="button" class="btnSubmit" onclick="reject()">확인</button>
			</div>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>

<script>
$(function() {
    
    

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

$('#all_approval_btn').click(function(){
    if(confirm('상태를 바꾸시겠습니까?')) {
        $.ajax({
            type: "POST",
            url: '/ajax/changeStatus.php',
            data: {'status': 1},
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
            url: '/ajax/changeStatus.php',
            data: {'status': 2, 'wr_id': arr},
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
            url: '/ajax/changeStatus.php',
            data: {'status': 1, 'wr_id': arr},
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

var target;
$('.moa_status').change(function(){
    if($(this).val() == 2) {
        $('#popup01').addClass('open');
        target = this;
    } else {
        if(confirm('상태를 바꾸시겠습니까?')) {
            $.ajax({
                type: "POST",
                url: '/ajax/changeStatus.php',
                data: {'status': $(this).val(), 'wr_id': $(this).data('wr_id') },
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
    }
});
function reject(){
    let refuse_msg = $('#refuse_msg').val();
    if(refuse_msg == '') {
        alert('반려 사유를 입력해주세요.');
        $('#refuse_msg').focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: '/ajax/changeStatus.php',
        data: {'status': $(target).val(), 'wr_id': $(target).data('wr_id'), 'refuse_msg': refuse_msg },
        cache: false,
        async: false,
        dataType: "json",
        success: function (data) {
                alert('상태가 변경되었습니다.');
                location.reload();
        }
    });
}
</script>

<?php
include_once('./admin.tail.php');
?>
