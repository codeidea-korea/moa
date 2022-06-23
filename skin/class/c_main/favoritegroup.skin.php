<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 최근에 찜한 모임 -->
<section class="s_content">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>최근에 찜한 모임</h1>
        <a href="<?php echo MOA_DETAIL_URL;?>/d_wish.php">더보기</a>
    </div>
    <!-- 최근에 찜한 모임 리스트-->
    <ul class="stmng">

        <?php while($row = sql_fetch_array($result6)) {
            $likechk = checkLikeOn('class',$row['it_id'], $member['mb_id']);
            $likeon = ($likechk)?"on":"";
            $likenoon = ($likechk)?"":"";
        ?>
            <li>
                <a href="/shop/item.php?it_id=<?= $row['it_id']; ?>">
                    <!-- <div class="st_img"></div> -->
                    <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" style="width:337px;height:148px;"/>
                    <div class="st_textarea">
                        <?php echo $row['it_name'] ?>
                    </div>
                </a>

                <button class="lick_btn <?= $likeon; ?>" onclick="deb_goods_like(<?php echo $row['it_2'] ?>, 'good'); return false;"></button>
            </li>
        <?php }?>
    </ul>
</section>
