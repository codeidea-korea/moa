<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$moa_onoff = $_GET['moa_onoff'];
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
                        <a href="javascript:" Onclick="areaview(<?php echo $i;?>,'<?php echo $list[$i]['type_id'];?>','<?php echo $list[$i]['type_name'];?>');">
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
                        <a href="javascript:"
                        onclick="areaselected('<?php echo $list2[$j]['cd_id']?>', '<?php echo $list2[$j]['cd_name'];?>');"">
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
    var area1 = '';
    var area2 = '';
    var area = '';
function areaview(obj, id, names) {
    area1 = id;
    area = names;
    $(".areaspan").removeClass("on");
    $("aspan"+obj).addClass("on");
    //$(".catarea").removeClass("district");
    $(".catarea").hide();
    //$(".area"+obj).addClass("distirict");
    $(".area"+obj).show();;
}

function areaselected(id, names) {
    area += '&gt;'+names;
    location.href='/c_category/category01.php?moa_onoff=<?php echo $moa_onoff;?>&area1='+area1+'&area2='+id+'&area='+area;
}
</script>