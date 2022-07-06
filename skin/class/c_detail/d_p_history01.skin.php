<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 구매내역보기 -->
<section class="s_content">
    <ul class="last_list mt16">
        <?php for ($i=0; $i < count($list); $i++) { ?>
        <li class="p_history_area">
            <div class="p_history">
                <div class="payinfo">
                    <span class="tit_chip"><?= $list[$i]['od_status']; ?></span>
                    <span><?= date('y/m/d', strtotime($list[$i]['od_time'])) ?> 결제</span>
                    <p class="ellipsis2"><?= $list[$i]['it_name']; ?></p>
                    <?php $yoil = array('일','월','화','수','목','금','토'); ?>
                    <p><?= date('y-m-d('. $yoil[date('w', strtotime($list[$i]['it_time']))] .') H:i', strtotime($list[$i]['it_time'])); ?> ~ <?= date('y-m-d('. $yoil[date('w', strtotime($list[$i]['it_4']))] .') H:i', strtotime($list[$i]['it_4'])); ?></p>
                </div>
                <div class="h_img_area">
                    <div class="his_img">
                        <img src="<?php echo filter_var($list[$i]['as_thumb'], FILTER_VALIDATE_URL) != '' ? $list[$i]['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="">
                    </div>
                     <p>수량: <?= $list[$i]['od_cart_count']; ?>개</p>
                </div>
            </div>
            <div class="pymdtl">
                <a href="<?= $list[$i]['od_href']; ?>">결제 상세 내역 보기</a>
            </div>
        </li>
        <?php } ?>
    </ul>

</section>

<div style="height:150px"></div>

