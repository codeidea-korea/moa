<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper">
    <div class="content">
        <div class="con_area">
            <p class="cert_text01">보다 원활한 서비스를 위해 직장인과 프리랜서<br> 인증을 하셔야 서비스 이용이 가능합니다. </p>
        </div>
        <div class="sel_lh">
            <button class="arrowL_btn" onclick="location.href='<?php echo MOA_LOGIN_URL;?>/certification_rectal.php?t=e'">직장인 이메일 인증</button>
            <button class="arrowL_btn" onclick="location.href='<?php echo MOA_LOGIN_URL;?>/certification_rectal.php?t=n'">직장인 명함 인증</button>
            <button class="arrowL_btn" onclick="location.href='<?php echo MOA_LOGIN_URL;?>/certification_free.php'">프리랜서 인증</button>
        </div>
    </div>
</section>