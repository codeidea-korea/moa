<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 하단배너 -->
<section class="btlbnr mt35 last_cnt">

<?php

if ($is_member) {
?> 
<!--로그인한 사용자 링크 -->
<a href="/shop/partner/register.php"><img src="../images/visual_img/bt_banner.png" alt=""></a>
<?php 
} else { ?>
<!--비회원 링크 / 로그인페이지로이동-->
<a href="<?php echo C_MAIN_PATH;?>/main.php"><img src="../images/visual_img/bt_banner.png" alt=""></a>
<?php } ?>

<p class="guide_m">(주)모아프렌즈는 통신판매중개자로서 거래당사자가 아닙니다. 호스트가 등록한 상품 정보 및 호스트와 게스트간 거래에 대해 (주)모아프렌즈는 일체의 책임을 지지 않습니다.</p>
</section>
