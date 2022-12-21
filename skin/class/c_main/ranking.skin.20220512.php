<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- Top 랭킹 모임 -->
<section class="s_content mt35">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>Top 랭킹 모임</h1>
        <a href="<?php echo MOA_DETAIL_URL;?>/d_ranking.php">더보기</a>
    </div>
    <!-- Top 랭킹 모임 리스트 -->
    <ul class="rank_list">
        <?php while($row = sql_fetch_array($result4)) {
            $rate = getStrpointWr($row['it_2']);
             ?>
            <li>
                <a href="<?php echo $row['as_thumb'] ?>">
                    <div class="thumb_box" style="position:relative;height:146px">
                    <img src="<?php echo $row['as_thumb']; ?>" alt="" style="position:absolute;top: 50%;left:50%;transform: translate(-50%, -50%);"><!-- <div style="background:url('<?php echo $row['as_thumb'] ?>');"></div> -->
                    </div>
                    <!-- <div class="lctn">성동 • 마포 • 서대문</div> -->
     <div class="lctn">위치출력</div>
                    <div class="ttl"><?php echo $row['it_name']; ?></div>
                    <div class="rated">
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

                    <p class="sale"><?php echo number_format($row['it_cust_price']); ?></p>
                    <div class="dsc_price">
                        <?php $disp = ($row['it_cust_price'] - $row['it_price']) * 100 / $row['it_cust_price'] ?>
                        <span class="disp"><?php echo floor($disp); ?>%</span><span><?php echo number_format($row['it_price']); ?></span>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
</section>