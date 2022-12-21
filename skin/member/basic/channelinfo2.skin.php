<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css">', 0);
//<script src="<?/p/hp echo G5_JS_URL; /?/>/viewimageresize.js"></script>
?>


<div class="review main sps">
    <div class="table-responsive">
        <h4>베스트 리스트 </h4>

        <div class="row">
            <div class="col-sm-12" id="best_info">

                <section class="cs_list board-list">
                    
                <div class="list-wrap">
                    <div class="list-board lbd_list_best">
                        <div id="list-bodylist_best" class="list-body basic-body color-body">

<?php
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $row['name'] = apms_sideview($row['mb_id'], $row['wr_name']);
        $wr_label = '';
        $is_lock = false;
        if ($row['icon_secret'] || $row['is_lock']) {
            $is_lock = true;
            $wr_label = '<div class="label-cap bg-orange">Lock</div>';
        } else {
            if ($wr_id == $row['wr_id']) {
                $wr_label = '<div class="label-cap bg-green">Now</div>';
            } else if ($row['icon_hot']) {
                $wr_label = '<div class="label-cap bg-red">Hot</div>';
            } else if ($row['icon_new']) {
                $wr_label = '<div class="label-cap bg-blue">New</div>';
            }
        }

        // 썸네일
        $wr_vicon = ($row['as_list'] == "2" || $row['as_list'] == "3") ? '<i class="fa fa-play-circle-o wr-vicon"></i>' : ''; // 비디오 아이콘
        $thumb = apms_wr_thumbnail($row['botable'], $row, "400", "300", false, true); // 썸네일
        $wr_thumb = ($thumb['src']) ? '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" class="wr-img">' : '<div class="thumb-icon'.$fa_color.'"><div class="wr-fa">'.$fa_photo.'</div></div>';

        // 날짜
        $wr_date = ($is_date) ? '<div class="wr-date en">'.date($is_dtype, $row['date']).'</div>' : '';
        $datemd = str_replace("-","월",substr($row['wr_datetime'],5,5))."일";
        // 회원사진
        $wr_mb = '';
        if($is_mb) {
            $wr_mb = apms_photo_url($row['mb_id']);
            $wr_mb = ($wr_mb) ? '<span class="wr-mb"><img src="'.$wr_mb.'"></span>' : '<span class="wr-mb"><i class="fa fa-user"></i></span>';
        }
?>


            <div class="list-row">
                <div class="list-col">
                    <div class="list-box">
                        <div class="list-front">
                            <div class="category_p"><?php echo $row['bosub'];?></div>
                            <div class="list-img">
                                <a href="/bbs/board.php?bo_table=<?=$row['botable']?>&wr_id=<?=$row['wr_id']?>"><?php echo $row['target'];?><?php echo $is_modal_js;?>
                                    <div class="imgframe">
                                        <div class="img-wrap">
                                            <?php echo $wr_label;?>
                                            <?php echo $wr_vicon;?>
                                            <?php echo $wr_date;?>
                                            <div class="img-item">
                                                <?php echo $wr_thumb;?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php echo $is_shadow; //그림자 ?>
                            <div class="list-text">
                                <?php if($is_category) { ?>
                                <div class="div-title-underline-thin font-12">
                                    <?php echo ($row['ca_name']) ? $row['ca_name'] : '미분류';?>
                                </div>
                                <div class="clearfix"></div>
                                <?php } ?>
                                <div class="list-desc">
                                    <a href="/bbs/board.php?bo_table=<?=$row['botable']?>&wr_id=<?=$row['wr_id']?>"><?php echo $is_modal_js;?>
                                        <strong class="en">[<?php echo $row['wr_1'];?>] <?php echo $row['wr_subject'];?></strong>
                                        <div class="h5"></div>
                                        <div class="text-muted font-12">
                                            <?php echo apms_cut_text($row['wr_content'], $is_cont); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="li_bot">
                                    <div class="front">
                                        <span class="list_pf_photo">
                                            <p class="none"><?php $member = apms_member($row['mb_id']);?></p>
                                            <?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="">' : '<img src="/img/reporter.svg" alt="">'; ?>
                                        </span>
                                        <span>
                                            <?php echo $wr_mb;?>
                                            <p class="pf_name"><?php echo $row['name']; ?></p>
                                            <p class="pf_date"><?php echo $datemd;?></p>
                                        </span>
                                    </div>

                                    <div class="back">
                                        <ul>
                                            <li class="none"><a href="#"><img src="/img/share_icon.png" alt=""><span><?php echo ($row['wr_link1_hit'] +         $row['wr_link2_hit']);?></span></a></li>
                                            <li><img src="/img/read_icon.svg" alt=""><span><?php echo $row['wr_comment'];?></span></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

<?php
    }
?>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


<?php
echo channelinfo2_page($config['cf_write_pages'], $page, $total_page, "./channelinfo2.php?", "");
?>
</div>


<script>
   

$(function(){
    $(".pg2_page").click(function(){
        $("#channelinfo2").load($(this).attr("href"));
        return false;
    });
    //$( ".controlgroup" ).controlgroup();
 
});

</script>

<?php //echo get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); 
//echo itemuse_page($config['cf_write_pages'], $page, $total_page, "./itemuselist.php?page=", "");
?>
