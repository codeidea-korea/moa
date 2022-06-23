<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- BEST 후기 -->
<section class="s_content mt8">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>BEST 후기</h1>
        <a href="<?php echo MOA_DETAIL_URL;?>/d_best_review.php">더보기</a>
    </div>
    <!-- BEST 후기 슬라이드-->
    <div class="swiper-container best">
        <div class="swiper8">
            <div class="swiper-wrapper">
                <?php while($row = sql_fetch_array($result5)) { ?>
                    <div class="swiper-slide">
                    <div class="bsw">
                        <a href="/shop/item.php?it_id=<?= $row['it_id']; ?>">
                            <div class="id_area">
                                <span></span> <p><?php echo $row['is_name'] ?></p>
                            </div>
                            <div class="thumb_box" style="position:relative;height:352px">
                                <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="" style="position:absolute;top: 50%;left:50%;transform: translate(-50%, -50%);"><!-- <div style="background:url('<?php echo $row['as_thumb'] ?>');"></div> -->
                            </div>
                            <div class="con_txt">
                                <span><?php echo $row['is_subject'] ?></span>
                                <p><?php echo substr($row['is_content'], 0, 30); ?>...</p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
