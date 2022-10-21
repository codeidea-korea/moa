<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 참여한모임 홈 -->
<section class="s_content">
    <div class="tabs02 mt16">
        <input id="host" type="radio" name="tab_item02" checked="">
        <label class="tab_item02" for="host">온라인</label>
        <input id="group" type="radio" name="tab_item02">
        <label class="tab_item02" for="group">오프라인</label>
        <hr>

<?
// 2022.08.21. botbinoo, 예약 확정된 나의 모임 내역 리스트 조회
$onlineList = array();
$offlineList = array();

while($row = sql_fetch_array($result)) {
    if($row['moa_onoff'] == '온라인') {
        array_push($onlineList, $row);
    } else if($row['moa_onoff'] == '오프라인') {
        array_push($offlineList, $row);
    }
}
// end 2022.08.21. botbinoo, 예약 확정된 나의 모임 내역 리스트 조회
?>
        <!-- 온라인 -->
        <div class="tab_content p0 bt" id="host_content">
            <ul class="mt20 last_list">
                <?php 
//                while($row = sql_fetch_array($result)) 
                for($inx = 0; $inx < count($onlineList); $inx++)
                {
                    $row = $onlineList[$inx];
                    $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);
                    if($row['moa_onoff'] == '온라인') { ?>
                        <li class="p_history_area">
                            <div class="p_history">
                                <div class="payinfo">
                                    <span class="tit_chip"><?php echo $row['status']; ?></span>
                                    <span><?php echo date('Y-m-d', strtotime($row['regdate'])) ?></span>
                                    <p class="ellipsis2"><?= $row['it_name']; ?></p>
                                    <?php $yoil = array('일','월','화','수','목','금','토'); ?>
                                    <p><?php echo date('Y-m-d('. $yoil[date('w', strtotime($row['aplydate']))] .') H:i', strtotime($row['aplydate'] . ' ' . $row['aplytime'])); ?></p>
                                </div>
                                <div class="h_img_area">
                                    <div class="his_img">
                                        <img src="<?php echo $row['as_thumb']; ?>" alt="">
                                    </div>
                                    <p>수량: <?php echo $row['man']; ?></p>
                                </div>
                            </div>
                            <div class="pymdt2">
                                <a href="/shop/item.php?it_id=<?php echo $row['it_id']; ?>">모임 상세 내역 보기</a>
                                <a href="/c_detail/d_review.php?it_id=<?php echo $row['it_id'] ?>">후기작성하기</a>
                            </div>
                        </li>
                <?php }
                } ?>
            </ul>
        </div>

        <!-- 오프라인 -->
        <div class="tab_content p0" id="group_content">
            <ul class="mt20 last_list">
                <?php
//                while($row = sql_fetch_array($result)) 
                for($inx = 0; $inx < count($offlineList); $inx++)
                {
                    $row = $offlineList[$inx];
                    if($row['moa_onoff'] == '오프라인') { ?>
                        <li class="p_history_area">
                            <div class="p_history">
                                <div class="payinfo">
                                    <span class="tit_chip"><?= $row['status']; ?></span>
                                    <span><?php echo date('Y-m-d', strtotime($row['regdate'])) ?></span>
                                    <p class="ellipsis2"><?= $row['it_name']; ?></p>
                                    <?php $yoil = array('일','월','화','수','목','금','토'); ?>
                                    <p><?php echo date('Y-m-d('. $yoil[date('w', strtotime($row['aplydate']))] .') H:i', strtotime($row['aplydate'] . ' ' . $row['aplytime'])); ?></p>
                                </div>
                                <div class="h_img_area">
                                    <div class="his_img">
                                        <img src="<?php echo $row['as_thumb']; ?>" alt="">
                                    </div>
                                    <p>수량: <?php echo $row['man']; ?></p>
                                </div>
                            </div>
                            <div class="pymdt2">
                                <a href="/shop/item.php?it_id=<?php echo $row['it_id']; ?>">모임 상세 내역 보기</a>
                                <a href="/c_detail/d_review.php?it_id=<?php echo $row['it_id'] ?>">후기작성하기</a>
                            </div>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
    </div>
</section>
