<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 메인 중간 배너 -->
<section class="mdlbnr" onclick="location.href='<?php echo MOA_DETAIL_URL;?>/d_today.php'">
    <div class="bn_txt">
        <p><span><?php echo date('m월 d일') ?></span> 당일 수강 가능한 클래스</p>
    </div>
</section>