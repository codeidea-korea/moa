<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- Moa’s pick -->
<section class="s_content mt35">
        <!-- 타이틀 -->
    <div class="main_tit">
        <h1>Moa’s pick</h1>
    </div>
    <!-- Moa’s pick 슬라이드-->
    <div class="swiper-container pick">
        <div class="swiper5">
            <div class="swiper-wrapper">
                <?php
                $cnt = 1;
                while($row = sql_fetch_array($result2)) { ?>
                <div class="swiper-slide">
                    <a href="/shop/item.php?it_id=<?= $row['it_id']; ?>">
                        <div class="title_area">
                            <div class="t_text">
                                <?php echo $row['it_name']; ?>
                            </div>
                        </div>
                        <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="">
                        <div class="t_badge">
                            <?php echo $cnt; ?>
                        </div>
                    </a>
                </div>
                <?php $cnt++;
                } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
