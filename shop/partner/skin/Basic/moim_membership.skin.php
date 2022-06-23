<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<?php
//html 팝업
include_once($skin_path.'/pop.confirm-reservation.php'); //예약확정
?>

<div class="section-title">모임 신청자 관리</div>

<div class="boxContainer padding40">

	<form name="" action="" method="post">
	<div class="data-search-wrap fx-wrap label120">
		<div class="fx-list">
			<div class="fx-list-label">모임 명</div>
			<div class="fx-list-con">
                <select class="moim_select" id="moim_select">
                    <option value="">전체</option>
                    <?php while($row1 = sql_fetch_array($result2)) { ?>
                        <option value="<?php echo $row1['wr_id']; ?>" <?php echo $row1['wr_id'] == $_GET['wr_id'] ? 'selected="selected"' : ''; ?>><?php echo $row1['wr_subject']; ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
	</div>
	</form>

	<form class="" name="" method="post" action="">
	<div class="tbl-basic outline odd th-h5 ">
		<table>
			<colgroup>
				<col width="100">
				<col>
				<col>
				<col>
				<col>
				<col>
				<col>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">모임 날짜</th>
					<th scope="col">신청자</th>
					<th scope="col">모임금액</th>
					<th scope="col">모임 신청일</th>
					<th scope="col">정산 상태</th>
					<th scope="col">예약확정</th>
				</tr>
			</thead>
			<tbody>
                <?php $i = 1; ?>
                <?php while($row = sql_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($row['aplydate'] . " " . $row['aplytime'])); ?></td>
                            <td><?php echo $row['mb_name'] ?></td>
                            <td><?php echo number_format($row['pay']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['regdate'])); ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><span data-href="#pop-confirm-reservation" class="pop-inline btn small" data-idx="<?php echo $row['idx']; ?>">예약확정</span></td>
                        </tr>
                <?php $i++;
                } ?>
			</tbody>
		</table>
	</div>
        <?php
            $total_count = $row['cnt'];
            $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
            if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
        ?>
        <div class="mt20">
            <?php if($total_count > 0) { ?>
                <ul class="pagination pagination-sm en" style="margin-top:0; padding-top:0;">
                    <?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
                </ul>
            <?php } ?>
        </div>

	</form>

</div>
<script>
    $('#moim_select').change(function(){
        location.search = '?ap=moim_membership&wr_id=' + $(this).val();
    })

    $('.pop-inline').click(function(){
        var idx = $(this).data('idx');

        $('#fregister').children('input[name="idx"]').val(idx);
    })
</script>