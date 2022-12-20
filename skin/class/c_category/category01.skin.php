<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$moa_onoff = (isset($_GET['moa_onoff']))?$_GET['moa_onoff']:'';
$area1  = (isset($_GET['area1']))?$_GET['area1']:'';
$area2  = (isset($_GET['area2']))?$_GET['area2']:'';
$area  = (isset($_GET['area']))?$_GET['area']:'지역선택';
?>

<!-- 카테고리 화면 -->
<section class="s_content mt30">
    <div class="select_area">
        <div class="cate_sel">
            <select name="moa_onoff" id="moa_onoff">
                <option value="">온·오프라인</option>
                <option value="오프라인" <?php if ($moa_onoff == '오프라인') {echo ' selected ';}?>>오프라인</option>
                <option value="온라인" <?php if ($moa_onoff == '온라인') {echo ' selected ';}?>>온라인</option>
            </select>
            <!--
            <div class="cla_cho slctRgn">
                <button  onclick="location.href='<?php echo MOA_CATEGORY_URL;?>/category02.php?moa_onoff='+$('#moa_onoff').val();"><?php echo $area;?></button>
            </div>
            -->
            <div class="cla_cho slctRgn">
                            <button onclick="location.href='<?php echo MOA_CATEGORY_URL;?>/category02.php?moa_onoff='+$('#moa_onoff').val();"
            "><?php echo $area;?></button>
                        </div>
        </div>
        <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=class"><img src="../images/icon_magnifier_1.svg" alt=""></a>
    </div>
</section>

<section class="s_content">
    <ul class="category">
        <?php
       
        $cnt = 1;
        while ($row = sql_fetch_array($result)) { 
            if ($cnt % 2) {
        ?>
        <li>
            <?php } ?>
            <!-- <a href="<?php echo G5_SHOP_URL;?>/list.php?ca_id=<?php echo $row['ca_id'];?>"> -->
            <a href="javascript:" onclick="gocategory('<?php echo $row['ca_name'];?>');">
                <div>
                    <p><?php echo $row['ca_name'];?></p>
                    <img src="../images/<?php echo $row['as_mobile_icon'];?>" alt="">
                </div>
            </a>
            <?php if ($cnt % 2 == 0) {?>
            </li>
            <?php } ?>
        <?php
            $cnt++;
        } ?>
        
    </ul>
</section>
<script>
    function gocategory(ca) {
        // 2022.09.05. botbinoo, 검색시 카테고리 지역 조회 안되는 부분의 원인이 여러가지라 문자 조회로 변경
        // 1. 우선 지역 코드를 넣고 있는데, 실제 모임(클래스) 생성시 지역코드를 안넣고 있어서 의미가 없음
        // 2. 조회할때 지역코드 기반으로 고려하고 있는데, 지역 코드를 관리자 화면 메뉴 어디에서도 관리하고 있지 않음
        // 따라서 1/2 를 해결해도 정책적으로 새로운 문제가 될 바에는 지역 베이스(광역시/도) 조회를 하도록 처리함
//        location.href="<?php echo G5_BBS_URL;?>/board.php?bo_table=class&moa_onoff=<?php echo $moa_onoff;?>&moa_area1=<?php echo $area1;?>&moa_area2=<?php echo $area2?>&sca="+ca;
        location.href="<?php echo G5_BBS_URL;?>/board.php?bo_table=class&moa_onoff=<?php echo $moa_onoff;?>&moa_area1=<?php echo $area1;?>&moa_area2=<?php echo $area2?>&area=<?php echo $area?>&sca="+ca;
    }
</script>