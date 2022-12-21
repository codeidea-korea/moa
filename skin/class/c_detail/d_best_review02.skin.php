<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- BEST 솔직 후기 페이지-->
<section class="wrapper01">
    <div class="swiper-container plan">
        <div class="swiper4">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="<?php echo $query['as_thumb']?>" width="100%" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <?php while($row = sql_fetch_array($result)) { ?>
        <div class="s_content mt25">
            <div class="re_tit">
                <h4><?php echo $row['it_name']?></h4>
            </div>
            <div class="b_review">
                <div class="pro_img"><?php echo get_member_profile_img($row['mb_id'])?></div>
                <div class="t_area">
                    <p><?php echo $row['is_name'] ?></p>
                    <div class="s_day">
                        <div class="scope">
                            <?php for($i=0;$i<$row['is_score'];$i++) { ?>
                            <span class="on"></span>
                            <?php } ?>
                            <?php for($i=0;$i<(5-$row['is_score']);$i++) { ?>
                                <span></span>
                            <?php } ?>
                        </div>
                        <div class="date">
                            <span><?php echo date('Y-m-d H:i', strtotime($row['is_time']))?> 작성</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b_retxt">
                <p class="txt">
                    <?php echo $row['is_content']; ?>
                </p>
            </div>
        </div>
    <?php } ?>
</section>