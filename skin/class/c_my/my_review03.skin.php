<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 후기 리스트 -->
<section class="s_content">

    <ul class="my_re_layout last_list">
        <?php
            $sql = "select a.is_subject, a.is_content, a.is_name, a.is_score, a.is_time, c.wr_subject, c.moa_area1, c.moa_area2 
                    from g5_shop_item_use a join g5_shop_item b on a.it_id = b.it_id 
                    join g5_write_class c on b.it_2 = c.wr_id 
                    where a.mb_id = '{$member['mb_id']}' and a.is_confirm = 1";
            $query = sql_query($sql);
            if(sql_num_rows($query) > 0) {
                while($row = sql_fetch_array($query)) {
        ?>
            <li>
                <div class="re_txt">
                    <p><?php echo get_common_type($row['moa_area1'])['type_name'] ? '[' . get_common_type($row['moa_area1'])['type_name'] . ']' : ''; ?>
                        <?php echo $row['wr_subject']; ?></p>
                </div>
                <div class="review">
                    <div class="pro_img"><?php echo get_mb_img($member['mb_id']); ?></div>
                    <div class="t_area">
                        <p><?php echo $row['is_name']; ?><span><?php echo date('y-m-d', strtotime($row['is_time'])); ?></span></p>
                        <div class="scope">
                            <?php for($i=0;$i<$row['is_score'];$i++) { ?>
                                <span class="on"></span>
                            <?php } ?>
                            <?php for($k=0;$k<(5-$row['is_score']);$k++) { ?>
                            <span></span>
                            <?php } ?>
                        </div>
                        <p class="txt">
                            <?php echo $row['is_content']; ?>
                        </p>
                    </div>
                </div>
            </li>
        <?php }
            } else { ?>
                <div style="width:100%;text-align:center;padding:50px 0">
                    현재 후기 리스트가 없습니다.
                </div>
        <?php } ?>
    </ul>
</section>