<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- Moa’s 기획전! -->
<section class="s_content mt35">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>Moa’s 기획전!</h1>
    </div>
        <!-- Moa’s 기획전! 슬라이드 -->
    <div class="swiper-container plan">
        <div class="swiper4">
            <div class="swiper-wrapper">
                <?php while($row = sql_fetch_array($result)) { ?>
                    <div class="swiper-slide">
                    <a href="/shop/item.php?it_id=<?php echo $row['it_id'] ?>">
                        <div class="bsw">
                            <div class="title_area">
                                <!--
                                <div class="t_text">
                                    <?php echo $row['it_name']; ?>
                                </div>
                                <div class="text_area">
                                    <p><?php echo $row['it_model'] ?>
                                    </p>
                                </div>
                                -->
                            </div>
                            <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="">
                            <div class="con_txt">
                                <span>서울&#183;전체</span>
                                <p><?php echo $row['it_6'] ?></p>
                            </div>
                            <div class="t_badge">
                                기획전
                            </div>
                        </div>
                    </a>
						<!--신고버튼-->
						<div class="d_tit cr mt14" style="margin:0;float:left;">
							<div class="com_chip color_red">
								<span onclick="report_btn('모임1')" style="cursor:pointer;">신고</span>
								<span onclick="report_btn('모임2')" style="cursor:pointer;">차단</span>
							</div>
						</div>
						<!--신고버튼-->
                </div>
                <?php } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
