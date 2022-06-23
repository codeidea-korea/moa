<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 카테고리 지역선택 화면 -->
<section class="wrapper01">
    <div class="s_content">
        <div class="select_area">
            <div class="cate_sel">
                <div class="slctRgn">
                    <button class="cla_btn">지역선택</button>
                </div>
            </div>
            <a href="<?php echo MOA_MAIN_URL;?>/main_search.php"><img src="../images/icon_magnifier_1.svg" alt=""></a> 
        </div>
    </div>
<style>
.catarea {display:none}
.areaspan {}
</style>
    <div class="s_content mt10">
        <div class="area_c">
            <div class="city">
                <ul>
                    <?php 
                    if (count($list)) 
                        $cnt = count($list);
                    for ($i = 0; $i < $cnt; $i++) {?>
                    <li>
                        <a href="javascript:" Onclick="areaview(<?php echo $i;?>);">
                            <span class="areaspan aspan<?php echo $i;?>"><?php echo $list[$i]['type_name'];?></span>
                        </a>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
            <?php 
            for ($i = 0; $i < $cnt; $i++) {
                $list2 = get_common_code_list($list[$i]['type_id']);?>           
            <div class="district catarea area<?php echo $i;?>">
                <ul>
                    <?php
                    $cnt2 = count($list2);
                    for ($j = 0; $j < $cnt2; $j++) {?>
                    <li>
                        <a href="">
                            <span><?php echo $list2[$j]['cd_name'];?></span>
                            <img src="../images/r_arrow_o.svg" alt="">
                        </a>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<script>
function areaview(obj) {
    $(".areaspan").removeClass("on");
    $("aspan"+obj).addClass("on");
    //$(".catarea").removeClass("district");
    $(".catarea").hide();
    //$(".area"+obj).addClass("distirict");
    $(".area"+obj).show();;



}
</script>