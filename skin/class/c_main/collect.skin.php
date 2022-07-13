<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 인기 모임 모아보기 -->
<section id="sec_ca_name">
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
                <div class="swiper-slide">
                    <a class="btn btn-primary ca_name_btn" data-ca_id = "pm_0" data-ca_name="">전체</a>
                </div>
                <?php foreach($cats as $cat) { ?>
                    <div class="swiper-slide">
                        <a class="btn btn-primary ca_name_btn" data-ca_id = "pm_<?= $cat['wr_id']?>" data-ca_name="<?php echo $cat['ca_name']; ?>"><?= $cat['ca_name']; ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    


    <div class="popular_moim s_content mt25" id="pm_0">
        <ol class="ppl_list">
            <?php $cnt = 1; ?>
            <?php $classes = getFavoriteClass(3, ''); ?>
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
    <?php foreach($cats as $cat) { ?>
        <div class="popular_moim s_content mt25" id="pm_<?= $cat['wr_id']?>" style="display:none;">
            <ol class="ppl_list">
                <?php $cnt = 1; ?>
                <?php $classes = getFavoriteClass(3, $cat['ca_name']); ?>
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
    <?php } ?>

    


</section>
<script>
    // $('.popular_moim').click(function(){
    //     var a = $(this).attr('data-ca_name');
    //     $('.popular_moim').hide();
    //     $('#'+a).show();
    // });

    $('.ca_name_btn').click(function(){
        var tid = $(this).attr('data-ca_id');
        $('.popular_moim').hide();
        $('#' + tid).show();
    })
</script>
