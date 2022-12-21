<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="login_wrap">
    <div class="cnter">
        <div class="login_logo" style="margin-top: 40px;">
            <img src="../images/Moa_black.svg" alt="">
            <p>누구나 Moa의<br>호스트가 될 수 있어요! </p>
        </div>
        <div class="login_button">
            <button class="kakao_btn">카카오톡으로 계속하기</button>
            <button class="naver_btn">네이버로 계속하기</button>
           <!--
               <button class="Apple_btn">Apple로 계속하기</button>
            -->
            <button class="email_btn" onclick="location.href='<?php echo MOA_HOSTJ_URL;?>/host_join03.php'">이메일로 시작하기</button>
        </div>
    </div>
</section>