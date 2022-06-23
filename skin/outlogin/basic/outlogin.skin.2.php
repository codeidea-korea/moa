<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<div class="dropdown dropdown-right btn-group">
    <a class="btn dropdown-toggle" tabindex="0">
        <i class="icon icon-people"></i>
        <strong><?php echo $nick ?></strong>
        <i class="icon icon-more-vert"></i>
    </a>
    <ul class="menu text-left">
        <li class="menu-item"><a href="<?php echo UHD_URL ?>/mypurchased.php">수업 신청 목록<span class="label label-primary">0</span></a></li>
        <li class="menu-item"><a href="<?php echo G5_SHOP_URL ?>/cart.php">장바구니 <span class="label">0</span></a></li>
        <li class="menu-item"><a href="<?php echo G5_SHOP_URL ?>/wishlist.php">위시리스트 <span class="label">0</span></a></li>
        <li class="menu-item"><a href="<?php echo G5_SHOP_URL ?>/coupon.php">쿠폰 관리</a></li>
        <li class="menu-item menu-divider"><a href="<?php echo G5_BBS_URL ?>/discover.php?bo_table=portfolio"><strong>포트폴리오 관리</strong></a></li>
        <li class="menu-item"><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u">내 정보</a></li>
        <li class="menu-item"><a href="<?php echo G5_BBS_URL ?>/reg_teacher_infomation.php?w=u">강의 공통사항 관리</a></li>
        <li class="menu-item"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
        <?php if ($is_admin) echo '<li class="menu-item"><a href="'.G5_ADMIN_URL.'" target="_blank">관리자 콘솔</a></li>' ?>
    </ul>
</div>