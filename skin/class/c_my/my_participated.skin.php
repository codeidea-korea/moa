<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 참여한모임 홈 -->
<section class="s_content">
    <div class="tabs02">
        <input id="host" type="radio" name="tab_item02" checked="">
        <label class="tab_item02" for="host">온라인</label>
        <input id="group" type="radio" name="tab_item02">
        <label class="tab_item02" for="group">오프라인</label>
        <hr>

        <!-- 온라인 -->
        <div class="tab_content p0 bt" id="host_content">
            <ul class="mt20 last_list">
                <?php while($row = sql_fetch_array($result)) {
                    $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);
                    if($row['moa_onoff'] == '온라인') { ?>
                        <li class="p_history_area">
                            <div class="p_history">
                                <div class="payinfo">
                                    <span class="tit_chip"><?= $row['od_status']; ?></span>
                                    <span><?= $row['od_time'] ?> 결제</span>
                                    <p class="ellipsis2"><?= $row['it_name']; ?></p>
                                    <?php $yoil = array('일','월','화','수','목','금','토'); ?>
                                    <p><?= date('y-m-d('. $yoil[date('w', strtotime($row['it_time']))] .') H:i', strtotime($row['it_time'])); ?> ~ <?= date('y-m-d('. $yoil[date('w', strtotime($row['it_4']))] .') H:i', strtotime($row['it_4'])); ?></p>
                                </div>
                                <div class="h_img_area">
                                    <div class="his_img">
                                        <img src="<?= $row['as_thumb']; ?>" alt="">
                                    </div>
                                    <p>수량: <?= $row['od_cart_count']; ?></p>
                                </div>
                            </div>
                            <div class="pymdt2">
                                <a href="/shop/orderinquiryview.php?od_id=<?= $row['od_id'] ?>&uid=<?= $uid; ?>">결제 상세 내역 보기</a>
                                <a href="/shop/item.php?it_id=<?= $row['it_id'] ?>">후기작성하기</a>
                            </div>
                        </li>
                <?php }
                } ?>
            </ul>
        </div>

        <!-- 오프라인 -->
        <div class="tab_content p0" id="group_content">
            <ul class="mt20 last_list">
                <?php while($row = sql_fetch_array($result)) {
                    if($row['moa_onoff'] == '오프라인') { ?>
                        <li class="p_history_area">
                            <div class="p_history">
                                <div class="payinfo">
                                    <span class="tit_chip"><?= $row['od_status']; ?></span>
                                    <span><?= $row['od_time'] ?> 결제</span>
                                    <p class="ellipsis2"><?= $row['it_name']; ?></p>
                                    <?php $yoil = array('일','월','화','수','목','금','토'); ?>
                                    <p><?= date('y-m-d('. $yoil[date('w', strtotime($row['it_time']))] .') H:i', strtotime($row['it_time'])); ?> ~ <?= date('y-m-d('. $yoil[date('w', strtotime($row['it_4']))] .') H:i', strtotime($row['it_4'])); ?></p>
                                </div>
                                <div class="h_img_area">
                                    <div class="his_img">
                                        <img src="<?= $row['as_thumb']; ?>" alt="">
                                    </div>
                                    <p>수량: <?= $row['od_cart_count']; ?></p>
                                </div>
                            </div>
                            <div class="pymdt2">
                                <a href="/shop/orderinquiryview.php?od_id=<?= $row['od_id'] ?>&uid=<?= $uid; ?>">결제 상세 내역 보기</a>
                                <a href="/shop/item.php?it_id=<?= $row['it_id'] ?>">후기작성하기</a>
                            </div>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
    </div>
</section>
