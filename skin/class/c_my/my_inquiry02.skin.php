<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 후기 리스트 -->
<section class="wrapper">
    <div class="s_content">
        <div class="p0 bt" id="host_content">
            <ul class="my_re_layout last_list">
                <?php
                    $sql = "select * from g5_write_qa a join g5_member b on a.mb_id = b.mb_id where a.mb_id = '{$member['mb_id']}'";
                    $query = sql_query($sql);
                    if(sql_num_rows($query) > 0) {
                    while($row = sql_fetch_array($query)) {
                    ?>
                    <li>
                        <div class="re_txt">
                            <p><?php echo $row['ca_name'] ? '[' . $row['ca_name'] . ']' : ''; ?><?php echo $row['wr_subject']; ?></p>
                        </div>
                        <div class="review">
                            <div class="pro_img"><?php echo get_mb_img($row['mb_id']); ?></div>
                            <div class="t_area">
                                <p><?php echo $row['wr_name']; ?><span><?php echo date('Y-m-d', strtotime($row['wr_datetime'])) ?></span></p>
                                <p class="txt">
                                    <?php echo conv_content($row['wr_content'], 0); ?>
                                </p>
                            </div>
                        </div>
                    </li>
                <?php }
                } else { ?>
                    <div style="width:100%;text-align:center;padding:50px 0">
                        현재 Q&A가 없습니다.
                    </div>
                <?php }?>
            </ul>
        </div>
    </div>
</section>