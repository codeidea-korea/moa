<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- New 모임 -->
<section class="s_content mt35">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>New 모임</h1>
        <a href="/bbs/board.php?bo_table=class">더보기</a>
    </div>
    <!-- New 모임 슬라이드 -->
    <div class="swiper-container meeting">
        <div class="swiper6">
            <div class="swiper-wrapper">
                <?php while($row = sql_fetch_array($result3)) { ?>
                    <div class="swiper-slide">
                        <a href="/shop/item.php?it_id=<?= $row['it_id']; ?>">
                            <div class="title_area">
                                <div class="t_text">
                                    <?php echo $row['wr_subject'] ?>
                                </div>
                                <span class="location_area ellipsis1">
                                <?= get_common_type($row['moa_area1'])['type_name']; ?>
                                <?= get_common_code_name($row['moa_area1'], $row['moa_area2'])['cd_name']; ?>
                            </span>
                            </div>
                            <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="">
                        </a>
                    </div>
                <?php }?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
