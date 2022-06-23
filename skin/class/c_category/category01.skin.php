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
            <div class="cla_cho slctRgn">
                <button  onclick="location.href='<?php echo MOA_CATEGORY_URL;?>/category02.php?moa_onoff='+$('#moa_onoff').val();"><?php echo $area;?></button>
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
                    <img src="../images/<?php echo $category_img[$row['ca_name']];?>" alt="">
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
        location.href="<?php echo G5_BBS_URL;?>/board.php?bo_table=class&moa_onoff=<?php echo $moa_onoff;?>&moa_area1=<?php echo $area1;?>&moa_area2=<?php echo $area2?>&sca="+ca;
    }
</script>