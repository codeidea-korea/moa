<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- New 모임 -->
<section class="s_content mt35" style="height:260px;">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>새로운 모아</h1>
        <a href="/bbs/board.php?bo_table=class">더보기</a>
    </div>
    <!-- New 모임 슬라이드 -->
    <div class="swiper-container meeting">
        <div class="swiper6">
            <div class="swiper-wrapper">
                <?php while($row = sql_fetch_array($result3)) {
                    ?>
                    <div class="swiper-slide">
                        <a href="/shop/item.php?it_id=<?= $row['it_id']; ?>">
                            <div class="title_area">
                                <!--
                                <div class="t_text">
                                    <?php echo $row['wr_subject'] ?>
                                </div>
                                -->
                                <span class="location_area ellipsis1">
                                <?= get_common_type($row['moa_area1'])['type_name']; ?>
                                <?= get_common_code_name($row['moa_area1'], $row['moa_area2'])['cd_name']; ?>
                            </span>
                            </div>
                            <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="">
                            <!-- 제목 가격 추가 -->
                            <div class="common_listarea">
                                <div class="ttl"><?php echo $row['wr_subject']; ?></div>
                                <? if($row['it_cust_price'] != $row['it_price']){ 
                                    ?>
                                    <div class="sale"><?php echo number_format($row['it_cust_price']); ?></div>
                                <? } ?>
                                <div class="dsc_price">
                                    <? if($row['it_cust_price'] != $row['it_price']){ 
                                        $disp = ($row['it_cust_price'] - $row['it_price']) * 100 / $row['it_cust_price'];
                                        $disp = floor($disp);
                                        ?>
                                        <span class="disp"><?php echo $disp.'%'; ?></span>
                                    <? } ?>
                                    <span><?php echo number_format($row['it_price']); ?>원</span>
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
                <?php }?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
