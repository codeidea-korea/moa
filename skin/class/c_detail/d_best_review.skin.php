<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- BEST 후기 리스트페이지-->
<section class="wrapper01">
    <!-- 리스트 시작 -->
    <div class="s_content mt25">
        <ul class="last_list">
            <?php while($row = sql_fetch_array($result)) { ?>
            <li class="best other">
                <div class="bsw">
                    <a href="<?php echo MOA_DETAIL_URL;?>/d_best_review02.php?it_id=<?php echo $row['it_id']?>">
                        <div class="id_area">
                            <span><?php echo get_member_profile_img($row['it_id']) ?></span> <p><?php echo $row['is_name']?></p>
                        </div>
                        <div class="img_area img_ct">
                           <img src="<?php echo $row['as_thumb']?>" width="100%" />
                        </div>
                        <div class="con_txt">
                            <span class="ellipsis1"><?php echo $row['it_name'] ?> </span>
                            <p class="ellipsis2"><?php echo $row['is_content'] ?></p>
                        </div>
                    </a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>