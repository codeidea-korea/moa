<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 포인트 -->
<div class="wrapper01">
    <div class="point_history">
        <p><?php echo $member['mb_nick'] ?>님의 사용 가능 포인트</p>
        <p> <?php echo number_format($member['mb_point']); ?> P</p>
        <p>15일 내, 소멸 예정 포인트 : <?=number_format($expire_point_15['expire_sum_point'], 0)?> P</p>
    </div>
    <div class="s_content">
        <div class="tabs02 pr">
            <input id="host" type="radio" name="tab_item02" checked>
            <label class="tab_item02" for="host">전체내역</label>
            <input id="group" type="radio" name="tab_item02" >
            <label class="tab_item02" for="group">소멸예정</label>
            <hr class="hr02">
            
            <div class="tab_content p0 bt" id="host_content" <?php if ($_REQUEST['ep_day'] != ''){?>style="display:none!important;"<?php }?>>
                <p class="explan mt60">지난 1년간 적립/사용/소멸된 포인트 내역입니다.</p>
                <table class="point_table" border="1">
					<thead>
						<th>내용</th>
						<th>포인트</th>
						<th>적용일</th>
						<th>만기일</th>
					</thead>
                    <?php while($row = sql_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row['po_content'] ?></td>
                            <td><?=number_format($row['po_point'],0)?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['po_datetime'])) ?></td>
                            <td><?php echo date('Y', strtotime($row['po_expire_date'])) == '9999' ? '' : date('Y-m-d H:i:s', strtotime($row['po_expire_date'])); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            
            <div class="tab_content p0" id="group_content" <?php if ($_REQUEST['ep_day'] != ''){?>style="display:block!important;"<?php }?>>
                <div class="ex_sel">
                    <select name="ep_day" id="ep_day">
						<?php for($i=1; $i<=15; $i++){?>
							<option value="<?=$i?>" <?php if($_REQUEST['ep_day']==$i || $_REQUEST['ep_day']==""){echo 'selected';}?>><?=$i?></option>
						<?php }?>
                    </select>
                    <p>일 이내, <?=number_format($ep_day_epoint, 0)?>P 소멸 예정입니다. </p>
                </div>
				<?php if ($ep_day_epoint == 0){?>
					<p class="explan mt60">선택하신 기간 내, 소멸예정 포인트가 없습니다.</p>
				<?php }?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
	$('#ep_day').change(function(){
		//console.log($('#ep_day option:selected').val());
		location.href = "?ep_day=" + $('#ep_day option:selected').val();
	});
});
</script>