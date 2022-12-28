<!-- 슬라이드 메뉴02 -->
<div class="swiper-container pplrgthrn other">
    <div class="swiper7">
        <div class="swiper-wrapper">
            <?php
                $sql = "select b.ca_name from deb_class_item a join g5_write_class b on a.wr_id = b.wr_id 
                        where DATE_FORMAT(a.day, '%Y.%c.%d') = DATE_FORMAT('{$date}', '%Y.%c.%d') 
                        group by b.ca_name order by b.wr_id desc";
                        //echo $sql;
                $query = sql_query($sql);
                while($row = sql_fetch_array($query)){
            ?>
                <div class="swiper-slide">
                    <a href="/bbs/board.php?bo_table=class&moa_onoff=&moa_area1=&moa_area2=&sca=<?php echo $row['ca_name']; ?>" class="on"><?php echo $row['ca_name'] ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>