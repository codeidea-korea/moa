<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<section class="wrapper01">
    <div class="swiper-container main_slide">
            <div class="swiper1">
                <div class="swiper-wrapper">
                    <?php while($row = sql_fetch_array($main)) { ?>
                    <div class="swiper-slide">
                    <? if(!empty($row['bn_url']) && $row['bn_url'] != '' && $row['bn_url'] != 'http://' && $row['bn_url'] != 'https://'){ ?>
                        <a href="<?php echo $row['bn_url']; ?>" target="<?php echo $row['bn_new_win'] ? '_blank' : '' ?>">
                    <? } ?>
                            <img src="<?php echo $row['bn_bimg'] != '' ? $row['bn_bimg'] : G5_URL . "/images/moa_logo.svg" ?>" 
                            <? if(empty($row['bn_url']) || $row['bn_url'] == '' || $row['bn_url'] == 'http://' || $row['bn_url'] == 'https://'){ ?>
                                    style="cursor:auto;"
                            <? } ?>
                            />
                        </a>
                    <? if(!empty($row['bn_url']) && $row['bn_url'] != '' && $row['bn_url'] != 'http://' && $row['bn_url'] != 'https://'){ ?>
                        </a>
                    <? } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
</section>
