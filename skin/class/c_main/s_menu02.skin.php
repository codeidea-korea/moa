<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!-- 기본 리스트 -->
<section>
    <div class="s_content mt25">
        <ul class="tab_list pb100">
            <?php for($i=0;$i<count($list);$i++) { ?>
            <li>
                <a href="/shop/item.php?it_id=<?php echo $list[$i]['it_id']; ?>">
                    <div class="thumb_box">
                        <?php if($list[$i]['as_thumb'] != '' && filter_var($list[$i]['as_thumb'], FILTER_VALIDATE_URL)) { ?>
                        <img src="<?php echo $list[$i]['as_thumb']; ?>" alt="" style="width:340px;">
                        <?php } else { ?>
                            <img src="/images/moa_logo.svg" alt="" style="width:340px;">
                        <?php }?>
                    </div>
                    <div class="lctn"><?php echo get_common_type($list[$i]['moa_area1'])['type_name']; ?></div>
                    <div class="st_textarea">
                        <?php echo $list[$i]['wr_subject']; ?>
                    </div>
                    <div class="rated">
                        <?php for($j=0;$j<$list[$i]['is_score'];$j++) { ?>
                            <span class="on"></span>
                        <?php } ?>
                        <?php for($j=0;$j<(5-$list[$i]['is_score']);$j++) { ?>
                            <span></span>
                        <?php } ?>
                        <p>후기 <?php echo $list[$i]['cnt']; ?>개</p>
                    </div>
                    <div class="dsc_price">
                        <div class="price">
                            <span class="t_l"><?php echo$list[$i]['wr_3'] ? number_format($list[$i]['wr_3']) : 0; ?>원</span>
                        </div>
                    </div>
                </a>
                <?php
                //좋아요 기능구현
                $likechk = checkLikeOn('class',$list[$i]['wr_id'],$member['mb_id']);
                $likeon = ($likechk)?"on":"";
                $likenoon = ($likechk)?"":"";
                ?>
                <button class="lick_btn <?php echo $likeon;?>" onclick="deb_apms_like('class', '<?php echo $list[$i]['wr_id'];?>', '<?php echo $likenoon;?>good', 'wr_<?php echo $likenoon;?>good'); return false;"></button>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>