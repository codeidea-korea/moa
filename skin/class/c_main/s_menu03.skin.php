<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


$sql = "select a.day, b.it_price, c.moa_onoff, c.moa_area1, c.wr_subject, b.it_id, c.as_thumb, (select sum(is_score) from g5_shop_item_use where it_id = b.it_id) as score, (select count(*) from g5_shop_item_use where it_id = b.it_id) as cnt  
        from deb_class_item a join g5_shop_item b
        on a.it_id = b.it_id 
        join g5_write_class c on c.wr_id = b.it_2
        where DATE_FORMAT(a.day, '%Y.%c.%d') = DATE_FORMAT('{$date}', '%Y.%c.%d') order by a.it_id desc";
$query = sql_query($sql);
?>
<!-- 당일수강 리스트 -->
<section class="s_content mt25">
    <ul class="day_list last_list">
        <?php if(sql_num_rows($query) > 0) {
            while($row = sql_fetch_array($query)) {
                ?>
            <li>
                <a href="/shop/item.php?it_id=<? echo $row['it_id']; ?>">
                    <div class="thumb_box">
                        <img src="<?php echo $row['as_thumb'] ?>" />
                    </div>
                    <div class="lctn"><?php echo $row['moa_onoff'] ?></div>
                    <div class="ttl"><?php echo $row['moa_area1'] ? '['.get_common_type($row['moa_area1'])['type_name'].']' : ''; ?> <?php echo $row['wr_subject']; ?></div>
                    <!--
                    <div class="rated">
                        <?php for($i=0;$i<$row['score'];$i++) { ?>
                        <span class="on"></span>
                        <?php } ?>
                        <?php for($i=0;$i<(5-$row['score']);$i++) { ?>
                            <span></span>
                        <?php } ?>
                        <p>후기 <?php echo number_format($row['cnt']); ?>개</p>
                    </div>
                    -->
                    <p class="sale"></p>
                    <div class="dsc_price">
                        <span><?php echo number_format($row['it_price']); ?>원</span>
                        <!--
                        <p>
                            <span>당일사용</span>
                        </p>
                        -->
                    </div>
                </a>
                <button class="lick_btn"></button>
            </li>
        <?php }
        } else { ?>
            <li>
                <span>당일 수강 가능한 클래스가 없습니디.</span>
            </li>
        <?php } ?>
    </ul>
</section>