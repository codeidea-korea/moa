<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!-- 구매내역보기 -->
<?php foreach($item as $i) { ?>
    <section class="detail_con bg_gray">
        <div class="s_con_bg pt0">
            <div class="p_history_dt">
                <div class="p_his_area his_option">
                    <div class="h_img_area">
                        <div class="his_img">
                            <a href="/shop/item.php?it_id=<?= $i['it_id']; ?>"><img src="<?= $i['as_thumb'] ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="p_history_txt">
                        <p class="ellipsis2"><a href="/shop/item.php?it_id=<?= $i['it_id']; ?>"><?= $i['it_name']; ?></a></p>
                        <span><?= $i['seller']; ?></span>
                    </div>
                </div>
                <div class="p_hisday">
                    <span class="tit_chip"><?= $i['ct_status'] ?></span>
                    <?php $yoil = array('일','월','화','수','목','금','토'); ?>
                    <span>
                        모임일 : <?=$i['it_4']?>
                    </span>
                </div>
            </div>
            <div class="payhist">
                <p>참가비 (1인) / 수량 <?= number_format($i['ct_qty']) ?>개</p>
                <p><?= number_format($i['opt'][0]['sell_price']); ?>원</p>
            </div>
        </div>
    </section>
<?php } ?>
