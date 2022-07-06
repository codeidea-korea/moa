<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<section class="wrapper01">
    <div class="swiper-container main_slide">
            <div class="swiper1">
                <div class="swiper-wrapper">
                    <?php while($row = sql_fetch_array($main)) { ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $row['bn_url']; ?>">
                            <img src="<?php echo $row['bn_bimg'] != '' ? $row['bn_bimg'] : G5_URL . "/images/moa_logo.svg" ?>" />
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
</section>
