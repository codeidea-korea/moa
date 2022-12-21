<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- Top 랭킹 모임 -->
<section class="s_content mt35">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>Top 랭킹 모아</h1>
    </div>
    <!-- Top 랭킹 모임 리스트 -->
    <ul class="rank_list">
        <?php while($row = sql_fetch_array($result7)) {
            $rate = getStrpointWr($row['it_2']);
             ?>
            <li>
                <a href="/shop/item.php?it_id=<?php echo $row['it_id'] ?>">
                    <div class="thumb_box" style="">
                    <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt=""><!-- <div style="background:url('<?php echo $row['as_thumb'] ?>');"></div> -->
                    </div>
                    <!-- <div class="lctn">성동 • 마포 • 서대문</div> -->
                    <div class="lctn"><?php echo get_common_type($row['moa_area1'])['type_name']; ?></div>
                    <div class="ttl"><?php echo $row['it_name']; ?></div>
                    <div class="rated dpnone">
                        <?php
                        $cc = $rate['cnt'];
                        for ($ii = 0; $ii < 5; $ii++) {
                            $classon = "";
                            if ($cc > 0) {
                                $classon = "on";
                                $cc--;
                            }
                                ?>
                        <span class="<?php echo $classon;?>"></span>
                        <?php } ?>
                        <p>후기 <?php echo ($rate['cnt'])?$rate['cnt']:0;?>개</p>
                    </div>

                    <?php if(($row['it_cust_price'] - $row['it_price']) > 0) { ?>
                    <p class="sale"><?php echo number_format($row['it_cust_price']); ?>원</p>
                    <div class="dsc_price">
                        <?php $disp = ($row['it_cust_price'] - $row['it_price']) * 100 / $row['it_cust_price'] ?>
                        <span class="disp"><?php echo floor($disp); ?>%</span><span><?php echo number_format($row['it_price']); ?>원</span>
                    </div>
                    <?php } else { ?>
                        <p class="sale"></p>
                        <div class="dsc_price">
                            <span class="disp"><span><?php echo number_format($row['it_price']); ?>원</span>
                        </div>
                    <?php } ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</section>
