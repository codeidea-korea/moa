<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 인기 모임 모아보기 -->
<section>
    <div class="s_content mt35">
        <!-- 타이틀 -->
        <div class="main_tit">
            <h1>인기 모임 모아보기</h1>
        </div>
    </div>

    <!-- 메뉴 슬라이드 -->
    <div class="swiper-container pplrgthrn">
        <div class="swiper7">
            <div class="swiper-wrapper">
                <?php $cats = getHitCategory(); ?>
                <?php foreach($cats as $cat) { ?>
                    <div class="swiper-slide">
                        <a href="/bbs/board.php?bo_table=class&moa_onoff=&moa_area1=&moa_area2=&sca=<?php echo $cat['ca_name'];?>" class="on"><?= $cat['ca_name']; ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- 인기 모임 리스트 -->
    <div class="s_content mt25">
        <ol class="ppl_list">
            <?php $cnt = 1; ?>
            <?php $classes = getFavoriteClass(3); ?>
            <?php foreach($classes as $class) { ?>
            <li>
                <a href="/shop/item.php?it_id=<?php echo $class['it_id'] ?>">
                    <span class="num item1"><?php echo $cnt; ?></span>
                    <div class="item2">
                        <!-- <div class="ppl_img" style="background:url('<?php echo $class['as_thumb']; ?>')"></div>-->
						<div class="round_img">
                            <img src="<?php echo filter_var($class['as_thumb'], FILTER_VALIDATE_URL) != '' ? $class['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>"/>
                        </div>
                    </div>
                    <div class="item3">
                        <p class="lctn">
                            <?php echo get_common_type($class['moa_area1'])['type_name']; ?>
                            <?php echo get_common_code_name($class['moa_area1'], $class['moa_area2'])['cd_name']; ?>
                        </p>
                        <p class="ttl"><?php echo $class['wr_subject'] ?></p>
                        <p class="dsc_price">
                            <span>1회</span><?php echo number_format($class['wr_3']); ?>원
                        </p>
                    </div>
                </a>
            </li>
            <?php $cnt++; } ?>
        </ol>
    </div>
</section>
