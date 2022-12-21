<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 쿠폰 리스트 -->
<section class="s_content">
    <p class="noti_stit">총 보유 쿠폰 <span><?php echo count($cp); ?>개</span></p>
<!--    <div class="cou_plus mt10">
            <button onclick="location.href='?php //echo MOA_MY_URL ?>/my_coupon02.php'">쿠폰 등록하기</button>
        </div>-->
    <ul class="coupon_list last_list">
        <?php for($i=0; $i<count($cp); $i++) { ?>
            <li>
                <div class="cou_txe">
                    <p>[<?php echo $cp[$i]['cp_target']; ?>] <?php echo $cp[$i]['cp_subject']; ?></p>
                    <p><?php echo $cp[$i]['cp_price']; ?></p>
                    <!-- 최소 사용금액 추가 -->
                    <p>최소 사용금액 : <? echo number_format($cp[$i]['cp_minimum']); ?>원</p>
                    <p>유효기간: <?php echo date('Y.m.d', strtotime($cp[$i]['cp_start'])); ?> ~ <?php echo date('Y.m.d', strtotime($cp[$i]['cp_end'])); ?></p>
                </div>
                <div class="use">
                    사용가능
                </div>
            </li>
        <?php } ?>
    </ul>
</section>