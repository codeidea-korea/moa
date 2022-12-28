<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 최근에 찜한 모임 -->
<section class="s_content">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>내가 찜한 모아</h1>
        <a href="<?php echo MOA_DETAIL_URL;?>/d_wish.php" id="btnLikeMore">더보기</a>
    </div>
    <!-- 최근에 찜한 모임 리스트-->
    <ul class="stmng">

        <?php 
        $likeCnt = 0;
        while($row = sql_fetch_array($result6)) {
            $likeCnt = $likeCnt + 1;
            $likechk = checkLikeOn('class',$row['it_id'], $member['mb_id']);
            $likeon = ($likechk)?"on":"";
            $likenoon = ($likechk)?"":"";

            if($likeCnt < 3) {
        ?>
            <li>
                <a href="/shop/item.php?it_id=<?= $row['it_id']; ?>">
                    <!-- <div class="st_img"></div> -->
                    <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" style="width:337px;height:148px;"/>
                    <div class="st_textarea">
                        <?php echo $row['it_name'] ?>
                    </div>
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
<!--
                <button class="lick_btn <?= $likeon; ?>" onclick="deb_goods_like(<?php echo $row['it_2'] ?>, 'good'); return false;"></button>
                -->
            </li>
        <?php 
            }
        }
        
        if($likeCnt < 1) {
            ?>
            <li>
            현재 찜한 모임 리스트가 없습니다.
            </li>
            <?
        }
        if($likeCnt > 2) {
            ?>
            <script>$('#btnLikeMore').show();</script>
            <?
        } else {
            ?>
            <script>$('#btnLikeMore').hide();</script>
            <?
        }

        ?>
    </ul>
</section>
