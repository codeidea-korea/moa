<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 포인트 -->
<div class="wrapper01">
    <div class="point_history">
        <p><?php echo $member['mb_nick'] ?>님의 사용 가능 포인트</p>
        <p> <?php echo number_format($member['mb_point']); ?> P</p>
        <p>15일 내, 소멸 예정 포인트 : 0 P</p>
    </div>
    <div class="s_content">
        <div class="tabs02 pr">
            <input id="host" type="radio" name="tab_item02" checked="">
            <label class="tab_item02" for="host">전체내역</label>
            <input id="group" type="radio" name="tab_item02">
            <label class="tab_item02" for="group">소멸예정</label>
            <hr class="hr02">
            
            <div class="tab_content p0 bt" id="host_content">
                <p class="explan mt60">지난 1년간 적립/사용/소멸된 포인트 내역입니다.</p>
                <table>
                    <?php while($row = sql_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row['po_content'] ?></td>
                            <td><?php echo $row['po_point'] > 0 ? $row['po_point'] : $row['po_use_point'] ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['po_datetime'])) ?></td>
                            <td><?php echo date('Y', strtotime($row['po_expire_date'])) == '9999' ? '' : date('Y-m-d H:i:s', strtotime($row['po_expire_date'])); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            
            <div class="tab_content p0" id="group_content">
                <div class="ex_sel">
                    <select name="" id="">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                    <p>일 이내, 0P 소멸 예정입니다. </p>
                </div>
                <p class="explan mt60">선택하신 기간 내, 소멸예정 포인트가 없습니다.</p>
            </div>
        </div>
    </div>
</div>